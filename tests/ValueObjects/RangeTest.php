<?php

namespace Tests\ValueObjects;

use Tests\TestCase;

class RangeTest extends TestCase
{
    /**
     * @test
     * @dataProvider getTestData
     * @param int $start
     * @param int $end
     * @param int $step
     * @param array $expectedArray
     */
    public function range(int $start, int $end, int $step, array $expectedArray)
    {
        $range = new Range($start, $end, $step);

        $this->assertTrue(isset($range->start));
        $this->assertTrue(isset($range->end));
        $this->assertTrue(isset($range->step));
        $this->assertTrue(isset($range->range));
        $this->assertSame($start, $range->start);
        $this->assertSame($end, $range->end);
        $this->assertSame($step, $range->step);
        $this->assertSame($expectedArray, $range->range);
        $this->assertSame(json_encode($expectedArray), (string) $range);
    }

    /**
     * @return array
     */
    public function getTestData()
    {
        return [
            [
                'start' => 1,
                'end' => 10,
                'step' => 1,
                'expectedArray' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
            ],
            [
                'start' => 1,
                'end' => 10,
                'step' => 2,
                'expectedArray' => [1, 3, 5, 7, 9]
            ],
            [
                'start' => 10,
                'end' => 1,
                'step' => -1,
                'expectedArray' => [10, 9, 8, 7, 6, 5, 4, 3, 2, 1]
            ]
        ];
    }
}
