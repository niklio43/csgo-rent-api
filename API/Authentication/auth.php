<?php
function verify($API = null){
    if ($API === null) {
        if (isset($_REQUEST['apikey'])) {
            $API = $_REQUEST['apikey'];
        }    
    };

    if ($API === null) {
        return;
    }
    include_once '../../config/Database.php';    
    $database = new Database();
    $db = $database->connect();

    $SQL = "SELECT TIMESTAMPDIFF(SECOND, expiration,CURRENT_TIME()) as time FROM user WHERE apiKey = :apiKey";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(':apiKey', $API);                  
    $stmt->execute(); 
    
    if ($stmt->rowcount() > 0) {
        while($row = $stmt->fetch( PDO::FETCH_ASSOC )) {
            if($row['time']>1800){
                // "Time out";
				echo "Timeout";
                return false;
            } else {
                $SQL ="UPDATE user SET expiration=CURRENT_TIME() WHERE apiKey = :apiKey";
                $stmt = $db->prepare($SQL);
                $stmt->bindParam(':apiKey', $API,PDO::PARAM_STR);
                $stmt->execute();
//                echo "Correct";
                return true;
            }
        }
    } 

    echo "Wrong APIKey!";
    return false;
}

?>