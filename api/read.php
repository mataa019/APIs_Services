<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT id, title, description, created_at FROM todos";
$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $todos_arr = array();
    $todos_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $todo_item = array(
            "id" => $id,
            "title" => $title,
            "description" => html_entity_decode($description),
            "created_at" => $created_at
        );
        array_push($todos_arr["records"], $todo_item);
    }

    http_response_code(200);
    echo json_encode($todos_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No to-do items found."));
}
?>