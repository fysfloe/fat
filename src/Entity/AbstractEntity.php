<?php

namespace App\Entity;

use App\Service\Traits\CaseConverter;

abstract class AbstractEntity
{
    use CaseConverter;

    abstract public function getWriteableFields(): array;
    abstract public function getReadableFields(): array;

    public function toArray(): array
    {
        $arr = [];

        foreach ($this->getReadableFields() as $fieldName) {
            $getter = 'get' . ucfirst($fieldName);

            if (method_exists($this, $getter)) {
                $arr[$this->toSnakeCase($fieldName)] = $this->$getter();
            }
        }

        return $arr;
    }
}