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
            <a id="chapterPublish" class="adminFuncSelectA">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Édition de chapitres
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
        <h2>Édition de nouveaux chapitres :</h2>
        <textarea class="tinymce"></textarea>
        <input id="chapterSubmit" type="submit" name="submit" class="formSubmit" value="Publier le chapitre">
    </div>
</section>

<?php $content = ob_get_clean();
require ('template.php');
?>
