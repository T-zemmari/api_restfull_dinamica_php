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

    static function getData($tabla,$select, $orderBy, $orderInfo,$limit_ini,$limit_end)
    {
        $response = GetModel::getData($tabla,$select, $orderBy, $orderInfo,$limit_ini,$limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    static function getDataFilter($tabla,$select,$linkTo,$equalTo, $orderBy, $orderInfo,$limit_ini,$limit_end)
    {
        $response = GetModel::getDataFilter($tabla,$select,$linkTo,$equalTo, $orderBy, $orderInfo,$limit_ini,$limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }
}
