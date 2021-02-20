<?php

require __DIR__.'/vendor/autoload.php';

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

class Anagram extends CLI
{
    protected function setup(Options $options)
    {
        $options->setHelp('Finds anagrams in given text file');
    }

    protected function main(Options $options)
    {

    }
}
// execute it
$cli = new Anagram();
$cli->run();
