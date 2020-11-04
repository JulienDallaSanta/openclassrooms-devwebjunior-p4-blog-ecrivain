<!doctype html>
<html lang="fr">

    <head>
        <?php require("views/head.php"); ?>

    </head>

    <body>
        <div class="page">
            <main class="content">
                <section id="home_header">
                    <div id="header">
                        <div id="darkModeDiv">
                            <span>dark mode</span>
                            <input type="checkbox" name=""id="darkModeButton">
                        </div>
                        <div id="connexionButton">
                            <a id="connexionLink" href="#" data-title="Se connecter">Se connecter</a>
                        </div>
                    </div>
                </section>

                <section id="pageContent"></section>

            </main>
          </div>

          <?php require("scripts.php"); ?>
    </body>
</html>
