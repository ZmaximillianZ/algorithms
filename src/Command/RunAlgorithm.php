<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\Algorithms\Algorithm;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunAlgorithm extends Command
{
    private const ARG_ALG = 'alg';
    private const ARG_ALG_LIST = 'alg-list';
    private const ARG_ALG_DESCRIPTION = 'alg-description';

    protected static $defaultName = 'run-algorithm';
    private Algorithm $algorithm;

    public function __construct(Algorithm $algorithm)
    {
        parent::__construct();
        $this->algorithm = $algorithm;
    }

    protected function configure()
    {
        $this->addArgument(self::ARG_ALG, InputArgument::OPTIONAL, 'name of algorithm');
        $this->addOption(
            self::ARG_ALG_LIST,
            self::ARG_ALG_LIST,
            null,
            'list of algorithms',
        );
        $this->addOption(
            self::ARG_ALG_DESCRIPTION,
            self::ARG_ALG_DESCRIPTION,
            null,
            'Description of algorithms',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $algList = $input->getOption(self::ARG_ALG_LIST);
        $algDescription = $input->getOption(self::ARG_ALG_DESCRIPTION);
        $algorithmsList = $this->algorithm->getAlgorithmsList();
        if ($algDescription) {
            $output->writeln(implode("\n\n", $this->algorithm->getInfo()));

            return Command::SUCCESS;
        }
        if ($algList) {
            $output->writeln(implode("\n", $algorithmsList));

            return Command::SUCCESS;
        }

        $alg = $input->getArgument(self::ARG_ALG);
        if (!in_array($alg, $algorithmsList, true)) {
            $output->writeln(sprintf('%s algorithm does not exist!', $alg));

            return Command::SUCCESS;
        }
        $algorithm = $this->algorithm->buildAlgorithm($this->algorithm->resolve($alg));
        $this->algorithm->setAlgorithm($algorithm);
        $output->writeln($this->algorithm->execute());

        return Command::SUCCESS;
    }
}
