<?php

namespace App\Entity;

use App\Service\Traits\CaseConverter;
use ReflectionException;
use ReflectionProperty;

abstract class AbstractEntity
{
    use CaseConverter;

    abstract public function getWriteableFields(): array;
    abstract public function getReadableFields(): array;

    /**
     * @return array
     */
    public function toArray(): array
    {
        $arr = [];

        foreach ($this->getReadableFields() as $fieldName) {
            $getter = 'get' . ucfirst($fieldName);

            if (method_exists($this, $getter)) {
                $value = $this->$getter();

                if (is_object($value) && method_exists($value, 'toArray')) {
                    $value = $value->toArray();
                }

                $arr[$this->toSnakeCase($fieldName)] = $value;
            }
        }

        return $arr;
    }
}