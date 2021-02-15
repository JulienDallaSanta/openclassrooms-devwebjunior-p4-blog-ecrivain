<div id="header">
<?php
if(isset($_SESSION['username'])){
    ?>
    <span id="helloAdmin">Bonjour <?= $_SESSION['username']?> !</span>
    <?php
}
?>
    <div id="connexionButton">
        <?php
            if(!isset($_SESSION['username'])){
                ?>
                <a id="connexionLink" data-title="Se connecter">Se connecter</a>
                <?php
            } else{
                ?>
                <a id="disconnectLink" data-title="Se déconnecter">Se déconnecter</a>
                <?php
            }
        ?>
    </div>

</div>
