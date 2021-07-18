<?php

namespace Dex\Composer\Commander\Tests;

use Composer\Composer;
use Composer\Console\Application as ComposerApplication;
use Dex\Composer\Commander\CommanderPlugin;

class Application extends ComposerApplication
{
    public function getComposer($required = true, $disablePlugins = null): Composer
    {
        $composer = parent::getComposer($required, $disablePlugins);

        $composer->getPluginManager()->addPlugin(new CommanderPlugin());

        return $composer;
    }
}
