<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/authentication.php';


$database = new Database();
$db = $database->connect();

$auth = new User($db);

$auth->apiKey = isset($_GET['apiKey']) ? $_GET['apiKey'] : die();

$auth->authenticateUser();

$auth_arr = array(
    'apiKey' => $auth->apiKey
);

print_r(json_encode($auth_arr));

?>