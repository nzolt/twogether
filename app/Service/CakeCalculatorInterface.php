<?php

namespace App\Service;

interface CakeCalculatorInterface
{
    /**
     * @param string $filenameIn
     * @param $filenameOut
     * @param string|false $return
     * @return array
     */
    public function calculate(string $filenameIn, $filenameOut, string $return = ''): array;

    /**
     * @param array $bdays
     * @return array[]
     */
    public function processDates(array $bdays): array;

    /**
     * @param array $cakes
     * @param false $big
     * @return array
     */
    public function getCakeDate(array $cakes, $big = false): array;

    /**
     * @param array $cakeDates
     * @return array
     */
    public function formatToFile(array $cakeDates): array;

    /**
     * @param array $data
     * @param string $fileOut
     */
    public function writeToFile(array $data, string $fileOut): void;
}