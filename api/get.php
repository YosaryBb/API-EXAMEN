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

$data = $person->get();
$response = array();

if($data != null) {
    while ($row = mysqli_fetch_assoc($data)) {
        array_push($response, $row);
    }
    echo json_encode($response);
} else {
    echo json_encode(array(
        "success" => false,
        "code" => 200,
        "message" => "No hay datos."
    ));
}