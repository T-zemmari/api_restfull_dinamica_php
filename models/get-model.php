<?php


require_once "models/connection.php";

class GetModel
{

    //##########################################################//
    //####         Obtener datos sin mas filtros    ############//
    //#########################################################//
    static public function getData($tabla, $select, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $arraySelect = explode(',', $select);

        //==============================================//
        //============= Validar columnas 
        //==============================================//

        if (empty(Connection::getColumnsData($tabla, $arraySelect))) {
            return null;
        }

        $sql = "";

        if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select  FROM $tabla ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
        }
        if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select  FROM $tabla ORDER BY $orderBy $orderInfo";
        }
        if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM $tabla LIMIT $limit_ini,$limit_end";
        }

        if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $tabla";
        }



        $stmt = Connection::Connect()->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //##########################################################//
    //####         Obtener datos con filtros      ############//
    //#########################################################//

    static public function getDataFilter($tabla, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {
        $linkToArray = explode(',', $linkTo);
        $arraySelect = explode(',', $select);

        foreach ($linkToArray as $key => $value) {
            array_push($arraySelect, $value);
        }

        $arraySelect = array_unique($arraySelect);

        if (empty(Connection::getColumnsData($tabla, $arraySelect))) {
            return null;
        }

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
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //#####################################################################//
    //#####  Obtener datos con tablas relacionadas sin filtros ############//
    //#####################################################################//

    static public function getDataWithRelation($rel, $type, $select, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $newLink = "";
        $sql = "";
        $arraySelect = explode(',', $select);

        if (count($relArray) > 1) {

            foreach ($relArray as $key => $value) {
                if (empty(Connection::getColumnsData($value, ['*']))) {
                    return null;
                }

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
            try {
                $stmt->execute();
            } catch (PDOException $e) {
                return null;
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    //#####################################################################//
    //#####  Obtener datos con tablas relacionadas con filtros ############//
    //#####################################################################//

    static public function getDataWithRelationAndFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $linkToArray = explode(',', $linkTo);
        $equalToArray = explode('_', $equalTo);
        $arraySelect = explode(',', $select);


        foreach ($linkToArray as $key => $value) {
            array_push($arraySelect, $value);
        }
        $arraySelect = array_unique($arraySelect);

        $newLink = "";
        $newLinkInnerJoin = "";
        $sql = "";

        if (count($relArray) > 1) {
            // echo '<pre>'; print_r($relArray); echo '</pre>';
            // return;
            foreach ($relArray as $key => $value) {
                if (empty(Connection::getColumnsData($value, ['*']))) {
                    return null;
                }

                if ($key > 0) {
                    $newLinkInnerJoin .= " INNER JOIN " . $value . " ON " . $relArray[0] . ".id_" . $typeArray[$key] . "_" . $typeArray[0] . " = " . $value . ".id_" . $typeArray[$key] . " ";
                }
            }
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $newLink .= "AND " . $value . "= :" . $value . " ";
                }
            }

            // Obtener datos ordenados y limitados

            if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin  WHERE $linkToArray[0] = $equalToArray[0] $newLink ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
                // echo '<pre>'; print_r("SELECT $select FROM $relArray[0] $newLinkInnerJoin  WHERE $linkToArray[0] = $equalToArray[0] $newLink ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end"); echo '</pre>';
                // return;

            }

            // Obtener datos ordenados sin limit

            if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin WHERE $linkToArray[0] = $equalToArray[0] $newLink ORDER BY $orderBy $orderInfo";
                //echo '<pre>'; print_r("SELECT $select FROM $relArray[0] $newLinkInnerJoin  WHERE $linkToArray[0] = $equalToArray[0] $newLink ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end"); echo '</pre>';
                // return;
            }
            // Obtener no ordenados con limit

            if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin WHERE $linkToArray[0] = $equalToArray[0] $newLink LIMIT $limit_ini,$limit_end";
                //echo '<pre>'; print_r("SELECT $select FROM $relArray[0] $newLinkInnerJoin  WHERE $linkToArray[0] = $equalToArray[0] $newLink ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end"); echo '</pre>';
                // return;
            }

            // Obtener datos sin orden y sin limit

            if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {

                $sql = "SELECT $select FROM $relArray[0] $newLinkInnerJoin WHERE $linkToArray[0] = :$linkToArray[0] $newLink ";
                // echo '<pre>';
                // print_r("SELECT $select FROM $relArray[0] $newLinkInnerJoin WHERE $linkToArray[0] = :$linkToArray[0] $newLink");
                // echo '</pre>';
                // return;
            }

            $stmt = Connection::Connect()->prepare($sql);


            foreach ($linkToArray as $key => $value) {
                $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
            }

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                return null;
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }


    //#####################################################################//
    //#####  Obtener datos con tablas relacionadas y busqueda  ############//
    //#####################################################################//

    static public function getDataWithRelationOneSearchAndMAnyFilters($rel, $type, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {


        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $newLink = "";
        $linkSearchAndFilters = "";

        $linkToArray = explode(',', $linkTo);
        $searchOrFiltersArray = explode('_', $search);


        $sql = "";

        if (count($relArray) > 1) {

            foreach ($relArray as $key => $value) {
                if (empty(Connection::getColumnsData($value, ['*']))) {
                    return null;
                }
                if ($key > 0) {
                    $newLink .= "INNER JOIN " . $value . " ON " . $relArray[0] . ".id_" . $typeArray[$key] . "_" . $typeArray[0] . " = " . $value . ".id_" . $typeArray[$key] . " ";
                }
            }

            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkSearchAndFilters .= "AND " . $value . " = :" . $value . " ";
                }
            }



            // Obtener datos ordenados y limitados

            if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink  WHERE $linkToArray[0] LIKE '%$searchOrFiltersArray[0]%' $linkSearchAndFilters ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos ordenados sin limit

            if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink WHERE $linkToArray[0] LIKE '%$searchOrFiltersArray[0]%' $linkSearchAndFilters ORDER BY $orderBy $orderInfo";
            }
            // Obtener no ordenados con limit

            if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink WHERE $linkToArray[0] LIKE '%$searchOrFiltersArray[0]%' $linkSearchAndFilters LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos sin orden y sin limit

            if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink WHERE $linkToArray[0] LIKE '%$searchOrFiltersArray[0]%' $linkSearchAndFilters";
                // echo '<pre>';
                // print_r($sql);
                // echo '</pre>';
                //return;
            }

            $stmt = Connection::Connect()->prepare($sql);

            foreach ($linkToArray as $key => $value) {

                if ($key > 0) {
                    // echo '<pre>';
                    // print_r($value);
                    // echo '</pre>';
                    // return;
                    $stmt->bindParam(":" . $value, $searchOrFiltersArray[$key], PDO::PARAM_STR);
                }
            }
            try {
                $stmt->execute();
            } catch (PDOException $e) {
                return null;
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    //#####################################################################//
    //##########      Obtener datos con search sin filtros      ###########//
    //#####################################################################//

    static public function getdataWithSearch($tabla, $select, $linkTo, $search, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $sql = "";

        if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select  FROM $tabla WHERE $linkTo LIKE '%$search%' ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
        }
        if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select  FROM $tabla WHERE $linkTo LIKE '%$search%' ORDER BY $orderBy $orderInfo";
        }
        if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM $tabla WHERE $linkTo LIKE '%$search%' LIMIT $limit_ini,$limit_end";
        }

        if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $tabla WHERE $linkTo LIKE '%$search%' ";
        }


        $stmt = Connection::Connect()->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }
        // $stmt->bindParam(":".$linkTo,$search,PDO::PARAM_STR);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //#####################################################################//
    //##########      Obtener datos con search con filtros      ###########//
    //#####################################################################//

    static public function getdataWithSearchAndFilters($tabla, $select, $linkTo, $search,  $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $sql = "";

        $arrayLinksTo = explode(',', $linkTo);
        $arraySearch = explode('_', $search);
        $newLink = "";

        if (count($arrayLinksTo) > 1) {
            foreach ($arrayLinksTo as $key => $value) {

                if ($key > 0) {
                    $newLink .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select  FROM $tabla WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
        }
        if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select  FROM $tabla WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' ORDER BY $orderBy $orderInfo";
        }
        if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM $tabla WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' LIMIT $limit_ini,$limit_end";
        }

        if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $tabla WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' $newLink ";
        }

        // echo '<pre>'; print_r($sql); echo '</pre>';
        // return;

        $stmt = Connection::Connect()->prepare($sql);
        foreach ($arrayLinksTo as $key => $value) {
            if ($key > 0) {
                $stmt->bindParam(":" . $value, $arraySearch[$key], PDO::PARAM_STR);
            }
        }
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }



        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //#####################################################################//
    //### Obtener datos de tablas relacionadas con search con filtros #####//
    //#####################################################################//

    static public function getReldataWithSearchAndFilters($rel, $type, $select, $linkTo, $search,  $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $sql = "";

        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $arrayLinksTo = explode(',', $linkTo);
        $arraySearch = explode('_', $search);
        $newLink = "";
        $newRelLink = "";


        if ($relArray > 1) {

            foreach ($relArray as $key => $value) {

                if ($key > 0) {
                    $newRelLink .= "INNER JOIN" . $value . "";
                }
            }
        }

        if (count($arrayLinksTo) > 1) {
            foreach ($arrayLinksTo as $key => $value) {
                if ($key > 0) {
                    $newLink .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM $relArray[0] ON $relArray[0].$typeArray[0] $newRelLink WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
        }
        if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $relArray[0] $newRelLink  WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' ORDER BY $orderBy $orderInfo";
        }
        if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM $relArray[0] $newRelLink  WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' LIMIT $limit_ini,$limit_end";
        }

        if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $relArray[0] $newRelLink  WHERE $arrayLinksTo[0] LIKE '%$arraySearch[0]%' $newLink ";
        }

        // echo '<pre>'; print_r($sql); echo '</pre>';
        // return;

        $stmt = Connection::Connect()->prepare($sql);
        foreach ($arrayLinksTo as $key => $value) {
            if ($key > 0) {
                $stmt->bindParam(":" . $value, $arraySearch[$key], PDO::PARAM_STR);
            }
        }
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }



        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //#####################################################################//
    //##########  Funcion obtener datos con rango de fechas     ###########//
    //#####################################################################//


    static function getDataWithRange($tabla, $select, $filter_to, $in_to, $linkTo, $range_1, $range_2, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $sql = "";
        $filter = "";


        if ($filter_to != null && $in_to != null) {

            $filter = "AND " . $filter_to . " IN ('$in_to') ";
        }


        if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select  FROM $tabla WHERE $linkTo BETWEEN $range_1 AND $range_2 $filter ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
        }
        if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select  FROM $tabla WHERE  $linkTo BETWEEN $range_1 AND $range_2 $filter ORDER BY $orderBy $orderInfo";
        }
        if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
            $sql = "SELECT $select FROM  $tabla WHERE$linkTo BETWEEN $range_1 AND $range_2 $filter LIMIT $limit_ini,$limit_end";
        }

        if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
            $sql = "SELECT $select FROM $tabla WHERE $linkTo BETWEEN $range_1 AND $range_2 $filter";

            //return;

        }



        $stmt = Connection::Connect()->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //###############################################################################################//
    //##########  Funcion obtener datos con rango de fechas y relaciones entre tablas     ###########//
    //###############################################################################################//


    static function getDataWithRangeAndRel($rel, $type, $select, $filter_to, $in_to, $linkTo, $range_1, $range_2, $orderBy, $orderInfo, $limit_ini, $limit_end)
    {

        $filter = "";
        if ($filter_to != null && $in_to != null) {
            $filter = "AND " . $filter_to . " IN ('$in_to') ";
        }

        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $newLink = "";
        $sql = "";
        if (count($relArray) > 1) {

            foreach ($relArray as $key => $value) {

                if (empty(Connection::getColumnsData($value, ['*']))) {
                    return null;
                }

                if ($key > 0) {
                    $newLink .= " INNER JOIN " . $value . " ON " . $relArray[0] . ".id_" . $typeArray[$key] . "_" . $typeArray[0] . " = " . $value . ".id_" . $typeArray[$key] . " ";
                }
            }

            // Obtener datos ordenados y limitados

            if ($orderBy != null && $orderInfo != null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink  WHERE $linkTo BETWEEN $range_1 AND $range_2 $filter ORDER BY $orderBy $orderInfo LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos ordenados sin limit

            if ($orderBy != null && $orderInfo != null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink WHERE $linkTo BETWEEN $range_1 AND $range_2 $filter ORDER BY $orderBy $orderInfo";
            }
            // Obtener no ordenados con limit

            if ($orderBy == null && $orderInfo == null && $limit_ini != null && $limit_end != null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink WHERE $linkTo BETWEEN $range_1 AND $range_2 $filter LIMIT $limit_ini,$limit_end";
            }

            // Obtener datos sin orden y sin limit

            if ($orderBy == null && $orderInfo == null && $limit_ini == null && $limit_end == null) {
                $sql = "SELECT $select FROM $relArray[0] $newLink WHERE $linkTo BETWEEN $range_1 AND $range_2 $filter ";
                // echo '<pre>';
                // print_r($sql);
                // echo '</pre>';
            }

            $stmt = Connection::Connect()->prepare($sql);
            try {
                $stmt->execute();
            } catch (PDOException $e) {
                return null;
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
}
