<?php
require_once './models/post-model.php';
require_once './models/get-model.php';
require_once './models/put-model.php';
require_once "models/connection.php";
require_once "vendor/autoload.php";

use Firebase\JWT\JWT;

class PostController
{


    //#####################################################################//
    //###################   Funcion respueta en json    ###################//
    //#####################################################################//

    public function respuestaJson($response, $error, $sufijo_tabla)
    {

        if (!empty($response)) {

            /*###########################################*/
            /*##    Eliminar la contraseña del json   ## */
            /*###########################################*/

            if (isset($response[0]["password_" . $sufijo_tabla])) {

                unset($response[0]["password_" . $sufijo_tabla]);
            }

            $json = [
                'status' => 200,
                'total' => count($response),
                'result' => $response
            ];
        } else {

            if ($error != null) {
                $json = [
                    'status' => 400,
                    'result' => $error,
                    'method' => 'post'
                ];
            } else {
                $json = [
                    'status' => 404,
                    'result' => "Información no encontrada",
                    'method' => 'post'
                ];
            }
        }
        echo json_encode($json, http_response_code($json['status']));
    }


    static function postDataLogin($tabla, $body, $sufijo_tabla)

    {

        /*############################################################*/
        /*##    Validar si el usuario existe en la base de datos   ## */
        /*############################################################*/

        $response = GetModel::getDataFilter($tabla, "*", "email_" . $sufijo_tabla, $body["email_" . $sufijo_tabla], null, null, null, null);

        if (!empty($response)) {

            if ($response[0]["password_" . $sufijo_tabla] != null) {
                $crypt = crypt($body["password_" . $sufijo_tabla], '$2a$07$aHasheaHachea052022$$');
                if ($response[0]["password_" . $sufijo_tabla] == $crypt) {

                    $token = Connection::jwt($response[0]["id_" . $sufijo_tabla], $response[0]["email_" . $sufijo_tabla]);
                    $key = "Hola_Soy_laKey_de_momento_para_pruebas";
                    $jwt = JWT::encode($token, $key, 'HS256');

                    $data = [
                        "token_" . $sufijo_tabla => $jwt,
                        "token_exp_" . $sufijo_tabla => $token['exp']
                    ];

                    /*###############################################################*/
                    /*##  Guardar el token en la tabla y registro correspondiente ## */
                    /*###############################################################*/

                    $update = PutModel::putData($tabla, $data, $response[0]["id_" . $sufijo_tabla], "id_" . $sufijo_tabla);


                    if (isset($update) && $update["comment"] == "El proceso se realizó con exito") {

                        $response[0]["token_" . $sufijo_tabla] = $jwt;
                        $response[0]["token_exp_" . $sufijo_tabla] = $token['exp'];
                        $postController = new PostController();
                        $postController->respuestaJson($response, null, $sufijo_tabla);
                    } else {
                        $response = null;
                        $postController = new PostController();
                        $postController->respuestaJson($response, "No se han podido actualizar los datos ", $sufijo_tabla);
                    }
                } else {
                    $response = null;
                    $postController = new PostController();
                    $postController->respuestaJson($response, "Contraseña incorrecta", $sufijo_tabla);
                }
            } else {


                /*##########################################################################################################*/
                /*##   Guarda el token en el caso de que los datos vengan de facebook gmail ..etc o sea (Sin contraseña )## */
                /*##########################################################################################################s*/

                $token = Connection::jwt($response[0]["id_" . $sufijo_tabla], $response[0]["email_" . $sufijo_tabla]);
                $key = "Hola_Soy_laKey_de_momento_para_pruebas";
                $jwt = JWT::encode($token, $key, 'HS256');

                $data = [
                    "token_" . $sufijo_tabla => $jwt,
                    "token_exp_" . $sufijo_tabla => $token['exp']
                ];


                $update = PutModel::putData($tabla, $data, $response[0]["id_" . $sufijo_tabla], "id_" . $sufijo_tabla);


                if (isset($update) && $update["comment"] == "El proceso se realizó con exito") {

                    $response[0]["token_" . $sufijo_tabla] = $jwt;
                    $response[0]["token_exp_" . $sufijo_tabla] = $token['exp'];
                    $postController = new PostController();
                    $postController->respuestaJson($response, null, $sufijo_tabla);
                } else {
                    $response = null;
                    $postController = new PostController();
                    $postController->respuestaJson($response, "No se han podido actualizar los datos ", $sufijo_tabla);
                }
            }
        } else {
            $response = null;
            $postController = new PostController();
            $postController->respuestaJson($response, "No se ha encontrado el email", $sufijo_tabla);
        }
    }

    static function postDataRegister($tabla, $body, $sufijo_tabla)

    {

        /*############################################################*/
        /*##  Peticion POST para el registro de un nuevo usuario   ## */
        /*############################################################*/

        if (isset($body["password_" . $sufijo_tabla])  && $body["password_" . $sufijo_tabla] != null) {

            $crypt = crypt($body["password_" . $sufijo_tabla], '$2a$07$aHasheaHachea052022$$');
            $body["password_" . $sufijo_tabla] = $crypt;
            $response = PostModel::postData($tabla, $body);
            $postController = new PostController();
            $postController->respuestaJson($response, null, null);
        } else {
            /*#################################################*/
            /*##  Peticion POST registro desde app externas ## */
            /*#################################################*/

            $response = PostModel::postData($tabla, $body);
            if (isset($response) && $response["comment"] == "El proceso se realizó con exito") {

                $response = GetModel::getDataFilter($tabla, "*", "email_" . $sufijo_tabla, $body["email_" . $sufijo_tabla], null, null, null, null);

                if (!empty($response)) {
                    $token = Connection::jwt($response[0]["id_" . $sufijo_tabla], $response[0]["email_" . $sufijo_tabla]);

                    $key = "Hola_Soy_laKey_de_momento_para_pruebas";
                    $jwt = JWT::encode($token, $key, 'HS256');

                    $data = [
                        "token_" . $sufijo_tabla => $jwt,
                        "token_exp_" . $sufijo_tabla => $token['exp']
                    ];

                    $update = PutModel::putData($tabla, $data, $response[0]["id_" . $sufijo_tabla], "id_" . $sufijo_tabla);
                    if (isset($update) && $update["comment"] == "El proceso se realizó con exito") {

                        $response[0]["token_" . $sufijo_tabla] = $jwt;
                        $response[0]["token_exp_" . $sufijo_tabla] = $token['exp'];
                        $postController = new PostController();
                        $postController->respuestaJson($response, null, $sufijo_tabla);
                    }
                }
            } else {
                $response = null;
                $postController = new PostController();
                $postController->respuestaJson($response, "Error en el login", $sufijo_tabla);
            }
        }
    }
    /*############################################################*/
    /*##          Peticion POST para el registro de datos      ## */
    /*############################################################*/
    static function postData($tabla, $body)
    {
        // echo '<pre>'; print_r($tabla); echo '</pre>';
        // echo '<pre>'; print_r($body); echo '</pre>';
        // return;
        $response = PostModel::postData($tabla, $body);
        $postController = new PostController();
        $postController->respuestaJson($response, null, null);
    }
}
