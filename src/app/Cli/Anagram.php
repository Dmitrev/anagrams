<?php

namespace Dmitrev\Angrams\Cli;

use Exception;
use Dmitrev\Angrams\Service\AnagramFinder;
use Dmitrev\Angrams\Service\FileLoader;
use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

class Anagram extends CLI
{
    protected function setup(Options $options)
    {
        $options->setHelp('Finds anagrams in given text file');
        $options->registerArgument('file', 'The input where we need to search for anagrams');
    }

    protected function main(Options $options)
    {
        $iterator = null;

        $fileName = $options->getArgs()[0];
        try {
            $iterator = FileLoader::loadFile("/data/{$fileName}");
        } catch (Exception $e) {
            $this->fatal($e->getMessage());
            // Program terminates...
        }

        $finder = new AnagramFinder($iterator);

        foreach ($finder->getAll() as $group) {
            foreach ($group as $words) {
                $this->success(implode(', ', $words));
            }
        }
    }
}
