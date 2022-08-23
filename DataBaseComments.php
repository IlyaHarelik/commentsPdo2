<?php

require 'ControllersPdo\ConnectionPdo.php';


//use ControllersPdo\ConnectionPdo;

class DataBaseComments
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = ConnectionPdo::getInstance();
    }

    public function insert(string $tableName, array $comments): int
    {
        $fields = implode(', ', array_keys($comments));
        $values = array_values($comments);
        $values = array_map(function ($value) {
            return $this->pdo->quote($value);
        }, $values);

        $values = implode(', ', $values);
        $query = 'INSERT INTO ' . $tableName . ' (' . $fields . ') VALUES (' . $values . ')';
        $this->pdo->exec($query);

        return $this->pdo->lastInsertID();
    }

    public function rowsCount(string $tableName)
    {
        var_dump($this->pdo);
//        $query = 'SELECT COUNT(*) FROM ' . $tableName;
//        $result = $this->pdo->query($query);
//        $row = $result->fetch(PDO::FETCH_NUM);
//
//        return $row[0];
    }

    public function getList(int $begin, int $numPerPage)
    {
        var_dump($this->pdo);
//        $query = "SELECT *
//            FROM `allcomments`
//            ORDER BY `id` ASC
//            LIMIT " . $begin . ", " . $numPerPage;
//
//        return $this->pdo->query($query);
    }

}
