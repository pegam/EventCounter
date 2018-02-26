<?php

require_once __DIR__ . '/../src/lib/Core/Db/Db.php';
require_once __DIR__ . '/../src/lib/Core/Formatter/FormatEnum.php';
require_once __DIR__ . '/../src/lib/Core/Formatter/JsonFormatter.php';
require_once __DIR__ . '/../src/lib/Core/Formatter/CsvFormatter.php';
require_once __DIR__ . '/../src/lib/Core/Formatter/XmlFormatter.php';
require_once __DIR__ . '/../src/lib/Core/Cache/ApiCache.php';

use \Core\Db\Db;
use \Core\Formatter\FormatEnum;
use \Core\Formatter\JsonFormatter;
use \Core\Formatter\CsvFormatter;
use \Core\Formatter\XmlFormatter;
use \Core\Cache\ApiCache;

/**
 * Class JobWorker
 */
class JobWorker {

    /** @var array */
    private $internalCache = [];

    /** @var int */
    private $previousTime = 0;

    public function storeData(array $data) {
        $this->updateInternalCache($data);
        if ($this->shouldSave()) {
            $this->saveToDb();
            $this->updateCache();
            $this->internalCache = [];
            $this->previousTime = time();
        }
    }

    private function updateInternalCache(array $data) {
        $date = $data['date'];
        $country = $data['country'];
        $event = $data['event'];
        if (isset($this->internalCache[$date][$country][$event])) {
            $this->internalCache[$date][$country][$event] += 1;
        } else {
            $this->internalCache[$date][$country][$event] = 1;
        }
    }

    /**
     * @return bool
     */
    private function shouldSave() {
        $now = time();
        return $now - $this->previousTime > 1;
    }

    /**
     * @return void
     */
    private function saveToDb() {
        Db::instance()->startTransaction();
        try {
            $this->saveEventCount();
            $this->saveGlobalStatistics();
            Db::instance()->commit();
        } catch (Exception $e) {
            Db::instance()->rollBack();
        }
    }

    /**
     * @return void
     */
    private function saveEventCount() {
        foreach ($this->internalCache as $date => $countries) {
            foreach ((array)$countries as $country => $events) {
                foreach ((array)$events as $event => $count) {
                    $sql = 'INSERT INTO EventsCount (EventDate, Country, Event, EventCount)
                            VALUES (:date, :country, :event, :count)
                            ON DUPLICATE KEY UPDATE EventCount = EventCount + :count';
                    $params = [
                        ':date' => $date,
                        ':country' => $country,
                        ':event' => $event,
                        ':count' => $count,
                    ];
                    Db::instance()->query($sql, $params);
                }
            }
        }
    }

    private function saveGlobalStatistics() {
        $countryCount = [];
        foreach ($this->internalCache as $countries) {
            foreach ((array)$countries as $country => $events) {
                foreach ((array)$events as $count) {
                    if (isset($countryCount[$country])) {
                        $countryCount[$country] += $count;
                    } else {
                        $countryCount[$country] = $count;
                    }
                }
            }
        }
        foreach ($countryCount as $country => $count) {
            $sql = 'INSERT INTO CountriesCount (Country, EventCount)
                    VALUES  (:country, :count)
                    ON DUPLICATE KEY UPDATE EventCount = EventCount + :count';
            $params = [':country' => $country, ':count' => $count];
            Db::instance()->query($sql, $params);
        }
    }

    private function updateCache() {
        $data = $this->getTopCounts();
        $formatter = new JsonFormatter();
        $formatted = $formatter->format($data);
        $key = 'events_count_' . FormatEnum::FORMAT_JSON;
        ApiCache::instance()->set($key, $formatted);
        $formatter = new CsvFormatter();
        $formatted = $formatter->format($data);
        $key = 'events_count_' . FormatEnum::FORMAT_CSV;
        ApiCache::instance()->set($key, $formatted);
        $formatter = new XmlFormatter();
        $formatted = $formatter->format($data);
        $key = 'events_count_' . FormatEnum::FORMAT_XML;
        ApiCache::instance()->set($key, $formatted);
    }

    /**
     * @return array
     */
    private function getTopCounts() {
        $sql = 'SELECT Country FROM CountriesCount ORDER BY EventCount DESC LIMIT 5';
        $topCountries = Db::instance()->get($sql);
        $countries = '""';
        foreach ($topCountries as $country) {
            $countries .= ',"' . $country['Country'] . '"';
        }
        $sql = "SELECT EventDate, Country, Event, SUM(EventCount) as Count
                FROM EventsCount
                WHERE Country IN ({$countries})
                  AND EventDate > :dateMin AND EventDate <= :dateMax
                GROUP BY Country, Event, EventDate
                ORDER BY EventDate DESC, Country, Count DESC";
        $params = [':dateMax' => date('Y-m-d'), ':dateMin' => date('Y-m-d', strtotime('-7 days'))];
        $records = Db::instance()->get($sql, $params);
        $result = [];
        foreach ($records as $row) {
            $result[] = [
                'Date' => $row['EventDate'],
                'Country' => $row['Country'],
                'Event' => $row['Event'],
                'Count' => $row['Count']
            ];
        }
        return $result;
    }

}