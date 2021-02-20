<?php

namespace Tests\Service;

use ArrayIterator;
use Dmitrev\Angrams\Service\AnagramFinder;
use Tests\TestCase;

class AnagramFinderTest extends TestCase
{
    /**
     * @group me
     */
    public function testCanFindEasyAnagram()
    {
        $data = [
          'aaa',
          'abc',
          'cab',
          'bca',
          'acb',
        ];

        $finder = new AnagramFinder(
            new ArrayIterator($data)
        );

        $expected = [
            ['aaa'],
            ['abc', 'cab', 'bca', 'acb'],
        ];

        $actual = [];

        foreach ($finder->getAll() as $item) {
            $actual = array_merge($actual, $item);
        }

        $this->assertEquals($expected, $actual);
    }

    public function testCanFindMixedSizeAnagram()
    {
        $data = [
            'ab',
            'ba',
            'cab',
            'bca',
            'acb',
        ];

        $finder = new AnagramFinder(
            new ArrayIterator($data)
        );

        $expected = [
            ['ab', 'ba'],
            ['cab', 'bca', 'acb'],
        ];

        $actual = [];

        foreach ($finder->getAll() as $item) {
            $actual = array_merge($actual, $item);
        }

        $this->assertEquals($expected, $actual);
    }

    public function testCanHandleNonResetIterator()
    {
        $data = [
            'ab',
            'ba', // <- We will manually set the iterator to start here
            'cab',
            'bca',
            'acb',
        ];

        $iterator = new ArrayIterator($data);
        $iterator->next();

        $finder = new AnagramFinder(
            $iterator
        );

        $firstResult = $finder->getAll()->current();

        $this->assertEquals([
            ['ab', 'ba']
        ], $firstResult);
    }
}
