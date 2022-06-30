<?php
require_once './models/delete-model.php';

class DeleteController{


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
                'method'=>'delete'
            ];
            echo json_encode($json, http_response_code($json['status']));
        }
    }

    static function deleteData($tabla,$id,$column)
    {
        $response = DeleteModel::deleteData($tabla,$id,$column);
        echo '<pre>'; print_r($response); echo '</pre>';
        return;

        $deleteController = new DeleteController();
        $deleteController->respuestaJson($response);
    }
}
