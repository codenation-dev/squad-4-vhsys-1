<?php


namespace App\Enums;


class AmbienceType
{
    const HOMOLOGACAO = 'Homologacao';
    const PRODUCAO = 'Producao';
    const DESENVOLVIMENTO = 'Desenvolvimento';
    const VAZIO = '';

    public static $types = [self::HOMOLOGACAO, self::PRODUCAO, self::DESENVOLVIMENTO, self::VAZIO];
}
