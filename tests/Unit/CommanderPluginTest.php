<?php

namespace Dex\Composer\Commander\Tests\Unit;

use Dex\Composer\Commander\Tests\Application;
use Dex\Composer\Commander\Tests\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;

class CommanderPluginTest extends TestCase
{
    public function test()
    {
        $application = new Application();
        $input = new StringInput("commands");
        $output = new BufferedOutput();

        $application->doRun($input, $output);

        $this->assertStringContainsString('There are no custom commands', $output->fetch());
    }
}
