<?php

namespace Models;

class Model{
    protected function dbConnect(){
        $db = new PDO('mysql:host=phpmyadmin.localhost;dbname=dev_web_junior_p4;charset=utf8', 'phpmyadmin', 'phpmyadmin', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}
