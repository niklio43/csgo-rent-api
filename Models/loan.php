<?php

Class Loan{

    private $conn;
    private $table = 'loan';

    public $loanID;
    public $skinID;
    public $userID;
    public $startDate;
    public $endDate = date("Y/m/d",strtotime('+30 days')); //ksk inte fungerar
    public $expired;

    public function __construct($db){
        $this->conn = $db;
    }

    public function readLoan(){

        $query = 'SELECT * FROM ' . $this->table . '';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function readSingleLoan(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE loanID = ?';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->loanID);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->loanID = $row['loanID'];
        $this->userID = $row['userID'];
        $this->skinID = $row['skinID'];
        $this->startDate = $row['startDate'];
        $this->endDate = $row['endDate'];
        $this->expired = $row['expired'];

    }

            public function updateLoan(){

                $query = 'UPDATE ' . $this->table . '
                SET
                    userID = :userID,
                    skinID = :skinID,
                    startDate = :startDate,
                    endDate = :endDate,
                    expired = :expired
                WHERE
                    loanID = :loanID';

                    $stmt = $this->conn->prepare($query);
        
                    $this->loanID =htmlspecialchars(strip_tags($this->loanID));
                    $this->userID =htmlspecialchars(strip_tags($this->userID));
                    $this->skinID =htmlspecialchars(strip_tags($this->skinID));
                    $this->startDate =htmlspecialchars(strip_tags($this->startDate));
                    $this->starend =htmlspecialchars(strip_tags($this->endDate));
                    $this->expired =htmlspecialchars(strip_tags($this->expired));

                    $stmt->bindParam(':loanID', $this->loanID);
                    $stmt->bindParam(':userID', $this->userID);
                    $stmt->bindParam(':skinID', $this->skinID);
                    $stmt->bindParam(':startDate', $this->startDate);
                    $stmt->bindParam(':endDate', $this->endDate);
                    $stmt->bindParam(':expired', $this->expired);

                    if($stmt->execute()){
                        return true;
                    }

                    printf("Error: %s.\n", $stmt->error);
                    return false;
            }

    public function createLoan(){

        $query = 'INSERT INTO ' . $this->table . '
        SET
            skinID = :skinID,
            userID = :userID,
            startDate = CURDATE(),
            endDate = :endDate,
            expired = 0';

            $stmt = $this->conn->prepare($query);

            $this->skinID = htmlspecialchars(strip_tags($this->skinID));
            $this->userID = htmlspecialchars(strip_tags($this->userID));
            $this->endDate = htmlspecialchars(strip_tags($this->endDate));

            $stmt->bindParam(':skinID', $this->skinID);
            $stmt->bindParam(':userID', $this->userID);
            $stmt->bindParam(':endDate', $endDate);
            if($stmt->execute()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
    }
}
?>