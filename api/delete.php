<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../database.php");
require_once("../person.php");
$connection = new Database();
$person = new Person($connection->getConnection());
$input = json_decode(file_get_contents("php://input"));
$person->pid = $input->id;

if($person->delete()) {
    echo json_encode(array(
        "success" => true,
        "code" => 200,
        "message" => "Se a eliminado exitosamente."
    ));
} else {
    echo json_encode(array(
        "success" => false,
        "code" => 200,
        "message" => "La persona no existe."
    ));
}