<?php

namespace App\Enums;

class PostType
{
    const PICTURE = 'picture';
    const VIDEO = 'video';
    const TEXT = 'text';

    public static function getAll()
    {
        return [
            self::PICTURE,
            self::VIDEO,
            self::TEXT,
        ];
    }
}