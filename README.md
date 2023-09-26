# PHP-Calculator
Simple PHP Calculator to use for unit testing

Usage: 
a) test phpunit installed via shell cmd: vendor/bin/phpunit
should return No tests executed! if you are just starting :)

b) when a test is ready , like
it's probably more interesting to see the output with methods tested and to do this you can issue
the following cmd:
vendor/bin/phpunit --testdox
which would output a kind of something like this for a test like "tests/CalculatorTest.php":
PHPUnit 9.6.13 by Sebastian Bergmann and contributors.

Calculator
 ✔ Add

Time: 00:00.038, Memory: 6.00 MB

OK (1 test, 1 assertion)