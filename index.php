<?php

    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    spl_autoload_register(function ($class_name) {
        include __DIR__.'/'.str_replace('\\','/',$class_name ). '.php';
    });

    use Controllers\PageController;
    use Controllers\ChapterController;
    use Controllers\CommentController;
    use Controllers\UserController;

    $rawPath = $_SERVER['REQUEST_URI'];
    $path = explode("/", $rawPath);
    array_shift($path);

    if($path[0] == 'home' || $path[0] == 'accueil' || $path[0] == ''){
        return ChapterController::printLastChapters();
    }
    if($path[0] == 'biographie' || $path[0] == 'bio' || $path[0] == 'biography'){
        return PageController::printBiography();
    }
    if($path[0] == 'blog' || $path[0] == 'chapitres' || $path[0] == 'chapters'){
        return ChapterController::printBlog();
    }
    if($path[0] == 'chapitre' || $path[0] == 'chapter'){
        $chapterId = $path[1];
        if(isset($chapterId) && is_numeric($chapterId) && ($chapterId > 0)){
            $exist = ChapterController::exists($chapterId);
            if($exist != false){
                return ChapterController::printChapter($chapterId);
            }
        }
    }
    if($path[0] == 'admin'){
        return ChapterController::printAdmin();
    }
    if($path[0] == 'api'){
        header('Content-Type: application/json');
        if($path[1] == 'user'){
            if($path[2] == 'login'){
                return UserController::login();
            }
            if($path[2] == 'logout'){
                return UserController::logout();
            }
        }
    }
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    return PageController::print404();
?>
