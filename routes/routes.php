<?php

// echo '<pre>'; print_r($_SERVER['REQUEST_URI']); echo '<pre>';
// return;

$array_routes = explode('/', $_SERVER['REQUEST_URI']);
$array_routes = array_filter($array_routes);
$json = [];

if (empty($array_routes)) {
    $json = [
        'status' => 404,
        'result' => "no hay informacion"
    ];
    echo json_encode($json);
} else {
    $json = [
        'status' => 200,
        'result' => 'hola'
    ];
    echo json_encode($json);
}
// echo '<pre>';
// print_r($array_routes);
// echo '<pre>';
// return;



return;
