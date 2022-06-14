<?php

$tabla=$array_routes[1];
// echo '<pre>'; print("tabla : ") ;print_r($tabla); echo '</pre>';
// return;

$json = [
    'status' => 200,
    'result' => "Solicitud GET"
];
echo json_encode($json, http_response_code($json['status']));
