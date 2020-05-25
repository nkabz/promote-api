<?php

namespace App\Enums;

class TransactionType
{
    const BALANCEIN = 'balancein';
    const BALANCEOUT = 'balanceout';
    const SERVER = 'server';

    public static function getAll()
    {
        return [
            self::BALANCEIN,
            self::BALANCEOUT,
            self::SERVER,
        ];
    }
}