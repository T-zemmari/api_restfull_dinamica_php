<?php
require_once './models/get-model.php';

class GetController
{
    static function getData($tabla)
    {
        $response = GetModel::getData($tabla);
        return $response;
    }
}
