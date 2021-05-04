<?php

namespace App\Service\Algorithms;

class Algorithm
{
    private array $algorithmsList;
    private AlgorithmInterface $algorithm;

    public function __construct()
    {
        $this->algorithmsList = [
            AddTwoNumbers::getName() => AddTwoNumbers::class,
            SplitIntoGroups::getName() => SplitIntoGroups::class,
            TwoSum::getName() => TwoSum::class,
        ];
    }

    public function getInfo(): array
    {
        return [
            AddTwoNumbers::getName() => AddTwoNumbers::getDescription(),
            SplitIntoGroups::getName() => SplitIntoGroups::getDescription(),
            TwoSum::getName() => TwoSum::getDescription(),
        ];
    }

    public function setAlgorithm(AlgorithmInterface $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    public function execute(): array
    {
        if (!isset($this->algorithm)) {
            return [];
        }

        return $this->algorithm->run();
    }

    public function getAlgorithmsList(): array
    {
        return array_keys($this->algorithmsList);
    }

    public function resolve(string $alg): ?AlgorithmInterface
    {
        if (!array_key_exists($alg, $this->algorithmsList)) {
            return null;
        }

        return new $this->algorithmsList[$alg]();
    }

    /**
     * @todo bad practice
     */
    public function buildAlgorithm(AlgorithmInterface $algorithm): AlgorithmInterface
    {
        if ($algorithm instanceof AddTwoNumbers) {
            $algorithm->setArr1([2, 4, 3]);
            $algorithm->setArr2([5, 6, 4]);
        }
        if ($algorithm instanceof SplitIntoGroups) {
            $algorithm->setString('Привет мир! Это проект Максима по изучению алгоритмов!'); // 54 symbols
        }
        if ($algorithm instanceof TwoSum) {
            $algorithm->setNums([2, 7, 11, 15]);
            $algorithm->setTarget(26);
        }

        return $algorithm;
    }
}
