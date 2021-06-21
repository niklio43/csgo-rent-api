<?php
    function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 20; $i++) {
            $randstring = $randstring.$characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }

    include_once "db.php";
    $pass="no set";
    $user="no set";
    $hash="no set";
    $myObj = new stdClass();
    $foo = file_get_contents("php://input");
    $data=json_decode($foo, true);    
    if(isset($data['password'])){
        $pass=$data['password'];
    }
    if(isset($data['user'])){
        $user=$data['user'];
    }
    if(isset($data['hash'])){
        $hash=$data['hash'];
    }
    if(isset($_REQUEST['password'])){
        $pass=$_REQUEST['password'];
    }
    if(isset($_REQUEST['user'])){
        $user=$_REQUEST['user'];
    }
    if(isset($_REQUEST['hash'])){
        $hash=$_REQUEST['hash'];
    }
    if($hash!="no set"){
        $sql ="SELECT TIMESTAMPDIFF(SECOND, date,CURRENT_TIME()) as time from user WHERE hash='$hash'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['time']>180){
                    $myObj->ok = false;
                    $myObj->error = "Time out";
                    $myJSON = json_encode($myObj);
                    echo $myJSON;
                } else {
                    $sql ="UPDATE user SET date=CURRENT_TIME() WHERE userID='$user'";
                    $result2 = $conn->query($sql);
                    $myObj->ok = true;
                    $myJSON = json_encode($myObj);
                    echo $myJSON;
                        }
            }
        } else {
            $myObj->ok = false;
            $myObj->error = "Wrong hash";
            $myJSON = json_encode($myObj);
            echo $myJSON;
        }
    } else {
        $sql = "SELECT * FROM user where password='$pass' AND userID='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $hash = RandomString();
                $sql ="UPDATE user SET hash='$hash', date=CURRENT_TIME() WHERE userID='$user'";
                $result2 = $conn->query($sql);
                $myObj->ok = true;
                $myObj->hash = $hash;
                $myJSON = json_encode($myObj);
                echo $myJSON;
            }
        } else {
            $myObj->ok = false;
            $myObj->error = "Wrong password or user!";
            $myJSON = json_encode($myObj);
            echo $myJSON;
    }
    }
    $conn->close();
?>