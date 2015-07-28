var counter = 20000; // 20 sekunder

$.fn.nextSlide = function() { // Funksjon for å gå til neste bok
    this.fadeOut(1000).next().fadeIn(1000).end().appendTo('body');
    $("html, body").animate({ scrollTop: 0 }, "slow"); // Scroll til toppen når vi går til neste bok
};
function setResetInterval(bool) {
    if(bool) {
        timer = setInterval(function() {$('body > article:first').nextSlide();}, counter);
    } else {
        clearInterval(timer);
    }
};

$(window).scroll(function() { // Lengre tid på seg til å lese hvis brukeren har scrollet ned til krydderbeskrivelsen
    var windowtop = $(window).scrollTop() + ($(window).height() / 3);
    var reviewtop = $( " .review" ).offset().top;
    if ( reviewtop  <= windowtop  ) {
        setResetInterval(false);
        counter = 40000; // 40 sekunder
        setResetInterval(true);
    } else {
        setResetInterval(false);
        counter = 20000; // 20 sekunder
        setResetInterval(true);
    }
});

$(document).ready(function(){ // Når siden er ferdig lastet
    $("body > article").hide(); // Gjem alle bøkene
    $("body > article:first").fadeIn(1000); // Fade inn den første boka
    $(function() {setResetInterval(true);}); // Start "karusellen"
});
$(document).on("swipeleft",function() { // Gå til neste slide når det swipes mot venstre
    $('body > article:first').nextSlide();
});
