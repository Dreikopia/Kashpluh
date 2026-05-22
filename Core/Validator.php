<?php

namespace Core;

class Validator
{
    protected $errors = [];

    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value ?? '');
        $length = strlen($value);

        return $length >= $min && $length <= $max;
    }
    public static function integerMin($value, $min = 1)
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            return false;
        }

        return (int) $value >= $min;
    }

    public static function date($value)
    {
        $date = strtotime($value);

        $today = strtotime(date('Y-m-d'));

        $oneYearAgo = strtotime('-1 year');

        // future date
        if ($date > $today) {
            return false;
        }

        // older than 1 year
        if ($date < $oneYearAgo) {
            return false;
        }

        return true;
    }

    public static function empty($value, $min = 1)
    {
        $value = trim($value ?? '');
        $length = strlen($value);

        return $length >= $min;
    }
}
