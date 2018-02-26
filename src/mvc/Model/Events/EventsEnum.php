<?php

namespace Model\Events;

/**
 * Class EventsEnum
 *
 * @package Model\Events
 */
class EventsEnum {

    const EVENT_VIEW = 'view';
    const EVENT_PLAY = 'play';
    const EVENT_CLICK = 'click';

    /**
     * @return string[]
     */
    public static function getAvailableEvents() {
        return [self::EVENT_VIEW, self::EVENT_PLAY, self::EVENT_CLICK];
    }

}