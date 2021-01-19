// SEO stats animations
$(document).ready(()=>{
    $("#chapterEdit").hide();
    /*Menu Admin*/
    $(".AdminSection").hide();
    $("#seoStats").show();
    $("#statSite").show();
    $("#statSite").on("click", ()=>{
        $(".AdminSection").hide();
        $("#seoStats").show();
    });
    $("#chapterAdmin").on("click", ()=>{
        $(".AdminSection").hide();
        $("#chaptersManagement").show();
    });
    $("#commentsAdmin").on("click", ()=>{
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
    $(".selectChapter:first").prop("checked", true);
    $("#addChapterCallToAction").on("click", ()=>{
        $("#chapterEdit").slideToggle();
    });
    $(".fa-edit").on("click", ()=>{ // modify chapter when click on the modify button

    });
    $(".fa-trash-alt").on("click", ()=>{ // delete chapter when click on the delete button

    });
    $(".fa-trash-restore").on("click", ()=>{ // restore chapter when click on the restore button

    });
    $(".fa-newspaper").on("click", ()=>{ // edit chapter when click on the edit button

    });
    $("#createChapterSubmit").on("click", ()=>{ //open modal to confirm chapter creation
        console.log($(".mce-content-body>p").html());
        tinyMCE.triggerSave();//Calls the save method on all editor instances in the collection.
        let title = $("#title").val();
        $(".page").prepend($(`
            <div id="chapterModal">
                <div id="chapterModalContent">
                    <h3>Enregistrer le chapitre sans le publier ?</h3>
                    <h5>Titre : ${title}</h5>
                    <p>Texte : ${localStorage.getItem('content')}</p>
                    <img>Image : ${localStorage.getItem('chapter_image')}</img>
                    <div class="confirmButtons">
                        <i id="saveChapterOk" class="fas fa-check-circle" onclick="saveChapter(event)"></i>
                        <i class="fas fa-times-circle saveChapterNo" onclick="closeChapterModal(event)"></i>
                    </div>
                </div>
            </div>
        `));
    }) ;
    $("#saveChapter").on('click', function(){
        tinyMCE.triggerSave();//Calls the save method on all editor instances in the collection.
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

function closeChapterModal(event){
    event.stopPropagation();
    event.preventDefault();
    $("#chapterModal").remove();
}
