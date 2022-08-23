<?php

//
//namespace ControllersPdo;

class ConnectionPdo
{
    protected static $instance;
    public $pdo;

    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'comments';
    const DB_CHARSET = 'utf8';
    const DB_PORT = '3306';
    const DB_HOST = 'localhost';
    const DB_DSN_MYSQL = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnectionPdo();
//            self::$instance->pdo = new PDO(DB_DSN_MYSQL, DB_USER, DB_PASSWORD);
//            self::$instance->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
    public function pdo()
    {
        $this->pdo=new PDO(DB_DSN_MYSQL, DB_USER, DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
//include('DataBaseComments.php');
class DataBaseComments
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = ConnectionPdo::getInstance();
        $this->pdo->pdo();
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
//        var_dump($this->pdo);
        $query = 'SELECT COUNT(*) FROM ' . $tableName;
        $result = $this->pdo->pdo->query($query);
        $row = $result->fetch(PDO::FETCH_NUM);

        return $row[0];
    }

    public function getList(int $begin, int $numPerPage)
    {
//        var_dump($this->pdo);
        $query = "SELECT *
            FROM `allcomments`
            ORDER BY `id` ASC
            LIMIT " . $begin . ", " . $numPerPage;

        return $this->pdo->pdo->query($query);
    }
    public function test()
    {
//        var_dump($this->pdo === $this->pdo2);
    }

}

$db = new DataBaseComments;
$db->test();

$numPerPage = 5;
$countComments = $db->rowsCount('allcomments');

if (isset($_GET['page'])) {
    if ($_GET['page' == 1]) {
        $begin = 0;
    } else {
        $begin = ($_GET['page'] - 1) * $numPerPage;
    }
} else {
    $begin = 0;
}

$comments = $db->getList($begin, $numPerPage);

foreach ($comments as $comment) {
    echo '<h4 style=margin-left:100px>' . $comment['comment'] . '</h4>';
    echo '<div style=margin-left:300px><p>' . $comment['author'] . '</p></div>';
}

$numLinks = ceil($countComments / $numPerPage);

echo '<span style=margin-left:100px>';

for ($i = 1; $i <= $numLinks; $i++) {
    echo '<a href="/index.php?page=' . $i . '"style=margin-left:10px>' . $i . '    ' . '</a>';
}

echo '</span></br>';
