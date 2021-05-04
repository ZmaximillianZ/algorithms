<?php

namespace App\Service\Algorithms;

class TwoSum extends AbstractAlgorithm implements AlgorithmInterface
{
    protected const INFO = 'Given an array of integers nums and an integer target, return indices of the two numbers such that they add up to target. You may assume that each input would have exactly one solution, and you may not use the same element twice. You can return the answer in any order.';

    private array $nums;

    private int $target;

    public function setNums(array $nums): void
    {
        $this->nums = $nums;
    }

    public function setTarget(int $target): void
    {
        $this->target = $target;
    }

    public static function getName(): string
    {
        return 'two-sum';
    }

    public function run(): array
    {
        if (!isset($this->nums) || !isset($this->target)) {
            return [];
        }

        return $this->calculate($this->nums);
    }

    /**
     * brute force
     */
    private function calculate(array $arr): array
    {
        $result = [];
        $count = count($arr);
        for ($i = 0; $i < $count; $i++) {
            $currentNumber = $arr[$i];
            for ($j = 0; $j < $count; $j++) {
                if (($currentNumber + $arr[$j]) === $this->target) {
                    $result = [$i, $j];
                    break;
                }
            }
        }

        return $result;
    }
}