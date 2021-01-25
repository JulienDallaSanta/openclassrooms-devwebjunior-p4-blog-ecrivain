// SEO stats animations
$(document).ready(()=>{
    /*----set variables----*/
    let chapterTitle = localStorage.getItem('newChapterTitle');
    let chapterContent = localStorage.getItem('newChapterContent');

    let chapterImage = $("#urlImgInput").val();
    let file_data = '';
    let form_data = '';

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
        if(chapterTitle || chapterImage || chapterContent){
            $(".fa-chevron-down").toggleClass('hiddenChevron');
            $(".fa-chevron-up").toggleClass('hiddenChevron');
            $("#chapterEdit").toggle();
            console.log('chapterEdit show');
            let intervalIdAutoReady = setInterval(saveDataToLSIfExists, 5000);
            $("#addChapterCallToAction").click(()=>{
                clearInterval(intervalIdAutoReady);
                console.log('intervalIdAutoReady off');
            });
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
    //Store radio input value into a div & in local storage
    $("input[name='saveAndPublish']").click(function(){
        let log = $("input[name='saveAndPublish']:checked").val();
        $( "#log" ).html(log);
        localStorage.setItem("createChapterAction", log)
    });
    //ChapterEdit show/hide when click on #addChapterCallToAction
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
        //Save AddAChapter form data to LocalStorage every 5 seconds if the AddAChapter form is visible
        function saveChapterToLocalStorage(){
            if($("i.fa-chevron-up").hasClass("hiddenChevron")){
                let title = $("#title").val();
                let content = tinyMCE.activeEditor.getContent({format : 'raw'});
                if(title != ''){
                    localStorage.setItem('newChapterTitle', title);
                }
                if(content != '<p><br data-mce-bogus="1"></p>' && content != '<p><br></p>'){
                    localStorage.setItem('newChapterContent', content);
                }
                console.log('setInterval');
            }else{
                clearInterval(intervalIdChapterAutoSave);
                console.log('ClearInterval');
            }
        }
        let intervalIdChapterAutoSave = setInterval(saveChapterToLocalStorage, 5000);

    });

    $("#upload_image").click((e)=>{
        e.stopPropagation();
        e.preventDefault();
        let file_data = $('#chapter_image').prop('files')[0];
        let form_data = new FormData();
        if($('#chapter_image').prop('files')){ // if an image has been selected we send it to the api/api/chapter/image with ajax call
            form_data.append('file', file_data);
            let urlImg = 'http://'+window.location.hostname+'/Public/uploads/'+file_data['name'];
            console.log(file_data['name']);
            $.ajax({
                url: '/api/chapter/image',
                type: 'POST',
                //AJAX responses
                success: function(){
                    $(".sendImageSpan").remove();
                    $(".form-group:first").append( $(`
                        <span class="sendImageSpan" style="color:forestgreen"><em>L'image a bien été envoyée</em></span>
                    `));
                    $("input[name='urlImg']").val(urlImg);
                    localStorage.setItem('urlImg', $("#urlImgInput").val()); //Store the url in a hidden input
                    console.log('image envoyée');
                },
                error: function(){
                    $(".sendImageSpan").remove();
                    $(".form-group:first").append( $(`
                        <span class="sendImageSpan" style="color:red"><em>Merci de choisir une image</em></span>
                    `));
                    console.log('échec envoi image');
                },
                //Données du formulaire envoyé
                data: form_data,
                //Options signifiant à jQuery de ne pas s'occuper du type de données
                cache: false,
                contentType: false,
                processData: false
            });
        }else{
            console.log('image pas sélectionnée');
            $(".sendImageSpan").remove();
            return $(".form-group:first").append( $(`
                <span class="sendImageSpan" style="color:red"><em>Merci de choisir une image</em></span>
            `));
        }
    });

    $(".createChapterSubmit").on("click", ()=>{ //open modal to confirm chapter creation
        let creation_date = newFormatedDate();
        let chapterImage = $("#urlImgInput").val();
        if(chapterImage && chapterImage != null){
            let chapterAction = localStorage.getItem('createChapterAction');
            if(chapterAction !== '' && chapterAction !== null){
                console.log('createChapterAction ok');
                console.log(chapterAction);
                if(chapterAction == 'save'){
                    console.log('save');
                    localStorage.removeItem('createChapterAction');
                    $(".page").prepend($(`
                        <div id="chapterModal">
                            <div id="createChapterModalContent">
                                <i id="connectModalClose" class="fas fa-times-circle" onclick="closeChapterModal(event)"></i>
                                <h2>Enregistrer le chapitre sans le publier ?</h2>
                                <h3>${chapterTitle}</h3>
                                <h4><em>édité le ${creation_date}</em></h4>
                                <div id="adminChapterDiv">
                                    <img id="adminChapterImg" src="${chapterImage}">
                                    <div id="adminChapterP">${chapterContent}</div>
                                </div>
                                <span class="createChapterSubmit" onclick="saveChapter(event)">Sauvegarder SANS Publier</span>
                            </div>
                        </div>
                    `));
                } else if (chapterAction == 'save and publish') {
                    console.log('save and publish');
                    localStorage.removeItem('createChapterAction');
                    $(".page").prepend($(`
                        <div id="chapterModal">
                            <div id="createChapterModalContent">
                                <i id="connectModalClose" class="fas fa-times-circle" onclick="closeChapterModal(event)"></i>
                                <h2>Enregistrer ET publier le chapitre ?</h2>
                                <h3>${chapterTitle}</h3>
                                <h4><em>édité le ${creation_date}</em></h4>
                                <div id="adminChapterDiv">
                                    <img id="adminChapterImg" src="${chapterImage}">
                                    <div id="adminChapterP">${chapterContent}</div>
                                </div>
                                <span class="createChapterSubmit" onclick="saveAndPublishChapter(event)">Sauvegarder ET Publier</span>
                            </div>
                        </div>
                    `));
                }
            } else {
                console.log('createChapterAction no');
                $(".page").prepend($(`
                    <div id="chapterImageModal">
                        <div id="chapterImageModalContent">
                            <h3>Merci de sélectionner une action ci-dessus ("enregistrer" ou "enregistrer et publier")</h3>
                            <span class="createChapterSubmit" onclick="closeChapterImageModal(event)">OK</span>
                        </div>
                    </div>
                `));
            }
        }else{
            $(".page").prepend($(`
                <div id="chapterImageModal">
                    <div id="chapterImageModalContent">
                        <h3>Merci de choisir une image pour le chapitre et de l'envoyer en cliquant sur le bouton "Envoyer le fichier"</h3>
                        <span class="createChapterSubmit" onclick="closeChapterImageModal(event)">OK</span>
                    </div>
                </div>
            `));
        }
    }) ;

    $(".fa-edit").on("click", ()=>{ // modify chapter when click on the modify button

    });
    $(".fa-trash-alt").on("click", ()=>{ // delete chapter when click on the delete button

    });
    $(".fa-trash-restore").on("click", ()=>{ // restore chapter when click on the restore button

    });
    $(".fa-newspaper").on("click", ()=>{ // edit chapter when click on the edit button

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
function statsIncrement(container, value, valMax, intervalIdStats, intervalDuration){
    container.text(value);
    intervalIdStats = setInterval(()=>{
        value+=1;
        container.text(value);
        if(value>=valMax){
            clearInterval(intervalIdStats);
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

function saveDataToLSIfExists(){
    let title = $("#title").val();
    let content = tinyMCE.activeEditor.getContent({format : 'raw'});
    if(title != ''){
        localStorage.setItem('newChapterTitle', title);
    }
    if(content != '<p><br data-mce-bogus="1"></p>' && content != '<p><br></p>'){
        localStorage.setItem('newChapterContent', content);
    }
    console.log('setInterval start');
}

function newFormatedDate(){
    let monthName=['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    let dayName= ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];

    let newDate = new Date();
    let hours = newDate.getHours();
    let minutes = newDate.getMinutes();
    let day = newDate.getDay(); //Jour
    let nday = newDate.getDate(); //Numéro du jour
    let month = newDate.getMonth(); //Mois (commence à 0, donc +1)
    let year = newDate.getFullYear(); //Année sur 2 chiffres ou getFullYear sur 4


    let newFormatedDate = dayName[day]+' '+nday+' '+monthName[month]+' '+year+' à '+hours+'h'+minutes+'m';

    return newFormatedDate;
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

function saveChapter(event){
    event.preventDefault();
    event.stopPropagation();
    let chapterTitle = localStorage.getItem('newChapterTitle');
    let chapterContent = localStorage.getItem('newChapterContent');
    let chapterImage = $("#urlImgInput").val();
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/chapter/create',
        data:{
            title : chapterTitle,  // Nous récupérons la valeur de nos inputs
            content : chapterContent,
            chapter_image : chapterImage,
            published : '0'

        },
        statusCode:{
            200: function(){
                console.log('chapitre sauvegardé');
                document.location.reload();

            },
            400: function() {
                console.log('erreur sauvegarde chapitre');
            },
        },
        dataType: "json"
    });
}

function saveAndPublishChapter(event){
    event.preventDefault();
    event.stopPropagation();
    let chapterTitle = localStorage.getItem('newChapterTitle');
    let chapterContent = localStorage.getItem('newChapterContent');
    let chapterImage = $("#urlImgInput").val();
    $.ajax({ //AJAX call to post data from comment create form
        type: "POST",
        url:'/api/chapter/create',
        data:{
            title : chapterTitle,  // Nous récupérons la valeur de nos inputs
            content : chapterContent,
            chapter_image : chapterImage,
            published : '1'

        },
        statusCode:{
            200: function(){
                console.log('chapitre sauvegardé et publié');
                // document.location.reload();

            },
            400: function() {
                console.log('erreur sauvegarde chapitre');
            },
        },
        dataType: "json"
    });
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
