<?php
namespace NerdsAndCompany\Composer\Util;

/**
 * Filesystem class
 */
class Filesystem extends \Composer\Util\Filesystem
{
    /**
     * Creates a symbolic link
     *
     * @param string $target Target of the link.
     * @param string $name The link name.
     *
     * @return bool true on success or false on failure.
     */
    final public function symlink($target, $name)
    {
        return symlink($target, $name);
    }
}
