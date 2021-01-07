$(document).ready(function(){
    //-----------rgpd for mobiles & gestion bouton backtotop---------
    $("#mobiletopbtn").hide();
    var largeur = $(window).width();
    if(largeur <= 768){
        $("#rgpd").addClass('forMobileDevices');
        $(window).scroll(function(){
            if(window.scrollY>=300){
                $("#mobiletopbtn").show();
            }else{
                $("#mobiletopbtn").hide();
            }
        });
    }else{
        $("#mobiletopbtn").hide();
        $("#rgpd").removeClass('forMobileDevices');
    }
    //-----------boutons du RGPD---------
    $("#cookiesOk").on('click', ()=>{
        $("#rgpd").hide();
    });

    // menu_toggle
    var $page = $('.page');

    $('.menu_toggle').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();
    $page.toggleClass('shazam');
    });
    $('.content').on('click', function(){
    $page.removeClass('shazam');
    });
    $(".menu_items>li:first").on('click', function(){
        console.log('ok');
        $(".icon").removeClass('activeIcon');
        $(".fa-home").addClass('activeIcon');
        $(".menu_items>li>a>span").removeClass('activeASpan');
        $(".menu_items>li:first>a>span").addClass('activeASpan');
    });
    $(".menu_items>li:eq(1)").on('click', function(){
        console.log('okbis');
        $(".icon").removeClass('activeIcon');
        $(".fa-portrait").addClass('activeIcon');
        $(".menu_items>li>a>span").removeClass('activeASpan');
        $(".menu_items>li:eq(1)>a>span").addClass('activeASpan');
    });
    $(".menu_items>li:last").on('click', function(){
        console.log('ok3');
        $(".icon").removeClass('activeIcon');
        $(".fa-blog").addClass('activeIcon');
        $(".menu_items>li>a>span").removeClass('activeASpan');
        $(".menu_items>li:last>a>span").addClass('activeASpan');
    });
    $(window).scroll(function(){
        if(window.scrollY>=300){
            $("#darkModeDiv>span").hide();
            $(".menu_toggle").addClass('discretMenu');
            $("#header").addClass('discretHeader');
            $("#darkModeDiv").addClass('discretMode');
            $("#connexionButton").addClass('discretButton');
        }else if(window.scrollY<300){
            $("#darkModeDiv>span").show();
            $(".menu_toggle").removeClass('discretMenu');
            $("#header").removeClass('discretHeader');
            $("#darkModeDiv").removeClass('discretMode');
            $("#connexionButton").removeClass('discretButton');
        }
    });

    // arrowDown animation
    $('a.scroll-link').click(function(e){
        e.preventDefault();
        $('body,html').animate({
            scrollTop: $(this).attr('href').offset().top -20
        }, 750);
    });

    //---connexion/déconnexion à l'admin---
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
        $(".page").prepend($(`
            <div id="connectModal">
                <div id="disconnectModalContent">
                    <h3>Confirmer la déconnexion :</h3>
                    <div id="disconnectButtons">
                        <a id="disconnectOk" class="formSubmit ok">OUI</a>
                        <a id="disconnectNo" class="formSubmit no">NON</a>
                    </div>
                </div>
            </div>
        `));
        $("#disconnectOk").on('click', function (event){
            console.log(event);
            event.preventDefault();
            event.stopPropagation();
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
        $("#disconnectNo").on('click', function (event){
            event.preventDefault();
            event.stopPropagation();
            $("#connectModal").remove();
        });
    });

});
