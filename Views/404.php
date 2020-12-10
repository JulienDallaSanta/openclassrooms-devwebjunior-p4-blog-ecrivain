<?php ob_start();?>

<section class="pages page404">
    <div id="pageContent404">
    </div>
    <div id="page404div">
        <p>Il semble que la page à laquelle vous essayez d'accéder n'est pas ou plus disponible.
        Veuillez vérifier l'orthographe et les majuscules de l'URL.
        Si vous ne parvenez pas à localiser une page sur ce site, essayez d'accéder à la page d'accueil.
        </p>
        <div>
            <button class="formSubmit button404">Accueil</button>
            <button class="formSubmit button404">Page précedente</button>
        </div>
    </div>

</section>

<?php $content = ob_get_clean();
require ('template.php');
?>
