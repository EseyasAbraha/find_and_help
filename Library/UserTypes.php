<?php

namespace App\Library;

if (!defined('ACCESS')) { die; }

class UserTypes
{
    private static $types = ['student', 'teacher'];

    public static function validType(): bool
    {
        $return = !isset($_GET['type']) || !in_array($_GET['type'], self::$types);
        if ($return) {
            include __DIR__.'/../pages/404.php';
        }
        return $return;
    }

    public static function typeIndex(string $type): int
    {
        return array_search($type, self::$types);
    }

    public static function typeName(int $type): string
    {
        return self::$types[$type];
    }

    public static function getTypes(): array
    {
        return self::$types;
    }
}
