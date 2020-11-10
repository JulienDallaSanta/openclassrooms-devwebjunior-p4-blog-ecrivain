<!doctype html>
<html lang="fr">

    <head>
    <?php include('Views/head.php'); ?>
    </head>

    <body>
        <div class="page">
            <?php include('Views/menu.php'); ?>
            <main class="content">
                <?php require('Views/header.php');
                echo $content;
                include('Views/footer.php');
                ?>
            </main>
        </div>

        <?php include("Views/rgpd.php"); ?>

        <?php include("Views/scripts.php"); ?>
    </body>
</html>
