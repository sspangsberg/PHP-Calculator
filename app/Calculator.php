<?php

/**
 * Calculator class for performing basic arithmetic operations
 *
 * @category Mathematics
 * @package  App
 * @author   Dmitriy I. <xcart.customize+phpcalcgithub@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/whatafunc/PHP-Calculator-with-PHPunits/blob/main/README.md
 */

namespace App;

/**
 * Calculator class for performing basic arithmetic operations
 */
class Calculator
{
    /**
     * Adds two numbers
     *
     * @param float $num1 First number
     * @param float $num2 Second number
     *
     * @return float Sum of $num1 and $num2
     */
    public function add($num1, $num2)
    {
        return $num1 + $num2;
    }

    /**
     * Calculate the difference between two numbers
     *
     * @param float $num1 First number
     * @param float $num2 Second number
     *
     * @return float Difference of $num1 and $num2
     */
    public function subtract($num1, $num2)
    {
        return $num1 - $num2;
    }

    /**
     * Calculate the product of two numbers
     *
     * @param float $num1 First number
     * @param float $num2 Second number
     *
     * @return float Product of $num1 and $num2
     */
    public function multiply($num1, $num2)
    {
        return $num1 * $num2;
    }

    /**
     * Calculate the division of two numbers
     *
     * @param float $num1 Dividend
     * @param float $num2 Divisor
     *
     * @return float Quotient of $num1 divided by $num2
     *
     * @throws \InvalidArgumentException If divisor is zero
     */
    public function divide($num1, $num2)
    {
        if ($num2 == 0) {
            throw new \InvalidArgumentException('Division by zero');
        }
        return $num1 / $num2;
    }

    /**
     * Calculate the mean average of numbers
     *
     * @param array $numbers Array of numeric values
     *
     * @return float Arithmetic mean
     */
    public function mean(array $numbers)
    {
        return array_sum($numbers) / count($numbers);
    }

    /**
     * Calculate the median average of numbers
     *
     * @param array $numbers Array of numeric values
     *
     * @return float Median value
     */
    public function median(array $numbers)
    {
        sort($numbers);
        $size = count($numbers);

        if ($size % 2) {
            return $numbers[$size / 2];
        }

        return $this->mean(
            array_slice($numbers, ($size / 2) - 1, 2)
        );
    }
}
