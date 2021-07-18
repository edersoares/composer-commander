<?php

namespace Dex\Composer\Commander;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdapterCommand extends BaseCommand
{
    public function __construct(
        protected Command $command
    ) {
        parent::__construct($this->getName());
    }

    public function getName(): ?string
    {
        return $this->command->getName();
    }

    public function getDescription(): ?string
    {
        return $this->command->getDescription();
    }

    public function getHelp(): ?string
    {
        return $this->command->getHelp();
    }

    public function getAliases(): array
    {
        return $this->command->getAliases();
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $this->command->ignoreValidationErrors();

        return $this->command->run($input, $output);
    }
}
