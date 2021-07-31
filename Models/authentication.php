<?php

Class Auth {

    private $conn;
    private $table = 'user';

    public $apiKey;

    public function __construct($db){
        $this->conn = $db;
    }

    public function authenticateUser(){
        $query = 'SELECT apiKey FROM ' . $this->table . ' WHERE apiKey = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->apiKey);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->apiKey = $row['apiKey'];

    }
    
}
?>
