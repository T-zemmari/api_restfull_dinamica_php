<?php
require_once "models/connection.php";
require_once "models/get-model.php";
class DeleteModel
{

    /*=========================================================
        Eliminar registro mediante un id 
    ===========================================================*/

    static public function deleteData($tabla, $id, $column)
    {
     
        /*=========================================================
        Validar el id de la tabla 
    ===========================================================*/

        $response = GetModel::getDataFilter($tabla, $column, $column, $id, null, null, null, null);
        if (count($response) == 0) {

            $response = [
                'comment' => "El id no se encuentra registrado en la base de datos",
            ];
            return $response;
        }


        /*=========================================================
        Eliminar el registro
    ===========================================================*/
        $sql = "DELETE FROM $tabla WHERE $column = :$column ";
      
        $link = Connection::Connect();
        $stmt = $link->prepare($sql);

        try {
            $stmt->bindParam(":" . $column, $id, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $response = [
                    'comment' => "El proceso se realizó con exito",
                ];
                return $response;
            } else {

                return $link->errorInfo();
            }
            //echo '<pre>'; print_r($link->errorInfo()); echo '</pre>';
        } catch (PDOException $e) {
            //echo '<pre>'; print_r($e); echo '</pre>';
            return null;
        }
    }
}
