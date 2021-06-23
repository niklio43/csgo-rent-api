<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/search.php';

$database = new Database();
$db = $database->connect();



$skin = new Search($db);
$skin->search = isset($_GET['search']) ? $_GET['search'] : die();



$result = $skin->searchSkin();
$rowCount = $result->rowCount();



if($rowCount > 0){

    $skin_arr = array();
    $skin_arr['search'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row);



        $skin_item = array(
            'market_name' => $market_name,
            'name' => $name
        );

        array_push($skin_arr['search'], $skin_item);
    }



    $skin_arr['search']=array_map("unserialize", array_unique(array_map("serialize", $skin_arr['search'])));
    echo json_encode($skin_arr);

} else {
    echo json_encode(
        array('message' => 'No Results Found')
    );
}




?>