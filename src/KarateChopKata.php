<?php
declare(strict_types=1);

namespace App;

/**
 * @see http://codekata.com/kata/kata02-karate-chop/
 */
class KarateChopKata
{
    /**
     * @return int index of target in haystack
     */
    public static function chop(array $array, int $target): int
    {
        // no data -> no index
        if ($array === []) {
            return -1;
        }

        // array has 1 element, it's it if value matches
        if (count($array) === 1) {
            return reset($array) !== $target
                ? -1
                : array_keys($array)[0];
        }

        // split array & recursively search in it
        $chopIndex = intval(floor(count($array) / 2));
        $parts = [
            array_slice($array, 0, $chopIndex, preserve_keys: true),
            array_slice($array, $chopIndex, preserve_keys: true)
        ];
        foreach ($parts as $part) {
            // target in part ? -> chop again
            if ($target >= reset($part) && $target <= end($part)) {
                return self::chop($part, $target);
            }
        }

        // no result in any part
        return -1;
    }

}

