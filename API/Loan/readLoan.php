<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/loan.php';


$database = new Database();
$db = $database->connect();

$loan = new Loan($db);
$result = $loan->readLoan();

$num = $result->rowCount();


if($num > 0){

    $loan_arr = array();
    $loan_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $loan_item = array(
            'loanID' => $loanID,
            'skinID' => $skinID,
            'userID' => $userID,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'expired' => $expired
        );

        array_push($loan_arr['data'], $loan_item);
    }

    echo json_encode($loan_arr);

}else{

echo json_encode(
    array('message' => 'No loans found')
);
}

?>