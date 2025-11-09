<?php

/**
 * Repository for managing calculation results in the database
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
 * ResultRepository class for database operations
 */
class ResultRepository
{
    /**
     * Save a calculation result to the database
     *
     * @param float  $number1   First operand
     * @param float  $number2   Second operand
     * @param string $operation Operation performed
     * @param float  $result    Calculation result
     *
     * @return int ID of the inserted record
     */
    public function save($number1, $number2, $operation, $result)
    {
        $pdo = Database::getConnection();
        $sql = "INSERT INTO results (number1, number2, operation, result) 
                VALUES (:number1, :number2, :operation, :result)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':number1' => $number1,
            ':number2' => $number2,
            ':operation' => $operation,
            ':result' => $result
        ]);
        
        return $pdo->lastInsertId();
    }

    /**
     * Get all calculation results
     *
     * @return array Array of result records
     */
    public function getAll()
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM results ORDER BY created_at DESC";
        
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Get a calculation result by ID
     *
     * @param int $id Result ID
     *
     * @return array|null Result record or null if not found
     */
    public function getById($id)
    {
        $pdo = Database::getConnection();
        $sql = "SELECT * FROM results WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Delete a calculation result
     *
     * @param int $id Result ID
     *
     * @return bool True if deleted, false otherwise
     */
    public function delete($id)
    {
        $pdo = Database::getConnection();
        $sql = "DELETE FROM results WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
