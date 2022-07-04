<?php
require_once './models/post-model.php';
require_once './models/get-model.php';
class PostController
{


    //#####################################################################//
    //###################   Funcion respueta en json    ###################//
    //#####################################################################//

    public function respuestaJson($response, $error)
    {

        if (!empty($response)) {
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
            $crypt = crypt($body["password_" . $sufijo_tabla], '$2a$07$aHasheaHachea052022$$');
            if ($response[0]["password_" . $sufijo_tabla] == $crypt) {
                /*#######################*/
                /*##    Crear token   ## */
                /*#######################*/
            } else {
                $response = null;
                $postController = new PostController();
                $postController->respuestaJson($response, "Contraseña incorrecta");
            }
        } else {
            $response = null;
            $postController = new PostController();
            $postController->respuestaJson($response, "No se ha encontrado el email  ");
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
            $postController->respuestaJson($response, null);
        }
    }
    /*############################################################*/
    /*##          Peticion POST para el registro de datos      ## */
    /*############################################################*/
    static function postData($tabla, $body)
    {
        $response = PostModel::postData($tabla, $body);
        $postController = new PostController();
        $postController->respuestaJson($response, null);
    }
}
