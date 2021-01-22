// SEO stats animations
$(document).ready(()=>{
    /*Menu Admin*/
    $(".AdminSection").hide();
    $("#seoStats").show();

    $("#statSite").on("click", (e)=>{
        e.preventDefault();
        e.stopPropagation();
        $(".AdminSection").hide();
        $("#seoStats").show();
    });
    $("#chapterAdmin").on("click", (e)=>{
        e.preventDefault();
        e.stopPropagation();
        $(".AdminSection").hide();
        $("#chaptersManagement").show();
        if((localStorage.getItem('newChapterTitle')) || (localStorage.getItem('newChapterImage')) || (localStorage.getItem('newChapterContent'))){
            $(".fa-chevron-down").toggleClass('hiddenChevron');
            $(".fa-chevron-up").toggleClass('hiddenChevron');
            $("#chapterEdit").toggle();
            console.log('chapterEdit show');
        }
        checkIfChapterDataIsAlreadySet();
    });
    $("#commentsAdmin").on("click", (e)=>{
        e.stopPropagation();
        e.preventDefault();
        $(".AdminSection").hide();
        $("#commentsManagement").show();
    });

    /*stats sessions*/
    var sessionsIntervalId;
    statsIncrement($("#sessionsNumber"), 0, 259, sessionsIntervalId, 10);
    /*pages par session*/
    var pagesPerSessionsIntervalId;
    statsIncrement($("#pagesPerSessionsNumber"), 0, 6, pagesPerSessionsIntervalId, 500);
    /*pages par session*/
    var bounceRateIntervalId;
    statsIncrement($("#bounceRateNumber"), 0, 17, bounceRateIntervalId, 100);

    /*Chapters management*/
    // $(".selectChapter:first").prop("checked", true);

    $("#addChapterCallToAction").on("click", (e)=>{
        e.stopPropagation();
        e.preventDefault();
        $(".fa-chevron-down").toggleClass('hiddenChevron');
        $(".fa-chevron-up").toggleClass('hiddenChevron');
        if($("i.fa-chevron-up").hasClass("hiddenChevron")){
            $("#chapterEdit").slideToggle();
            checkIfChapterDataIsAlreadySet();
            console.log("i.fa-chevron-up:hidden");
        }else{
            $("#chapterEdit").slideToggle();
        }
        /*----Save AddAChapter form data to LocalStorage every 5 seconds if the AddAChapter form is visible----*/
        function saveChapterToLocalStorage(){
            if($("i.fa-chevron-up").hasClass("hiddenChevron")){
                let title = $("#title").val();
                let image = $("#urlImgInput").val();
                let content = tinyMCE.activeEditor.getContent({format : 'raw'});
                if(title != ''){
                    localStorage.setItem('newChapterTitle', title);
                }
                if(image != ''){
                    localStorage.setItem('newChapterImage', image);
                }
                if(content != '<p><br data-mce-bogus="1"></p>' && content != '<p><br></p>'){
                    localStorage.setItem('newChapterContent', content);
                }
                console.log('setInterval');
            }else{
                clearInterval(intervalId);
                console.log('ClearInterval');
            }
        }
        let intervalId = setInterval(saveChapterToLocalStorage, 5000);

    });

    $(".fa-edit").on("click", ()=>{ // modify chapter when click on the modify button

    });
    $(".fa-trash-alt").on("click", ()=>{ // delete chapter when click on the delete button

    });
    $(".fa-trash-restore").on("click", ()=>{ // restore chapter when click on the restore button

    });
    $(".fa-newspaper").on("click", ()=>{ // edit chapter when click on the edit button

    });
    $("#upload_image").click((e)=>{
        e.stopPropagation();
        e.preventDefault();
        let file_data = $('#chapter_image').prop('files')[0];
        let form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: '/api/chapter/image', //script qui traitera l'envoi du fichier
            type: 'POST',
            //Traitements AJAX
            success: function(php_script_response){
                alert(php_script_response); // display response from the PHP script, if any
            },
            error: function(){
                //afficher erreur dans le form
            },
            //Données du formulaire envoyé
            data: form_data,
            //Options signifiant à jQuery de ne pas s'occuper du type de données
            cache: false,
            contentType: false,
            processData: false
        });
        //Get the image url when downloaded in uploads folder & store in localstorage
        let words = $("#chapter_image").val().split('\\');
        let urlImg = 'http://'+window.location.hostname+'/Public/uploads/'+words[2];
        localStorage.setItem('urlImg', urlImg);
        $("input[name='urlImg']").val(urlImg);//Store the url in a hidden input
    });

    // if(localStorage.getItem('newChapterTitle') && !$("#chapterEdit").css('display', 'none')){
    //     $("#title").val(localStorage.getItem('newChapterTitle'));
    // }
    // if(localStorage.getItem('newChapterImage') && !$("#chapterEdit").css('display', 'none')){
    //     $("#urlImgInput").val(localStorage.getItem('newChapterImage'));
    // }
    // if(localStorage.getItem('newChapterContent') && !$("#chapterEdit").css('display', 'none')){
    //     tinyMCE.activeEditor.setContent(localStorage.getItem('newChapterContent'));
    // }

    $(".createChapterSubmit").on("click", ()=>{ //open modal to confirm chapter creation
        let content = localStorage.getItem('newChapterContent');
        let title = localStorage.getItem('newChapterTitle');
        let image = localStorage.getItem('newChapterImage');
        let creation_date = new Date();
        if( image != '' && image != NULL){
            if($("#save:checked")){
                $(".page").prepend($(`
                    <div id="chapterModal">
                        <div id="createChapterModalContent">
                            <i id="connectModalClose" class="fas fa-times-circle" onclick="closeChapterModal(event)"></i>
                            <h2>Enregistrer le chapitre sans le publier ?</h2>
                            <h3>${title}</h3>
                            <h4><em>édité le ${creation_date}</em></h4>
                            <div id="adminChapterDiv">
                                <img id="adminChapterImg" src="${$("#urlImgInput").val()}">
                                <div id="adminChapterP">${content}</div>
                            </div>
                            <span class="createChapterSubmit" onclick="saveChapter(event)">Sauvegarder SANS Publier</span>
                        </div>
                    </div>
                `));
            }
            if($("#saveAndPublish:checked")){
                $(".page").prepend($(`
                    <div id="chapterModal">
                        <div id="createChapterModalContent">
                            <i id="connectModalClose" class="fas fa-times-circle" onclick="closeChapterModal(event)"></i>
                            <h2>Enregistrer et publier le chapitre ?</h2>
                            <h3>${title}</h3>
                            <h4><em>édité le ${creation_date}</em></h4>
                            <div id="adminChapterDiv">
                                <img id="adminChapterImg" src="${$("#urlImgInput").val()}">
                                <div id="adminChapterP">${content}</div>
                            </div>
                            <span class="createChapterSubmit" onclick="saveAndPublishChapter(event)">Sauvegarder ET Publier</span>
                        </div>
                    </div>
                `));
            }
        }else{
            $(".page").prepend($(`
                <div id="chapterImageModal">
                    <div id="chapterImageModalContent">
                        <h3>Merci de choisir une image pour le chapitre et de l'envoyer en cliquant sur le bouton "Envoyer le fichier</h3>
                        <span class="createChapterSubmit" onclick="closeChapterImageModal(event)">OK</span>
                    </div>
                </div>
            `));
        }


    }) ;
    $("#saveChapter").on('click', function(){
        let title = $("#chapterContent_ifr");
        $(".page").prepend($(`
            <div id="chapterModal">
                <div id="chapterModalContent">
                    <h3>Enregistrer le chapitre sans le publier ?</h3>
                    <h5>Titre : ${localStorage.getItem('title')}</h5>
                    <p>Texte : ${localStorage.getItem('content')}</p>
                    <img>email : ${localStorage.getItem('chapter_image')}</img>
                    <span>objet : ${localStorage.getItem('object')}</span>
                    <p>message : ${localStorage.getItem('message')}</p>
                    <div class="confirmButtons">
                        <i id="saveChapterOk" class="fas fa-check-circle" onclick="saveChapter(event)"></i>
                        <i class="fas fa-times-circle saveChapterNo" onclick="closeChapterModal(event)"></i>
                    </div>
                </div>
            </div>
        `));
        let chapter = $(".tinymce").val();
        localStorage.setItem('chapter', chapter);
        saveToLocalStorage(chapter);
    });
    $("#saveAndPublishChapter").on('click', function(){
        tinyMCE.triggerSave();//Calls the save method on all editor instances in the collection.
        let title = $("#chapterContent_ifr");
        $(".page").prepend($(`
            <div id="chapterModal">
                <div id="chapterModalContent">
                    <h3>Enregistrer le chapitre sans le publier ?</h3>
                    <h5>Titre : ${localStorage.getItem('title')}</h5>
                    <p>Texte : ${localStorage.getItem('content')}</p>
                    <img>email : ${localStorage.getItem('chapter_image')}</img>
                    <span>objet : ${localStorage.getItem('status')}</span>
                    <div class="confirmButtons">
                        <i id="saveAndPublishChapterOk" class="fas fa-check-circle" onclick="saveChapter(event)"></i>
                        <i class="fas fa-times-circle saveChapterNo" onclick="closeChapterModal(event)"></i>
                    </div>
                </div>
            </div>
        `));
        let chapter = $(".tinymce").val();
        localStorage.setItem('chapter', chapter);
        saveToLocalStorage(chapter);
    });

    /*Comments management*/
    //---modal for unreport comment---
    $(".unreport").on('click', (event)=>{
        const commentId = event.target.parentElement.parentElement.dataset.commentId;
        console.log(event.target.parentElement.parentElement);
        // Check report confirmation
        $(".page").prepend($(`
            <div id="checkCommentModal">
            <div id="connectModalContent">
                <h3>Annuler le signalement du commentaire :</h3>
                <span>
                    <i id="commentFormPublish" class="fas fa-check-circle" onclick="unreportComment(${commentId})"></i>
                    <i id="commentFormAbort" class="fas fa-times-circle" onclick="closeCheckCommentModal(event)"></i>
                </span>
            </div>
        `));
    });
    //---modal for delete comment---
    $(".deleteComment").on('click', (event)=>{
        const commentId = event.target.parentElement.parentElement.dataset.commentId;
        // Check report confirmation
        $(".page").prepend($(`
            <div id="checkCommentModal">
            <div id="connectModalContent">
                <h3>Supprimer le commentaire :</h3>
                <span>
                    <i id="commentFormPublish" class="fas fa-check-circle" onclick="deleteComment(${commentId})"></i>
                    <i id="commentFormAbort" class="fas fa-times-circle" onclick="closeCheckCommentModal(event)"></i>
                </span>
            </div>
        `));
    });

});

