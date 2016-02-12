<?php

namespace NerdsAndCompany\Composer\Plugin;

use Composer\Composer;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;
use NerdsAndCompany\Composer\Util\Filesystem;

/**
 * Composer Installer for Craft Plugins
 *
 * @property FileSystem $filesystem
 */
class CraftInstaller extends LibraryInstaller
{
    const PACKAGE_TYPE = 'craft-library';

    //////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    final public function __construct(IOInterface $io, Composer $composer, $type, Filesystem $filesystem)
    {
        parent::__construct($io, $composer, $type, $filesystem);
    }

    /**
     * @param string $packageType
     * @return bool
     */
    final public function supports($packageType)
    {
        return $packageType === self::PACKAGE_TYPE;
    }

    final public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);

        $this->cleanup($package);
    }

    final public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        parent::update($repo, $initial, $target);

        $this->cleanup($target);
    }

    ////////////////////////////// UTILITY METHODS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * @param PackageInterface $package
     */
    private function cleanup(PackageInterface $package)
    {
        $this->filesystem->ensureDirectoryExists('craft');

        $subjects = [
            'craft/app',
            'craft/config',
            'craft/storage',
            'craft/.htaccess',
            'public',
            'templates',
        ];

        $installPath = $this->getInstallPath($package);

        $this->io->write(
            'Craft installer -- <info>creating symlinks</info>'
        );

        foreach ($subjects as $name) {

            $target = sprintf('%s/%s', $installPath, $name);

            if (file_exists($name) === true) {
                $this->io->writeError(
                    sprintf('  - Not creating symlink for <fg=yellow>%s</fg=yellow>, file already exists.', $name)
                );
            } else {
                $this->io->write(
                    sprintf('  - Creating symlink for <fg=yellow>%s</fg=yellow>', $name)
                );

                $this->filesystem->symlink($target, $name);
            }
        }
    }
}

/*EOF*/
