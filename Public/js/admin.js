//---create button & connexion form---

function closeConnectModal(event){
    event.preventDefault();
    event.stopPropagation();
    $("#connectModal").remove();
}

//---boite modale de connexion à l'admin---
$("#connexionLink").on('click', ()=>{
    $(".page").prepend($(`
        <div id="connectModal">
            <div id="connectModalContent">
                <i id="connectModalClose" class="fas fa-times-circle" onclick="closeConnectModal(event)"></i>
                <h3>Connexion :</h3>
                <div id="connectId" class="connectFormDiv">
                    <label for="identifiant">Votre identifiant :</label>
                    <input type="text" name="identifiant" id="identifiant" class="storage" value required>
                </div>
                <div id="connectPassword" class="connectFormDiv">
                    <label for="password">Votre mot de passe :</label>
                    <input type="password" name="password" id="password" class="storage" value required>
                </div>
                <a id="connectFormSubmit" class="formSubmit" onclick="connection(event)"><span>OK</span></a>
            </div>
        </div>
    `));
});

//---connexion/déconnexion à l'admin---

$(document).ready(function(){

    $("#connectFormSubmit").on('click', function (event){
        event.preventDefault();
        event.stopPropagation();
        console.log('Connect');

        $.post(
            'connexion.php', // Un script PHP que l'on va créer juste après
            {
                username : $("#identifiant").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                password : $("#password").val()
            },

            function(data){
                if(data == 'Success'){
                    // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                    document.location.reload();
                    $("#menu_items").append($(`
                        <li><a href="\admin"><i class="icon fa fa-crown fa-2x"></i><span> Admin</span></a></li>
                    `));
                    $("#connexionButton").prepend($(`
                        <a id="disconnectLink" href="home.html" data-title="Se déconnecter">Se déconnecter</a>
                    `));
                    $("#connexionLink").hide();
                    $("#connectModal").remove();
                    $("#helloAdmin").html("Bonjour Jean Forteroche !");
               }
               else{
                    // Le membre n'a pas été connecté. (data vaut ici "failed")
                    $("#connectModalContent>h3").css("color:red;")
                    $("#connectModalContent>h3").html("Vos identifiant et mot de passe sont incorrects");
               }
            },

            'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
         );

    });

    $("#disconnectLink").on('click', function (event){
        event.preventDefault();
        event.stopPropagation();
        console.log('disconnect');
        $("#connexionLink").show();
        $("#disconnectLink").remove();
        $("#menu_items").last().remove();
        $(window).load("home");
    });

});

$(document).ready(()=>{
    /*stats sessions*/
    var sessionsIntervalId;
    statsIncrement($("#sessionsNumber"), 0, 259, sessionsIntervalId, 10);
    /*pages par session*/
    var pagesPerSessionsIntervalId;
    statsIncrement($("#pagesPerSessionsNumber"), 0, 6, pagesPerSessionsIntervalId, 500);
    /*pages par session*/
    var bounceRateIntervalId;
    statsIncrement($("#bounceRateNumber"), 0, 17, bounceRateIntervalId, 100);
    saveChapter();
});

function statsIncrement(container, value, valMax, intervalId, intervalDuration){
    container.text(value);
    intervalId = setInterval(()=>{
        value+=1;
        container.text(value);
        if(value>=valMax){
            clearInterval(intervalId);
        }
    }, intervalDuration);
}

function saveChapter(){
    $("#chapterSubmit").on('click', function(){
        let chapter = $(".tinymce").val();
        localStorage.setItem('chapter', chapter);
        saveToLocalStorage(chapter);
    });
}
