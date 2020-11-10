$(document).ready(function(){
    //-----------rgpd for mobiles & gestion bouton backtotop---------
    $("#mobiletopbtn").hide();
    var largeur = $(window).width();
    if(largeur <= 768){
        $("#rgpd").addClass('forMobileDevices');
        $(window).scroll(function(){
            if(window.scrollY>=300){
                $("#mobiletopbtn").show();
            }else{
                $("#mobiletopbtn").hide();
            }
        });
    }else{
        $("#mobiletopbtn").hide();
        $("#rgpd").removeClass('forMobileDevices');
    }
    //-----------boutons du RGPD---------
    $("#cookiesOk").on('click', ()=>{
        $("#rgpd").hide();
    });


    // menu_toggle
    var $page = $('.page');

    $('.menu_toggle').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();
    $page.toggleClass('shazam');
    });
    $('.content').on('click', function(){
    $page.removeClass('shazam');
    });
    $(".menu_items>li:first").on('click', function(){
        console.log('ok');
        $(".icon").removeClass('activeIcon');
        $(".fa-home").addClass('activeIcon');
        $(".menu_items>li>a>span").removeClass('activeASpan');
        $(".menu_items>li:first>a>span").addClass('activeASpan');
    });
    $(".menu_items>li:eq(1)").on('click', function(){
        console.log('okbis');
        $(".icon").removeClass('activeIcon');
        $(".fa-portrait").addClass('activeIcon');
        $(".menu_items>li>a>span").removeClass('activeASpan');
        $(".menu_items>li:eq(1)>a>span").addClass('activeASpan');
    });
    $(".menu_items>li:last").on('click', function(){
        console.log('ok3');
        $(".icon").removeClass('activeIcon');
        $(".fa-blog").addClass('activeIcon');
        $(".menu_items>li>a>span").removeClass('activeASpan');
        $(".menu_items>li:last>a>span").addClass('activeASpan');
    });
    $(window).scroll(function(){
        if(window.scrollY>=300){
            $("#darkModeDiv>span").hide();
            $(".menu_toggle").addClass('discretMenu');
            $("#header").addClass('discretHeader');
            $("#darkModeDiv").addClass('discretMode');
            $("#connexionButton").addClass('discretButton');
        }else if(window.scrollY<300){
            $("#darkModeDiv>span").show();
            $(".menu_toggle").removeClass('discretMenu');
            $("#header").removeClass('discretHeader');
            $("#darkModeDiv").removeClass('discretMode');
            $("#connexionButton").removeClass('discretButton');
        }
    });

    // arrowDown animation
    $('a.scroll-link').click(function(e){
        e.preventDefault();
        $('body,html').animate({
            scrollTop: $(this).attr('href').offset().top -20
        }, 750);
    });
});
