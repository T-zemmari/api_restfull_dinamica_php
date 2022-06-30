<?php
require_once './models/put-model.php';

class PutController{


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
                'method'=>'post'
            ];
            echo json_encode($json, http_response_code($json['status']));
        }
    }

    static function putData($tabla, $data,$id,$column)
    {
        $response = PutModel::putData($tabla, $data,$id,$column);
        $putController = new PutController();
        $putController->respuestaJson($response);
    }
}
