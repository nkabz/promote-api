<?php

namespace App\Enums;

class UserType
{

    const _PUBLIC = 'public';
    const SUBSCRIPTOR = 'subscriptor';

    public static function getAll()
    {
        return [
            self::_PUBLIC,
            self::SUBSCRIPTOR,
        ];
    }
}