<?php
require_once "models/connection.php";
class PostModel
{

    /*=========================================================
    
    ===========================================================*/
    static public function postData($tabla, $body)

    {
        echo '<pre>'; print_r($body); echo '</pre>';
        echo '<pre>'; print_r($tabla); echo '</pre>';
  
    }
}
