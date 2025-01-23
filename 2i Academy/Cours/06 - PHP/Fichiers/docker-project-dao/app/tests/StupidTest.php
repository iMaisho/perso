<?php
use PHPUnit\Framework\TestCase;
class StupidTest extends TestCase{
    public function testThatTrueIsTrue(){
        $expected = true;
        $actual = true;
        $this->assertEquals($expected, $actual, "true doit être true");
    }
}