,<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/search.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate post object
$skin = new Search($db);

//Get name from URL
$skin->name = isset($_GET['name']) ? $_GET['name'] : die();

//Get post
$skin->searchSkin();

//Create array
$skin_arr = array(
    'skinID' => $skin->skinID,
    'name' => $skin->name,
    'market_name' => $skin->market_name,
    'icon_url' => $skin->icon_url,
    'link' => $skin->link,¨
    'price' => $skin->price,
    'steamID' => $skin->steamID,
    'float_value' => $skin->float_value,
    'patternSeed' => $skin->patternSeed
);

//Make JSON
print_r(json_encode($skin_arr));

?>