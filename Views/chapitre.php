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
                <img class="chapImg chapImgSize" src="<?= $chapter['chapter_image'] ?>"></img>
                <p class="chapterText"><?php echo htmlspecialchars($chapter['content']); ?></p>
            </div>
        </div>
        <div id="crud">
            <div id="commentCreate">
                <div id="commentCreateHeader">
                    <p id="numberOfComments"><span><?= $_VIEW['commentsCount']; ?></span> commentaires</p>
                    <p id="writeAComment"><i id="commentCreateIcon" class="fas fa-pen-square"></i><span>Écrire un commentaire</span></p>
                    <span id="chapterId" style="display: none"><?= $chapter['id']; ?></span>
                </div>
                <form id="commentCreateForm" method="post">
                    <span></span>
                    <input id="pseudo" class="storage commentCreateFormInput" type="text" name="pseudo" placeholder="Votre pseudo" required>

                    <div id="textAreaAndPublish">
                        <textarea id="comment" class="storage" name="comment" placeholder="Votre commentaire" required></textarea>
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

                foreach($_VIEW['comments'] as $comment){
                ?>
                <div class="commentDiv" data-comment-id="<?php echo $comment['id']; ?>">
                    <p class="namePublishDate">
                        <span class="commentId" style="display: none"><?= htmlspecialchars($comment['id']); ?></span>
                        <span class="authorName"><?= htmlspecialchars($comment['pseudo']); ?></span>
                        <em> le <span class="dateOfPublish"><?= $comment['creation_date']; ?></span></em>
                    </p>
                    <p class="comment"><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                <?php
                if($comment['report'] == 1){
                    ?>
                    <p class="commentReported">Commentaire signalé</p>
                    <?php
                } else{
                    ?>
                    <a class="commentReport">Signaler le commentaire</a>
                    <?php
                }
                ?>
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
