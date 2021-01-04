//---create button & connection form---

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

            // AJAX call for connection
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
                        $("#connectModalContent>h3").html("Merci de renseigner tous les champs du formulaire");
                    },
                    401: function() {
                        $("#connectModalContent>h3").css("color:red;")
                        $("#connectModalContent>h3").html("Votre email n'est pas valide");
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

$(document).ready(function(){
    $("#contactDiv>p").remove();
    $(".formSubmit").on('click', function(event){
        console.log(event);
        event.preventDefault();
        event.stopPropagation();
        let name = $("#name").val();
        let firstname = $("#firstname").val();
        let email = $("#email").val();
        let object = $("#object").val();
        let message = $("#message").val();
        localStorage.setItem('name', name);
        localStorage.setItem('firstname', firstname);
        localStorage.setItem('email', email);
        localStorage.setItem('object', object);
        localStorage.setItem('message', message);
        saveToLocalStorage();

        // AJAX call for contactForm
        $.ajax({
            type: "POST",
            url:'/api/user/message',
            data:{
                name : $("#name").val(),
                firstname : $("#firstname").val(),
                email : $("#email").val(),
                object : $("#object").val(),
                message : $("#message").val()
            },
            statusCode:{
                200: function(){
                    document.location.reload();
                    $(".page").prepend($(`
                        <div id="connectModal">
                            <div id="connectModalContent">
                                <i id="connectModalClose" class="fas fa-times-circle" onclick="closeConnectModal(event)"></i>
                                <h3>Votre message a bien été envoyé.</h3>
                                <span>nom : ${localStorage.getItem('name')}</span>
                                <span>prénom : ${localStorage.getItem('firstname')}</span>
                                <span>nom : ${localStorage.getItem('email')}</span>
                                <span>nom : ${localStorage.getItem('object')}</span>
                                <p>nom : ${localStorage.getItem('message')}</p>
                            </div>
                        </div>
                    `));
                },
                400: function() {
                    $("#contactDiv>h2").after(`
                    <p style='color:red'>Merci de renseigner l'identifiant ET le mot de passe</p>
                    `);
                },
                401: function() {
                    $("#contactDiv>h2").after(`
                    <p style='color:red'>Vos identifiant et mot de passe sont incorrects</p>
                    `);
                }
            },
            dataType: "json"
        });
    });
});

// SEO stats animations
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

// Chapters management
function saveChapter(){
    $("#chapterSubmit").on('click', function(){
        let chapter = $(".tinymce").val();
        localStorage.setItem('chapter', chapter);
        saveToLocalStorage(chapter);
    });
}
