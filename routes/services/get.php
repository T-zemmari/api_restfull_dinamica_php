<?php

require_once './controllers/get-controller.php';
$tabla = explode("?", $array_routes[1])[0];
$select = $_GET['select'] ?? "*";
$linkTo = $_GET['linkTo'] ?? null;
$equalTo = $_GET['equalTo'] ?? null;
$orderBy = $_GET['orderBy'] ?? null;
$orderInfo = $_GET['orderInfo'] ?? null;
$limit_ini = $_GET['limit_ini'] ?? null;
$limit_end = $_GET['limit_end'] ?? null;
$search = $_GET['search'] ?? null;

$response =  new GetController();

if (isset($_GET['linkTo']) && isset($_GET['equalTo']) && !isset($_GET['rel']) && !isset($_GET['type'])) {
    // echo '<pre>';
    // print_r("estoy getDataFilter ");
    // echo '</pre>';
    // return;
    $response->getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
//#####################################################################//
//########       Peticiones con relaciones Sin Filtros     ############//
//#####################################################################//

else if (isset($_GET['rel']) && isset($_GET['type']) && $tabla == "relaciones"  && !isset($_GET['linkTo']) && !isset($_GET['equalTo'])) {
    // echo '<pre>';
    // print_r("estoy getRelationData");
    // echo '</pre>';
    // return;
    $response->getRelationData($_GET['rel'], $_GET['type'], $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
//#####################################################################//
//#######        Peticiones con relaciones Con Filtros     ############//
//#####################################################################//

else if (isset($_GET['rel']) && isset($_GET['type']) && $tabla == "relaciones"  && isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
    // echo '<pre>';
    // print_r("estoy en relaciones con filtros");
    // echo '</pre>';
    // return;
    $response->getRelationDataWithFilter($_GET['rel'], $_GET['type'], $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);


}
//#####################################################################//
//#######     Peticiones datos con palabras sin filtro     ############//
//#####################################################################//

else if (isset($_GET['linkTo']) && isset($_GET['search'])) {


    $arraySearch = explode('_', $_GET['search']);
    if (count($arraySearch) == 1) {
        // echo '<pre>';
        // print_r("estoy en getdataWithSearch");
        // echo '</pre>';
        // return;
        $response->getdataWithSearch($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
    }
    if (count($arraySearch) > 1) {
        // echo '<pre>';
        // print_r("estoy en getdataWithSearchAndFilters");
        // echo '</pre>';
        // return;
        $response->getdataWithSearchAndFilters($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
    }
}
//#####################################################################//
//########     Peticiones datos con palabras sin filtro    ############//
//#####################################################################//

else if (isset($_GET['linkTo']) && isset($_GET['search'])) {
    // echo '<pre>';
    // print_r("estoy en getdataWithSearchAndFilters");
    // echo '</pre>';
    // return;
    $response->getdataWithSearchAndFilters($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
} else {
    // echo '<pre>';
    // print_r("estoy en getData");
    // echo '</pre>';
    // return;
    $response->getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
