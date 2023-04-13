let counter = shortCounter;

function nextSlide() {
    let slides = document.querySelectorAll('.item');
    let activeSlide = "";
    let nextSlide = "";
    for (let i = 0; i < slides.length; i++){
        if (slides[i].matches('.active')){
            activeSlide = slides[i];
            if (i == slides.length - 1){
                nextSlide = slides[0];
            } else {
                nextSlide = slides[i + 1];
            }
            break;
        }
    }
    activeSlide.classList.remove('active');
    nextSlide.classList.add('active');
    window.scrollTo({
        top: 0,
        behavior: "smooth"
      });      
}

function setResetInterval(bool) {
    if(bool) {
        timer = setInterval(function() {
            nextSlide();
        }, counter);
    } else {
        clearInterval(timer);
    }
};

window.addEventListener('scroll', () => { // Lengre tid på seg til å lese hvis brukeren har scrollet ned til krydderbeskrivelsen
    let windowtop = window.pageYOffset + (window.innerHeight / 3);
    let reviewtop = document.querySelector(".review").getBoundingClientRect().top + window.pageYOffset;

    if ( reviewtop  <= windowtop  ) {
        setResetInterval(false);
        counter = longCounter;
        setResetInterval(true);
    } else {
        setResetInterval(false);
        counter = shortCounter;
        setResetInterval(true);
    }
});

document.querySelector(".item:first-of-type").classList.add('active'); // Fade inn den første boka
setResetInterval(true); // Start "karusellen"

document.addEventListener('swipeleft', () => { // Gå til neste slide når det swipes mot venstre
    nextSlide();
});
