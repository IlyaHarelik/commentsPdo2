<?php

namespace ControllersPdo;

class ConnectionPdo
{
     protected static $instance;
     protected $pdo;

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
}