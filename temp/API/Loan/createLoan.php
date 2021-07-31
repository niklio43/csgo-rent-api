<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Models/loan.php';

$database = new Database();
$db = $database->connect();

$loan = new Loan($db);

$data = json_decode(file_get_contents("php://input"));

$loan->skinID = $data->skinID;
$loan->userID = $data->userID;
$loan->endDate = $data->endDate;

	if($user->createLoan()){
		echo json_encode(
			array('message' => 'Loan Registered')
		);
	}else{
		echo json_encode(
			array('message' => 'Loan not Registered')
		);
	}
?>