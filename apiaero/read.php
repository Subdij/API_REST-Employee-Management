<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/vols.php';

$database = new Database();
$db = $database->getConnection();
$items = new vols($db);
$emp=new vols($db);
$stmt = $items->getvols();
$itemCount = $stmt->rowCount();
echo json_encode($itemCount);

if($itemCount > 0){
    $volsArr = array();
    $volsArr["body"] = array();
    $volsArr["itemCount"] = $itemCount;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "num_vol" => $num_vol, //$id
            "villedep" => $villedep, //$name
            "villearr" => $villearr, //$email
            "heuredep" => $heuredep, //$id
            "heurearr" => $heurearr, //$name
            "pilote_id" => $pilote_id, //$email
            "avion_id" => $avion_id //$email
        );
        array_push($volsArr["body"], $e);
    }
    echo json_encode($volsArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>
