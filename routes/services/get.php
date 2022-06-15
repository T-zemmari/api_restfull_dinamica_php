<?php

require_once './controllers/get-controller.php';
$tabla = explode('?', $array_routes[1])[0];
$select = $_GET['select'] ?? "*";
$linkTo = $_GET['linkTo'] ?? null;
$equalTo = $_GET['equalTo'] ?? null;
$orderBy = $_GET['orderBy'] ?? null;
$orderInfo = $_GET['orderInfo'] ?? null;
$limit_ini = $_GET['limit_ini'] ?? null;
$limit_end = $_GET['limit_end'] ?? null;

$response =  new GetController();

if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {

    //#####################################################################//
    //#### Peticiones con filtros orenados o no Limitados o no ############//
    //#####################################################################//

    $response->getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);
} else if (isset($_GET['rel']) && isset($_GET['type']) &&  !isset($_GET['linkTo']) && !isset($_GET['equalTo'])) {

    //#####################################################################//
    //########       Peticiones con relaciones Sin Filtros     ############//
    //#####################################################################//

    $response->getRelationData($_GET['rel'], $_GET['type'], $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
} else if (isset($_GET['rel']) && isset($_GET['type']) &&  isset($_GET['linkTo']) && isset($_GET['equalTo'])) {

    //#####################################################################//
    //#######        Peticiones con relaciones Con Filtros     ############//
    //#####################################################################//

    $response->getRelationDataWithFilter($_GET['rel'], $_GET['type'], $select, $linkTo, $equalTo,  $orderBy, $orderInfo, $limit_ini, $limit_end);
} else {

    //#####################################################################//
    //#### Peticiones sin filtros orenados o no Limitados o no ############//
    //#####################################################################//
    $response->getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
