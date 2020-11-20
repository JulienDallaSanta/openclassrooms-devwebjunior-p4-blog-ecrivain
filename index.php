<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    /*spl_autoload_register(function ($class_name) {
        include __DIR__.'/'.str_replace('\\','/',$class_name ). '.php';
    });*/

    spl_autoload_register(function ($class){
        $files = array('Controllers/' . $class . '.php', 'Models/' . $class . '.php');

        foreach ($files as $file)
        {
            if (file_exists($file))
            {
                require_once $file;
            }
        }
    });

    use Controllers\PageController;

    $rawPath = $_SERVER['REQUEST_URI'];
    $path = explode("/", $rawPath);
    array_shift($path);
    if($path[0] == 'home' || $path[0] == 'accueil' || $path[0] == ''){
        $PageController = new PageController();
        $PageController->printHome();
    }
    if($path[0] == 'biographie' || $path[0] == 'bio' || $path[0] == 'biography'){
        $PageController = new PageController();
        $PageController->printBiography();
    }
    if($path[0] == 'blog' || $path[0] == 'chapitres' || $path[0] == 'chapters'){
        return require ('Views/blog.php');
    }
    if($path[0] == 'chapitre' || $path[0] == 'chapter'){
        return require ('Views/chapitre.php');
    }
    if($path[0] == 'admin'){
        return require ('Views/admin.php');
    }

?>
