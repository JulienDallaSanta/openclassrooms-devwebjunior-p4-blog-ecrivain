<?php ob_start();?>

<section class="pages">
    <div id="blogPageContent">
        <div id="blogTitle">
            <h1>UN BILLET SIMPLE <br/>POUR L'ALASKA</h1>
            <h3>TOUS LES CHAPITRES</h3>
        </div>

        <div id="chapters">
            <?php
            foreach ($_VIEW['chapters'] as $chapter){
            ?>
            <div class="chaptersDiv">
                <img class="chaptersImg" src="<?php echo $chapter['chapter_image']; ?>"></img>
                <div class="chaptersDivContent">
                    <p class="chaptersP"><?= $chapter['preview'] ?>
                    </p>
                    <span class="chaptersDatetime"><?= $chapter['creation_date'] ?></span>
                    <h4 class='chaptersH4'>Chapitre <?= $chapter['id'] ?> : <?=$chapter['title'] ?></h4>
                    <a id="pageLink<?= $chapter['id'] ?>" class="pageLink" href="chapitre/<?= $chapter['id'] ?>">LIRE LE CHAPITRE<i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
            <?php
            }
            ?>
            <div id="nextChapter">
                <h3 id="nextChapterP">Le prochain chapitre sera bientôt disponible ...
                </h3>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
require ('template.php');
?>
