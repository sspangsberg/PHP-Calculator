<?php
/*
This is the fuzz test for the app/calculator script
It's a simple PHP script that generates random inputs and sends them to the calculator script using cURL. 

In this fuzzing script, an array of valid operations and a function gets defined to generate random inputs (two numbers and an operation). 

The test runs a loop for a specified number of test cases, generating random inputs and sending them to the calculator script using cURL.

The script will output the test case inputs and the response from the calculator script for each test case. By analyzing the responses, you can identify potential issues, such as crashes, unexpected outputs, or other abnormal behaviors.

Please note that this is a very basic example, and real-world fuzzing techniques often involve more sophisticated input generation strategies, mutation techniques, and specialized fuzzing tools and frameworks. Additionally, proper error handling, logging, and analysis of the results are essential for effective fuzzing.
*/


// Array of valid operations
$operations = ['plus', 'minus', 'times', 'divided by'];

// Function to generate random inputs
function generateRandomInput()
{
	$num1 = rand(-1000, 1000);
	$num2 = rand(-1000, 1000);
	$operation = $GLOBALS['operations'][array_rand($GLOBALS['operations'])];

	return [
		'number1' => $num1,
		'number2' => $num2,
		'operation' => $operation
	];
}

// Number of test cases
$numTestCases = 100;

// URL of the calculator script that lives in Docker 
$calculatorUrl = 'http://nginx/app/calcController.php';
// Loops of fuzzing tests if $numTestCases > 0
for ($i = 0; $i < $numTestCases; $i++) {
	$randomInput = generateRandomInput();

	$postFields = http_build_query([
		'number1' => $randomInput['number1'],
		'number2' => $randomInput['number2'],
		'operation' => $randomInput['operation'],
		'submit' => true
	]);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $calculatorUrl);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);
	curl_close($ch);

	echo "Test Case " . ($i + 1) . ": " . $randomInput['num1'] . " " . $randomInput['operation'] . " " . $randomInput['num2'] . "\n";
	echo "Response: " . $response . "\n\n";

}