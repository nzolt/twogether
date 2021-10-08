<?php

namespace App\Factory;

use App\Exceptions\InvalidDateException;
use App\Service\CakeCalculator;
use App\Exceptions\InvalidFileException;

class CakeCalculatorFactory
{
    /**
     * @param string $filenameIn
     * @param string $filenameOut
     * @param bool $return
     * @return array
     */
    public static function calculate(string $filenameIn, string $filenameOut, string $return = ''): array
    {
        $cakeClass = new CakeCalculator();
        try {
            return $cakeClass->calculate($filenameIn, $filenameOut, $return);
        } catch (InvalidFileException $e){
            return [$e->getCode(), $e->getMessage()];
        } catch (InvalidDateException $e){
            return [$e->getCode(), $e->getMessage()];
        }
    }
}