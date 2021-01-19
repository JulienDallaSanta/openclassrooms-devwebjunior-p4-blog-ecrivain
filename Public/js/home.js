function closeConnectModal(event){
    event.preventDefault();
    event.stopPropagation();
    $("#connectModal").remove();
}

$(document).ready(function(){
    $("#contactDiv>p").remove();
    if((localStorage.getItem("name")) || (localStorage.getItem("firstName")) || (localStorage.getItem("email")) || (localStorage.getItem("object")) || (localStorage.getItem("message"))){
        $("#name").val(localStorage.getItem("name")) ;
        $("#firstName").val(localStorage.getItem("firstName")) ;
        $("#email").val(localStorage.getItem("email")) ;
        $("#object").val(localStorage.getItem("object")) ;
        $("#message").val(localStorage.getItem("message")) ;
    }

    $(".formSubmit").on('click', function(event){
        console.log(event);
        event.preventDefault();
        event.stopPropagation();
        let name = $("#name").val();
        let firstName = $("#firstName").val();
        let email = $("#email").val();
        let object = $("#object").val();
        let message = $("#message").val();
        localStorage.setItem('name', name);
        localStorage.setItem('firstName', firstName);
        localStorage.setItem('email', email);
        localStorage.setItem('object', object);
        localStorage.setItem('message', message);

        // AJAX call for contactForm
        $.ajax({
            type: "POST",
            url:'/api/user/message',
            data:{
                name : $("#name").val(),
                firstName : $("#firstName").val(),
                email : $("#email").val(),
                object : $("#object").val(),
                message : $("#message").val()
            },
            statusCode:{
                200: function(){
                },
                400: function() {
                    $("#contactDiv>h2").after(`
                    <p style='color:red'>Merci de renseigner l'identifiant ET le mot de passe</p>
                    `);
                },
                401: function() {
                    $("#contactDiv>h2").after(`
                    <p style='color:red'>Vos identifiant et mot de passe sont incorrects</p>
                    `);
                }
            },
            dataType: "json"
        });

        $(".page").prepend($(`
            <div id="connectModal">
                <div id="connectModalContent">
                    <i id="connectModalClose" class="fas fa-times-circle" onclick="closeConnectModal(event)"></i>
                    <h3>${localStorage.getItem('firstName')} ${localStorage.getItem('name')}, votre message a bien été envoyé.</h3>
                    <div id="connectModalData">
                        <p><strong><em>De</em> : </strong>${localStorage.getItem('email')}</p>
                        <p class="formSeparator"></p>
                        <p><strong><em>Objet</em> : </strong>${localStorage.getItem('object')}</p>
                        <p class="formSeparator"></p>
                        <p><strong><em>Message</em> : </strong><br/>${localStorage.getItem('message')}</p>
                    </div>
                </div>
            </div>
        `));
    });
});
