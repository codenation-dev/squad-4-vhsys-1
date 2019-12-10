<?php


namespace App\Enums;


class OrderByType
{
    const LEVEL = 'level';
    const EVENTS = 'events';

    public static $types = [self::LEVEL, self::EVENTS];
}
