<?php


namespace App\Enums;


class SearchByType
{
    const LEVEL = 'level';
    const DESCRICAO = 'log';
    const AMBIENCE = 'ambience';
    const EMPTY = '';

    public static $types = [self::LEVEL, self::AMBIENCE, self::DESCRICAO, self::EMPTY];
}
