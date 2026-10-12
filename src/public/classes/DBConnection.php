<?php

namespace Aslam\Test\public\classes;
class DBConnection{
    
    public $conn;
    
    public function __construct(){
        if (!isset($this->conn)) {
            $config = require dirname(__DIR__, 2) . '/config.php';
            $database = $config['database'];
            $this->conn = new \mysqli(
                $database['host'],
                $database['user'],
                $database['password'],
                $database['name']
            );

            if ($this->conn->connect_errno) {
                throw new \RuntimeException('Database connection failed: ' . $this->conn->connect_error);
            }            
        }    
        
    }
    public function __destruct(){
        $this->conn->close();
    }
}
?>