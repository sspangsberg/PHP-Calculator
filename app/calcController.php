<?php

/**
 * Handles calculator operations (e.g., add, subtract) via HTTP API requests
 *
 * @category Calculator
 * @package  App\Controllers
 * @author   Dmitriy I. <xcart.customize+phpcalcgithub@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @version  GIT: $Id$
 * @link     https://github.com/whatafunc/PHP-Calculator-with-PHPunits/blob/main/README.md
 */

require_once "./Calculator.php";
require_once "./Database.php";
require_once "./ResultRepository.php";

// If the submit button has been pressed
if (isset($_POST['submit'])) {
    // Check number values
    if (is_numeric($_POST['number1']) && is_numeric($_POST['number2'])) {
        $calculator = new \App\Calculator();

        // Calculate total
        if ($_POST['operation'] == 'plus') {
            $total = $calculator->add($_POST['number1'], $_POST['number2']);
        } elseif ($_POST['operation'] == 'minus') {
            $total = $calculator->subtract($_POST['number1'], $_POST['number2']);
        } elseif ($_POST['operation'] == 'times') {
            $total = $calculator->multiply($_POST['number1'], $_POST['number2']);
        } elseif ($_POST['operation'] == 'divided by') {
            $total = $calculator->divide($_POST['number1'], $_POST['number2']);
        }

        // Save result to database
        $resultRepository = new \App\ResultRepository();
        $resultRepository->save(
            $_POST['number1'],
            $_POST['number2'],
            $_POST['operation'],
            $total
        );

        // Split long line to fix line length warning
        $operationString = "{$_POST['number1']} {$_POST['operation']} "
                         . "{$_POST['number2']} equals {$total}";
        echo "<h1>$operationString</h1>";
    } else {
        // Print error message to the browser
        echo 'Numeric values are required';
    }
}
