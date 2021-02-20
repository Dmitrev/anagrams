<?php


namespace Dmitrev\Angrams\Service;


use Exception;

class FileLoader
{
    /**
     * @param $path
     * @return FileIterator
     * @throws Exception
     */
    public static function loadFile($path): FileIterator
    {
        if (!file_exists($path)) {
            throw new Exception("File: {$path} does not exist");
        }

        $file = fopen($path, 'r');

        // Don't worry about file close. PHP will handle that on shutdown

        return new FileIterator($file);
    }
}
