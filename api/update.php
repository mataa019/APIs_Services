<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->title)) {
    $query = "UPDATE todos SET title = :title, description = :description WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":title", $data->title);
    $stmt->bindParam(":description", $data->description);
    $stmt->bindParam(":id", $data->id);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(array("message" => "To-Do item was updated."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update to-do item."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update to-do item. Data is incomplete."));
}
?>