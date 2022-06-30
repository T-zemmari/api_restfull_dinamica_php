<?php

require_once './controllers/delete-controller.php';
require_once './models/connection.php';



if (isset($_GET['id']) && isset($_GET['column'])) {

    $columns = [$_GET['column']];
    
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
       Pasar los datos id y columna al controlador
    ===========================================================*/

    echo '<pre>'; print_r($_GET['column']); echo '</pre>';
    echo '<pre>'; print_r($_GET['id']); echo '</pre>';
    echo '<pre>'; print_r($tabla); echo '</pre>';
    //return;
    $response =  new DeleteController();
    $response->deleteData($tabla,$_GET['id'],$_GET['column']);
}
