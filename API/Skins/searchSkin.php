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

$skin_arr = array(
    'name' => $skin->name,
);

print_r(json_encode($skin_arr));

?>