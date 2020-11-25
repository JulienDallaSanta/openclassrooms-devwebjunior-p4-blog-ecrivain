<?php

namespace Controllers;

class Controller{
    static $_instance;
    function __construct(){
        $this->rootPath = $_SERVER['DOCUMENT_ROOT'];
    }
    public static function __callStatic($name, $arguments){
        if(method_exists(__CLASS__, $name) || method_exists(get_parent_class(__CLASS__), $name)){
            static::$_instance = new static();
            return static::$_instance->$name(...$arguments);
        }
    }
    private function ViewPath($view){
        return $this->rootPath.'/Views/'.$view.'.php';
    }
    private function View($view){
        return require $this->ViewPath($view);
    }
}
