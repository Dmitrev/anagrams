<?php


namespace Dmitrev\Angrams\Helper;


class Str
{
    /**
     * Sort all the characters in a string alphabetically
     * @param string $str
     * @return string
     */
    public static function sort(string $str): string
    {
        $sorted = str_split($str);
        sort($sorted);

        return implode('', $sorted);
    }
}
