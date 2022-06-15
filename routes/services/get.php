<?php

require_once './controllers/get-controller.php';
$tabla = explode('?', $array_routes[1])[0];
$select = $_GET['select'] ?? "*";

$response =  new GetController();

if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
    if (isset($_GET['orderBy']) && isset($_GET['orderInfo'])) {
        if (isset($_GET['limit_ini']) && isset($_GET['limit_end'])) {
            $response->getDataFilter($tabla, $select, $_GET['linkTo'], $_GET['equalTo'], $_GET['orderBy'], $_GET['orderInfo'], $_GET['limit_ini'], $_GET['limit_end']);
        } else {
            $response->getDataFilter($tabla, $select, $_GET['linkTo'], $_GET['equalTo'], $_GET['orderBy'], $_GET['orderInfo'], null, null);
        }
    } else {
        if (isset($_GET['limit_ini']) && isset($_GET['limit_end'])) {
            $response->getDataFilter($tabla, $select, $_GET['linkTo'], $_GET['equalTo'], null, null,$_GET['limit_ini'], $_GET['limit_end']);
        } else {
            $response->getDataFilter($tabla, $select, $_GET['linkTo'], $_GET['equalTo'], null, null,null,null);
        }
    }
} else {
    if (isset($_GET['orderBy']) && isset($_GET['orderInfo'])) {
        if (isset($_GET['limit_ini']) && isset($_GET['limit_end'])) {
            $response->getData($tabla, $select, $_GET['orderBy'], $_GET['orderInfo'], $_GET['limit_ini'], $_GET['limit_end']);
        } else {
            $response->getData($tabla, $select, $_GET['orderBy'], $_GET['orderInfo'], null, null);
        }
    } else {
        if (isset($_GET['limit_ini']) && isset($_GET['limit_end'])) {
            $response->getData($tabla, $select, null, null, $_GET['limit_ini'], $_GET['limit_end']); 
        }else{
            $response->getData($tabla, $select, null, null,null,null);  
        }
      
    }
}
