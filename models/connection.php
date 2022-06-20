<?php

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


    // Informcacion de la base de datos y validar exitencia de una columna en la base de datos;

    static public function getColumnsData($table)
    {

        $database = Connection::infoDatabase()['database'];


        return Connection::Connect()
            ->query("SELECT column_name, data_type FROM INFORMATION_SCHEMA.COLUMNS where table_name = '$table'and table_schema = '$database'")
            ->fetchAll(PDO::FETCH_OBJ);
    }
}
