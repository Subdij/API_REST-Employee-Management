<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/Database.php';
    include_once '../class/vols.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new vols($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->num_vol = $data->num_vol;
    $item->villedep = $data->villedep;
    $item->villearr = $data->villearr;
    $item->heuredep = $data->heuredep;
    $item->heurearr = $data->nom;
    $item->pilote_id = $data->pilote_id;
    $item->avion_id = $data->avion_id;
    
    if($item->deletevols()){
        echo json_encode("vols deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>