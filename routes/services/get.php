<?php

require_once './controllers/get-controller.php';
$tabla = $array_routes[1];

$response =  new GetController();
$response -> getData($tabla);
