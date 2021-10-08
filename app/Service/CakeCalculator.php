<?php

namespace App\Service;

use App\Validators\DateValidator;
use App\Exceptions\InvalidFileException;
use App\Helpers\DateHelper;
use DateTime;

class CakeCalculator extends CakeCalculatorAbstract implements CakeCalculatorInterface
{
    /**
     * @param string $filenameIn
     * @param $filenameOut
     * @param string $return
     * @return array
     * @throws InvalidFileException
     */
    public function calculate(string $filenameIn, $filenameOut, string $return = ''): array
    {
        $bdays = $this->loadData($filenameIn);
        $cakes = $this->processData($bdays);

        // Prepare output data
        $cakesFull = array_merge(
            [["Date", "Number of Small Cakes", "Number of Large Cakes", "Names of people"]],
            $cakes
        );

        $this->writeToFile($cakesFull, $filenameOut);

        // Prepare data to cli
        if($return == 'Yes'){
            $cakeCli = [];
            foreach($cakes as $day){
                $cakeCli[] = [
                    "Date" => $day[0],
                    "Number of Small Cakes" => $day[1],
                    "Number of Large Cakes" => $day[2],
                    "Names of people" => $day[3]
                ];
            }
            return $cakeCli;
        }

        return [];
    }

    /**
     * @param string $filenameIn
     * @return array
     * @throws InvalidFileException
     */
    public function loadData(string $filenameIn): array
    {
        $csvMimes = array('text/csv', 'text/plain');
        if(!file_exists($filenameIn) || !in_array(mime_content_type($filenameIn), $csvMimes)){
            throw new InvalidFileException();
        }
        $bdays = [];
        $handle = fopen($filenameIn,'r');
        while ( ($data = fgetcsv($handle) ) !== FALSE ) {
            if(DateValidator::validateDate($data[1])) {
                $monthDay = date_create($data[1]);
                if ($monthDay) {
                    $bdays[] = ['name' => $data[0], 'bday' => date("Y") . $monthDay->format('-m-d')];
                    // We don't store the full DateTime object to save memory space.
                    // Anyway, we need current year.
                }
            }
        }

        return $bdays;
    }

    /**
     * @param array $bdays
     * @return array
     */
    public function processData(array $bdays): array
    {
        list($bigCakes, $smallCakes) = $this->processDates($bdays);

        return $this->formatToFile([
            'Big cakes' => $this->getCakeDate($bigCakes, true),
            'Small cakes' => $this->getCakeDate($smallCakes),
        ]);
    }

    /**
     * @param array $bdays
     * @return array[]
     */
    public function processDates(array $bdays): array
    {
        $bdays = DateHelper::sortByDate($bdays, 'bday'); # Overwrite the array, we don't need the original
        $bigCakes = [];
        $smallCakes = [];
        for($i = 0; $i < count($bdays); $i++){
            $currentKey = $i; # Get current key
            $currentDate = $bdays[$i]; # Get first birthday
            $currentDateTime = date_create($currentDate['bday']);
            $nextKey = $currentKey + 1; # Get second key
            if(array_key_exists($nextKey, $bdays)){
                $nextDate = $bdays[$nextKey]; # Get second start
                $nextDateTime = date_create($nextDate['bday']);
                $diff = date_diff($currentDateTime, $nextDateTime);
                if($diff->days == 1 && !array_key_exists($currentDate['bday'], $bigCakes)){
                    $bigCakes[$nextDate['bday']] = implode(', ', [$currentDate['name'], $nextDate['name']]);
                    $i++;
                } elseif(!array_key_exists($currentDate['bday'], $bigCakes)) {
                    $smallCakes[$currentDate['bday']] = $currentDate['name'];
                }
            } else {
                if(!array_key_exists($currentDate['bday'], $bigCakes)){
                    $smallCakes[$currentDate['bday']] = $currentDate['name'];
                }
            }
        }

        ksort($bigCakes, SORT_STRING); # Overwrite the array, we don't need the original
        ksort($smallCakes, SORT_STRING); # Overwrite the array, we don't need the original

        return [$bigCakes, $smallCakes];
    }

    /**
     * @param array $cakes
     * @param false $big
     * @return array
     */
    public function getCakeDate(array $cakes, $big = false): array
    {
        $cakeDates = [];
        foreach($cakes as $key => $names){
            $cakeDate = DateHelper::getNextWorkingDay($key);
            $cakeDates[$names] = $cakeDate;
        }

        return $cakeDates;
    }
}