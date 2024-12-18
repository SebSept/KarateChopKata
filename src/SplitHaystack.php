<?php

namespace App;

readonly class SplitHaystack
{
    public function __construct(
        public array $left,
        public array $right,
        public int   $rightIndexStart)
    {

    }
}