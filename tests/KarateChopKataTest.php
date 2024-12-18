<?php

namespace App\Tests;

use App\KarateChopKata;
use PHPUnit\Framework\TestCase;

class KarateChopKataTest extends TestCase
{
    public function testChop(): void
    {
        $this->assertSame(-1, KarateChopKata::chop([], 3));
        $this->assertSame(-1, KarateChopKata::chop([1], 3));
        $this->assertSame(0, KarateChopKata::chop([1], 1));

        $this->assertSame(0, KarateChopKata::chop([1, 3, 5], 1));
        $this->assertSame(1, KarateChopKata::chop([1, 3, 5], 3));
        $this->assertSame(2, KarateChopKata::chop([1, 3, 5], 5));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5], 0));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5], 2));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5], 4));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5], 6));

        $this->assertSame(0, KarateChopKata::chop([1, 3, 5, 7], 1));
        $this->assertSame(1, KarateChopKata::chop([1, 3, 5, 7], 3));
        $this->assertSame(2, KarateChopKata::chop([1, 3, 5, 7], 5));
        $this->assertSame(3, KarateChopKata::chop([1, 3, 5, 7], 7));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5, 7], 0));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5, 7], 2));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5, 7], 4));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5, 7], 6));
        $this->assertSame(-1, KarateChopKata::chop([1, 3, 5, 7], 8));
    }
}

