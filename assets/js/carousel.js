document.addEventListener('DOMContentLoaded', () => {

    const track = document.querySelector('.avis-track');
    const nextBtn = document.querySelector('.next');
    const prevBtn = document.querySelector('.prev');
    const avis = document.querySelectorAll('.avis');

    if (!track || !nextBtn || !prevBtn) return;

    let index = 0;
    const avisVisible = 2;
    const largeurAvis = 325;

    nextBtn.addEventListener('click', () => {
        if (index < avis.length - avisVisible) {
            index++;
            track.style.transform = `translateX(-${index * largeurAvis}px)`;
        }
    });

    prevBtn.addEventListener('click', () => {
        if (index > 0) {
            index--;
            track.style.transform = `translateX(-${index * largeurAvis}px)`;
        }
    });

});
