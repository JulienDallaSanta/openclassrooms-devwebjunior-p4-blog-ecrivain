$(document).ready(function(){
    function lastChaptersNext(){
        $("#lastChaptersNext").css('background-color', 'black');
        $("#lastChaptersPrev").css('background-color', '');
        let chapitres = $(".chaptersSliderDiv");
        chapitres.hide();
        $(chapitres[chapitres.length-1]).show();
        $(chapitres[chapitres.length-2]).show();
        $(chapitres[chapitres.length-3]).show();
        $(chapitres[chapitres.length-4]).show();
    }
    function lastChaptersPrev(){
        $("#lastChaptersPrev").css('background-color', 'black');
        $("#lastChaptersNext").css('background-color', '');
        let chapitres = $(".chaptersSliderDiv");
        chapitres.hide();
        $(chapitres[0]).show();
        $(chapitres[1]).show();
        $(chapitres[2]).show();
        $(chapitres[3]).show();
    }

    function livresSliderNext(){
        $("#livresSliderNext").css('background-color', 'black');
        $("#livresSliderPrev").css('background-color', '');
        $("#book1").hide();
        $("#book2").hide();
        $("#book3").hide();
        $("#book4").hide();
        $("#book5").show();
        $("#book6").show();
        $("#book7").show();
    }
    function livresSliderPrev(){
        $("#livresSliderPrev").css('background-color', 'black');
        $("#livresSliderNext").css('background-color', '');
        $("#book1").show();
        $("#book2").show();
        $("#book3").show();
        $("#book4").show();
        $("#book5").hide();
        $("#book6").hide();
        $("#book7").hide();
    }
    lastChaptersPrev();
    livresSliderPrev();
    $("#lastChaptersPrev").on('click', lastChaptersPrev);
    $("#lastChaptersNext").on('click', lastChaptersNext);
    $("#sliderButNext").on('click', livresSliderNext);
    $("#livresSliderNext").on('click', livresSliderNext);
    $("#sliderButPrev").on('click', livresSliderPrev);
    $("#livresSliderPrev").on('click', livresSliderPrev);
});
