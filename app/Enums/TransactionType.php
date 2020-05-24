<?php

namespace App\Enums;

class TransactionType
{
    const IN = 'in';
    const OUT = 'out';

    public static function getAll()
    {
        return [
            self::IN,
            self::OUT,
        ];
    }
}