<?php


namespace Tests\Helper;


use Dmitrev\Angrams\Helper\Str;
use Tests\TestCase;

class StrTest extends TestCase
{
    /**
     * @group str
     * @dataProvider sortProvider
     * @param string $input
     * @param string $expected
     */
    public function testCanSort(string $input, string $expected)
    {
        $this->assertEquals($expected, Str::sort($input));
    }

    public function sortProvider(): array
    {
        return [
            ['abc', 'abc'],
            ['bac', 'abc'],
            ['acb', 'abc'],
            ['cab', 'abc'],
            ['cba', 'abc'],
            ['aaa', 'aaa'],
            ['zyx', 'xyz'],
            ['zxa', 'axz'],
        ];
    }

}
