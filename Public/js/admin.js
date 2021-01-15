// SEO stats animations
$(document).ready(()=>{
    /*stats sessions*/
    var sessionsIntervalId;
    statsIncrement($("#sessionsNumber"), 0, 259, sessionsIntervalId, 10);
    /*pages par session*/
    var pagesPerSessionsIntervalId;
    statsIncrement($("#pagesPerSessionsNumber"), 0, 6, pagesPerSessionsIntervalId, 500);
    /*pages par session*/
    var bounceRateIntervalId;
    statsIncrement($("#bounceRateNumber"), 0, 17, bounceRateIntervalId, 100);
    saveChapter();
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

// Chapters management
function saveChapter(){
    $("#chapterSubmit").on('click', function(){
        tinyMCE.triggerSave();//Calls the save method on all editor instances in the collection.
        let title = $("#chapterContent_ifr");
        $(".page").prepend($(`
            <div id="chapterModal">
                <div id="chapterModalContent">
                    <i id="chapterModalClose" class="fas fa-times-circle" onclick="closeChapterModal(event)"></i>
                    <h3>confirmer la publication du chapitre</h3>
                    <h5>Titre : ${localStorage.getItem('title')}</h5>
                    <p>Texte : ${localStorage.getItem('content')}</p>
                    <img>email : ${localStorage.getItem('chapter_image')}</img>
                    <span>objet : ${localStorage.getItem('object')}</span>
                    <p>message : ${localStorage.getItem('message')}</p>
                </div>
            </div>
        `));
        let chapter = $(".tinymce").val();
        localStorage.setItem('chapter', chapter);
        saveToLocalStorage(chapter);
    });
}
