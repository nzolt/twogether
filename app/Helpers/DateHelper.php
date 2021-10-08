<?php

namespace App\Helpers;

use App\Exceptions\InvalidDateException;
use DateTime;
use DateInterval;

class DateHelper
{
    /**
     * ISO-8601 numeric representation of the day of the week
     * @param \DateTime $date
     * @return int
     */
    public static function getDayOfWeek(\DateTime $date): int
    {
        return $date->format('N');
    }

    /**
     * @param array $cakes
     * @return array
     */
    public static function sortByDate(array $cakes): array
    {
        usort($cakes, # Order by dates ascending
            function ($a, $b) {
                return $a['bday'] > $b['bday'];
            }
        );
        return $cakes;
    }

    /**
     * @param DateTime $nextDate
     * @return string
     */
    public static function getNextWorkingDay(string $date): string
    {
        $nextWorkingDay = [1, 2, 3];
        $nextMonday = [4];
        $nextTuesday = [5, 6, 7];
        $cakeDate = date_create($date);
        $christmasDay = date_create(date("Y") . '-12-25');
        $newYearsDay = date_create(date("Y") . '-01-01');
        $newYearsDay->add(new DateInterval('P1Y'));
        $nonWorkingDays = [
            self::checkWeekendDay($christmasDay)->format('Y-m-d'),
            $christmasDay->add(new DateInterval('P1D'))->format('Y-m-d'), # Christmas day already on a working day
            $newYearsDay->format('Y-m-d'),
        ];

        if($cakeDate instanceof DateTime) {
            $day = self::getDayOfWeek($cakeDate);
            switch (true) {
                case in_array($day, $nextWorkingDay):
                    $cakeDate->add(new DateInterval('P2D'));
                    break;
                case in_array($day, $nextMonday):
                    $cakeDate->modify('next monday');
                    break;
                case in_array($day, $nextTuesday):
                    $cakeDate->modify('next tuesday');
                    break;
            }
        } else {
            throw new InvalidDateException();
        }

        // Handle the exceptions. Bank holidays
        if(in_array($cakeDate->format('Y-m-d'), $nonWorkingDays)){
            $add = '';
            $cakeDate->add(new DateInterval('P1D'));
            $day = self::getDayOfWeek($cakeDate);
            if($day == 6){
                $add = 'P2D';
            } elseif ($day == 7){
                $add = 'P1D';
            }
            if($add != ''){
                $cakeDate->add(new DateInterval($add));
            }
        }

        return $cakeDate->format('Y-m-d');
    }

    /**
     * @param DateTime $date
     * @return DateTime
     * @throws \Exception
     */
    public static function checkWeekendDay(DateTime $date): DateTime
    {
        $day = self::getDayOfWeek($date);
        if($day == 6){
            $add = 'P2D';
        } elseif ($day == 7){
            $add = 'P1D';
        }
        if($add != ''){
            $date->add(new DateInterval($add));
        }

        return $date;
    }
}