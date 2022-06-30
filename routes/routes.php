<?php


$array_routes = explode('/', $_SERVER['REQUEST_URI']);
$array_routes = array_filter($array_routes);
$json = [];

//##########################################################//
//#### Si no se hace ningua peticion a  la api ############//
//#########################################################//

if (empty($array_routes)) {
    $json = [
        'status' => 404,
        'result' => "no hay peticion"
    ];
    echo json_encode($json, http_response_code($json['status']));
    return;
}

//##########################################################//
//####      Si se hace una peticion a la api   ############//
//#########################################################//

if (count($array_routes) == 1 && isset($_SERVER['REQUEST_METHOD'])) {
   
    $tabla = explode("?", $array_routes[1])[0];


    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        include 'routes/services/get.php';
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        include 'routes/services/post.php';
    }
    if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        include 'routes/services/put.php';
    }

    if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        include 'routes/services/delete.php';
    }
}
