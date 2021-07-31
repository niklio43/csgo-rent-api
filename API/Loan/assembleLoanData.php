<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/loan.php';


$database = new Database();
$db = $database->connect();

$loan = new Loan($db);

$loan->userID = isset($_GET['userID']) ? $_GET['userID'] : die();
$loan->skinID = isset($_GET['skinID']) ? $_GET['skinID'] : die();

$loan->assembleLoanData();

$loan_arr = array(
    'userID' => $loan->userID,
    'skinID' => $loan->skinID,
    'tradeUrl' => $loan->tradeUrl
);

if(isset($loan_arr)){
print_r(json_encode($loan_arr));
}else{
    echo json_encode(
        array('message' => 'User/Skin does not exist!')
    );
}
?>