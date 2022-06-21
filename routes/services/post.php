<?php
require_once './controllers/post-controller.php';

$tabla = explode("?", $array_routes[1])[0];
$body = $_POST['body'] ?? null;

if (isset($body)) {
    $response->createNew($tabla, $_POST['body']);
}
