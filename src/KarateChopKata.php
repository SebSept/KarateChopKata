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
            return self::getIndexInHaystack($haystack, $target);
        }

        // couper l'array en 2
        $splittedHaystack = self::splitArray($haystack);

        // valeur est dans la partie gauche : val min <= cible && val max >= cible
        if (self::arrayContains($splittedHaystack->left, $target)) {
            // relancer le processus
            if (count($splittedHaystack->left) > 1) {
                return self::chop($splittedHaystack->left, $target);
            }

            return self::getIndexInHaystack($splittedHaystack->left, $target);
        }

        // valeur dans la partie droite
        if (count($splittedHaystack->right) > 1) {
            return self::chop($splittedHaystack->right, $target);
        }

        return self::getIndexInHaystack($splittedHaystack->right, $target);
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
    public static function getIndexInHaystack(array $haystack, int $target): int
    {
        return reset($haystack) !== $target
            ? -1
            : (int) array_keys($haystack)[0];
    }
}

