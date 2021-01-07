function abortComment(event){
    event.preventDefault();
    event.stopPropagation();
    $("#checkCommentModal").hide();
}

function publishComment(event){
    event.preventDefault();
    event.stopPropagation();
    let pseudo = $("#pseudo").val();
    let comment = $("#comment").val();
    localStorage.setItem('comment', comment);
    localStorage.setItem('pseudo', pseudo);
    $("#commentCreateForm").slideToggle();
    $("#checkCommentModal").hide();
    document.location.reload();
    let numberofComments = $(".commentDiv");
    $("#numberOfComments>span").html(numberofComments.length);
}

$(document).ready(function(){
    $("#commentCreateForm").hide();
    //chapter selection
    $(".chapterSelectA").on('click', function(){
        console.log('ok');
        let elementId = this.id;
        switch(elementId) {
            case 'chapterSelect1':
                $("#blogTitleH3").text('CHAPITRE 1 : UN VRAI DÉFI');
                $(".chapterEntireText").hide();
                $("#chapter1").show();
                break;
            case 'chapterSelect2':
                $("#blogTitleH3").text('CHAPITRE 2 : PRENDRE DE LA HAUTEUR');
                $(".chapterEntireText").hide();
                $("#chapter2").show();
                break;
            case 'chapterSelect3':
                $("#blogTitleH3").text('CHAPITRE 3 : UNE ÂME PERDUE');
                $(".chapterEntireText").hide();
                $("#chapter3").show();
                break;
            case 'chapterSelect4':
                $("#blogTitleH3").text('CHAPITRE 4 : ON THE ROAD AGAIN');
                $(".chapterEntireText").hide();
                $("#chapter4").show();
                break;
            case 'chapterSelect5':
                $("#blogTitleH3").text('CHAPITRE 5 : MANGER OU ÊTRE MANGÉ');
                $(".chapterEntireText").hide();
                $("#chapter5").show();
                break;
            case 'chapterSelect6':
                $("#blogTitleH3").text('CHAPITRE 6 : PEINE DE MORT');
                $(".chapterEntireText").hide();
                $("#chapter6").show();
        }
    });

    //create a comment
    $("#writeAComment").on('click', function(){
        $("#commentCreateForm").slideToggle(); //the form appears
        if(localStorage.getItem('pseudo')){
            $("#pseudo").val(localStorage.getItem('pseudo'));
        }
        //when submit...
        $("#commentFormSubmit").on('click', (event)=>{
            event.stopPropagation();
            event.preventDefault();
            let pseudo = $("#pseudo").val();
            localStorage.setItem('pseudo',pseudo);
            let comment = $("#comment").val();
            console.log(comment);
            $(".page").prepend($(`
            <div id="checkCommentModal">
                <p>Confirmer l'envoi de votre commentaire :</br>
                    <span id="pseudoSpan">"${pseudo}"</span>
                    <span id="commentSpan">"${comment}"</span>
                    <span>
                        <i id="commentFormPublish" class="fas fa-check-circle" onclick="publishComment(event)"></i>
                        <i id="commentFormAbort" class="fas fa-times-circle" onclick="abortComment(event)"></i>
                    </span>
                </p>
            </div>
            `));

            $.ajax({ //AJAX call to post data
                type: "POST",
                url:'/api/comment/newcomment',
                data:{
                    username : $("#pseudo").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                    comment : $("#comment").val()
                },
                statusCode:{
                    200: function(){
                        // document.location.reload();

                    },
                    400: function() {
                        $("#commentCreateForm").prepend(`
                        <p style='color:red; font-weight:bold'>Merci de renseigner tous les champs du formulaire.</p>
                        `);
                    },
                    401: function() {
                        $("#commentCreateForm").prepend(`
                        <p style='color:red; font-weight:bold'>Erreur : votre message n'a pas été envoyé.</p>
                        `);
                    }
                },
                dataType: "json"
            });


        })
    });
});
