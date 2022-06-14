<?php


$json = [
    'status' => 200,
    'result' => "Solicitud DELETE"
];
echo json_encode($json, http_response_code($json['status']));
