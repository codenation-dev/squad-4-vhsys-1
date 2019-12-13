<?php


namespace App\Enums;


class AmbienceType
{
    const HOMOLOGACAO = 'Homologacao';
    const PRODUCAO = 'Producao';
    const DESENVOLVIMENTO = 'Desenvolvimento';
    const EMPTY = '';

    public static $types = [self::HOMOLOGACAO, self::PRODUCAO, self::DESENVOLVIMENTO, self::EMPTY];
}
