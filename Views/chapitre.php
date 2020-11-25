<?php ob_start();?>

<section class="pages">
    <div id="chapitrePageContent">
        <div id="blogTitle">
            <h1>UN BILLET SIMPLE <br/>POUR L'ALASKA</h1>
            <h3 id="blogTitleH3">CHAPITRE <?php echo $chapter['id']?> : <?php echo $chapter['title']?></h3>
            <span class="chapterPubliDate"><em>Publié le <?php echo $chapter['date_creation_fr']; ?></em></span>
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
            <?php
            // get from bdd image & text of each chapter not deleted
            $req = $bdd->query('SELECT `chapter_image`, `text` FROM `chapter` WHERE deleted=0');
            while ($donnees = $req->fetch())
            {
            ?>
            <div class="chapterEntireText">
                <div class="chapterImg" style="background-image: <?php echo $donnees['chapter_image'];?>;"></div>
                <p class="chapterText"><?php echo htmlspecialchars($donnees['text']); ?></p>
            </div>
            <?php
            }
            $req->closeCursor();
            ?>
        </div>
        <div id="crud">
            <div id="commentCreate">
                <div id="commentCreateHeader">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM `comment` WHERE `deleted`=0 ORDER BY `chapter_id`');
                    $req->execute(array($_GET['comment']));
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
                $req = $bdd->prepare('SELECT * DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr, `text` FROM comment WHERE chapter_id = ? ORDER BY date_creation DESC');
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
                    <a href="" class="commentReport">Signaler le commentaire</a>
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

<?php $content = ob_get_clean();
require ('template.php');
?>
