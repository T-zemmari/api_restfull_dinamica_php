<?php


require_once "models/connection.php";

class GetModel
{
    static public function getData($tabla)
    {

        $sql = "SELECT * FROM $tabla";
        $stmt = Connection::Connect()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}
