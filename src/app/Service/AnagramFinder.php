<?php

namespace Dmitrev\Angrams\Service;

use Dmitrev\Angrams\Helper\Str;
use Generator;
use Iterator;

class AnagramFinder
{
    private int $currentLength = 0;

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
        // Always make sure we are at the beginning of our input
        $this->iterator->rewind();

        $this->currentLength = strlen($this->iterator->current());
        $buffer = [];

        while($this->iterator->valid()) {
            $currentWord = $this->iterator->current();

            // We reached a longer word
            if ($this->longerThanPrevious($currentWord)) {
                yield $this->groupWords($buffer);
                $this->setNewLength($currentWord);
                $buffer = [];
            }

            $buffer[] = $currentWord;
            $this->iterator->next();
        }

        yield $this->groupWords($buffer);
    }

    public function longerThanPrevious(string $word): bool
    {
        return strlen($word) > $this->currentLength;
    }

    private function setNewLength(string $word)
    {
        $this->currentLength = strlen($word);
    }
}
