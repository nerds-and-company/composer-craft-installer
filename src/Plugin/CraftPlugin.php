<?php

namespace NerdsAndCompany\Composer\Plugin;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use NerdsAndCompany\Composer\Factory;

/**
 * Composer Installer for Craft
 */
class CraftPlugin implements PluginInterface
{
    //////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    final public function activate(Composer $composer, IOInterface $io)
    {
        $installer = Factory::createCraftInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}
