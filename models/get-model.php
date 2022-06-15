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
    //####         Obtener datos con filtros      ############//
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

        // Obtener datos ordenados y limitados

        if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM $tabla  WHERE $linkToArray[0]= :$linkToArray[0] $newLink ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
        }

        // Obtener datos ordenados sin limit

        if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink  ORDER BY $orderBy $orderInfo";
        }
        // Obtener no ordenados con limit

        if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink  LIMIT $limit_ini,$limit_end";
        }

        // Obtener datos sin orden y sin limit

        if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $tabla WHERE $linkToArray[0]= :$linkToArray[0] $newLink ";
        }
        $stmt = Connection::Connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {
            $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //#####################################################################//
    //#####  Obtener datos con tablas relacionadas sin filtros ############//
    //#####################################################################//

    static public function getRelationData($rel, $type, $select, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $newLink = "";
        $sql = "";
        if (count($relArray) > 1) {

            foreach ($relArray as $key => $value) {
                if ($key > 0) {
                    $newLink .= " INNER JOIN " . $value . " ON " . $relArray[0] . ".id_" . $typeArray[$key] . "_" . $typeArray[0] . " = " . $value . ".id_" . $typeArray[$key] . " ";
                }
            }

            // Obtener datos ordenados y limitados

            if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink  ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos ordenados sin limit

            if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink ORDER BY $orderBy $orderInfo";
            }
            // Obtener no ordenados con limit

            if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos sin orden y sin limit

            if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink";
            }

            $stmt = Connection::Connect()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    //#####################################################################//
    //#####  Obtener datos con tablas relacionadas sin filtros ############//
    //#####################################################################//

    static public function getRelationDataWithFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $linkToArray = explode(',', $linkTo);
        $equalToArray = explode('_', $equalTo);
        $newLink = "";
        $newLinkInnerJoin = "";
        $sql = "";

        if (count($linkToArray) > 1) {

            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $newLink .= "AND " . $value . "= :" . $value . " ";
                }
            }
        }


        if (count($relArray) > 1) {

            foreach ($relArray as $key => $value) {
                if ($key > 0) {
                    $newLinkInnerJoin .= " INNER JOIN " . $value . " ON " . $relArray[0] . ".id_" . $typeArray[$key] . "_" . $typeArray[0] . " = " . $value . ".id_" . $typeArray[$key] . " ";
                }
            }

            // Obtener datos ordenados y limitados

            if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin  WHERE $newLink ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos ordenados sin limit

            if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin WHERE $newLink ORDER BY $orderBy $orderInfo";
            }
            // Obtener no ordenados con limit

            if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin WHERE $newLink LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos sin orden y sin limit

            if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin WHERE $newLink ";
            }

            $stmt = Connection::Connect()->prepare($sql);
            $stmt->execute();

            foreach ($linkToArray as $key => $value) {
                $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
}
