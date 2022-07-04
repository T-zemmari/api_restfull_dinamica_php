<?php

require_once './controllers/get-controller.php';
$select = $_GET['select'] ?? "*";
$linkTo = $_GET['linkTo'] ?? null;
$equalTo = $_GET['equalTo'] ?? null;
$orderBy = $_GET['orderBy'] ?? null;
$orderInfo = $_GET['orderInfo'] ?? null;
$limit_ini = $_GET['limit_ini'] ?? null;
$limit_end = $_GET['limit_end'] ?? null;
$search = $_GET['search'] ?? null;
$filter_to = $_GET['filter_to'] ?? null;
$in_to = $_GET['in_to'] ?? null;

$response =  new GetController();

if (isset($_GET['linkTo']) && isset($_GET['equalTo']) && !isset($_GET['rel']) && !isset($_GET['type']) && !isset($_GET['range_1']) && !isset($_GET['range_2'])) {

    $response->getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
//#####################################################################//
//########       Peticiones con relaciones Sin Filtros     ############//
//#####################################################################//

else if (isset($_GET['rel']) && isset($_GET['type']) && $tabla == "relaciones"  && !isset($_GET['linkTo']) && !isset($_GET['equalTo'])) {

    $response->getDataWithRelation($_GET['rel'], $_GET['type'], $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
//#####################################################################//
//#######        Peticiones con relaciones Con Filtros     ############//
//#####################################################################//

else if (isset($_GET['rel']) && isset($_GET['type']) && $tabla == "relaciones"  && isset($_GET['linkTo']) && isset($_GET['equalTo'])) {
 
    $response->getDataWithRelationAndFilter($_GET['rel'], $_GET['type'], $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);
}

//#####################################################################//
//#######     Peticiones datos con palabras sin filtro     ############//
//#####################################################################//

else if (isset($_GET['linkTo']) && isset($_GET['search']) && !isset($_GET['rel']) && !isset($_GET['type'])) {

    $arraySearch = explode('|', $_GET['search']);
    if (count($arraySearch) == 1) {
   
        $response->getdataWithSearch($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
    }
    if (count($arraySearch) > 1) {
     
        $response->getdataWithSearchAndFilters($tabla, $select, $_GET['linkTo'], $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
    }
} else if (isset($_GET['linkTo']) && isset($_GET['search']) && $tabla == "relaciones" && isset($_GET['rel']) && isset($_GET['type'])) {



    $response->getDataWithRelationOneSearchAndMAnyFilters($_GET['rel'], $_GET['type'], $select, $linkTo, $_GET['search'], $orderBy, $orderInfo, $limit_ini, $limit_end);
} else if (isset($_GET['linkTo']) && isset($_GET['range_1']) && isset($_GET['range_2']) && !isset($_GET['rel']) && !isset($_GET['type'])) {

   
    $response->getDataWithRange($tabla, $select, $filter_to, $in_to, $linkTo, $_GET['range_1'], $_GET['range_2'], $orderBy, $orderInfo, $limit_ini, $limit_end);
} else if (isset($_GET['linkTo']) && isset($_GET['range_1']) && isset($_GET['range_2']) && $tabla == "relaciones" && isset($_GET['rel']) && isset($_GET['type'])) {

   
    $response->getDataWithRangeAndRel($_GET['rel'], $_GET['type'], $select, $filter_to, $in_to, $linkTo, $_GET['range_1'], $_GET['range_2'], $orderBy, $orderInfo, $limit_ini, $limit_end);
} else {

    
  
    $response->getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end);
}
