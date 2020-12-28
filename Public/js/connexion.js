$(document).ready(function(){

    $("#connectFormSubmit").click(function(){

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

});
