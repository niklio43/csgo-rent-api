<?php

class Search {

        private $conn;
        private $table = 'skin';
    
        public $name;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function searchSkin(){
            $sql = "SELECT * FROM `skin` WHERE name LIKE '%AUG%'";
        
            $stmt = $this->conn->prepare($sql);

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->name);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->skinID = $row['skinID'];
            $this->name = $row['name'];
            $this->market_name = $row['market_name'];
            $this->icon_url = $row['icon_url'];
            $this->link = $row['link'];
            $this->price = $row['price'];
            $this->steamID = $row['steamID'];
            $this->float_value = $row['float_value'];
            $this->patternSeed = $row['patternSeed'];
        }
    }

?>