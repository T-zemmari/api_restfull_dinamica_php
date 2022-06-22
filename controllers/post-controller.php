<?php
require_once './models/post-model.php';

class PostController{


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
            ];
            echo json_encode($json, http_response_code($json['status']));
        }
    }

    static function postData($tabla, $body)
    {
        $response = PostModel::postData($tabla, $body);
        echo '<pre>'; print_r($response); echo '</pre>';
        return;

    
        $postController = new PostController();
        $postController->respuestaJson($response);
    }








}