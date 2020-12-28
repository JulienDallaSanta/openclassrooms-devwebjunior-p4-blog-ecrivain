<?php

namespace Controllers;

use Controllers\Controller;

class PageController extends Controller{
    static function printHome(){
        return self::View('home');
    }
    static function printBiography(){
        return self::View('biography');
    }
    static function print404(){
        return self::View('404');
    }
    static function printAdmin(){
        return self::View('admin');
    }
}
?>
