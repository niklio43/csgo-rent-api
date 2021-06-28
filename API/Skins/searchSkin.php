<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/search.php';

$database = new Database();
$db = $database->connect();

$search = new Search($db);

$search->search = isset($_GET['search']) ? $_GET['search'] : die('Test2');

$result = $search->searchSkin();

$rowCount = $result->rowCount();

if($rowCount > 0){
    $search_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $search_item = array(
            'name' => $name
        );

        array_push($search_arr, $search_item);
    }

    echo json_encode($search_arr);

} else {
    echo json_encode(
        array('message' => 'No Skins Found')
    );
}

?>