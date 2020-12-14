<?php ob_start();?>

<section id="home_header">
    <div id="home_header_center">
        <div id="homeTitle">
            <h1>JEAN<br/>FORTEROCHE</h1>
            <h2>ACTEUR - AVENTURIER - ÉCRIVAIN</h2>
        </div>
        <div id="biography">
            <div id="jfPortrait"></div>
            <div id="biographyBloc">
                <h3>AVENTURIER DE LA PLUME</h3><br/>
                <p id="bioP">Jean Forteroche, né le 12 Avril 1980 à Boston dans le Massachussetts, est un écrivain Français (bénéficiant aussi par sa naissance d'un passeport américain).
                    Jean Forteroche publie son premier livre, intitulé L'enfant qui venait des étoiles, en 1998. Il a obtenu le prix des libraires avec L'ombre du vent en 2003. Son roman le plus connu, l'écho de ton souvenir, est traduit dans 15 langues à travers le monde.
                    Actuellement, Jean Forteroche travaille sur son prochain roman, "Billet simple pour l'Alaska" et le publie par épisode en ligne sur ce site.</p><br/>
                <p class="citation">"Les écrivains sont des gens seuls. Partout, et toujours, ils l'ont été." </p><br/>
                <p id="quoteSign">- Jean Forteroche</p><br/><br/>
                <a class="pageLink" href="biography">BIOGRAPHIE<i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>

    <i class="fas fa-angle-down fa-4x"></i>
</section>

<section id="pageContent">
    <section id="blog">
        <div id="blogLeftCol">
            <h2>BILLET SIMPLE POUR L'ALASKA</h2>
            <h3>Découvrez mon dernier roman , publié sur mon site chapitre par chapitre et dites-moi ce que vous en pensez !</h3>
            <div id="alaskaDiv">
                <img id="alaskaDivImg" src="/Public/images/un_billet.png" alt="Un billet simple pour l'Alaska - Jean Forteroche">
                <div id="alaskaDivP">
                    <p>Peter Flectcher avait tout juste 2 ans quand sa mère a quitté l’Alaska, fuyant la vie trop rude, et
                        laissant derrière elle le père de Peter. Peter a aujourd’hui 26 ans et mène une vie bien remplie à Toronto.
                        Lorsqu’il apprend que les jours de son père, très malade, sont peut-être comptés, il entreprend le voyage jusqu’à
                        son village natal. Il va alors découvrir le quotidien « à la dure » , les journées qui comptent peu d’heures de
                        clarté, les nuits à la belle étoile… Il va en profiter pour mieux connaître son père, à qui il tient beaucoup malgré
                        les erreurs qu’il a commises.
                    </p><br/>
                    <a class="pageLink" href="blog">TOUS LES CHAPITRES<i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
            <div id="blogDbleCol">
                <div id="blogDbleColLeft">
                    <div class="blogDbleColTitle">
                        <button class="blogIDiv">
                            <i class="icon fas fa-atlas"></i>
                        </button>
                        <h4>Le choix d'un roman en ligne :</h4>
                    </div>
                    <p>À l'heure du tout connecté et de l'omniprésence des réseaux sociaux, nous (Jean Forteroche et les personnes concernées
                        par le projet) avons décidé de transposer le nouveau récit de Jean Forteroche en ligne, sous la forme de chapitres
                        périodiques et interactifs, afin d'établir une communication bilatérale qu'empêche le support papier.
                        Ce roman est un cadeau pour vous, la communauté de lecteurs qui s'est constituée au fil des histoires abracadabrantesques
                        dont seul Jean Forteroche détient le secret. Un cadeau pour faire entendre votre voix, et pour vous récompenser de votre
                        indéfectible loyauté.
                    </p>
                </div>
                <div id="blogDbleColRight">
                    <div class="blogDbleColTitle">
                        <button class="blogIDiv">
                            <i class="icon fas fa-comments"></i>
                        </button>
                        <h4>Interagissez en direct :</h4>
                    </div>
                    <p>Chaque publication périodique qui composera le roman "Billet simple pour l'Alaska" sera l'occasion de faire entendre
                        votre voix. Exprimez votre ressenti sur la progression de l'histoire, réagissez sur les décisions des personnages,
                        proposez vos interprétations, échangez vos idées.
                        Au gré de la pertinence de votre commentaire, Jean Forteroche vous répondra !
                    </p>
                </div>
            </div>
        </div>
        <div id="blogRightCol">
            <div class="blogDbleColTitle">
                <button class="blogIDiv">
                    <i class="icon fas fa-list-alt"></i>
                </button>
                <h4>Les 4 derniers chapitres :</h4>
            </div>
            <div id="chaptersSlider">
            <?php
            var_dump($_VIEW['lastChapters']);
            foreach ($_VIEW['lastChapters'] as $lastChapter){
            ?>
                <div id="chap<?php $lastChapter['id']?>" class="chaptersSliderDiv">
                    <div id="chap<?php $lastChapter['id']?>Img" class="chap<?php $lastChapter['id']?>Img chapImg"></div>
                    <div id="chap<?php $lastChapter['id']?>Content" class="chaptersSliderDivContent">
                        <span class="dateTime"><?php $lastChapter['creation_date']?></span>
                        <h4>Chapitre <?php $lastChapter['id']?> :<br/><?php $lastChapter['title']?></h4>
                        <a class="pageLink" href="chapitre/<?php $lastChapter['id']?>">LIRE LE CHAPITRE<i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </section>

    <section id="livres">
        <div id="livresDiv">
            <h2>ROMANS</h2>
            <button id="sliderButPrev" class="sliderBut"><i class="fas fa-chevron-left"></i></button>
            <div id="livresSlider">
                <img id="book1" src="/Public/images/book1.png">
                <img id="book2" src="/Public/images/book2.png">
                <img id="book3" src="/Public/images/book3.png">
                <img id="book4" src="/Public/images/book4.png">
                <img id="book5" src="/Public/images/book5.png">
                <img id="book6" src="/Public/images/book6.png">
                <img id="book7" src="/Public/images/book7.png">
            </div>
            <button id="sliderButNext" class="sliderBut"><i class="fas fa-chevron-right"></i></button>
            <div class="sliderIndex">
                <div id="livresSliderPrev" class="sliderIndex1"></div>
                <div id="livresSliderNext" class="sliderIndex2"></div>
            </div>
        </div>
        <div id="contactDiv">
            <h2>CONTACT</h2>
            <form id="contactForm">
                <div id="contactColLeft">
                    <div class="contactFormDivs">
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" class="storage" placeholder="Votre nom" value required>
                    </div>
                    <div class="contactFormDivs">
                        <label for="firstName">Prénom</label>
                        <input type="text" name="firstName" id="firstName" class="storage" placeholder="Votre prénom" value required>
                    </div>
                    <div class="contactFormDivs">
                        <label for="email">Adresse mail</label>
                        <input type="email" name="email" id="email" class="storage" placeholder="Votre email" value required>
                    </div>
                </div>
                <div id="contactColRight">
                    <div class="contactFormDivs">
                        <label for="object">Objet du message</label>
                        <input type="text" name="object" id="object" class="storage" placeholder="L'objet de votre message" value required>
                    </div>
                    <div class="contactFormDivs">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="storage" placeholder="Votre message" value required></textarea>
                    </div>
                </div>
                <div class="captchaSend">
                    <div>
                        <input type="checkbox" name="checkbox" id="checkbox" value required>
                        <label for="checkbox">Je ne suis pas un robot</label>
                    </div>
                    <input type="submit" name="submit" class="formSubmit" value="Envoyer">
                </div>
            </form>
        </div>
    </section>
</section>

<?php $content = ob_get_clean();
require ('template.php');
?>
