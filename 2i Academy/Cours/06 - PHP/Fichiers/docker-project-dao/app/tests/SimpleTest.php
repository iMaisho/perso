<?php
use PHPUnit\Framework\TestCase;
class SimpleTest extends TestCase{
    public function testAddingTwoPlusOneIsThree(){
        $expected = 3;
        $actual = 2 + 1;
        $this->assertEquals($expected, $actual, "2+1 doit faire 3");
    }
}