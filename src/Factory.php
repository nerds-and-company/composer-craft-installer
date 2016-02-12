<?php

namespace NerdsAndCompany\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use NerdsAndCompany\Composer\Plugin\CraftInstaller;
use NerdsAndCompany\Composer\Plugin\CraftPluginInstaller;
use NerdsAndCompany\Composer\Util\Filesystem;

final class Factory
{
    final public static function createCraftInstaller(
        IOInterface $io,
        Composer $composer,
        Filesystem $filesystem = null
    ) {
        return new CraftInstaller(
            $io,
            $composer,
            CraftInstaller::PACKAGE_TYPE,
            $filesystem ?: static::createFilesystem()
        );
    }

    final public static function createFilesystem()
    {
        return new Filesystem();
    }
}
