<?php

use \App\Calculator;
use \App\CalculatorController;
use \PHPUnit\Framework\TestCase;

class CalculatorControllerTest extends TestCase
{
    private $calculator;
    private $controller;

    /**
     * Prepare any needed test dependencies
     */
    public function setUp(): void
    {
        $this->calculator = new Calculator;
    }
   
    /**
     * Integration test - invalid input to calculator (add)
     */
    public function testInvalidInputToHandleCalculation()
    {   
        // Arrange
        $this->controller = new CalculatorController;
       
        // Act
        $result = $this->controller->handleCalculation("10asdf",20, "plus");
              
        // Assert
        $this->assertEquals("Numeric values are required", $result);
    }

    /**
     * Integration test - Valid input to calculator (add)
     */
    public function testValidInputToHandleCalculation()
    {   
        // Arrange
        $this->controller = new CalculatorController;
       
        // Act
        $actual = $this->controller->handleCalculation(10,20, "plus");
        
        // Assert
        $expected = "<h1>10 plus 20 equals 30</h1>";      
        $this->assertEquals($expected, $actual);
    }
}