# PHP-Calculator
Simple PHP Calculator to use and do Unit testing, Fuzz testing

Usage:
use your webserver and visit /app/index.php to get the web UI

Unit testing: 
a) run phpunit test installed via shell cmd: 
bash: vendor/bin/phpunit
should return No tests executed! if you are just starting, i.e. no tests are developed

b) when a test is ready, run same bash cmd:
vendor/bin/phpunit

it's probably more interesting to see the output with methods tested and to do this you can issue
the following cmd:
bash: vendor/bin/phpunit --testdox

It works nice if the tests are well descriptive:
ClassName
 - methodName
   - Test case description

So, the test with key --testdox
would output a kind of something like this for a test like "tests/CalculatorTest.php":
PHPUnit 9.6.13 by Sebastian Bergmann and contributors.

Calculator
 ✔ Add

Time: 00:00.038, Memory: 6.00 MB

OK (1 test, 1 assertion)
-------------

Fuzz test PHP:
run fuzz_test.php from bash or your favourite terminal
![See fuzz testing in action and compare the results with web ui of the PHP calculator](comparing-the-result-from-the-webbrowser-with-one-of-the-fuzz-tests.png)

Notes:
- PHP 7.3 compatibility
- Newer phpunit xmlns:xsi declaration (see previous in phpunit.xml.bak)