<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/skin.php';


$database = new Database();
$db = $database->connect();

$skin = new Skin($db);
$result = $skin->readSkins();

$num = $result->rowCount();


if($num > 0){

    $skin_arr = array();
    $skin_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $skin_item = array(
            'skinID' => $skinID,
            'name' => $name,
            'market_name' => $market_name,
            'icon_url' => $icon_url,
            'link' => $link,
            'price' => $price
        );

        array_push($skin_arr['data'], $skin_item);
    }

    echo json_encode($skin_arr);

}else{

echo json_encode(
    array('message' => 'No skins found')
);
}

?>