<?php

namespace Dex\Composer\Commander\Tests\Unit;

use Dex\Composer\Commander\Tests\Application;
use Dex\Composer\Commander\Tests\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

class CommanderPluginTest extends TestCase
{
    private string $directory = __DIR__ . '/../Fixtures/Plugin';

    public function test()
    {
        $application = new Application();
        $input = new StringInput('commands');
        $output = new BufferedOutput();

        $application->doRun($input, $output);

        $this->assertStringContainsString('There are no custom commands', $output->fetch());
    }

    public function testCommandsInComposerJson()
    {
        $application = new Application();
        $input = new StringInput('success -d ' . $this->directory);
        $output = new BufferedOutput();

        $application->doRun($input, $output);

        $this->assertStringContainsString('Success', $output->fetch());
    }

    public function testCommandsInCommanderJson()
    {
        $application = new Application();
        $input = new StringInput('success:commander -d ' . $this->directory);
        $output = new BufferedOutput();

        $application->doRun($input, $output);

        $this->assertStringContainsString('Running commands from commander.json', $output->fetch());
    }
}
