<?php

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorAverageTest extends TestCase {

    protected $calculator;

    public function setUp(): void {
        $this->calculator = new Calculator();
    }

    public function testMean(){
        $result      = $this->calculator->mean([160,140,0]); 
        $this->assertEquals(100, $result);
    }

    public function testMedian(){
        $result      = $this->calculator->median([1,2,3,4,5]); 
        $this->assertGreaterThan(2, $result);
    }
}