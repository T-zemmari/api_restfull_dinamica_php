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

    static function getDataWithRelation($rel, $type, $select, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getDataWithRelation($rel, $type, $select, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    //#####################################################################//
    //########## Funcion obtener datos con relaciones con filtros##########//
    //#####################################################################//

    static function  getDataWithRelationAndFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getDataWithRelationAndFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }


    //#####################################################################//
    //########## Funcion obtener datos con relaciones con filtros##########//
    //#####################################################################//

    static function  getDataWithRelationOneSearchAndMAnyFilters($rel, $type, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getDataWithRelationOneSearchAndMAnyFilters($rel, $type, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end);

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
        $response = GetModel::getdataWithSearchAndFilters($table, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }


    //#####################################################################//
    //##########  Funcion obtener datos con rango de fechas     ###########//
    //#####################################################################//

    static function getDataWithRange($tabla, $select, $filter_to, $in_to, $linkTo, $range_1, $range_2, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getDataWithRange($tabla, $select, $filter_to, $in_to, $linkTo, $range_1, $range_2, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }

    //###############################################################################################//
    //##########  Funcion obtener datos con rango de fechas y relaciones entre tablas     ###########//
    //###############################################################################################//

    static function getDataWithRangeAndRel($rel, $type, $select, $filter_to, $in_to, $linkTo, $range_1, $range_2, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $response = GetModel::getDataWithRangeAndRel($rel, $type, $select, $filter_to, $in_to, $linkTo, $range_1, $range_2, $orderBy, $orderInfo, $limit_ini, $limit_end);

        $getController = new GetController();
        $getController->respuestaJson($response);
    }
}
