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
        if (!self::arrayContains($array, $target)) {
            return -1;
        }

        if(count($array) === 1) {
            return self::getKeyAtFirstPositionOnValueMatch($array, $target);
        }

        $splitArray = self::splitArray($array);
        $partToProcess = self::arrayContains($splitArray->left, $target)
            ? $splitArray->left
            : $splitArray->right;

        return count($partToProcess) > 1
            ? self::chop($partToProcess, $target)
            : self::getKeyAtFirstPositionOnValueMatch($partToProcess, $target);
    }

    private static function splitArray(array $array): SplitHaystack
    {
        $rightIndexStart = intval(floor(count($array) / 2));
        $left = array_slice($array, 0, $rightIndexStart, preserve_keys: true);
        $right = array_slice($array, $rightIndexStart, preserve_keys: true);

        $assertErrorMessage = 'partie de tableau vide, ne contient qu\'un élément ou est mal splité';
        assert($left !== [], $assertErrorMessage);
        assert($right !== [], $assertErrorMessage);

        return new SplitHaystack($left, $right, $rightIndexStart);
    }

    private static function arrayContains(array $array, int $value): bool
    {
        $min = reset($array);
        $max = end($array);
        return $value >= $min && $value <= $max;

    }

    /**
     * Index of target in array
     * @return int -1 if target is not in haystack
     */
    private static function getKeyAtFirstPositionOnValueMatch(array $array, int $value): int
    {
        return reset($array) !== $value
            ? -1
            : (int)array_keys($array)[0];
    }
}

