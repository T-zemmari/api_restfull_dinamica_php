<?php
require_once './controllers/post-controller.php';
require_once './models/connection.php';
$_POST = $_POST ?? null;


$json = file_get_contents('php://input');
$dataObj = json_decode($json, true);
$_POST=$dataObj;


// echo '<pre>'; print_r($tabla); echo '</pre>';
// echo '<pre>'; print_r($_POST); echo '</pre>';
// echo '<pre>'; print_r($sufijo_tabla); echo '</pre>';
// return;

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




    if (isset($_GET['register']) && $_GET['register'] == true) {
        /*############################################################*/
        /*##  Peticion POST para el registro de un nuevo usuario   ## */
        /*############################################################*/



        $sufijo_tabla = $_GET['sufijo_tabla'] ?? "user";

        $sufijo_tabla = $_GET['sufijo_tabla'] ?? "user";
        // echo '<pre>';
        // print_r($tabla);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($sufijo_tabla);
        // echo '</pre>';
        // return;
        $response->postDataRegister($tabla, $_POST, $sufijo_tabla);

    } elseif (isset($_GET['login']) && $_GET['login'] == true) {
        /*############################################################*/
        /*##   Peticion POST para el login de un nuevo usuario     ## */
        /*############################################################*/


        $response->postDataLogin($tabla, $_POST, $sufijo_tabla);
    } else {
        /*############################################################*/
        /*##   Obtener los datos del body y pasarlos al controlador## */
        /*############################################################*/

        // Obtener el token desde la url y pasarla al metodo validateToken

        if (isset($_GET['token'])) {


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

                $response->postData($tabla, $_POST);
            } else {

                $tabla_token = $_GET['tabla_token'] ?? "users";
                $sufijo_tabla = $_GET['sufijo_tabla'] ?? "user";

                $validate = Connection::validateToken($_GET['token'], $tabla_token, $sufijo_tabla);



                if ($validate == "Ok") {

                    /*=========================================================*/
                    /*Token valido*/
                    /*=========================================================*/

                    $response->postData($tabla, $_POST);
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
}
