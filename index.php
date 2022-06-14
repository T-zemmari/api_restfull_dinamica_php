<?php

//##########################################################//
//############### MOSTRAR ERRORES #########################//
//#########################################################//

ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log',"C:/xampp\htdocs\Proyectos\React\Api-restfull-dinamica-php/php_error_log");



//##########################################################//
//################## Controlador ###########################//
//#########################################################//

require_once "controllers/routes-controller.php";

$index = new RoutersController();
$index->index();
