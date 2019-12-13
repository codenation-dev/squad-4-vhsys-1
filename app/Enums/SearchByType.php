<?php


namespace App\Enums;


class SearchByType
{
    const LEVEL = 'level';
    const DESCRICAO = 'log';
    const EVENTS = 'events';

    public static $types = [self::LEVEL, self::EVENTS, self::DESCRICAO];
}
