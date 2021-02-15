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
        $(".adminFuncSelectA").removeClass("focusAdminMenu");
        $("#statSite").toggleClass("focusAdminMenu");
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
            let intervalIdAutoReady = setInterval(saveDataToLSIfExists, 5000);
            $("#addChapterCallToAction").click(()=>{
                clearInterval(intervalIdAutoReady);
                console.log('intervalIdAutoReady off');
            });
        }
        checkIfChapterDataIsAlreadySet();
        $(".adminFuncSelectA").removeClass("focusAdminMenu");
        $("#chapterAdmin").toggleClass("focusAdminMenu");
    });
    $("#commentsAdmin").on("click", (e)=>{
        e.stopPropagation();
        e.preventDefault();
        $(".AdminSection").hide();
        $("#commentsManagement").show();
        $(".adminFuncSelectA").removeClass("focusAdminMenu");
        $("#commentsAdmin").toggleClass("focusAdminMenu");
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
    autoColorChapterLine();
    $(".chapterLine:first").addClass("chapterLineFocus");

    //ChapterEdit show/hide when click on #addChapterCallToAction
    $("#addChapterCallToAction").on("click", (e)=>{
        e.stopPropagation();
        e.preventDefault();
        $(".fa-chevron-down").toggleClass('hiddenChevron');
        $(".fa-chevron-up").toggleClass('hiddenChevron');
        if($("i.fa-chevron-up").hasClass("hiddenChevron")){
            $("#chapterEdit").slideToggle();
            checkIfChapterDataIsAlreadySet();
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
            }else{
                clearInterval(intervalIdChapterAutoSave);
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
        let chapterContent = localStorage.getItem('newChapterContent');
        if(chapterImage && chapterImage != null){
            $(".page").prepend($(`
                <div id="chapterModal">
                    <div id="createChapterModalContent">
                        <i id="connectModalClose" class="fas fa-times-circle" onclick="closeChapterModal(event)"></i>
                        <h2>${chapterTitle}</h2>
                        <h4><em>édité le ${creation_date}</em></h4>
                        <div id="adminChapterDiv">
                            <img id="adminChapterImg" src="${chapterImage}">
                            <div id="adminChapterP">${chapterContent}</div>
                        </div>
                        <span class="createChapterSubmit" onclick="saveChapter(event)">Sauvegarder</span>
                    </div>
                </div>
            `));
        } else {
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

    $(".fa-edit").on("click", (event)=>{ // modify chapter when click on the modify button
        let chapterId = event.target.parentNode.parentNode.parentNode.parentNode.getAttribute("data-id");
        let chapterTitle = event.target.parentNode.parentNode.parentNode.childNodes[3].childNodes[1].textContent;
        let chapterImage = event.target.parentNode.parentNode.parentNode.childNodes[3].childNodes[5].childNodes[1].getAttribute("src");
        let chapterContent = event.target.parentNode.parentNode.parentNode.childNodes[3].childNodes[5].childNodes[3].innerHTML;
        let chapter = [chapterId, chapterTitle, chapterImage, chapterContent];

        $(".page").prepend($(`
            <div id="chapterModal">
                <div id="createChapterModalContent" class='editChapter'>
                    <i id="connectModalClose" class="fas fa-times-circle" onclick="closeChapterModal(event)"></i>
                    <h2>Modifier le chapitre ?</h2>
                    <div class="editChapterPreviewContainer" data-id="${chapterId}">
                        <div class="editChapterpreview">
                            <h3 class="editPreviewh3">Aperçu du chapitre ${chapterId} :</h3>
                            <div class="editChapterpreviewContent">
                                <h4 class="editChapterPreviewTitle">${chapterTitle}</h4>
                                <div  class="editChapterPreviewTextImage">
                                    <img class="editChapterPreviewImage" src="${chapterImage}">
                                    <div class="editChapterPreviewText">${chapterContent}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="edit_chapterForm" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="chapter_image">Image <em>(333x500px 96dpi)</em>:</label><br/>
                            <input type="hidden" name="MAX_FILE_SIZE" value="50000" />
                            <input type="file" id="edit_chapter_image_modal" name="chapter_image" accept="image/png, image/jpeg" class="form-control" required>
                            <button id="edit_upload_image">Envoyer le fichier</button>
                            <input type="hidden" id="edit_urlImgInput_modal" name="urlImg" value="">
                        </div>
                        <div class="form-group">
                            <label for="title">Titre :</label><br/>
                            <input type="text" id="edit_title_modal" name="title"  class="form-control input-sm" value="${chapterTitle}" required>
                        </div>
                        <div class="form-group" id='edit_textareaDiv_modal'>
                            <label for="edit_content">Contenu du chapitre :</label>
                            <textarea id="edit_chapterContent_modal" class="tinymce form-control" name="edit_content" required>${chapterContent}</textarea>
                        </div>
                        <div class="form-group" id='edit_createChapterSubmitDiv_modal'>
                            <span class="editChapterSubmit">OK</span>
                        </div>
                    </form>
                </div>
            </div>
        `));
        tinymce.init({
            selector: '.tinymce',
            width: 1000,
            height: 400,
            language: 'fr_FR',
            plugins: [
              'advlist autolink link image lists charmap print preview hr anchor pagebreak',
              'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
              'table emoticons template paste help'
            ],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
              'bullist numlist outdent indent | link image | print preview media fullpage | ' +
              'forecolor backcolor emoticons | help',
            menu: {
              favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
            },
            menubar: 'favs file edit view insert format tools table help',
            /*content_css: 'css/content.css'*/
        });

        $("#edit_upload_image").click((e)=>{
            e.stopPropagation();
            e.preventDefault();
            $("#edit_error_confirm").remove();
            console.log('edit image');
            let file_data = $('#edit_chapter_image_modal').prop('files')[0];
            let form_data = new FormData();
            if($('#edit_chapter_image_modal').prop('files')){ // if an image has been selected we send it to the api/api/chapter/image with ajax call
                form_data.append('file', file_data);
                let urlImg = 'http://'+window.location.hostname+'/Public/uploads/'+file_data['name'];
                console.log(file_data['name']);
                $.ajax({
                    url: '/api/chapter/image',
                    type: 'POST',
                    //AJAX responses
                    success: function(){
                        $(".sendImageSpan").remove();
                        $("#edit_chapterForm>.form-group:first").append( $(`
                            <span class="sendImageSpan" style="color:forestgreen"><em>L'image a bien été envoyée</em></span>
                        `));
                        $("#edit_urlImgInput_modal").val(urlImg);
                        localStorage.setItem('edit_urlImg', $("#edit_urlImgInput_modal").val()); //Store the url in a hidden input
                        console.log('image envoyée');
                    },
                    error: function(){
                        $(".sendImageSpan").remove();
                        $("#edit_chapterForm>.form-group:first").append( $(`
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
                return $("#edit_chapterForm>.form-group:first").append( $(`
                    <span class="sendImageSpan" style="color:red"><em>Merci de choisir une image</em></span>
                `));
            }
        });
        $(".editChapterSubmit").on("click", ()=>{ //open modal to confirm chapter creation
            let modify_date = newFormatedDate();
            let chapterImage = $("#edit_urlImgInput_modal").val();
            let chapterTitle = $("#edit_title_modal").val();
            let chapterContent = localStorage.getItem('newChapterContent');
            if(chapterImage && chapterImage != null){
                $("#edit_error_confirm").remove();
                $("#chapterModal").after($(`
                    <div id="chapterModal_modal">
                        <div id="confirmEditChapterContent">
                        <i id="connectModalClose" class="fas fa-times-circle" onclick="closeChapterModal_modal(event)"></i>
                            <h2>${chapterTitle}</h2>
                            <h4><em>édité le ${modify_date}</em></h4>
                            <div id="adminChapterDiv">
                                <img id="adminChapterImg" src="${chapterImage}">
                                <div id="adminChapterP">${chapterContent}</div>
                            </div>
                            <span class="submit" onclick="editAndSaveChapter(event)">Sauvegarder</span>
                        </div>
                    </div>
                `));
            }else{
                $("#edit_error_confirm").remove();
                $("#createChapterModalContent").append($(`
                    <div id="edit_error_confirm">
                        <p>Merci de choisir une image pour le chapitre et de l'envoyer en cliquant sur le bouton "Envoyer le fichier"</p>
                    </div>
                `));
            }
        });

    });
    $(".fa-trash-alt").on("click", (event)=>{ // delete chapter when click on the delete button
        event.preventDefault();
        event.stopPropagation();
        let chapterId = returnIdInTable(event);
        console.log(chapterId);
        $.ajax({ //AJAX call to post data FROM p4_comment create form
            type: "POST",
            url:'/api/chapter/delete',
            data:{
                id : chapterId
            },
            statusCode:{
                200: function(){
                    console.log('chapitre supprimé');
                    document.location.reload();

                },
                400: function() {
                    console.log('erreur suppression chapitre');
                },
            },
            dataType: "json"
        });
    });

    $(".fa-trash-restore").on("click", (event)=>{ // restore chapter when click on the restore button
        event.preventDefault();
        event.stopPropagation();
        let chapterId = returnIdInTable(event);
        console.log(chapterId);
        $.ajax({ //AJAX call to post data FROM p4_comment create form
            type: "POST",
            url:'/api/chapter/restore',
            data:{
                id : chapterId
            },
            statusCode:{
                200: function(){
                    console.log('chapitre restauré');
                    document.location.reload();

                },
                400: function() {
                    console.log('erreur restauration chapitre');
                },
            },
            dataType: "json"
        });
    });

    $(".fa-newspaper").on("click", (event)=>{ // edit chapter when click on the edit button
        event.preventDefault();
        event.stopPropagation();
        let chapterId = returnIdInTable(event);
        console.log(chapterId);
        $.ajax({ //AJAX call to post data FROM p4_comment create form
            type: "POST",
            url:'/api/chapter/publish',
            data:{
                id : chapterId
            },
            statusCode:{
                200: function(){
                    console.log('chapitre publié');
                    document.location.reload();

                },
                400: function() {
                    console.log('erreur publication chapitre');
                },
            },
            dataType: "json"
        });
    });

    //focus on the 1st table line
    $(".chapterLine[data-id='1']").css('background-color', 'style.backgroundColor = "#3e3e3e"');
    $(".chapterPreviewSelect:first").addClass('focus');
    $(".chapterPreviewContainer").hide();
    $(".chapterPreviewContainer[data-id='1']").show();

    //focus on "aperçu" button and show the chapter associated
    $(".chapterPreviewSelect").click((event)=>{
        event.stopPropagation();
        event.preventDefault();
        $(".chapterPreviewSelect").removeClass('focus');
        event.target.classList.add('focus');
        let line = event.target.parentNode.parentNode;
        $(".chapterLine").removeClass('chapterLineFocus');

        line.classList.toggle("chapterLineFocus");

        autoColorChapterLine();
        if(line.classList.contains("chapterLineGrey")){
            line.classList.toggle("chapterLineGrey");
        }
        let chapterId = line.getAttribute("data-id");
        $(".chapterPreviewContainer").hide();
        let previewContainers = document.getElementsByClassName("chapterPreviewContainer");
        for(let i = 0; i < previewContainers.length; i++){
            if(previewContainers[i].getAttribute("data-id") == chapterId){
                previewContainers[i].style.display = 'flex';
            }
        };
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

function autoColorChapterLine(){
    let chapterLines = $(".chapterLine");
    chapterLines.each((item)=>{
        if(item%2 == 1){
            chapterLines[item].classList.add("chapterLineGrey");
        }
    });
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
    tinymce.remove('#chapterModal .tinymce');
    $("#chapterModal").remove();
    console.log("closeModal");
}

function closeChapterModal_modal(event){
    event.stopPropagation();
    event.preventDefault();
    $("#chapterModal_modal").remove();
}

function closeChapterImageModal(event){
    event.stopPropagation();
    event.preventDefault();
    $("#chapterImageModal").remove();
}

function editAndSaveChapter(event){
    event.preventDefault();
    event.stopPropagation();
    let chapterTitle = localStorage.getItem('newChapterTitle');
    let chapterContent = localStorage.getItem('newChapterContent');
    let chapterImage = localStorage.getItem('edit_urlImg');
    let id = $(".editChapterPreviewContainer").attr("data-id");
    $.ajax({ //AJAX call to post data FROM p4_comment create form
        type: "POST",
        url:'/api/chapter/modify',
        data:{
            id : id,
            title : chapterTitle,  // Nous récupérons la valeur de nos inputs
            content : chapterContent,
            chapter_image : chapterImage,
            published : '0'
        },
        statusCode:{
            200: function(){
                console.log('chapitre sauvegardé');
                // document.location.reload();

            },
            400: function() {
                console.log('erreur sauvegarde chapitre');
            },
        },
        dataType: "json"
    });
}

function saveChapter(event){
    event.preventDefault();
    event.stopPropagation();
    let chapterTitle = localStorage.getItem('newChapterTitle');
    let chapterContent = localStorage.getItem('newChapterContent');
    let chapterImage = localStorage.getItem('urlImg');
    $.ajax({ //AJAX call to post data FROM p4_comment create form
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

function returnIdInTable(event){
    let target = event.target;
    let line = target.parentElement.parentElement.parentElement.parentElement;
    let data_id = line.getAttribute("data-id");
    console.log(data_id);
    return data_id;
}

function unreportComment(commentId){
    $.ajax({ //AJAX call to post data FROM p4_comment create form
        type: "POST",
        url:'/api/comment/unreport',
        data:{
            id : commentId
        },
        statusCode:{
            200: function(){
                window.location.reload();
            },
            400: function() {
            },
        },
        dataType: "json"
    });
}

function deleteComment(commentId){
    $.ajax({ //AJAX call to post data FROM p4_comment create form
        type: "POST",
        url:'/api/comment/delete',
        data:{
            id : commentId
        },
        statusCode:{
            200: function(){
                document.location.reload();
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
