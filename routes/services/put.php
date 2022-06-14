<?php
$json = [
    'status' => 200,
    'result' => "Solicitud PUT"
];
echo json_encode($json, http_response_code($json['status']));