/*----Functions-----*/
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

function checkIfChapterDataIsAlreadySet(){
    if(localStorage.getItem('newChapterTitle')){
        $("#title").val(localStorage.getItem('newChapterTitle'));
        console.log('get newChapterTitle');
    }
    if(localStorage.getItem('newChapterContent')){
        tinyMCE.activeEditor.setContent(localStorage.getItem('newChapterContent'));
        console.log('get newChapterContent');
    }
    console.log('checkIfChapterDataIsAlreadySet');
}

function closeChapterModal(event){
    event.stopPropagation();
    event.preventDefault();
    $("#chapterModal").remove();
}

function closeChapterImageModal(event){
    event.stopPropagation();
    event.preventDefault();
    $("#chapterImageModal").remove();
}
function unreportComment(commentId){
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/comment/unreport',
        data:{
            id : commentId
        },
        statusCode:{
            200: function(){
                // window.location.reload();
            },
            400: function() {
            },
        },
        dataType: "json"
    });
}

function deleteComment(commentId){
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/comment/delete',
        data:{
            id : commentId
        },
        statusCode:{
            200: function(){
                // document.location.reload();
            },
            400: function() {
            },
        },
        dataType: "json"
    });

}

function closeCheckCommentModal(event){
    event.preventDefault();
    event.stopPropagation();
    $("#checkCommentModal").remove();
}
