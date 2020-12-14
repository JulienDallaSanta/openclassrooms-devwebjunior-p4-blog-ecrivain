<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    spl_autoload_register(function ($class_name) {
        include __DIR__.'/'.str_replace('\\','/',$class_name ). '.php';
    });

    use Controllers\PageController;
    use Controllers\ChapterController;
    use Controllers\CommentController;

    $rawPath = $_SERVER['REQUEST_URI'];
    $path = explode("/", $rawPath);
    array_shift($path);

    if($path[0] == '404'){
        PageController::print404();
    }
    if($path[0] == 'home' || $path[0] == 'accueil' || $path[0] == ''){
        //PageController::printHome();
        ChapterController::printLastChapters();
    }
    if($path[0] == 'biographie' || $path[0] == 'bio' || $path[0] == 'biography'){
        PageController::printBiography();
    }
    if($path[0] == 'blog' || $path[0] == 'chapitres' || $path[0] == 'chapters'){
        ChapterController::printBlog();
    }
    if($path[0] == 'chapitre' || $path[0] == 'chapter'){
        $chapterId = $path[1];
        if(isset($chapterId) && is_numeric($chapterId) && ($chapterId > 0)){
            $exist = ChapterController::exists($chapterId);
            if($exist != false){
                ChapterController::printChapter($chapterId);
            } else{
                $path[0] == '404';
            }
        }else{
            $path[0] == '404';
        }
    }
    if($path[0] == 'admin'){
        PageController::printAdmin();
    }


?>
