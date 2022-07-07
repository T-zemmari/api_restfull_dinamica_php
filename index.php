<?php

//##########################################################//
//############### CONFIGURAR CORS #########################//
//#########################################################//

// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept");
// header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE');
// header('Content-type:application/json; charset=utf-8');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");


//##########################################################//
//############### MOSTRAR ERRORES #########################//
//#########################################################//

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', "C:/xampp\htdocs\Proyectos\React\Api-restfull-dinamica-php/php_error_log");



//##########################################################//
//################## Controlador ###########################//
//#########################################################//

require_once "models/connection.php";
require_once "controllers/routes-controller.php";

$index = new RoutersController();
$index->index();
