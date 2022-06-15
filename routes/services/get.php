<?php

require_once './controllers/get-controller.php';
$tabla = explode('?', $array_routes[1])[0];
$select = $_GET['select'] ?? "*";

$response =  new GetController();

if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
    $response->getDataFilter($tabla, $select, $_GET['linkTo'], $_GET['equalTo']);
} else {
    $response->getData($tabla, $select);
}
