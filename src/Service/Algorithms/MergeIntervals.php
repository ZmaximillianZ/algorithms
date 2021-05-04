<?php

namespace App\Service\Algorithms;


class MergeIntervals extends AbstractAlgorithm implements AlgorithmInterface
{
    protected const INFO = 'Given an array of intervals where intervals[i] = [starti, endi], merge all overlapping intervals, and return an array of the non-overlapping intervals that cover all the intervals in the input.';

    private array $intervals;

    public static function getName(): string
    {
        return 'merge-intervals';
    }

    public function setIntervals(array $intervals)
    {
        $this->intervals = $intervals;
    }

    public function run(): array
    {
        if (!isset($this->intervals)) {
            return [];
        }
        return $this->merge($this->intervals);
    }

    private function merge(array $intervals): array
    {
        $result = [];
        $next = [];
        for ($i = 0; $i < count($intervals); ++$i) {
            $current = $intervals[$i];
            if (isset($intervals[$i + 1])) {
                $next = $intervals[$i + 1];
            }
            if (!empty($next) && $current[1] >= $next[0]) {
                $result[] = [$current[0], $next[1]];
                $next = [];
                ++$i;
                continue;
            }
            $result[] = $current;
            $next = [];
        }

        return $result;
    }
}
