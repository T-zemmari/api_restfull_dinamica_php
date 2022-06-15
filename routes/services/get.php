<?php

require_once './controllers/get-controller.php';
$tabla = explode('?', $array_routes[1])[0];
$select = $_GET['select'] ?? "*";

$response =  new GetController();

if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
    if (isset($_GET['orderBy']) && isset($_GET['orderInfo'])) {
        $response->getDataFilter($tabla, $select, $_GET['linkTo'], $_GET['equalTo'], $_GET['orderBy'], $_GET['orderInfo']);
    } else {
        $response->getDataFilter($tabla, $select, $_GET['linkTo'], $_GET['equalTo'], '00', '00');
    }
} else {
    if (isset($_GET['orderBy']) && isset($_GET['orderInfo'])) {
        $response->getData($tabla, $select, $_GET['orderBy'], $_GET['orderInfo']);
    } else {
        $response->getData($tabla, $select, '00', '00');
    }
}
