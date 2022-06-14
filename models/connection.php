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
}
