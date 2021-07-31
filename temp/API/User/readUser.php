<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/user.php';


$database = new Database();
$db = $database->connect();

$user = new User($db);
$result = $user->readUser();

$num = $result->rowCount();


if($num > 0){

    $users_arr = array();
    $users_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user_item = array(
            'firstName' => $firstName,
            'middleName' => $middleName,
            'lastName' => $lastName,
            'tradeUrl' => $tradeUrl,
            'subscription' => $subscription,
            'email' => $email,
            'personNummer' => $personNummer,
            'userID' => $userID
        );

        array_push($users_arr['data'], $user_item);
    }

    echo json_encode($users_arr);

}else{

echo json_encode(
    array('message' => 'No users Found')
);
}

?>