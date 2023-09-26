<?php

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase {

    protected $calculator;

    public function setUp(): void {
        $this->calculator = new Calculator();
    }

    public function testAdd(){
        $result      = $this->calculator->add(160,140); 
        $this->assertEquals(300, $result);
    }

    public function testDiv(){
        $result      = $this->calculator->divide(160,140); 
        $this->assertGreaterThan(1, $result);
    }
}