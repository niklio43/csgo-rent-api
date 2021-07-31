<?php 
  class Database {
    // DB Params
    private $host = '206.81.27.23';
    private $db_name = 'csgorent';
    private $username = 'admin';
    private $password = 'f87f7cb906f269d7bca1d4d8df380c253700d1aa9cec832b';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }