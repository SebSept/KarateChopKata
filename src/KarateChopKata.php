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
            return reset($haystack) !== $target
                ? -1
                : array_keys($haystack)[0];
        }

        // couper l'array en 2
        $splittedHaystack = self::splitArray($haystack);
        $left = $splittedHaystack->left;
        $right = $splittedHaystack->right;

        // valeur est dans la partie gauche : val min <= cible && val max >= cible
        if (self::arrayContains($left, $target)) {
            // relancer le processus
            if (count($left) > 1) {
                return self::chop($left, $target);
            }

            return reset($left) !== $target
                ? -1
                : array_keys($left)[0];
        }

        // valeur dans la partie droite
        if (count($right) > 1) {
            return self::chop($right, $target);
        }

        return reset($right) !== $target
            ? -1
            : array_keys($right)[0];
    }

    private static function splitArray(array $haystack): SplittedHaystack
    {
        $rightIndexStart = intval(floor(count($haystack) / 2));
        $left = array_slice($haystack, 0, $rightIndexStart, preserve_keys: true);
        $right = array_slice($haystack, $rightIndexStart, preserve_keys: true);

        $assertErrorMessage = 'partie de tableau vide, ne contient qu\'un élément ou est mal splité';
        assert(count($left) !== 0, $assertErrorMessage);
        assert(count($right) !== 0, $assertErrorMessage);

        return new SplittedHaystack($left, $right, $rightIndexStart);
    }

    private static function arrayContains(array $haystack, int $target): bool
    {
        $min = reset($haystack);
        $max = end($haystack);
        return $target >= $min && $target <= $max;

    }
}

