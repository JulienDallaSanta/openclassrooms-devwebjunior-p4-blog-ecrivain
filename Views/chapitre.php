<?php ob_start();?>

<section class="pages">
    <div id="chapitrePageContent">
        <div id="blogTitle">
            <h1>UN BILLET SIMPLE <br/>POUR L'ALASKA</h1>
            <?php
            $chapter = $_VIEW['chapter'];
            ?>
            <h3 id="blogTitleH3">CHAPITRE <?= $chapter['id'];?> : <?= $chapter['title'];?></h3>
            <span class="chapterPubliDate"><em>Publié le <?= $chapter['creation_date']; ?></em></span>
        </div>
        <div id="chaptersSelect">
            <a id="chapterSelect1" class="chapterSelectA" href='http://p4.localhost/chapitre/1'>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Chapitre 1
            </a>
            <a id="chapterSelect2" class="chapterSelectA" href='http://p4.localhost/chapitre/2'>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Chapitre 2
            </a>
            <a id="chapterSelect3" class="chapterSelectA" href='http://p4.localhost/chapitre/3'>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Chapitre 3
            </a>
            <a id="chapterSelect4" class="chapterSelectA" href='http://p4.localhost/chapitre/4'>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Chapitre 4
            </a>
            <a id="chapterSelect5" class="chapterSelectA" href='http://p4.localhost/chapitre/5'>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Chapitre 5
            </a>
            <a id="chapterSelect6" class="chapterSelectA" href='http://p4.localhost/chapitre/6'>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Chapitre 6
            </a>
        </div>
        <div class="chapterAndComments">
            <div class="chapterEntireText">
                <div class="chapterImg" style="background-image: ;"></div>
                <p class="chapterText"><?php echo htmlspecialchars($chapter['content']); ?></p>
            </div>
        </div>
        <div id="crud">
            <div id="commentCreate">
                <div id="commentCreateHeader">
                    <p id="numberOfComments"><span><?= $_VIEW['commentsCount']; ?></span> commentaires</p>
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
                var_dump($_VIEW['comments']);
                foreach($_VIEW['comments'] as $comment[]){
                ?>
                <div class="commentDiv">
                    <p class="namePublishDate">
                        <span class="authorName"><?= htmlspecialchars($comment['pseudo']); ?></span>
                        <em> le <span class="dateOfPublish"><?= $comment['creation_date']; ?></span></em>
                    </p>
                    <p class="comment"><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                    <a href="" class="commentReport">Signaler le commentaire</a>
                </div>
                <?php
                }
                ?>

            </section>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
require ('template.php');
?>
