<?php
require_once './models/get-model.php';

class GetController
{


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

    static function getData($tabla,$select)
    {
        $response = GetModel::getData($tabla,$select);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    static function getDataFilter($tabla,$select,$linkTo,$equalTo)
    {
        $response = GetModel::getDataFilter($tabla,$select,$linkTo,$equalTo);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }
}
