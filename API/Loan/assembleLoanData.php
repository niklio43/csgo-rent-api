<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

print_r(json_encode($loan_arr));

?>