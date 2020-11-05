<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);
    $rawPath = $_SERVER['REQUEST_URI'];
    $path = explode("/", $rawPath);
    array_shift($path);
    if($path[0] == 'home' || $path[0] == 'accueil' || $path[0] == ''){
        return require ('views/home.php');
    }
?>

<!doctype html>
<html lang="fr">

    <head>
    <?= include('views/head.php'); ?>
    </head>

    <body>
        <div class="page">
            <?= include('views/menu.php'); ?>
            <main class="content">
                <?php require('views/header.php');
                    include("views/home.php");
                    include('views/footer.php');
                ?>
            </main>
        </div>

        <?= include("views/rgpd.php"); ?>

        <?= include("views/scripts.php"); ?>
    </body>
</html>

<?php
    if($path[0] == 'biographie' || $path[0] == 'bio' || $path[0] == 'biography'){
        return require ('views/biography.php');
    }
    if($path[0] == 'blog' || $path[0] == 'chapitres' || $path[0] == 'chapters'){
        return require ('views/blog.php');
    }
    if($path[0] == 'chapitre' || $path[0] == 'chapter'){
        return require ('views/chapitre.php');
    }
    if($path[0] == 'admin'){
        return require ('views/admin.php');
    }
?>
