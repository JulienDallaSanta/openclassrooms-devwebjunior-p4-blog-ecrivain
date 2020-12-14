<?php

namespace Models;

use PDO;

class Model{
    protected function dbConnect(){
        $this->db = new PDO('mysql:host=phpmyadmin.localhost;dbname=dev_web_junior_p4;charset=utf8', 'phpmyadmin', 'phpmyadmin', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    /**
   * @var Singleton
   * @access private
   * @static
   */
    private static $_instance = null;

    /**
    * Method creating a unique instance of the class
    * if yet doesn't exists then return it.
    *
    * @param void
    * @return static
    */
    public static function getInstance() {
        // if(is_null(static::$_instance)) {
        //   static::$_instance = new static();
        // }
        // return static::$_instance;
        return(new static);
    }

    public static function __callStatic($name, $arguments){
        if(method_exists(__CLASS__, $name) || method_exists(get_parent_class(__CLASS__), $name)){
            return static::getInstance()->$name(...$arguments);
        }
    }

    public function toArray(){
        $res = [];
        foreach(static::getInstance()as $propertyName => $propertyValue){
            $res[$propertyName ] = $propertyValue;
        }
        return $res;
    }
}
