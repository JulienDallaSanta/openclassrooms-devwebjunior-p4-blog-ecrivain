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
    static function printBlog(){
        return self::View('blog');
    }
    static function printChapter(){
        return self::View('chapitre');
    }
    static function printAdmin(){
        return self::View('admin');
    }
}
?>
