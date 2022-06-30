<?php
require_once "models/connection.php";
class PutModel
{

    /*=========================================================
        Editar datos en una tabla de forma dinamica
    ===========================================================*/
    static public function putData($tabla, $data, $id, $column)


    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= $key . " = :" . $key . ",";
        }

        $set = substr($set, 0, -1);
        $sql = "UPDATE $tabla SET $set WHERE $column=:$column";

        $link = Connection::Connect();
        $stmt = $link->prepare($sql);

        try {
            foreach ($data as $key => $value) {
                $stmt->bindParam(":" . $key, $data[$key], PDO::PARAM_STR);
            }
            $stmt->bindParam(":" . $column, $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $response = [
                    'comment' => "El proceso se realizó con exito",
                ];
                return $response;
            } else {
                return $link->errorInfo();
            }
        } catch (PDOException $e) {
            return null;
        }


    }
}
