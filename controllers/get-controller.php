<?php
require_once './models/get-model.php';

class GetController
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
            ];
            echo json_encode($json, http_response_code($json['status']));
        }
    }

    //#####################################################################//
    //################ Funcion obtener datos sin filtros  #################//
    //#####################################################################//

    static function getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    //#####################################################################//
    //################ Funcion obtener datos con filtros  #################//
    //#####################################################################//

    static function getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    //#####################################################################//
    //########## Funcion obtener datos con relaciones sin filtros##########//
    //#####################################################################//

    static function getRelationData($rel, $type, $select, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getRelationData($rel, $type, $select, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    //#####################################################################//
    //########## Funcion obtener datos con relaciones con filtros##########//
    //#####################################################################//

    static function  getRelationDataWithFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getRelationDataWithFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);
      
        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    //#####################################################################//
    //##########  Funcion obtener datos con search sin filtros  ###########//
    //#####################################################################//

    static function  getdataWithSearch($table, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getdataWithSearch($table, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }



    //#####################################################################//
    //##########  Funcion obtener datos con search con filtros  ###########//
    //#####################################################################//

    static function  getdataWithSearchAndFilters($table, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getdataWithSearchAndFilters($table, $select, $linkTo, $search,$orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }
}
