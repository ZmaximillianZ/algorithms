<?php

namespace App\Service\Algorithms;

use PHPUnit\Framework\TestCase;

class MergeIntervalsTest extends TestCase
{
    /**
     * @dataProvider getMergeProvider
     */
    public function testMerge(array $intervals, array $expected): void
    {
        $mergeIntervals = new MergeIntervals();
        $mergeIntervals->setIntervals($intervals);

        $this->assertEquals($expected, $mergeIntervals->run());
    }

    public function getMergeProvider(): array
    {
        return [
            [
                [[1, 3],[2, 6],[8, 10],[15, 18]],
                [[1, 6],[8, 10],[15, 18]]
            ],
            [
                [[1, 4],[4, 5]],
                [[1, 5]]
            ],
            [
                [[0, 3], [0, 1]],
                [[0, 3]],
            ],
        ];
    }
}
