<?php

namespace Tests\Unit;

use App\Helpers\DateHelper;
use App\Service\CakeCalculator;
use PHPUnit\Framework\TestCase;

/**
 * @package Tests
 * @group unit
 * @group ready
 */
class CakeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * @dataProvider \Tests\unit\Provider\Service\DataProvider::provideProcessData
     */
    public function testProcessData($expected, $data)
    {
        $calculator = new CakeCalculator();
        $this->assertSame($expected, $calculator->processData($data));
    }
}
