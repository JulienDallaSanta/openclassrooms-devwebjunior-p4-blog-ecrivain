var MobileSlider = {
    // Define current slide
    currentIndex: 0,

    init: function () {
        mobileSliderElt = $("#mobile_slider");
        mobileSliderElt.on("touchstart", (e) => { this.handleStart(e); });
        window.addEventListener("touchmove", (e) => { this.handleMove(e); }, { passive: false });
        window.addEventListener("touchend", (e) => { this.handleEnd(e); });
        window.addEventListener("touchcancel", (e) => { this.handleEnd(e); });
    },

    // Display the current Mobileslide
    mobActiveSlide: function () {
        var mobileSlides = $('.mobile_slider_img');
        var mobileSlide = mobileSlides.eq(this.currentIndex);
        var mobileIndexes = $(".mobile_sliderIndex");
        var mobileIndex = mobileIndexes.eq(this.currentIndex);
        mobileIndexes.removeClass("focus");
        mobileIndex.addClass("focus");
        mobileSlides.hide();
        mobileSlide.show();
    },

    // Define the next mobileSlide as the current mobileSlide
    mobIndexPlus: function () {
        var mobileSlides = $('.mobile_slider_img');
        var mobSlidesNumber = mobileSlides.length;
        this.currentIndex ++;
        if (this.currentIndex > mobSlidesNumber - 1) {
            this.currentIndex = 0;
        }
    },

    // Define the previous mobileSlide as the the current mobileSlide
    mobIndexMinus: function () {
        var mobileSlides = $('.mobile_slider_img');
        var mobSlidesNumber = mobileSlides.length;
        this.currentIndex --;

        if (this.currentIndex < 0) {
            this.currentIndex = mobSlidesNumber - 1;
        }
    },

    //Démarre le déplacement au toucher
    handleStart: function (e) {
        this.painting = true;
        if(e.touches){
            // Coordonnées de la souris :
            this.origin = { x: e.touches[0].pageX, y: e.touches[0].pageY };
            return this.origin;
        }
    },

    handleMove: function (e) {
        // Mouvement de la souris sur le canvas :
        // Si je suis en train de dessiner (click souris enfoncé) :
        if (!this.painting) return;
        // Set Coordonnées de la souris :
        var touches = e.changedTouches;
        var move = { x: e.touches[touches.length-1].pageX, y: e.touches[touches.length-1].pageY };
        if(Math.abs(move.y - this.origin.y) > Math.abs(move.x - this.origin.x)){
            this.painting = false;
            return;
        } else {
            e.preventDefault();
            if(Math.abs((this.origin.x - move.x) / window.innerWidth) > 0.15){
                if((this.origin.x - move.x) > 0){
                    this.mobIndexPlus();
                }

                else {
                    this.mobIndexMinus();
                }
                this.mobActiveSlide();
                this.painting = false
            }

        }
    },

    handleEnd: function () {
        // Relachement du toucher sur tout le document :
        this.painting = false;
        this.started = false;
    }

}
$(document).ready(function(){
    //init slider for mobiles
    let largeur = window.innerWidth;
    if (largeur<= 768){
        $(".sliderBut").hide();
        $("#livresSlider").hide();
        $(".sliderIndex").hide();
        $("#mobile_slider").show();
        $("#mobile_slider").on('dragstart', e => e.preventDefault());
        var mobileSlides = $('.mobile_slider_img');
        var mobileSlide = mobileSlides.eq(0);
        for(let i=0; i<mobileSlides.length; i++){
            $("#mobile_sliderIndex_container").append($(`
            <div id="mobile_sliderIndex${i}" class="mobile_sliderIndex"></div>
            `));
            console.log(window.getComputedStyle(mobileSlides[i]).display);
            if(window.getComputedStyle(mobileSlides[i]).display == 'inline'){
                $(".mobile_sliderIndex").removeClass("focus");
                $(".mobile_sliderIndex:eq(i)").addClass("focus");
            }
        }
        mobileSlides.hide();
        mobileSlide.show();
        MobileSlider.init();
    } else{
        $("#mobile_slider").hide();
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
        livresSliderPrev();
        $("#sliderButNext").on('click', livresSliderNext);
        $("#livresSliderNext").on('click', livresSliderNext);
        $("#sliderButPrev").on('click', livresSliderPrev);
        $("#livresSliderPrev").on('click', livresSliderPrev);
    }

});
