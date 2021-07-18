<?php

namespace Dex\Composer\Commander;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandsCommand extends BaseCommand
{
    public function __construct(
        private array $commands,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('commands')
            ->setDescription('List all custom commands');
    }

    protected function formatCommandNameAndDescription(BaseCommand $command): array
    {
        return [
            "  <info>{$command->getName()}</info>",
            $command->getDescription(),
        ];
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (empty($this->commands)) {
            $output->writeln('<error>There are no custom commands</error>');

            return 1;
        }

        $commands = array_map(fn($command) => $this->formatCommandNameAndDescription($command), $this->commands);

        $output->writeln('<comment>Available custom commands:</comment>');
        $this->renderTable($commands, $output);

        return 0;
    }
}
