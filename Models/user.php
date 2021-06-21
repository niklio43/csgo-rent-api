<?php

Class User {

    private $conn;
    private $table = 'user';

    public $userID;
    public $firstName;
    public $middleName;
    public $lastName;
    public $tradeUrl;
    public $subscription;
    public $personNummer;
    public $email;
    public $apiKey;

    public function __construct($db){
        $this->conn = $db;
    }

    public function readUser(){

        $query = 'SELECT * FROM ' . $this->table . '';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function readSingleUser(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE userID = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->userID);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->userID = $row['userID'];
        $this->firstName = $row['firstName'];
        $this->middleName = $row['middleName'];
        $this->lastName = $row['lastName'];
        $this->tradeUrl = $row['tradeUrl'];
        $this->subscription = $row['subscription'];
        $this->personNummer = $row['personNummer'];
        $this->email = $row['email'];

    }

            public function updateTradeUrl(){

                $query = 'UPDATE ' . $this->table . '
                SET
                    tradeUrl = :tradeUrl
                WHERE
                    userID = :userID';

                    $stmt = $this->conn->prepare($query);
        
                    $this->tradeUrl =htmlspecialchars(strip_tags($this->tradeUrl));

                    $stmt->bindParam(':tradeUrl', $this->tradeUrl);

                    if($stmt->execute()){
                        return true;
                    }

                    printf("Error: %s.\n", $stmt->error);
                    return false;
            }

            public function updateEmail(){

                $query = 'UPDATE ' . $this->table . '
                SET
                    email = :email
                WHERE
                    userID = :userID';

                    $stmt = $this->conn->prepare($query);
        
                    $this->email =htmlspecialchars(strip_tags($this->email));

                    $stmt->bindParam(':email', $this->email);

                    if($stmt->execute()){
                        return true;
                    }

                    printf("Error: %s.\n", $stmt->error);
                    return false;
            }

            public function updateSubscription(){

                $query = 'UPDATE ' . $this->table . '
                SET
                    subscription = :subscription
                WHERE
                    userID = :userID';

                    $stmt = $this->conn->prepare($query);
        
                    $this->subscription =htmlspecialchars(strip_tags($this->subscription));

                    $stmt->bindParam(':subscription', $this->subscription);

                    if($stmt->execute()){
                        return true;
                    }

                    printf("Error: %s.\n", $stmt->error);
                    return false;
            }

    /*public function createUser(){
        function RandomString()
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randstring = '';
            for ($i = 0; $i < 20; $i++) {
                $randstring = $randstring.$characters[rand(0, strlen($characters)-1)];
            }
            return $randstring;
        }

        $query = 'INSERT INTO ' . $this->table . '
        SET
            firstName = :firstName,
            middleName = :middleName,
            lastName = :lastName,
            personNummer = :personNummer
            apiKey = :apiKey';

            $stmt = $this->conn->prepare($query);

            $this->firstName = htmlspecialchars(strip_tags($this->firstName));
            $this->middleName = htmlspecialchars(strip_tags($this->middleName));
            $this->lastName = htmlspecialchars(strip_tags($this->lastName));
            $this->personNummer = htmlspecialchars(strip_tags($this->personNummer));

            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':middleName', $this->middleName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':personNummer', $this->personNummer);
            //$stmt->bindParam(':apiKey', RandomString());

            //Executing query
            if($stmt->execute()){
                return true;
            }

            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
    }*/

    public function createUser() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET firstName = :firstName, middleName = :middleName, lastName = :lastName, personNummer = :personNummer';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->middleName = htmlspecialchars(strip_tags($this->middleName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->personNummer = htmlspecialchars(strip_tags($this->personNummer));

        // Bind data
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':middleName', $this->middleName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':personNummer', $this->personNummer);

        // Execute query
        if($stmt->execute()) {
          return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
    
}
?>
