<?php ob_start();?>

<section id="adminPage">
    <div id="adminPageContent">
        <h1>Bienvenue, M. Forteroche !</h1>
        <div id="adminFuncSelect">
            <a id="statSite" class="adminFuncSelectA" href="#seoStats">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Statistiques
            </a>
            <a id="chapterAdmin" class="adminFuncSelectA" href="#chaptersManagement">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Chapitres
            </a>
            <a id="commentsAdmin" class="adminFuncSelectA" href="#commentsManagement">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Commentaires
            </a>
        </div>
        <div id="seoStats" class="AdminSection">
            <div id="sessions" class="seoStat seoStatsDiv">
                <div class="seoStatContent">
                    <h3>Nombre de sessions :</h3>
                    <div>
                        <span id="sessionsNumber" class="seoData"></span>
                        <span id="sessionsNumberSpan" class="seoSpan">Visites sur le site</span>
                    </div>
                </div>
            </div>
            <div id="pagesPerSessions" class="seoStat seoStatsDiv">
                <div class="seoStatContent">
                    <h3>Pages par session :</h3>
                    <div>
                        <span id="pagesPerSessionsNumber" class="seoData"></span>
                    </div>
                </div>
            </div>
            <div id="sessionLength" class="seoStat seoStatsDiv">
                <div class="seoStatContent">
                    <h3>Durée de session :</h3>
                    <div>
                        <p id="sessionLengthNumber">
                            <span id="sessionLengthNumberH" class="seoData">00</span><span class="seoSpan">h</span>
                            <span id="sessionLengthNumberM" class="seoData">35</span><span class="seoSpan">m</span>
                            <span id="sessionLengthNumberS" class="seoData">27</span><span class="seoSpan">s</span>
                        </p>
                    </div>
                </div>
            </div>
            <div id="bounceRate" class="seoStat seoStatsDiv">
                <div class="seoStatContent">
                    <h3>Taux de rebond :</h3>
                    <div>
                        <span id="bounceRateNumber" class="seoData"></span>
                    </div>
                </div>
            </div>
            <div id="exitRate" class="seoStatsDiv">
                <h3>Taux de sortie :</h3>
                <div class="exitRateDiv">
                    <h4>Page HOME</h4>
                    <span class="seoData">100%</span>
                </div>
                <div class="exitRateDiv">
                    <h4>Page BIOGRAPHIE</h4>
                    <span class="seoData">100%</span>
                </div>
                <div class="exitRateDiv">
                    <h4>Page BLOG</h4>
                    <span class="seoData">100%</span>
                </div>
                <div class="exitRateDiv">
                    <h4>Page CHAPITRE</h4>
                    <span class="seoData">100%</span>
                </div>
            </div>
        </div>
        <div id="chaptersManagement" class="AdminSection">

            <h2>Gestion des chapitres :</h2><br/>
            <div id="chaptersManagementContent">
                <table id="chaptersManagementTable">
                    <tr>
                        <th class="chaptersManagementTableTh">Aperçu</th>
                        <th class="chaptersManagementTableTh">Chapitre</th>
                        <th class="chaptersManagementTableTh">Titre</th>
                        <th class="chaptersManagementTableTh">Crée le</th>
                        <th class="chaptersManagementTableTh">Statut</th>
                        <th class="chaptersManagementTableTh">Sélectionner</th>
                    </tr>
                    <?php
                    foreach ($_VIEW['allChapters'] as $chapter){
                    ?>
                        <tr class="chapterLine" data-id="<?= $chapter['id']; ?>">
                            <td><div class="chapterPreviewSelect"></div></td>
                            <td><?= $chapter['id']; ?></td>
                            <td><?= $chapter['title']; ?></td>
                            <td><?= $chapter['creation_date']; ?></td>
                            <td><?php
                            if($chapter['published'] == 1){
                                ?>publié le <?= $chapter['published_date'];
                            }elseif($chapter['deleted'] == 1){
                                ?>supprimé le <?= $chapter['published_date'];
                            }elseif($chapter['published'] == 0 && $chapter['deleted'] == 0){
                                ?>Sauvegardé le <?php echo $chapter['creation_date'];
                            }?>
                            </td>
                            <td>
                                <div class="chaptersActionsContainer">
                                    <?php
                                    if($chapter['published'] == 1){
                                    ?>
                                    <div class="chaptersActionsContent">
                                        <i class="fas fa-edit chaptersActionsIcons"></i>
                                        <span>Modifier</span>
                                    </div>
                                    <div class="chaptersActionsContent">
                                        <i class="fas fa-trash-alt chaptersActionsIcons"></i>
                                        <span>Supprimer</span>
                                    </div>
                                    <?php
                                    }elseif($chapter['published'] == 0 && $chapter['deleted'] == 0){
                                    ?>
                                    <div class="chaptersActionsContent">
                                        <i class="fas fa-newspaper chaptersActionsIcons"></i>
                                        <span>Publier</span>
                                    </div>
                                    <div class="chaptersActionsContent">
                                        <i class="fas fa-edit chaptersActionsIcons"></i>
                                        <span>Modifier</span>
                                    </div>
                                    <div class="chaptersActionsContent">
                                        <i class="fas fa-trash-alt chaptersActionsIcons"></i>
                                        <span>Supprimer</span>
                                    </div>
                                    <?php
                                    }elseif($chapter['deleted'] == 1){
                                    ?>
                                    <div class="chaptersActionsContent">
                                        <i class="fas fa-trash-restore chaptersActionsIcons"></i>
                                        <span>Restaurer</span>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>

                <?php
                foreach ($_VIEW['allChapters'] as $chapter){
                ?>
                <div class="chapterPreviewContainer" data-id="<?php echo $chapter['id']?>">
                    <i class="fas fa-caret-left"></i>
                    <div class="chapterpreview">
                        <h3 class="previewh3">Aperçu du chapitre <?php echo $chapter['id']?> :</h3>
                        <div class="chapterpreviewContent">
                            <h4 class="chapterPreviewTitle"><?= $chapter['title'] ?></h4>
                            <h5 class="chapterPreviewStatus">
                                <em>
                                <?php
                                if($chapter['published'] == 1){
                                    ?>publié le <?= $chapter['published_date'];
                                }elseif($chapter['deleted'] == 1){
                                    ?>supprimé le <?= $chapter['published_date'];
                                }elseif($chapter['published'] == 0 && $chapter['deleted'] == 0){
                                    ?>Sauvegardé le <?php echo $chapter['creation_date'];
                                }?>
                                </em>
                            </h5>
                            <div  class="chapterPreviewTextImage">
                                <img class="chapterPreviewImage" src="<?= $chapter['chapter_image'] ?>">
                                <div class="chapterPreviewText"><?= $chapter['content'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div id="addChapterCallToAction"><p>Ajouter un chapitre</p> <i class="fas fa-chevron-down hiddenChevron"></i><i class="fas fa-chevron-up"></i></div>
            <div id="chapterEdit" style="display:none">
                <h3>Édition d'un nouveau chapitre</h3>
                <form enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="chapter_image">Image <em>(333x500px 96dpi)</em>:</label><br/>
                        <input type="hidden" name="MAX_FILE_SIZE" value="50000" />
                        <input type="file" id="chapter_image" name="chapter_image" accept="image/png, image/jpeg" class="form-control" required>
                        <button id="upload_image">Envoyer le fichier</button>
                        <input type="hidden" id="urlImgInput" name="urlImg" value="">
                    </div>
                    <div class="form-group">
                        <label for="title">Titre :</label><br/>
                        <input type="text" id="title" name="title"  class="form-control input-sm" required>
                    </div>
                    <div class="form-group" id='textareaDiv'>
                        <label for="chapterContent">Contenu du chapitre :</label>
                        <textarea id="chapterContent" name="content" class="tinymce form-control" required></textarea>
                    </div>
                    <div class="form-group" id='saveAndPublishDiv'>
                        <div>
                            <input type="radio" id="save" name="saveAndPublish" value="save">
                            <label for="save">ENREGISTRER</label>
                        </div>
                        <div>
                            <input type="radio" id="saveAndPublish" name="saveAndPublish" value="save and publish">
                            <label for="saveAndPublish">ENREGISTRER ET PUBLIER</label>
                        </div>
                        <div id="log" style="display: none"></div>
                    </div>
                    <div class="form-group" id='createChapterSubmitDiv'>
                        <span class="createChapterSubmit">OK</span>
                    </div>
                </form>
            </div>
        </div>
        <div id="commentsManagement" class="AdminSection">
            <h2>Commentaires signalés :</h2>
            <?php
            $reportedComments = $_VIEW['reportedComments'];
            if($_VIEW['numberOfReportedComments'] == 0){
                ?>
            <p>Aucun commentaire n'a été signalé.</p>
                <?php
                } else{
                ?>
            <p>Il y a <?= $_VIEW['numberOfReportedComments']?> commentaires signalés :</p>
            <div id="commentsAdminBloc">
                <?php
                foreach($_VIEW['reportedComments'] as $reportedComment){
                ?>
                <div class="commentDiv commentAdmin" data-comment-id="<?php echo $reportedComment['id']; ?>">
                    <p class="namePublishDate">
                        <span class="commentId" style="display: none"><?= htmlspecialchars($reportedComment['id']); ?></span>
                        <p class="">
                            <span>Posté par  : </span>
                            <span class="authorName"><?= htmlspecialchars($reportedComment['pseudo']); ?></span>
                            <em> le <span class="dateOfPublish"><?= $reportedComment['creation_date']; ?></span></em>
                        </p>
                    </p>
                    <p class="comment">
                        <span>Contenu du commentaire :</span></br>
                        <em>"<?php echo nl2br(htmlspecialchars($reportedComment['content'])); ?>"</em>
                    </p>
                    <div class="unreportOrDelete">
                        <a class="unreport">Annuler le signalement</a>
                        <a class="deleteComment">Supprimer le commentaire</a>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>

            <?php
            }
            ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();
require ('template.php');
?>
