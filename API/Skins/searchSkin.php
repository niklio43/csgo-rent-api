<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/skin.php';


$database = new Database();
$db = $database->connect();

$skin = new Skin($db);
$skin->name = isset($_GET['name']) ? $_GET['name'] : die();

$result = $skin->searchSkin();

if($result != NULL){

    $skin_arr = array();
    $skin_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $skin_item = array(
            'name' => $name
        );

        array_push($skin_arr['data'], $skin_item);
    }

    echo json_encode($skin_arr);

}else{

    $skin_arr = array();
    $skin_arr['data'] = array();

    $skin_item = array(
        'name' => ''
    );

    array_push($skin_arr['data'], $skin_item);

    echo json_encode($skin_arr);

}
?>