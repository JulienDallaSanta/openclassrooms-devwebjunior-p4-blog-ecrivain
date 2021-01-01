//---create button & connexion form---

function closeConnectModal(event){
    event.preventDefault();
    event.stopPropagation();
    $("#connectModal").remove();
}



//---connexion/déconnexion à l'admin---

$(document).ready(function(){
    //---boite modale de connexion à l'admin---
    $("#connexionLink").on('click', ()=>{
        $(".page").prepend($(`
            <div id="connectModal">
                <form id="connectModalContent" method="post">
                    <i id="connectModalClose" class="fas fa-times-circle" onclick="closeConnectModal(event)"></i>
                    <h3>Connexion :</h3>
                    <div id="connectId" class="connectFormDiv">
                        <label for="username">Votre identifiant :</label>
                        <input type="text" name="username" id="username" class="storage" value required>
                    </div>
                    <div id="connectPassword" class="connectFormDiv">
                        <label for="password">Votre mot de passe :</label>
                        <input type="password" name="password" id="password" class="storage" value required>
                    </div>
                    <input type="submit" id="connectFormSubmit" class="formSubmit" value="OK">
                </form>
            </div>
        `));
        $("#connectFormSubmit").on('click', function (event){
            console.log(event);
            event.preventDefault();
            event.stopPropagation();


            $.ajax({
                type: "POST",
                url:'/api/user/login',
                data:{
                    username : $("#username").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                    password : $("#password").val()
                },
                statusCode:{
                    200: function(){
                        // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                        document.location.reload();
                    },
                    400: function() {
                        $("#connectModalContent>h3").css("color:red;")
                        $("#connectModalContent>h3").html("Merci de renseigner l'identifiant ET le mot de passe");
                    },
                    401: function() {
                        $("#connectModalContent>h3").css("color:red;")
                        $("#connectModalContent>h3").html("Vos identifiant et mot de passe sont incorrects");
                    }
                },
                dataType: "json"
            });
        });
    });


    $("#disconnectLink").on('click', function (event){
        event.preventDefault();
        event.stopPropagation();
        console.log('disconnect');
        $("#connexionLink").show();
        $("#disconnectLink").remove();
        $("#menu_items").last().remove();
        $.post(
            '/api/user/logout',
            {

            }
        );
        window.location.reload();
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
