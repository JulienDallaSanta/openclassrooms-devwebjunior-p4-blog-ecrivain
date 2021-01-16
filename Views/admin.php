<?php ob_start();?>

<section id="adminPage">
    <div id="adminPageContent">
        <h1>Bienvenue, M. Forteroche !</h1>
        <div id="adminFuncSelect">
            <a id="statSite" class="adminFuncSelectA">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                SEO
            </a>
            <a id="chapterAdmin" class="adminFuncSelectA">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Gestion des chapitres
            </a>
            <a id="commentsAdmin" class="adminFuncSelectA">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Gestion des commentaires
            </a>
        </div>
        <div id="seoStats">
            <div id="sessions" class="seoStat">
                <div class="seoStatContent">
                    <h3>Nombre de sessions :</h3>
                    <div>
                        <span id="sessionsNumber"></span>
                        <span id="sessionsNumberSpan">Visites sur le site</span>
                    </div>
                </div>
            </div>
            <div id="pagesPerSessions" class="seoStat">
                <div class="seoStatContent">
                    <h3>Pages par session :</h3>
                    <div>
                        <span id="pagesPerSessionsNumber"></span>
                    </div>
                </div>
            </div>
            <div id="sessionLength" class="seoStat">
                <div class="seoStatContent">
                    <h3>Durée de session :</h3>
                    <div>
                        <p id="sessionLengthNumber">
                            <span id="sessionLengthNumberH">00</span>h
                            <span id="sessionLengthNumberM">35</span>m
                            <span id="sessionLengthNumberS">27</span>s
                        </p>
                    </div>
                </div>
            </div>
            <div id="bounceRate" class="seoStat">
                <div class="seoStatContent">
                    <h3>Taux de rebond :</h3>
                    <div>
                        <span id="bounceRateNumber"></span>
                    </div>
                </div>
            </div>
            <div id="exitRate" >
                <h3>Taux de sortie :</h3>
                <div class="exitRateDiv">
                    <h4>Page HOME</h4>
                    <span>100%</span>
                </div>
                <div class="exitRateDiv">
                    <h4>Page BIOGRAPHIE</h4>
                    <span>100%</span>
                </div>
                <div class="exitRateDiv">
                    <h4>Page BLOG</h4>
                    <span>100%</span>
                </div>
                <div class="exitRateDiv">
                    <h4>Page CHAPITRE</h4>
                    <span>100%</span>
                </div>
            </div>
        </div>
        <div id="chaptersManagement">
            <h2>Gestion des chapitres :</h2>

            <div id="chapterEdit">
                <h3>Édition d'un nouveau chapitre</h3>
                <form enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="chapter_image">Image du chapitre :</label>
                        <input type="file" id="chapter_image" name="chapter_image" accept="image/png, image/jpeg" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Titre du chapitre :</label>
                        <input type="text" id="title" name="title"  class="form-control input-sm"/>
                    </div>
                    <div class="form-group" id='textareaDiv'>
                        <label for="chapterContent">Contenu du chapitre :</label>
                        <textarea id="chapterContent" name="content" class="tinymce form-control"></textarea>
                    </div>
                    <div class="form-group" id='saveAndPublishDiv'>
                        <div>
                            <input type="checkbox" id="save" name="save"checked>
                            <label for="save">ENREGISTRER</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saveAndPublish" name="saveAndPublish">
                            <label for="saveAndPublish">ENREGISTRER ET PUBLIER</label>
                        </div>
                    </div>
                    <div class="form-group" id='createChapterSubmitDiv'>
                        <span id="createChapterSubmit">OK</span>
                    </div>
                </form>
            </div>
            <div id="allChapters">
                <h3>Tous les chapitres (en cours de rédaction/publiés/supprimés):</h3>
                <?php
                var_dump($_VIEW['allChapters']);
                ?>
            </div>

            <div id="chaptersDeleted">
                <h3>Chapitres supprimés :</h3>
                <?php
                $deletedChapters = $_VIEW['deletedChapters'];
                if($_VIEW['numberOfDeletedChapters'] == 0){
                    ?>
                    <p>Aucun chapitre n'a été supprimé.</p>
                    <?php
                } else{
                    ?>
                    <p>Il y a <?= $_VIEW['numberOfDeletedChapters']?> chapitres supprimés :</p>

                    // foreach($_VIEW['chaptersDeleted'] as $chapterDeleted){
                    ?>
                    <!-- <div>
                        <h3 id="blogTitleH3">CHAPITRE <?= $chapterDeleted['id'] ?> : <?= $chapterDeleted['title'] ?></h3>
                        <span class="chapterPubliDate"><em>Publié le <?= $chapterDeleted['creation_date'] ?></em></span>
                        <span class="chapterPubliDate"><em>Supprimé le <?= $chapterDeleted['deleted_date'] ?></em></span>
                        <p class="chaptersP"><?= $chapterDeleted['preview'] ?></p>
                    </div> -->
                <?php
                // }
                }
                ?>
            </div>

            <div id="chaptersToPublish">
                <h3>Chapitres à publier :</h3>
                <?php
                $chaptersToPublish = $_VIEW['chaptersToPublish'];
                if($_VIEW['numberOfChaptersToPublish'] == 0){
                    ?>
                    <p>Aucun chapitre n'est à publier.</p>
                    <?php
                } else{
                    ?>
                    <p>Il y a <?= $_VIEW['numberOfChaptersToPublish']?> chapitres non publiés :</p>

                    // foreach($_VIEW['chaptersToPublish'] as $chapterToPublish){
                    ?>
                    <!-- <div>
                        <h3 id="blogTitleH3">CHAPITRE <?= $chapterToPublish['id'] ?> : <?= $chapterToPublish['title'] ?></h3>
                        <span class="chapterPubliDate"><em>Publié le <?= $chapterToPublish['creation_date'] ?></em></span>
                        <span class="chapterPubliDate"><em>Supprimé le <?= $chapterToPublish['deleted_date'] ?></em></span>
                        <p class="chaptersP"><?= $chapterToPublish['preview'] ?></p>
                    </div> -->
                <?php
                // }
                }
                ?>
            </div>
        </div>
        <div id="commentsManagement">
            <h2>Gestion des commentaires :</h2>
            <h3>Commentaires signalés :</h3>
            <?php
                $reportedComments = $_VIEW['reportedComments'];
                if($_VIEW['numberOfReportedComments'] == 0){
                    ?>
                    <p>Aucun commentaire n'a été signalé.</p>
                    <?php
                } else{
                    ?>
                    <p>Il y a <?= $_VIEW['numberOfReportedComments']?> commentaires signalés :</p>

                    // foreach($_VIEW['reportedComments'] as $reportedComment){
                    ?>
                        <!-- <div class="commentDiv">
                            <p class="namePublishDate">
                                <span class="commentId" style="display: none"><?= htmlspecialchars($reportedComment['id']); ?></span>
                                <span class="authorName"><?= htmlspecialchars($reportedComment['pseudo']); ?></span>
                                <em> le <span class="dateOfPublish"><?= $reportedComment['creation_date']; ?></span></em>
                            </p>
                            <p class="comment"><?php echo nl2br(htmlspecialchars($reportedComment['content'])); ?></p>
                            <div class="unreportOrDelete">
                                <a class="unreport">Annuler le signalement</a>
                                <a class="deleteComment">Supprimer le commentaire</a>
                            </div>
                        </div> -->
                <?php
                // }
                }
                ?>
                <p>
                    <span class="red">Signalé le :</span>
                    <a href="index.php?action=setCancelReport&amp;id=" title="supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce signalement ?'));">
                        <button type="button" class=""></button>
                    </a>
                    <a href="index.php?action=adminCancelReport&amp;id=" title="Autoriser" onclick="return(confirm('Etes-vous sûr de vouloir autoriser ce signalement ?'));">
                        <button type="button" class=""></button>
                    </a>
                </p>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
require ('template.php');
?>
