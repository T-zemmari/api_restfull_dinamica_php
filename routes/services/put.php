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


    if (isset($_GET['token']) && $_GET['token'] != "") {



        if ($_GET['token'] == 'no' && $_GET['except']) {

            $columns = [$_GET['except']];

            if (empty(Connection::getColumnsData($tabla, $columns))) {
                $json = [
                    'status' => 400,
                    'results' => "Error, los campos del formulario no coinciden con los campos de la tabla" . $tabla,
                ];
                echo json_encode($json, http_response_code($json['status']));
                return;
            }

            $response->putData($tabla, $data, $id, $column);
        } else {
            $tabla_token = $_GET['tabla_token'] ?? "users";
            $sufijo_tabla = $_GET['sufijo_tabla'] ?? "user";

            $validate = Connection::validateToken($_GET['token'], $tabla_token, $sufijo_tabla);



            if ($validate == "Ok") {

                /*=========================================================*/
                /*Token valido*/
                /*=========================================================*/

                $response->putData($tabla, $data, $id, $column);
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
