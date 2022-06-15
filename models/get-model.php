<?php


require_once "models/connection.php";

class GetModel
{

    //##########################################################//
    //####         Obtener datos sin mas filtros    ############//
    //#########################################################//
    static public function getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $sql = "";
        if ($orderBy != null && $orderInfo != null) {
            if ($limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select  FROM $tabla ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
            } else {
                $sql = "SELECT $select  FROM $tabla ORDER BY $orderBy $orderInfo";
            }
        } else {
            if ($limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $tabla LIMIT $limit_ini,$limit_end";
            } else {
                $sql = "SELECT $select FROM $tabla";
            }
        }
        $stmt = Connection::Connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //##########################################################//
    //####         Obtener datos con el id      ############//
    //#########################################################//

    static public function getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $linkToArray = explode(',', $linkTo);
        $equalToArray = explode('_', $equalTo);
        $newLink = "";
        if (count($linkToArray) > 1) {

            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $newLink .= "AND " . $value . "= :" . $value . " ";
                }
            }
        }
        $sql = "";

        if ($orderBy != null && $orderInfo != null) {
            if ($limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
            } else {
                $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink ORDER BY $orderBy $orderInfo";
            }
        } else {
            if ($limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink LIMIT $limit_ini,$limit_end";
            } else {
                $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink ";
            }
        }

        $stmt = Connection::Connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {
            $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
