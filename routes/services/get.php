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
$search = $_GET['search'] ?? null;

$response =  new GetController();

if (isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
    $response->getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
//#####################################################################//
//########       Peticiones con relaciones Sin Filtros     ############//
//#####################################################################//

else if (isset($_GET['rel']) && isset($_GET['type']) &&  !isset($_GET['linkTo']) && !isset($_GET['equalTo'])) {
    $response->getRelationData($_GET['rel'], $_GET['type'], $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
//#####################################################################//
//#######        Peticiones con relaciones Con Filtros     ############//
//#####################################################################//

else if (isset($_GET['rel']) && isset($_GET['type']) &&  isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
    $response->getRelationDataWithFilter($_GET['rel'], $_GET['type'], $select, $linkTo, $equalTo,  $orderBy, $orderInfo, $limit_ini, $limit_end);
}
//#####################################################################//
//#######     Peticiones datos con palabras sin filtro     ############//
//#####################################################################//

else if (isset($_GET['linkTo']) && isset($_GET['search'])) {
    $arraySearch = explode('_', $_GET['search']);
    if (count($arraySearch) == 1) {
        $response->getdataWithSearch($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
    }
    if (count($arraySearch) > 1) {
        $response->getdataWithSearchAndFilters($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
    }
}
//#####################################################################//
//########     Peticiones datos con palabras sin filtro    ############//
//#####################################################################//

else if (isset($_GET['linkTo']) && isset($_GET['search'])) {
    $response->getdataWithSearchAndFilters($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
} else {
    $response->getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
