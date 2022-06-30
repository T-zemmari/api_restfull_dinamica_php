<?php
require_once './controllers/put-controller.php';
require_once './models/connection.php';

$response =  new PutController();

$id = $_GET['id'] ?? null;
$column = $_GET['column'] ?? null;


if (isset($id) && isset($column)) {

    $data = [];
    parse_str(file_get_contents('php://input'), $data);

    $columns = [];
    foreach (array_keys($data) as $key => $value) {
        array_push($columns, $value);
    }

    array_push($columns, $_GET['column']);
    $columns = array_unique($columns);
    
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


    $response->putData($tabla, $data, $id, $column);
}
