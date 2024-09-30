<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$request_method = $_SERVER["REQUEST_METHOD"];
$request_uri = $_SERVER["REQUEST_URI"];

switch ($request_method) {
    case 'GET':
        if (preg_match('/\/api\/todos\/?$/', $request_uri)) {
            include_once 'api/read.php';
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Endpoint not found."));
        }
        break;
    case 'POST':
        if (preg_match('/\/api\/todos\/?$/', $request_uri)) {
            include_once 'api/create.php';
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Endpoint not found."));
        }
        break;
    case 'PUT':
        if (preg_match('/\/api\/todos\/?$/', $request_uri)) {
            include_once 'api/update.php';
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Endpoint not found."));
        }
        break;
    case 'DELETE':
        if (preg_match('/\/api\/todos\/?$/', $request_uri)) {
            include_once 'api/delete.php';
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Endpoint not found."));
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
        break;
}
?>