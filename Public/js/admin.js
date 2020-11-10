let pseudoAdmin = 'admin';
let passwordAdmin = 'admin';
let pseudo = $("#identifiant").val();
let password = $("#password").val();


//---connexion à l'admin---
function connection(event){
    event.preventDefault();
    event.stopPropagation();

    $("#identifiant").attr('value', localStorage.getItem(pseudo));
    if((pseudo=pseudoAdmin) && (password=passwordAdmin)){
        localStorage.setItem('pseudo', pseudo);
        localStorage.setItem('password', password);
        console.log('ok');
        $("#connectModal").remove();
        $(window).load("file://wsl%24/Debian/var/www/p4.localhost/Views/admin.html#");
        $("#connexionButton").prepend($(`
            <a id="disconnectLink" href="home.html" data-title="Se déconnecter">Se déconnecter</a>
        `));
        $("#connexionLink").hide();
        $("#connectModal").remove();
    }else{
        alert("Accès refusé à l'administration du site");
    }
}
function closeConnectModal(event){
    event.preventDefault();
    event.stopPropagation();
    $("#connectModal").remove();
}

//---boite modale de connexion à l'admin---
$("#connexionLink").on('click', ()=>{
    $(".page").prepend($(`
        <div id="connectModal">
            <div id="connectModalContent">
                <i id="connectModalClose" class="fas fa-times-circle" onclick="closeConnectModal(event)"></i>
                <h3>Connexion :</h3>
                <div id="connectId" class="connectFormDiv">
                    <label for="identifiant">Votre identifiant :</label>
                    <input type="text" name="identifiant" id="identifiant" class="storage" value required>
                </div>
                <div id="connectPassword" class="connectFormDiv">
                    <label for="password">Votre mot de passe :</label>
                    <input type="password" name="password" id="password" class="storage" value required>
                </div>
                <a id="connectFormSubmit" class="formSubmit" onclick="connection(event)"><span>OK</span></a>
            </div>
        </div>
    `));
});
//---déconnexion de l'admin---
$("#disconnectLink").on('click', ()=>{
    $("#connexionLink").show();
    $("#disconnectLink").remove();
    $(window).load("home.html");
});

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

function saveChapter(){
    $("#chapterSubmit").on('click', function(){
        let chapter = $(".tinymce").val();
        localStorage.setItem('chapter', chapter);
        saveToLocalStorage(chapter);
    });
}

class Chapters{
    constructor(parent){
        this.parent = parent;
        this.buildChapter();
    }
    buildChapter(){

    }
}
