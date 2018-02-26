<?php

namespace Controller\Api;

use Core\Controller\Controller;
use Core\Controller\GetInterface;
use Core\Controller\PostInterface;
use Core\Formatter\FormatEnum;
use Core\Formatter\PlainTextFormatter;
use Core\View\ViewInterface;
use Model\Events\EventsModel;
use Model\Events\Validator\EventsValidator;
use View\CsvView;
use View\JsonView;
use View\PlainTextView;
use View\XmlView;

class Events extends Controller implements GetInterface, PostInterface {

    /** @var string */
    private $outputFormat;

    /** @var array */
    private $responseData = [];

    /**
     * @return void
     * @throws \Exception
     */
    public function get() {
        $this->outputFormat = $this->request->getGetParams()->get('format');
        if (null === $this->outputFormat) {
            $this->outputFormat = FormatEnum::FORMAT_JSON;
        }
        if (!in_array($this->outputFormat, FormatEnum::getAvailableFormats())) {
            throw new \Exception('Bad format (format: ' . $this->outputFormat . ')', 400);
        }
        $model = new EventsModel();
        $this->responseData = $model->getData($this->outputFormat);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function post() {
        $incomingData = $this->request->getPostParams()->getAll();
        $validator = new EventsValidator();
        $validator->validate($incomingData);
        $model = new EventsModel();
        $model->saveData($incomingData);
    }

    /**
     * @return ViewInterface
     */
    public function getView() {
        $formatter = new PlainTextFormatter();
        switch ($this->outputFormat) {
            case FormatEnum::FORMAT_JSON:
                $view = new JsonView($this->responseData, $formatter);
                break;
            case FormatEnum::FORMAT_CSV:
                $view = new CsvView($this->responseData, $formatter);
                break;
            case FormatEnum::FORMAT_XML:
                $view = new XmlView($this->responseData, $formatter);
                break;
            default:
                $view = new PlainTextView('', $formatter);
                break;
        }
        return $view;
    }

}