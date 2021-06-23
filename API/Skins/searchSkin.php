<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/search.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate user object
$search = new Search($db);

//Get name from URL
$search->name = isset($_GET['name']) ? $_GET['name'] : die();

//Get skin data
$search->searchSkin();

//Create array
$search_arr = array(
    'skinID' => $search->skinID,
    'name' => $search->name,
    'market_name' => $search->market_name,
    'icon_url' => $search->icon_url,
    'link' => $search->link,¨
    'price' => $search->price,
    'steamID' => $search->steamID,
    'float_value' => $search->float_value,
    'patternSeed' => $search->patternSeed
);

//Make JSON
print_r(json_encode($search_arr));

?>