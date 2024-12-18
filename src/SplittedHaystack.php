<?php

namespace App;

readonly class SplittedHaystack
{
    public function __construct(
        public array $left,
        public array $right,
        public int   $rightIndexStart)
    {

    }
}