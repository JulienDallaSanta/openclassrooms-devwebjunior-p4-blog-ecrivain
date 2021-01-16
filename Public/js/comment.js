$(document).ready(function(){
    //---boite modale de connexion à l'admin---
    $("#commentReport").on('click', ()=>{
        // Check report confirmation
        $(".page").prepend($(`
            <div id="checkCommentModal">
                <p>Confirmer le signalement du commentaire :</br>
                    <span>
                        <i id="commentFormPublish" class="fas fa-check-circle" onclick="reportComment(event)"></i>
                        <i id="commentFormAbort" class="fas fa-times-circle" onclick="abortReportComment(event)"></i>
                    </span>
                </p>
            </div>
        `));
        $.ajax({ //AJAX call to post data from comment create form
            type: "POST",
            url:'/api/comment/report',
            data:{
                pseudo : $("#pseudo").val(),  // Nous récupérons la valeur de nos inputs
                comment : $("#comment").val(),
                chapterId : $("#chapterIdInput").html()

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
    });
});
