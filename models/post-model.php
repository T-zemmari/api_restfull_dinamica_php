<?php
require_once "models/connection.php";
class PostModel
{

    /*=========================================================
    
    ===========================================================*/
    static public function postData($tabla, $body)

    {
        $sql = "";
        $column_name = "";
        $column_value = "";

        foreach ($body as $key => $value) {
            if ($key > 0) {
                $column_name .= $key . ",";
                $column_value .= ":".$key. ",";
            }
        }

        $column_name = substr($column_name, 0, -1);
        $column_value = substr($column_value, 0, -1);
        $sql = "INSERT INTO $tabla ($column_name)VALUES($column_value)";

        $stmt = Connection::Connect()->prepare($sql);

        try {
            foreach ($body as $key => $value) {
                $stmt->bindParam(":" . $key, $body[$key], PDO::PARAM_STR);
            }
            if ($stmt->execute()) {
                $response = [
                    'comment' => "El proceso se realizó con exito",
                ];
                return $response;
            } else {
                return Connection::Connect()->errorInfo();
            }
        } catch (PDOException $e) {
            return null;
        }
    }
}
