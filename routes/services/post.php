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


    /*############################################################*/
    /*##       Validar la tabla y los campos de la tabla       ## */
    /*############################################################*/

    if (empty(Connection::getColumnsData($tabla, $columns))) {
        $json = [
            'status' => 400,
            'results' => "Error, los campos del formulario no coinciden con los campos de la tabla" . $tabla,
        ];
        echo json_encode($json, http_response_code($json['status']));
        return;
    }


    /*############################################################*/
    /*##  Peticion POST para el registro de un nuevo usuario   ## */
    /*############################################################*/

    if (isset($_GET['register']) && $_GET['register'] == true) {

        $sufijo_tabla = $_GET['sufijo_tabla'] ?? "user";
        $response->postDataRegister($tabla, $_POST, $sufijo_tabla);
    }
    /*############################################################*/
    /*##   Peticion POST para el login de un nuevo usuario     ## */
    /*############################################################*/

    if (isset($_GET['login']) && $_GET['login'] == true) {

        $sufijo_tabla = $_GET['sufijo_tabla'] ?? "user";
        $response->postDataLogin($tabla, $_POST, $sufijo_tabla);
    } else {
        /*############################################################*/
        /*##   Obtener los datos del body y pasarlos al controlador## */
        /*############################################################*/

        $response->postData($tabla, $_POST);
    }
}
