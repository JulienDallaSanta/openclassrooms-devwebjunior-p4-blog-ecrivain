<?php
namespace Controllers;

class Controller{
    function __construct(){
        $this->rootPath = $_SERVER['DOCUMENT_ROOT'];
    }
    function View($view){
        return require $this->ViewPath($view);
    }
    private function ViewPath($view){
        return $this->rootPath.'/Views/'.$view.'.php';
    }
}
