<?php


require_once "models/connection.php";

class GetModel
{

    //##########################################################//
    //####         Obtener datos sin mas filtros    ############//
    //#########################################################//
    static public function getData($tabla, $select, $orderBy, $orderInfo)
    {
        $sql = "";
        if ($orderBy != "00" && $orderInfo != "00") {
            $sql = "SELECT $select  FROM $tabla ORDER BY $orderBy $orderInfo";
        } else {
            $sql = "SELECT $select FROM $tabla";
        }
        $stmt = Connection::Connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //##########################################################//
    //####         Obtener datos con el id      ############//
    //#########################################################//

    static public function getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo)
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

        if ($orderBy != "00" && $orderInfo != "00") {
            $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink ORDER BY $orderBy $orderInfo";
        } else {
            $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink ";
        }

        $stmt = Connection::Connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {
            $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
