<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 06/11/2016
 * Time: 23:57
 */

namespace Project\Database;


/**
 * Class Database
 * @package Project\Database
 * Singleton - provides a connection to the database
 */
class Database {
    protected static $instance = null;
    protected $dbHandler;

    public static function getInstance() {
        // change these to your database details
        $username = 'root';
        $password = 'katie';
        $host = 'localhost';
        $dbname = 'mvc';

        if (self::$instance === null) {
            self::$instance = new self($username, $password, $host, $dbname);
        }

        return self::$instance;
    }

    private function __construct($username, $password, $host, $database) {
        try {
            $this->dbHandler = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
        } catch (\PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function getDbHandler() {
        return $this->dbHandler;
    }

    public function __destruct() {
        $this->dbHandler = null;
    }
}