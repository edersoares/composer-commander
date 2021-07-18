<?php

namespace Dex\Composer\Commander;

use Composer\Command\BaseCommand;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

class CommanderPlugin implements Capable, CommandProvider, PluginInterface
{
    private static array $commands = [];

    public function getCapabilities(): array
    {
        return [
            CommandProvider::class => static::class,
        ];
    }

    public function getCommands(): array
    {
        return [
            new CommandsCommand(static::$commands),
            ...static::$commands
        ];
    }

    public function activate(Composer $composer, IOInterface $io)
    {
        $extra = $composer->getPackage()->getExtra();

        $commands = $extra['composer-commander']['commands'] ?? [];
        $file = $extra['composer-commander']['file'] ?? 'commander.json';

        $this->loadCommands($commands);

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, true);

            $commands = $data['commands'] ?? [];

            $this->loadCommands($commands);
        }
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

    private function instanceCommand(string $command): BaseCommand
    {
        $command = new $command;

        if ($command instanceof BaseCommand) {
            return $command;
        }

        return new AdapterCommand($command);
    }

    private function loadCommands(array $commands)
    {
        foreach ($commands as $command) {
            static::$commands[] = $this->instanceCommand($command);
        }
    }
}
