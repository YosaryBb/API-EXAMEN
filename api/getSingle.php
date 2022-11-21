<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../database.php");
require_once("../person.php");
$connection = new Database();
$person = new Person($connection->getConnection());
$input = json_decode(file_get_contents("php://input"));
$person->pid = $input->id;

$data = $person->getSingle();

if($data != null) {
    echo json_encode($data);
} else {
    echo json_encode(array(
        "success" => false,
        "code" => 200,
        "message" => "La persona no existe."
    ));
}