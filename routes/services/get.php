<?php

require_once './controllers/get-controller.php';
$tabla=$array_routes[1];
$response =  GetController::getData($tabla);

echo '<pre>'; print_r($response); echo '</pre>';
return;

$json = [
    'status' => 200,
    'result' => "Solicitud GET",
    'data'=>json_encode($response)
];
echo json_encode($json, http_response_code($json['status']));
