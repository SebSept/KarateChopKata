<?php
declare(strict_types=1);

namespace App;

/**
 * @see http://codekata.com/kata/kata02-karate-chop/
 */
class KarateChopKata
{
    /**
     * @return int index of target in array | -1 if target is not found
     */
    public static function chop(array $array, int $target): int
    {
        // no data
        if ($array === []) {
            return -1;
        }

        // array has 1 element, it's it if value matches
        if (count($array) === 1) {
            return (reset($array) !== $target) ? -1 : array_keys($array)[0];
        }

        // split array & recursively search in it
        // The choice of floor() here is arbitrary as ceil() or round() would yield
        // the same final result. The critical aspects are index preservation and
        // the range validation in each part of the array.
        $chopIndex = intval(round(count($array) / 2));
        $parts = [
            array_slice($array, 0, $chopIndex, preserve_keys: true),
            array_slice($array, $chopIndex, preserve_keys: true),
        ];
        foreach ($parts as $part) {
            // target in part ? -> chop again
            if ($target >= reset($part) && $target <= end($part)) {
                return self::chop($part, $target);
            }
        }

        return -1;
    }
}
