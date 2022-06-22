<?php
require_once './controllers/post-controller.php';
require_once './models/connection.php';
$_POST = $_POST ?? null;
$response =  new PostController();


if (isset($_POST)) {


    $columns = [];
    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns, $value);
    }

    /*=========================================================
    Validar la tabla y los campos de la tabla 
    ===========================================================*/
    if (empty(Connection::getColumnsData($tabla, $columns))) {
        $json = [
            'status' => 400,
            'results' => "Error, los campos del formulario no coinciden con los campos de la tabla" . $tabla,
        ];
        echo json_encode($json, http_response_code($json['status']));
        return;
    }
    /*=========================================================
       Obtener los datos del body y pasarlos al controlador
    ===========================================================*/


    $response->postData($tabla, $_POST);
}
