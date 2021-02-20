<?php

namespace Dmitrev\Angrams\Service;

use InvalidArgumentException;
use Iterator;

class FileIterator implements Iterator
{
    /**
     * @var resource
     */
    private $file;

    public function __construct($file)
    {
        if (!is_resource($file)) {
            throw new InvalidArgumentException('Argument has to be a resource');
        }

        $this->file = $file;
    }

    public function current()
    {
        $current = ftell($this->file);
        $line = fgets($this->file);

        // Move back the pointer
        fseek($this->file, $current);
        return trim($line);
    }

    public function next()
    {
        fgets($this->file);

        // Skip empty lines
        if (!feof($this->file) && empty($this->current())) {
            $this->next();
        }
    }

    public function key()
    {
        return ftell($this->file);
    }

    public function valid()
    {
        return !feof($this->file);
    }

    public function rewind()
    {
        fseek($this->file, 0);
    }
}
