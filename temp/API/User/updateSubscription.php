<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/user.php';


$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->subscription = $data->subscription;
$user->userID = $data->userID;

if($user->updateSubscription()){
    echo json_encode(
        array('message' => 'Subscription Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Subscription Not Updated')
    );
}
