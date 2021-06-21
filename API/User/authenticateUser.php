<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/user.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate user
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$user->username=$data->username;
$user->password=$data->password;
$array=$user->authenticateUser();
if($array["user"])
{
    echo $array["API"];
}
if($array["notFound"])
	echo "Not found!";
if($array["admin"])
    echo $array["API"];
?>