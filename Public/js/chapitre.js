class Comment{
    constructor(parent){
        this.parent = parent;
        this.buildComment();
        this.eraseComment();
    }
    buildComment(){
        let index = ($(".commentDiv").length)+1;
        let nom = localStorage.getItem('name') || "";
        let prenom = localStorage.getItem('firstname') || "";
        let comment = localStorage.getItem('comment') || "";
        $(this.parent).prepend($(`
        <div id="comment${index}" class="commentDiv">
            <p class="namePublishDate"><span class="authorName">${prenom} ${nom}</span>
                <em> le <span class="dateOfPublish">${localStorage.getItem('commentDate')}</span></em>
            </p>
            <p class="comment">${comment}</p>
            <a class="commentReport">Signaler le commentaire</a>
        </div>
        `));
    }
    eraseComment(){

    }
}

function abortComment(event){
    event.preventDefault();
    event.stopPropagation();
    $("#checkCommentModal").hide();
}

function publishComment(event){
    event.preventDefault();
    event.stopPropagation();
    let firstname = $("#firstname").val();
    let name = $("#name").val();
    let comment = $("#comment").val();
    let dateTime = new Date;
    let options = {year:'numeric',month:'long', day:'numeric', hour:'numeric', minute:'numeric', second:'numeric'};
    let commentDate = dateTime.toLocaleDateString('fr-FR', options);
    saveToLocalStorage(firstname);
    saveToLocalStorage(name);
    localStorage.setItem('comment', comment);
    localStorage.setItem('commentDate', commentDate);
    $("#commentCreateForm").slideToggle();
    $("#checkCommentModal").hide();
    new Comment($('#comments'));
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
    $("#writeAComment").on('click', function(){
        $("#commentCreateForm").slideToggle();
    });
    //create a comment
    $("#commentFormSubmit").on('click', (event)=>{
        event.stopPropagation();
        event.preventDefault();
        let comment = $("#comment").val();
        console.log(comment);
        $(".page").prepend($(`
        <div id="checkCommentModal">
            <p>Confirmer l'envoi de votre commentaire :</br>
                <span id="commentSpan">"${comment}"</span>
                <span>
                    <i id="commentFormPublish" class="fas fa-check-circle" onclick="publishComment(event)"></i>
                    <i id="commentFormAbort" class="fas fa-times-circle" onclick="abortComment(event)"></i>
                </span>
            </p>
        </div>
        `));
    })
});
