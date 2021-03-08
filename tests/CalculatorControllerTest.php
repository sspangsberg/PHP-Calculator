<?php

use \App\Calculator;
use \App\CalculatorController;
use \PHPUnit\Framework\TestCase;

class CalculatorControllerTest extends TestCase
{
    private $calculator;

    public function setUp(): void
    {
        $this->calculator = new Calculator;
    }
   
    public function testInvalidInputToHandleCalculation()
    {   
        $this->controller = new CalculatorController;
       
        $result = $this->controller->handleCalculation("10asdf",20, "add");
                
        $this->assertEquals("Numeric values are required", $result);
    }

    public function testValidInputToHandleCalculation()
    {   
        $this->controller = new CalculatorController;
       
        $actual = $this->controller->handleCalculation(10,20, "plus");
        $expected = "<h1>10 plus 20 equals 30</h1>";      
        
        $this->assertEquals($expected, $actual);
    }
}




