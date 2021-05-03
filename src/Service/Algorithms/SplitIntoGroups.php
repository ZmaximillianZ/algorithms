<?php

namespace App\Service\Algorithms;

class SplitIntoGroups extends AbstractAlgorithm implements AlgorithmInterface
{
    protected const INFO = 'Take characters in reverse order, split into groups of the same length (the latter may be less) so that no more than 10 groups. For each group, calculate the hash character as the bitwise xor of all characters in the group';
    private const XOR_HASH_KEY = 'key';
    private const GROUPS_LIMIT = 10;

    private string $string;

    public static function getName(): string
    {
        return 'split-into-groups';
    }

    public function setString(string $string)
    {
        $this->string = $string;
    }

    public function run(): array
    {
        return $this->splitIntoGroups($this->strRev($this->string));
    }

    private function strRev(string $str): string
    {
        $len = mb_strlen($str);
        $result = '';
        for ($i = $len; $i >= 0; --$i) {
            $result .= mb_substr($str, $i, 1);
        }

        return $result;
    }

    private function xorString($string)
    {
        return $string ^ self::XOR_HASH_KEY;
    }

    private function splitIntoGroups(string $string): array
    {
        $len = mb_strlen($string);
        $groupCount = 0;
        $numbers = 0;

        for ($i = self::GROUPS_LIMIT; $i > 1; --$i) {
            $reminder = $len % $i;
            if (0 === $reminder) {
                $numbers = $reminder;
                $groupCount = $i;
                break;
            }
            if ($reminder < $numbers) {
                $numbers = $reminder;
                $groupCount = $i + 1;
                break;
            }
            $numbers = $reminder;
        }

        $groups = [];
        $offset = 0;
        $int = round(mb_strlen(mb_substr($string, $numbers)) / $groupCount);
        for ($i = 1; $i <= $groupCount; ++$i) {
            if ($i === $groupCount) {
                $groups[] = $this->xorString(mb_substr($string, $offset));
                break;
            }
            $groups[] = $this->xorString(mb_substr($string, $offset, $int));
            $offset += $int;
        }

        return $groups;
    }
}
