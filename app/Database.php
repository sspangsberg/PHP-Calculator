<?php

/**
 * Database connection handler
 *
 * @category Database
 * @package  App
 * @author   Dmitriy I. <xcart.customize+phpcalcgithub@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @version  GIT: $Id$
 * @link     https://github.com/whatafunc/PHP-Calculator-with-PHPunits/blob/main/README.md
 */

namespace App;

/**
 * Database connection class
 */
class Database
{
    private static $pdo = null;

    /**
     * Get PDO database connection
     *
     * @return \PDO Database connection
     */
    public static function getConnection()
    {
        if (self::$pdo === null) {
            $driver = self::getDriver();
            
            if ($driver === 'mysql') {
                self::$pdo = self::connectMySQL();
            } else {
                self::$pdo = self::connectSQLite();
            }
            
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            // Create results table if it doesn't exist
            self::createTable();
        }

        return self::$pdo;
    }

    /**
     * Get database driver from environment
     *
     * @return string Database driver (mysql or sqlite)
     */
    private static function getDriver()
    {
        // Check Docker environment variables first
        if (isset($_ENV['DB_DRIVER'])) {
            return $_ENV['DB_DRIVER'];
        }
        
        // Check system environment variables
        $driver = getenv('DB_DRIVER');
        if ($driver !== false) {
            return $driver;
        }
        
        // Fall back to .env file
        $envPath = __DIR__ . '/../.env';
        if (file_exists($envPath)) {
            $env = parse_ini_file($envPath);
            if (isset($env['DB_DRIVER'])) {
                return $env['DB_DRIVER'];
            }
        }
        
        return 'sqlite';
    }

    /**
     * Get environment value with multiple fallbacks
     *
     * @param string $key     Environment variable key
     * @param string $default Default value if not found
     *
     * @return string Environment value
     */
    private static function getEnv($key, $default = '')
    {
        // Check Docker environment variables first
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }
        
        // Check system environment variables
        $value = getenv($key);
        if ($value !== false) {
            return $value;
        }
        
        // Fall back to .env file
        $envPath = __DIR__ . '/../.env';
        if (file_exists($envPath)) {
            $env = parse_ini_file($envPath);
            if (isset($env[$key])) {
                return $env[$key];
            }
        }
        
        return $default;
    }

    /**
     * Connect to MySQL database
     *
     * @return \PDO MySQL connection
     */
    private static function connectMySQL()
    {
        $host = self::getEnv('DB_HOST', 'localhost');
        $port = self::getEnv('DB_PORT', '3306');
        $dbName = self::getEnv('DB_NAME', 'calculator');
        $user = self::getEnv('DB_USER', 'root');
        $password = self::getEnv('DB_PASSWORD', '');
        
        $dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4";
        
        return new \PDO($dsn, $user, $password);
    }

    /**
     * Connect to SQLite database
     *
     * @return \PDO SQLite connection
     */
    private static function connectSQLite()
    {
        $dbPath = __DIR__ . '/../data/calculator.db';
        
        // Ensure data directory exists
        if (!is_dir(__DIR__ . '/../data')) {
            mkdir(__DIR__ . '/../data', 0755, true);
        }
        
        return new \PDO('sqlite:' . $dbPath);
    }

    /**
     * Create results table if it doesn't exist
     *
     * @return void
     */
    private static function createTable()
    {
        $driver = self::getDriver();
        
        if ($driver === 'mysql') {
            $sql = "CREATE TABLE IF NOT EXISTS results (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        number1 DECIMAL(10, 5) NOT NULL,
                        number2 DECIMAL(10, 5) NOT NULL,
                        operation VARCHAR(50) NOT NULL,
                        result DECIMAL(10, 5) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
        } else {
            $sql = "CREATE TABLE IF NOT EXISTS results (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        number1 REAL NOT NULL,
                        number2 REAL NOT NULL,
                        operation TEXT NOT NULL,
                        result REAL NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
        }
        
        self::$pdo->exec($sql);
    }
}
