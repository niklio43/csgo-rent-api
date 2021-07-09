<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/skin.php';


$database = new Database();
$db = $database->connect();

$skin = new Skin($db);

$skin->name = isset($_GET['name']) ? $_GET['name'] : die();

$skin->searchSkin();

$skin_arr = array();

$skin_arr['data'] = array();

    $skin_item = array(
	'name' => $skin->name
    );

    array_push($skin_arr['data'], $skin_item);

print_r(json_encode($skin_arr));

?>