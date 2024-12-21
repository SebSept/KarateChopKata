<?php

namespace App\Tests;

use App\KarateChopKata;
use PHPUnit\Framework\TestCase;

class KarateChopKataTest extends TestCase
{
    /**
     * Test chop with an empty array
     *
     * @covers \App\KarateChopKata::chop
     */
    public function testChopWithEmptyArray(): void
    {
        $this->assertSame(-1, KarateChopKata::chop([], 3));
    }

    /**
     * Test chop with a single element array
     *
     * @covers \App\KarateChopKata::chop
     */
    public function testChopWithSingleElement(): void
    {
        $this->assertSame(-1, KarateChopKata::chop([1], 3), 'Value not present');
        $this->assertSame(0, KarateChopKata::chop([1], 1), 'Value present');
    }

    /**
     * Test chop with three elements array - Present values
     *
     * @covers \App\KarateChopKata::chop
     */
    public function testChopWithThreeElementsPresentValues(): void
    {
        $array = [1, 3, 5];
        $this->assertSame(0, KarateChopKata::chop($array, 1), 'First element');
        $this->assertSame(1, KarateChopKata::chop($array, 3), 'Middle element');
        $this->assertSame(2, KarateChopKata::chop($array, 5), 'Last element');
    }

    /**
     * Test chop with three elements array - Missing values
     *
     * @covers \App\KarateChopKata::chop
     */
    public function testChopWithThreeElementsMissingValues(): void
    {
        $array = [1, 3, 5];
        $this->assertSame(-1, KarateChopKata::chop($array, 0), 'Value less than minimum');
        $this->assertSame(-1, KarateChopKata::chop($array, 2), 'Value between first and middle');
        $this->assertSame(-1, KarateChopKata::chop($array, 4), 'Value between middle and last');
        $this->assertSame(-1, KarateChopKata::chop($array, 6), 'Value greater than maximum');
    }

    /**
     * Test chop with four elements array - Present values
     *
     * @covers \App\KarateChopKata::chop
     */
    public function testChopWithFourElementsPresentValues(): void
    {
        $array = [1, 3, 5, 7];
        $this->assertSame(0, KarateChopKata::chop($array, 1), 'First element');
        $this->assertSame(1, KarateChopKata::chop($array, 3), 'Second element');
        $this->assertSame(2, KarateChopKata::chop($array, 5), 'Third element');
        $this->assertSame(3, KarateChopKata::chop($array, 7), 'Last element');
    }

    /**
     * Test chop with four elements array - Missing values
     *
     * @covers \App\KarateChopKata::chop
     */
    public function testChopWithFourElementsMissingValues(): void
    {
        $array = [1, 3, 5, 7];
        $this->assertSame(-1, KarateChopKata::chop($array, 0), 'Value less than minimum');
        $this->assertSame(-1, KarateChopKata::chop($array, 2), 'Value between first and second');
        $this->assertSame(-1, KarateChopKata::chop($array, 4), 'Value between second and third');
        $this->assertSame(-1, KarateChopKata::chop($array, 6), 'Value between third and last');
        $this->assertSame(-1, KarateChopKata::chop($array, 8), 'Value greater than maximum');
    }
}