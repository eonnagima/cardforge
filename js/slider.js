const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
const dots = document.querySelectorAll('.dot');
const slideshowContainer = document.querySelector('.slideshow-container');
const dotsContainer = document.querySelector('.dots-container');

let currentIndex = 0;

function updateDots(){
    dots.forEach((dot, index) => {
        if(index === currentIndex){
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

function showSlides(index) {
    if (index >= slides.length) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = slides.length - 1; 
    } else {
        currentIndex = index;
    }
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    updateDots();
}

function nextSlide(){
    showSlides(currentIndex + 1);
}

function prevSlide(){
    showSlides(currentIndex - 1);
}

//Bubbling for dots
dotsContainer.addEventListener('click', (e) => {
    if(e.target.classList.contains('dot')){
        showSlides(parseInt(e.target.dataset.index));
        console.log(parseInt(e.target.dataset.index));
    }
});

//eventlistener on prev and next buttons with prevent default
prev.addEventListener('click', (e) => {
    e.preventDefault();
    console.log('prev clicked');
    prevSlide();
});

next.addEventListener('click', (e) => {
    e.preventDefault();
    console.log('next clicked');
    nextSlide();
});

updateDots();