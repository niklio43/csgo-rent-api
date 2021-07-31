<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/loan.php';


$database = new Database();
$db = $database->connect();

$loan = new Loan($db);

$loan->userID = isset($_GET['userID']) ? $_GET['userID'] : die();
$loan->skinID = isset($_GET['skinID']) ? $_GET['skinID'] : die();

$loan->assembleLoan();

$loan_arr = array(
    'userID' => $loan->userID,
    'skinID' => $loan->skinID,
    'tradeUrl' => $loan->tradeUrl
);

if(isset($loan_arr)){
    print_r(json_encode($loan_arr));
}else{
    print_r(json_encode(
        array(
            "Message" => "Invalid user/skin"
        );
    ))
}

?>