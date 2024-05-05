<?php

namespace app\core;
use PDO;

class Database extends PDO
{
    private $DB_NAME = 'biblioteca_do_saber'; 
    private $DB_USER = 'root';
    private $DB_PASSWORD = '';
    private $DB_HOST = '127.0.0.1';
    private $DB_PORT = 3306;

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->DB_HOST;dbname=$this->DB_NAME", $this->DB_USER, $this->DB_PASSWORD);
    }
    private function setParams($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    private function mountQuerry($stmt, $params)
    {
        foreach($params as $key => $value){
            $this->setParams($stmt, $key, $value);
        }
    }

    public function executeQuerry(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->mountQuerry($stmt, $params);
        $stmt->execute();
        return $stmt;
    }
}