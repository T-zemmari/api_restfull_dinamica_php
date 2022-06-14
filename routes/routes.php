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

if(count($array_routes) == 1 && isset($_SERVER['REQUEST_METHOD'])){
    echo '<pre>'; print_r($_SERVER['REQUEST_METHOD']); echo '</pre>';

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $json = [
            'status' => 200,
            'result' => "Solicitud GET"
        ];
        echo json_encode($json, http_response_code($json['status']));
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $json = [
            'status' => 200,
            'result' => "Solicitud POST"
        ];
        echo json_encode($json, http_response_code($json['status']));
    }
    if($_SERVER['REQUEST_METHOD'] == "PUT"){
        $json = [
            'status' => 200,
            'result' => "Solicitud PUT"
        ];
        echo json_encode($json, http_response_code($json['status']));
    }

    if($_SERVER['REQUEST_METHOD'] == "DELETE"){
        $json = [
            'status' => 200,
            'result' => "Solicitud DELETE"
        ];
        echo json_encode($json, http_response_code($json['status']));
    }

}


return;
