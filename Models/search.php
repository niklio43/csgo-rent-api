<?php

class Search {

        private $conn;
        private $table = 'skin';
    
        public $name;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function searchSkin(){
            $sql = 'SELECT market_name FROM '. $this->table . ' WHERE name LIKE "%' . $this->name . '%"';
        
            $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        return $stmt;
        }
    }

?>