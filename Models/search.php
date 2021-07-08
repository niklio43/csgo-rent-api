<?php

class Search {

        private $conn;
        private $table = 'skin';
    
        public $name;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function searchSkin(){
            $sql = "SELECT * FROM $table WHERE name LIKE '%$name%'";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt;

        }
    }

?>