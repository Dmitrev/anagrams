<?php

require __DIR__.'/vendor/autoload.php';

use Dmitrev\Angrams\Service\AnagramFinder;
use Dmitrev\Angrams\Service\FileLoader;
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
        $iterator = null;

        try {
            $iterator = FileLoader::loadFile(__DIR__ . '/data/example1.txt');
        } catch (Exception $e) {
            $this->fatal($e->getMessage());
            // Program terminates...
        }

        $finder = new AnagramFinder($iterator);
        $finder->setOutputHandler(
            fn($message) => $this->info($message)
        );


    }
}
// execute it
$cli = new Anagram();
$cli->run();
