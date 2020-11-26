<?php ob_start();?>

<section class="pages">
    <div id="blogPageContent">
        <div id="blogTitle">
            <h1>UN BILLET SIMPLE <br/>POUR L'ALASKA</h1>
            <h3>TOUS LES CHAPITRES</h3>
        </div>

        <div id="chapters">
            <?php
            use Controllers\ChapterController;
            ChapterController::listchapters();
            while ($data = $chapters->fetch()){
            ?>
            <div class="chaptersDiv">
                <div class="chap<?=$data['id']?>Img chaptersImg"></div>
                <div class="chaptersDivContent">
                    <p class="chaptersP"><?=$data['preview']?>
                    </p>
                    <span class="chaptersDatetime"><?=$data['creation_date_fr']?></span>
                    <h4 class='chaptersH4'>Chapitre <?=$data['id']?> : <?=$data['title']?></h4>
                    <a id="pageLink<?=$data['id']?>" class="pageLink" href="chapitre">LIRE LE CHAPITRE<i class="fas fa-angle-double-right"></i></a>
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
