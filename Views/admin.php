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
            <h3>Tous les chapitres (publiés/en cours de rédaction):</h3>
            <div></div>
            <h3>Édition d'un nouveau chapitre</h3>
            <form action="index.php?action=addChapter" method="post">
                <div class="form-group">
                    <label for="chapter_image">Image du chapitre :</label>
                    <input type="file" id="chapter_image" name="chapter_image" accept="image/png, image/jpeg" class="form-control">
                    <button >Envoyer</button>
                </div>
                <div class="form-group">
                    <label for="title">Titre du chapitre :</label>
                    <input type="text" id="title" name="title"  class="form-control input-sm"/>
                </div>
                <div class="form-group">
                    <label for="chapterContent">Contenu du chapitre :</label>
                    <textarea id="chapterContent" name="chapterContent" class="form-control tinymce"></textarea>
                </div>
                <div class="form-group">
                    <input id="chapterSubmit" type="submit" name="submit" class="formSubmit" value="Enregistrer" />
                </div>
            </form>
            <h3>Chapitres supprimés :</h3>
            <div></div>
        </div>
        <div id="commentsManagement">
            <h2>Gestion des commentaires :</h2>
            <h3>Commentaires signalés :</h3>
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
