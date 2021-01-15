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
    $("#checkCommentModal").remove();
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/comment/newcomment',
        data:{
            pseudo : $("#pseudo").val(),  // Nous récupérons la valeur de nos inputs
            comment : $("#comment").val(),
            chapterId : $("#chapterId").html()

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
    // document.location.reload();
    let numberofComments = $(".commentDiv");
    $("#numberOfComments>span").html(numberofComments.length);
}

function reportComment(event) {
    event.preventDefault();
    event.stopPropagation();
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/comment/reportcomment',
        data:{
            report : $(".commentId").val(),  // Nous récupérons la valeur de nos inputs
            report_date : new Date(),
            chapterId : $("#chapterId").html()

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
}

function abortReportComment(event){
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
    //chapter selection
    // $(".chapterSelectA").on('click', function(){
    //     console.log('ok');
    //     let elementId = this.id;
    //     // switch(elementId) {
    //     //     case 'chapterSelect1':
    //     //         $("#blogTitleH3").text('CHAPITRE 1 : UN VRAI DÉFI');
    //     //         $(".chapterEntireText").hide();
    //     //         $("#chapterId").text(1);
    //     //         console.log($("#chapterId").text());
    //     //         $("#chapter1").show();
    //     //         break;
    //     //     case 'chapterSelect2':
    //     //         $("#blogTitleH3").text('CHAPITRE 2 : PRENDRE DE LA HAUTEUR');
    //     //         $(".chapterEntireText").hide();
    //     //         $("#chapterId").html("2");
    //     //         console.log($("#chapterId").html());
    //     //         $("#chapter2").show();
    //     //         break;
    //     //     case 'chapterSelect3':
    //     //         $("#blogTitleH3").text('CHAPITRE 3 : UNE ÂME PERDUE');
    //     //         $(".chapterEntireText").hide();
    //     //         $("#chapterId").html("3");
    //     //         console.log($("#chapterId").html());
    //     //         $("#chapter3").show();
    //     //         break;
    //     //     case 'chapterSelect4':
    //     //         $("#blogTitleH3").text('CHAPITRE 4 : ON THE ROAD AGAIN');
    //     //         $(".chapterEntireText").hide();
    //     //         $("#chapterId").html("4");
    //     //         console.log($("#chapterId").html());
    //     //         $("#chapter4").show();
    //     //         break;
    //     //     case 'chapterSelect5':
    //     //         $("#blogTitleH3").text('CHAPITRE 5 : MANGER OU ÊTRE MANGÉ');
    //     //         $(".chapterEntireText").hide();
    //     //         $("#chapterId").html("5");
    //     //         $("#chapter5").show();
    //     //         break;
    //     //     case 'chapterSelect6':
    //     //         $("#blogTitleH3").text('CHAPITRE 6 : PEINE DE MORT');
    //     //         $(".chapterEntireText").hide();
    //     //         $("#chapterId").html("6");
    //     //         $("#chapter6").show();
    //     // }
    // });

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
                <p>Confirmer l'envoi de votre commentaire pour le chapitre ${chapter} :</br>
                    <span id="pseudoSpan">Votre pseudo : ${pseudo}</span>
                    <span id="commentSpan">Votre commentaire : <em>${comment}</em></span>
                    <span>
                        <i id="commentFormPublish" class="fas fa-check-circle" onclick="publishComment(event)"></i>
                        <i id="commentFormAbort" class="fas fa-times-circle" onclick="abortComment(event)"></i>
                    </span>
                </p>
            </div>
            `));
        })
    });

    //report comment
    $(".commentReport").on('click', ()=>{
        // Check report confirmation
        $(".page").prepend($(`
            <div id="checkCommentModal">
                <div>
                    <h3>Confirmer le signalement du commentaire :</h3>
                    <span>
                        <i id="commentFormPublish" class="fas fa-check-circle" onclick="reportComment(event)"></i>
                        <i id="commentFormAbort" class="fas fa-times-circle" onclick="abortReportComment(event)"></i>
                    </span>
                </div>

            </div>
        `));
    });
});
