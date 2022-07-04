<?php
require_once "models/get-model.php";
require_once "vendor/autoload.php";

use Firebase\JWT\JWT;


class Connection
{

    //##########################################################//
    //################## Base de datos #########################//
    //#########################################################//

    static public  function infoDatabase()
    {

        $infoDataBase = [
            "database" => "api_restful",
            "user" => "root",
            "pass" => ""
        ];

        return $infoDataBase;
    }


    //##########################################################//
    //##################   Connexion  #########################//
    //#########################################################//

    static public function Connect()
    {

        try {
            $link = new PDO("mysql:host=localhost;dbname=" . Connection::infoDatabase()['database'], Connection::infoDatabase()['user'], Connection::infoDatabase()['pass']);
            $link->exec("set names utf8 ");
        } catch (PDOException $e) {
            die("Error :" . $e->getMessage());
        }

        return $link;
    }


    /*============================================================================================
     Informcacion de la base de datos y validar exitencia de una columna en la base de datos
    ==============================================================================================*/

    static public function getColumnsData($table, $columns)
    {

        /*=================================================*/
        /*Obtener el nombre de la base de datos*/
        /*=================================================*/

        $database = Connection::infoDatabase()['database'];

        /*=================================================*/
        /*Obtener todas las columnas de una tabla*/
        /*=================================================*/
        $validate = Connection::Connect()
            ->query("SELECT column_name as item  FROM INFORMATION_SCHEMA.COLUMNS where table_name = '$table'and table_schema = '$database'")
            ->fetchAll(PDO::FETCH_OBJ);

        /*=================================================*/
        /*Validar la existencia de la tabla*/
        /*=================================================*/

        if (empty($validate)) {
            return null;
        } else {

            /*=================================================*/
            /*Validar la existencia de las columnas*/
            /*=================================================*/



            /*=================================================*/
            /*Ajuste de seleccion de columnas globales*/
            /*=================================================*/

            if ($columns[0] == "*") {
                array_shift($columns);
            }
            $sum = 0;

            foreach ($validate as $key => $value) {
                $sum += in_array($value->item, $columns);
            }
            return $sum == count($columns) ? $validate : null;
        }
    }


    /*=================================================*/
    /*Genereacion del token de authenticacion*/
    /*=================================================*/

    static public function jwt($id, $email)
    {
        $time = time();

        $token = [
            'iat' => $time,  // El tiempo en el que inicia el token.
            'exp' => $time + (60 * 60 * 24), // El tiempo de expiracíon del token (1 dia).
            'data' => [
                'id' => $id,
                'email' => $email
            ]
        ];


        return $token;

        // echo '<pre>';
        // print_r($jwt);
        // echo '</pre>';
    }

    /*=================================================*/
    /*Validar el token recibido despues del login */
    /*=================================================*/

    static public function validateToken($token, $tabla, $sufijo_tabla)
    {

        $user = GetModel::getDataFilter($tabla, "token_exp_" . $sufijo_tabla, "token_" . $sufijo_tabla, $token, null, null, null, null);

        if (!empty($user)) {

            /*=================================================*/
            /*Validacion del tiempo expiracion  del token*/
            /*=================================================*/

            $time = time();
            if ($time < $user[0]["token_exp_" . $sufijo_tabla]) {
                return "Ok";
            } else {
                return "Expirado";
            }
        } else {
            return "No-autorizado";
        }
    }


    /*=================================================*/
    /*Api key */
    /*=================================================*/

    static public function apiKey()
    {

        $apiKey = "nnpTFTjQi5wdVvz6HqP4VcQUXhedaL";

        return  $apiKey;
    }
}
