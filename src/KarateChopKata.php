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
        // valeur n'est pas dans le haystack : min > cible || max < cible
        if(reset($haystack) > $target || end($haystack) < $target)
        {
            return -1;
        }

        // couper l'array en 2
        $splittedHaystack = self::splitArray($haystack);
        $left = $splittedHaystack->left;
        $right = $splittedHaystack->right;

        // valeur est dans la partie gauche : val min <= cible && val max >= cible
        if (end($left) >= $target && reset($left) <= $target) {
            if (count($left) === 1) {
                if(reset($left) !== $target)
                {
                    return -1;
                }

                return array_keys($left)[0];
            }

            // relancer le processus
            return self::chop($left, $target);
        }

        // valeur dans la partie droite
        if(count($right) === 1) {
            if(reset($right) !== $target)
            {
                return -1;
            }

            return array_keys($right)[0];
        }

        return self::chop($right, $target);
    }

    public static function splitArray(array $haystack): SplittedHaystack
    {
        $rightIndexStart = intval(floor(count($haystack) / 2));
        $left = array_slice($haystack, 0, $rightIndexStart, preserve_keys: true);
        $right = array_slice($haystack, $rightIndexStart, preserve_keys: true);

        return new SplittedHaystack($left, $right, $rightIndexStart);
    }
}

