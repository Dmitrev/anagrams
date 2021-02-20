<?php

namespace Dmitrev\Angrams\Service;

use Dmitrev\Angrams\Helper\Str;
use Generator;
use Iterator;

class AnagramFinder
{

    public function __construct(
        private Iterator $iterator
    ) {}

    /**
     * @param array $words
     * @return string[][]
     */
    public function groupWords(array $words): array
    {
        $anagrams = [];

        foreach ($words as $word) {
            $key = Str::sort($word);
            $anagrams[$key][] = $word;
        }

        return array_values($anagrams);
    }

    public function getAll(): Generator
    {
        $currentLength = strlen($this->iterator->current());
        $buffer = [];

        while($this->iterator->valid()) {
            $currentWord = $this->iterator->current();

            // We reached a longer word
            if (strlen($currentWord) !== $currentLength) {
                yield $this->groupWords($buffer);
                $currentLength = strlen($currentWord);
                $buffer = [];
            }

            $buffer[] = $currentWord;
            $this->iterator->next();
        }

        yield $this->groupWords($buffer);
    }
}
