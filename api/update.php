<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../class/Employee.php';

$database = new Database();
$db = $database->getConnection();

$item = new Employee($db);

$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

if(isset($data->name)) {
    $item->name = $data->name;
}
if(isset($data->email)) {
    $item->email = $data->email;
}
if(isset($data->age)) {
    $item->age = $data->age;
}
if(isset($data->designation)) {
    $item->designation = $data->designation;
}
if(isset($data->created)) {
    $item->created = $data->created;
}

if($item->updateEmployee()){
    echo json_encode("Employee updated.");
} else{
    echo json_encode("Data could not be updated.");
}
?>
