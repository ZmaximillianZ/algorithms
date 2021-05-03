<?php

namespace App\Service\Algorithms;

abstract class AbstractAlgorithm
{
    public static function getDescription(): string
    {
        return sprintf("%s:\n%s", static::getName(), static::INFO);
    }

    abstract public static function getName(): string;
}
