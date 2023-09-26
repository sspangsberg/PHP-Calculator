<?php

namespace App;

class Calculator{
    
    /**
     * Calculate the summary
     * @param $num1, num2 numbers
     * @return float summary result
     */
    public function add($num1, $num2) {
        return $num1 + $num2;
    }

    /**
     * Calculate the difference
     * @param $num1, num2 numbers
     * @return float difference result
     */
    public function subtract($num1, $num2) {
        return $num1 - $num2;
    }

    /**
     * Calculate the multiplication
     * @param $num1, num2 numbers
     * @return float multiplication result
     */
    public function multiply($num1, $num2) {
        return $num1 * $num2;
    }

    /**
     * Calculate the division
     * @param $num1, num2 numbers
     * @return float division result
     */
    public function divide($num1, $num2) {
        return $num1 / $num2;
    }

    /**
     * Calculate the mean average
     * @param array $numbers Array of numbers
     * @return float Mean average
     */
    public function mean(array $numbers)
    {
        return array_sum($numbers) / count($numbers);
    }

    /**
     * Calculate the median average
     * @param array $numbers Array of numbers
     * @return float Median average
     */
    public function median(array $numbers)
    {
        sort($numbers);
        $size = count($numbers);
        if ($size % 2) {
            return $numbers[$size / 2];
        } else {
            return $this->mean(
                array_slice($numbers, ($size / 2) - 1, 2)
            );
        }
    }
}