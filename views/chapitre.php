<?php
// BDD connexion
    try
    {
        $bdd = new PDO('mysql:host=phpmyadmin.localhost;dbname=dev_web_junior_p4;charset=utf8', 'phpmyadmin', 'phpmyadmin');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
?>

<!doctype html>
<html lang="fr">

    <head>
        <?php include("head.php"); ?>
    </head>

    <body>
        <div class="page">
            <?php include("menu.php"); ?>
            <main class="content">
                <?php include("header.php"); ?>
                <section class="pages">
                    <div id="chapitrePageContent">
                        <div id="blogTitle">
                            <h1>UN BILLET SIMPLE <br/>POUR L'ALASKA</h1>
                            <h3 id="blogTitleH3">CHAPITRE 1 : UN VRAI DÉFI</h3>
                            <span class="chapterPubliDate"><em>Publié le 18/06/1983</em></span>
                        </div>
                        <div id="chaptersSelect">
                            <a id="chapterSelect1" class="chapterSelectA">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Chapitre 1
                            </a>
                            <a href="#" id="chapterSelect2" class="chapterSelectA">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Chapitre 2
                            </a>
                            <a href="#" id="chapterSelect3" class="chapterSelectA">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Chapitre 3
                            </a>
                            <a href="#" id="chapterSelect4" class="chapterSelectA">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Chapitre 4
                            </a>
                            <a href="#" id="chapterSelect5" class="chapterSelectA">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Chapitre 5
                            </a>
                            <a href="#" id="chapterSelect6" class="chapterSelectA">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Chapitre 6
                            </a>
                        </div>
                        <div class="chapterAndComments">
                            <div id="chapter1" class="chapterEntireText">
                                <div class="chap1Img chapterImg"></div>
                                <p class="chapterText">
                                    <?php
                                        // get the chapter from bdd
                                        $req = $bdd->query('SELECT `text` FROM `chapter` WHERE id=1');
                                        $donnees = $req->fetch();
                                        echo htmlspecialchars($donnees['text']);
                                        $req->closeCursor();
                                    ?>
                                </p>
                            </div>
                            <div id="chapter2" class="chapterEntireText">
                                <div class="chap2Img chapterImg"></div>
                                <p class="chapterText">
                                    <?php
                                        // get the chapter from bdd
                                        $req = $bdd->query('SELECT `text` FROM `chapter` WHERE id=2');
                                        $donnees = $req->fetch();
                                        echo htmlspecialchars($donnees['text']);
                                        $req->closeCursor();
                                    ?>
                                </p>
                            </div>
                            <div id="chapter3" class="chapterEntireText">
                                <div class="chap3Img chapterImg"></div>
                                <p class="chapterText">
                                    <?php
                                        // get the chapter from bdd
                                        $req = $bdd->query('SELECT `text` FROM `chapter` WHERE id=3');
                                        $donnees = $req->fetch();
                                        echo htmlspecialchars($donnees['text']);
                                        $req->closeCursor();
                                    ?>
                                </p>
                            </div>
                            <div id="chapter4" class="chapterEntireText">
                                <div class="chap4Img chapterImg"></div>
                                <p class="chapterText">
                                    <?php
                                        // get the chapter from bdd
                                        $req = $bdd->query('SELECT `text` FROM `chapter` WHERE id=4');
                                        $donnees = $req->fetch();
                                        echo htmlspecialchars($donnees['text']);
                                        $req->closeCursor();
                                    ?>
                                </p>
                            </div>
                            <div id="chapter5" class="chapterEntireText">
                                <div class="chap5Img chapterImg"></div>
                                <p class="chapterText">
                                    <?php
                                        // get the chapter from bdd
                                        $req = $bdd->query('SELECT `text` FROM `chapter` WHERE id=5');
                                        $donnees = $req->fetch();
                                        echo htmlspecialchars($donnees['text']);
                                        $req->closeCursor();
                                    ?>
                                </p>
                            </div>
                            <div id="chapter6" class="chapterEntireText">
                                <div class="chap6Img chapterImg"></div>
                                <p class="chapterText">
                                    <?php
                                        // get the chapter from bdd
                                        $req = $bdd->query('SELECT `text` FROM `chapter` WHERE id=6');
                                        $donnees = $req->fetch();
                                        echo htmlspecialchars($donnees['text']);
                                        $req->closeCursor();
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div id="crud">
                            <div id="commentCreate">
                                <div id="commentCreateHeader">
                                    <?php

                                    ?>
                                    <p id="numberOfComments"><span>6</span> commentaires</p>
                                    <a id="writeAComment">Écrire un commentaire</a>
                                </div>
                                <form id="commentCreateForm">
                                    <span></span>
                                    <input id="firstname" class="storage commentCreateFormInput" type="text" name="firstname" placeholder="Prénom" required>
                                    <input id="name" class="storage commentCreateFormInput" type="text" name="name" placeholder="Nom" required>
                                    <div id="textAreaAndPublish">
                                        <textarea id="comment" class="storage" name="comment" placeholder="Commentaire" required></textarea>
                                        <div id="commentCaptchaSend" class="captchaSend">
                                            <div>
                                                <input type="checkbox" name="checkbox" id="checkbox" value required>
                                                <label for="checkbox">Je ne suis pas un robot</label>
                                            </div>
                                            <input id="commentFormSubmit" type="submit" name="submit" class="formSubmit">
                                        </div>
                                    </div>
                                    <span></span>
                                </form>
                            </div>
                            <section id="comments">
                            <?php
                                // Récupération des commentaires
                                $req = $bdd->prepare('SELECT `id`, `chapter_id`, `author_lastname`, `author_firstname`, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, `text` FROM comment WHERE id = ? ORDER BY date_creation DESC');
                                $req->execute(array($_GET['comment']));

                                while ($donnees = $req->fetch())
                                {
                            ?>
                                <div class="commentDiv">
                                    <p class="namePublishDate">
                                        <span class="authorName">
                                            <?php echo htmlspecialchars($donnees['author_firstname']); ?>
                                            <?php echo htmlspecialchars($donnees['author_lastname']); ?>
                                        </span>
                                        <em> le <span class="dateOfPublish"><?php echo $donnees['date_creation_fr']; ?></span></em>
                                    </p>
                                    <p class="comment"><?php echo nl2br(htmlspecialchars($donnees['text'])); ?></p>
                                    <a class="commentReport">Signaler le commentaire</a>
                                </div>

                            <?php
                                } // Fin de la boucle des commentaires
                                $req->closeCursor();
                            ?>
                                <!--<div id="comment1" class="commentDiv">
                                    <p class="namePublishDate"><span class="authorName">NomAuteur</span>
                                        <em> le <span class="dateOfPublish">18/06/1983</span></em>
                                    </p>
                                    <p class="comment">Super mais un peu long...</p>
                                    <a class="commentReport">Signaler le commentaire</a>
                                </div>
                                <div id="comment2" class="commentDiv">
                                    <p class="namePublishDate"><span class="authorName">NomAuteur</span>
                                        <em> le <span class="dateOfPublish">18/06/1983</span></em>
                                    </p>
                                    <p class="comment">Super mais un peu long...</p>
                                    <a class="commentReport">Signaler le commentaire</a>
                                </div>
                                <div id="comment3" class="commentDiv">
                                    <p class="namePublishDate"><span class="authorName">NomAuteur</span>
                                        <em> le <span class="dateOfPublish">18/06/1983</span></em>
                                    </p>
                                    <p class="comment">Super mais un peu long...</p>
                                    <a class="commentReport">Signaler le commentaire</a>
                                </div>
                                <div id="comment4" class="commentDiv">
                                    <p class="namePublishDate"><span class="authorName">NomAuteur</span>
                                        <em> le <span class="dateOfPublish">18/06/1983</span></em>
                                    </p>
                                    <p class="comment">Super mais un peu long...</p>
                                    <a class="commentReport">Signaler le commentaire</a>
                                </div>
                                <div id="comment5" class="commentDiv">
                                    <p class="namePublishDate"><span class="authorName">NomAuteur</span>
                                        <em> le <span class="dateOfPublish">18/06/1983</span></em>
                                    </p>
                                    <p class="comment">Super mais un peu long...</p>
                                    <a class="commentReport">Signaler le commentaire</a>
                                </div>
                                <div id="comment6" class="commentDiv">
                                    <p class="namePublishDate"><span class="authorName">NomAuteur</span>
                                        <em> le <span class="dateOfPublish">18/06/1983</span></em>
                                    </p>
                                    <p class="comment">Super mais un peu long...</p>
                                    <a class="commentReport">Signaler le commentaire</a>
                                </div>-->
                            </section>
                        </div>
                    </div>
                </section>

                <?php include("footer.php"); ?>

            </main>
          </div>

          <?php include("rgpd.php"); ?>

        <?php include("scripts.php"); ?>
    </body>
</html>
