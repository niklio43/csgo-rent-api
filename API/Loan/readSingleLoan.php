<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/loan.php';


$database = new Database();
$db = $database->connect();

$loan = new Loan($db);

$loan->loanID = isset($_GET['loanID']) ? $_GET['loanID'] : die();

$loan->readSingleLoan();

$loan_arr = array(
    'loanID' => $loan->loanID,
    'userID' => $loan->userID,
    'skinID' => $loan->skinID,
    'startDate' => $loan->startDate,
    'endDate' => $loan->endDate,
    'expired' => $loan->expired
);

print_r(json_encode($loan_arr));

?>