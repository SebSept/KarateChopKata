<?php

namespace App;

/**
 * @see http://codekata.com/kata/kata02-karate-chop/
 */
class KarateChopKata
{
    /**
     * @return int index of target in haystack
     */
    public static function chop(array $haystack, int $target): int
    {
        if (!self::arrayContains($haystack, $target)) {
            return -1;
        }

        if(count($haystack) === 1) {
            return self::getKeyAtFirstPositionOnValueMatch($haystack, $target);
        }

        $splittedHaystack = self::splitArray($haystack);
        $partToProcess = self::arrayContains($splittedHaystack->left, $target)
            ? $splittedHaystack->left
            : $splittedHaystack->right;

        return count($partToProcess) > 1
            ? self::chop($partToProcess, $target)
            : self::getKeyAtFirstPositionOnValueMatch($partToProcess, $target);
    }

    private static function splitArray(array $haystack): SplittedHaystack
    {
        $rightIndexStart = intval(floor(count($haystack) / 2));
        $left = array_slice($haystack, 0, $rightIndexStart, preserve_keys: true);
        $right = array_slice($haystack, $rightIndexStart, preserve_keys: true);

        $assertErrorMessage = 'partie de tableau vide, ne contient qu\'un élément ou est mal splité';
        assert($left !== [], $assertErrorMessage);
        assert($right !== [], $assertErrorMessage);

        return new SplittedHaystack($left, $right, $rightIndexStart);
    }

    private static function arrayContains(array $haystack, int $target): bool
    {
        $min = reset($haystack);
        $max = end($haystack);
        return $target >= $min && $target <= $max;

    }

    /**
     * Index of target in haystack
     * @return int -1 if target is not in haystack
     */
    private static function getKeyAtFirstPositionOnValueMatch(array $haystack, int $target): int
    {
        return reset($haystack) !== $target
            ? -1
            : (int)array_keys($haystack)[0];
    }
}

