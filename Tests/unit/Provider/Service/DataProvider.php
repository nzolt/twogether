<?php


namespace Tests\unit\Provider\Service;


class DataProvider
{
	public static function provideProcessData()
	{
		return [
            [
                array (
                    0 =>
                        array (
                            0 => '2021-06-29',
                            1 => 1,
                            2 => 0,
                            3 => 'Dave',
                        ),
                    1 =>
                        array (
                            0 => '2021-07-14',
                            1 => 1,
                            2 => 0,
                            3 => 'Sam',
                        ),
                    2 =>
                        array (
                            0 => '2021-07-22',
                            1 => 0,
                            2 => 1,
                            3 => 'Alex, Jen',
                        ),
                    3 =>
                        array (
                            0 => '2021-07-23',
                            1 => 1,
                            2 => 0,
                            3 => 'Pete',
                        ),
                    4 =>
                        array (
                            0 => '2021-09-07',
                            1 => 0,
                            2 => 1,
                            3 => 'Rob, Ray',
                        ),
                ),
                array (
                    0 =>
                        array (
                            'name' => 'Pete',
                            'bday' => '2021-07-21',
                        ),
                    1 =>
                        array (
                            'name' => 'Jen',
                            'bday' => '2021-07-20',
                        ),
                    2 =>
                        array (
                            'name' => 'Rob',
                            'bday' => '2021-09-04',
                        ),
                    3 =>
                        array (
                            'name' => 'Dave',
                            'bday' => '2021-06-25',
                        ),
                    4 =>
                        array (
                            'name' => 'Alex',
                            'bday' => '2021-07-19',
                        ),
                    5 =>
                        array (
                            'name' => 'Sam',
                            'bday' => '2021-07-12',
                        ),
                    6 =>
                        array (
                            'name' => 'Ray',
                            'bday' => '2021-09-05',
                        ),
                )
            ]
        ];
	}
}