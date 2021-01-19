function abortComment(event){
    event.preventDefault();
    event.stopPropagation();
    $("#checkCommentModal").remove();
}

function publishComment(event){
    event.preventDefault();
    event.stopPropagation();
    let pseudo = $("#pseudo").val();
    let comment = $("#comment").val();
    localStorage.setItem('comment', comment);
    localStorage.setItem('pseudo', pseudo);
    $("#commentCreateForm").slideToggle();
    $("#checkCommentModal").remove();
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/comment/newcomment',
        data:{
            pseudo : $("#pseudo").val(),  // Nous récupérons la valeur de nos inputs
            comment : $("#comment").val(),
            chapter_id : $("#chapterId").html()

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
        },
        dataType: "json"
    });
    document.location.reload();
    // let numberofComments = $(".commentDiv");
    // $("#numberOfComments>span").html(numberofComments.length);
}

function reportComment(commentId){
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/comment/report',
        data:{
            id : commentId
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
        },
        dataType: "json"
    });
    document.location.reload();
}

function closeCheckCommentModal(event){
    event.preventDefault();
    event.stopPropagation();
    $("#checkCommentModal").remove();
}

$(document).ready(function(){
    $("#commentCreateForm").hide();
    console.log($("#chapterId").html());
    // color writeAComment button function of the chapter
    switch($("#chapterId").html()){
        case '1':
            $("#writeAComment").removeClass();
            $("#writeAComment").addClass('yellowBg');
            break;
        case '2':
            $("#writeAComment").removeClass();
            $("#writeAComment").addClass('orangeBg');
            break;
        case '3':
            $("#writeAComment").removeClass();
            $("#writeAComment").addClass('redBg');
            break;
        case '4':
            $("#writeAComment").removeClass();
            $("#writeAComment").addClass('purpleBg');
            break;
        case '5':
            $("#writeAComment").removeClass();
            $("#writeAComment").addClass('blueBg');
            break;
        case '6':
            $("#writeAComment").removeClass();
            $("#writeAComment").addClass('lightBlueBg');
    }

    //create a comment
    $("#writeAComment").on('click', function(){
        $("#commentCreateForm").slideToggle(); //the form appears
        if(localStorage.getItem('pseudo') || localStorage.getItem('comment') ){
            $("#pseudo").val(localStorage.getItem('pseudo'));
            $("#comment").val(localStorage.getItem('comment'));
        }
        //when submit...
        $("#commentFormSubmit").on('click', (event)=>{
            event.stopPropagation();
            event.preventDefault();
            let pseudo = $("#pseudo").val();
            let comment = $("#comment").val();
            let chapter = $("#chapterId").html();
            console.log(chapter);
            $(".page").prepend($(`
            <div id="checkCommentModal">
                <div id="checkCommentModalContent">
                    <h3>Confirmer l'envoi de votre commentaire pour le chapitre ${chapter} :</h3>
                    <p id="pseudoSpan"><strong><em>Votre pseudo : </em></strong>${pseudo}</p>
                    <p id="commentSpan"><strong><em>Votre commentaire</em> : </strong><br/>"${comment}"</p>
                    <span>
                        <i id="commentFormPublish" class="fas fa-check-circle" onclick="publishComment(event)"></i>
                        <i id="commentFormAbort" class="fas fa-times-circle" onclick="abortComment(event)"></i>
                    </span>
                </div>

            </div>
            `));
        })
    });

    //---modal for report comment---
    $(".commentReport").on('click', (event)=>{
        const commentId = event.target.parentElement.dataset.commentId;
        // Check report confirmation
        $(".page").prepend($(`
            <div id="checkCommentModal">
            <div id="connectModalContent">
                <h3>Confirmer le signalement du commentaire :</h3>
                <span>
                    <i id="commentFormPublish" class="fas fa-check-circle" onclick="reportComment(${commentId})"></i>
                    <i id="commentFormAbort" class="fas fa-times-circle" onclick="closeCheckCommentModal(event)"></i>
                </span>
            </div>
        `));
    });
});
