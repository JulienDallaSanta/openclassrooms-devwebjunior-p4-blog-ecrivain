<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    spl_autoload_register(function ($class_name) {
        include __DIR__.'/'.str_replace('\\','/',$class_name ). '.php';
    });

    use Controllers\PageController;
    use Controllers\ChapterController;

    $rawPath = $_SERVER['REQUEST_URI'];
    $path = explode("/", $rawPath);
    array_shift($path);
    if($path[0] == 'home' || $path[0] == 'accueil' || $path[0] == ''){
        PageController::printHome();
    }
    if($path[0] == 'biographie' || $path[0] == 'bio' || $path[0] == 'biography'){
        PageController::printBiography();
    }
    if($path[0] == 'blog' || $path[0] == 'chapitres' || $path[0] == 'chapters'){
        ChapterController::printBlog();
    }
    if($path[0] == 'chapitre' || $path[0] == 'chapter'){
        ChapterController::printChapter();
    }
    if($path[0] == 'admin'){
        PageController::printAdmin();
    }

?>
