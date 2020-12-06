<?php

namespace App\Service\Traits;

trait CaseConverter
{
    protected function toSnakeCase(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }

    protected function toCamelCase(string $string): string
    {
        return str_replace('_', '', ucwords($string, '_'));
    }
}