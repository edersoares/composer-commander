<?php

namespace Dex\Composer\Commander\Tests\Fixtures;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SuccessCommanderCommand extends BaseCommand
{
    protected function configure()
    {
        $this->setName('success:commander');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Running commands from commander.json');

        return 0;
    }
}
