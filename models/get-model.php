<?php


require_once "models/connection.php";

class GetModel
{

    //##########################################################//
    //####         Obtener datos sin mas filtros    ############//
    //#########################################################//
    static public function getData($tabla, $select)
    {

        $sql = "SELECT * FROM $tabla";
        $stmt = Connection::Connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //##########################################################//
    //####         Obtener datos con el id      ############//
    //#########################################################//

    static public function getDataFilter($tabla, $select, $linkTo,$equalTo)
    {

        $sql = "SELECT $select FROM $tabla WHERE $linkTo= :$linkTo";
        $stmt = Connection::Connect()->prepare($sql);
        $stmt->bindParam(":".$linkTo,$equalTo,PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
