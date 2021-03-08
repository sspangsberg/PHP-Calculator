<?php

namespace App;

require_once("Calculator.php");

class CalculatorController
{
    public function handleCalculation($number1, $number2, $operation)
    {
        // Check number values
        if (is_numeric($number1) && is_numeric($number2)) {
            $calculator = new \App\Calculator;

            // Calculate total
            if ($operation == 'plus') {
                $total = $calculator->add($number1, $number2);
            } else if ($operation == 'minus') {
                $total = $calculator->subtract($number1, $number2);
            } else if ($operation == 'times') {
                $total = $calculator->multiply($number1, $number2);
            } else if ($operation == 'divided by') {
                $total = $calculator->divide($number1, $number2);
            }

            // Return result
            return "<h1>{$number1} {$operation} {$number2} equals {$total}</h1>";

        } else {

            // Return error message
            return 'Numeric values are required';
        }
    }
}
