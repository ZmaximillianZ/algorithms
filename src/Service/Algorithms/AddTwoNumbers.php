<?php

namespace App\Service\Algorithms;

/**
 * @see https://leetcode.com/problems/add-two-numbers/
 */
class AddTwoNumbers extends AbstractAlgorithm implements AlgorithmInterface
{
    protected const INFO = 'You are given two non-empty linked lists representing two non-negative integers. The digits are stored in reverse order, and each of their nodes contains a single digit. Add the two numbers and return the sum as a linked list. You may assume the two numbers do not contain any leading zero, except the number 0 itself';
    private array $arr1;
    private array $arr2;

    public static function getName(): string
    {
        return 'add-two-numbers';
    }

    public function setArr1(array $arr1): void
    {
        $this->arr1 = $arr1;
    }

    public function setArr2(array $arr2): void
    {
        $this->arr2 = $arr2;
    }

    public function run(): array
    {
        if (!isset($this->arr1) || !isset($this->arr2)) {
            return [];
        }

        return $this->calculate($this->revertArr($this->arr1), $this->revertArr($this->arr2));
    }

    private function calculate(array $arr1, array $arr2): array
    {
        $i = 0;
        $j = 0;
        $currentResult = 0;
        $is1 = true;
        $is2 = true;
        $arrResult = [];
        $count = 0;
        $d = 10;
        $reminder = 0;
        while ($is1 || $is2) {
            if ($is1 && isset($arr1[$i])) {
                $currentResult += $arr1[$i];
            } else {
                $is1 = false;
            }
            if ($is2 && isset($arr2[$j])) {
                $currentResult += $arr2[$j];
            } else {
                $is2 = false;
            }
            if (!($is1 || $is2) && 0 === $reminder) {
                break;
            }
            $currentResult += $reminder;
            $reminder = 0;
            if ($currentResult >= $d) {
                $arrResult[$count] = $currentResult % $d;
                ++$reminder;
            } else {
                $arrResult[$count] = $currentResult;
            }
            ++$i;
            ++$j;
            ++$count;
            $currentResult = 0;
        }

        return $arrResult;
    }

    private function revertArr(array $array): array
    {
        $result = [];
        for ($i = (count($array) - 1); $i >= 0; --$i) {
            $result[] = $array[$i];
        }

        return $result;
    }
}
