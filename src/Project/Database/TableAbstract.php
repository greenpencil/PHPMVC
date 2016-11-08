<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 06/11/2016
 * Time: 23:56
 */

namespace Project\Database;


require_once(__DIR__."/Database.php");

/**
 * Class TableAbstract
 * @package Project\Database
 * Provides an abstract table class for connecting to the database
 */
abstract class TableAbstract {
    // Name of the table and the primary key
    protected $name;
    protected $primaryKey = 'id', $dbHandler, $db;

    /**
     * Constructor
     */
    public function __construct() {
        // gets the database and database handler
        $this->db = Database::getInstance();
        $this->dbHandler = $this->db->getDbHandler();
    }

    // some default methods for fetching data - you should use the example in UserTable
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->name;
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
        return $results;
    }

    public function fetchByPrimaryKey($key) {
        $sql = 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $params = array(
            ':id' => $key
        );
        $results = $this->dbHandler->prepare($sql);
        $results->execute($params);
        return $results->fetch();
    }

}