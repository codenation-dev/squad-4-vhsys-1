<?php


namespace App\Enums;


class OrderByType
{
    const LEVEL = 'level';
    const EVENTS = 'events';
    const EMPTY = '';

    public static $types = [self::LEVEL, self::EVENTS, self::EMPTY];
}
