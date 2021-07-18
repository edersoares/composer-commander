<?php

namespace Dex\Composer\Commander\Tests\Fixtures;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SuccessCommand extends Command
{
    protected function configure()
    {
        $this->setName('success');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Success');

        return 0;
    }
}
