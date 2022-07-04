<?php
require_once './models/post-model.php';

class PostController
{


    //#####################################################################//
    //###################   Funcion respueta en json    ###################//
    //#####################################################################//

    public function respuestaJson($response)
    {

        if (!empty($response)) {
            $json = [
                'status' => 200,
                'total' => count($response),
                'result' => $response
            ];
            echo json_encode($json, http_response_code($json['status']));
        } else {
            $json = [
                'status' => 404,
                'result' => "Información no encontrada",
                'method' => 'post'
            ];
            echo json_encode($json, http_response_code($json['status']));
        }
    }


    static function postDataRegister($tabla, $body, $sufijo_tabla)

    {

        /*############################################################*/
        /*##  Peticion POST para el registro de un nuevo usuario   ## */
        /*############################################################*/

        if (isset($body["password_" . $sufijo_tabla])  && $body["password_" . $sufijo_tabla] != null) {

            $crypt = crypt($body["password_" . $sufijo_tabla], '$2a$07$HasheaHachea052022$');
            $body["password_" . $sufijo_tabla] = $crypt;
            $response = PostModel::postData($tabla, $body);
            $postController = new PostController();
            $postController->respuestaJson($response);
        }
    }
    /*############################################################*/
    /*##          Peticion POST para el registro de datos      ## */
    /*############################################################*/
    static function postData($tabla, $body)
    {
        $response = PostModel::postData($tabla, $body);
        $postController = new PostController();
        $postController->respuestaJson($response);
    }
}
