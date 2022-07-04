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




    if (isset($_GET['token']) && $_GET['token'] != "") {
        $tabla_token = $_GET['tabla_token'] ?? "users";
        $sufijo_tabla = $_GET['sufijo_tabla'] ?? "user";

        $validate = Connection::validateToken($_GET['token'], $tabla_token, $sufijo_tabla);

        if ($validate == "Ok") {

            /*=========================================================*/
            /*Token valido*/
            /*=========================================================*/

            $response =  new DeleteController();
            $response->deleteData($tabla, $_GET['id'], $_GET['column']);
        }
        if ($validate == "Expirado") {

            /*=========================================================*/
            /*Token expirado */
            /*=========================================================*/
            $json = [
                'status' => 303,
                'results' => "Error, el token ha exiprado"
            ];
            echo json_encode($json, http_response_code($json['status']));
            return;
        }
        if ($validate == "No-autorizado") {
            /*=========================================================*/
            /*Token no valido valido*/
            /*=========================================================*/
            $json = [
                'status' => 300,
                'results' => "El usuario no esta autorizado"
            ];
            echo json_encode($json, http_response_code($json['status']));
            return;
        }
    } else {

        /*=========================================================*/
        /*No se ha recibido ningun token */
        /*=========================================================*/
        $json = [
            'status' => 404,
            'results' => "La autentificacion es requerida"
        ];
        echo json_encode($json, http_response_code($json['status']));
        return;
    }
}
