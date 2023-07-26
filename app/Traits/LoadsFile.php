<?php

namespace App\Traits;

use App\Exceptions\LoadsFileException;

trait LoadsFile
{
    /**
     * The directory containing the file to load.
     */
    protected string $path;

    /**
     * @throws LoadsFileException
     */
    protected function assertPathIsReadable(): void
    {
        if (! (is_dir($this->path) && is_readable($this->path))) {
            throw new LoadsFileException('Path does not exist or is not readable.');
        }
    }

    /**
     * @throws LoadsFileException
     */
    protected function assertPathHasFile($file): void
    {
        if (! (is_file($file) && is_readable($file))) {
            throw new LoadsFileException('Unable to read the file '.$file);
        }
    }
}
