document.addEventListener('DOMContentLoaded', function() {
    // Menu Responsive

    // observer menu
    const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
        entry.target.classList.add('visible');

        } else {
            entry.target.classList.remove('visible'); 
        }
            
    });
    }, {
        root: null, // viewport
        rootMargin: '0px 0px -150px 0px', // activa 150px ANTES de entrar al viewport
        threshold: 0.1 // porcentaje visible mínimo para activarse
    });

    // scroll right 
    const rightSections = document.querySelectorAll('.scroll-right');

    function animateRightOnScroll() {
    const windowHeight = window.innerHeight;

    rightSections.forEach(el => {
        const rect = el.getBoundingClientRect();
        const distanceFromTop = rect.top;

        // Define el rango de entrada
        const start = windowHeight * 0.9;
        const end = windowHeight * 0.3;

        if (distanceFromTop < start && distanceFromTop > end) {
        const progress = 1 - (distanceFromTop - end) / (start - end); // de 0 a 1
        el.style.opacity = progress;
        el.style.transform = `translateX(${(1 - progress) * 100}px)`;
        } else if (distanceFromTop <= end) {
        el.style.opacity = 1;
        el.style.transform = 'translateX(0)';
        } else {
        el.style.opacity = 0;
        el.style.transform = 'translateX(100px)';
        }
    });
    }

    window.addEventListener('scroll', animateRightOnScroll);
    window.addEventListener('load', animateRightOnScroll);    

    // scroll left
    const leftSections = document.querySelectorAll('.scroll-left');

    function animateLeftOnScroll() {
    const windowHeight = window.innerHeight;

    leftSections.forEach(el => {
        const rect = el.getBoundingClientRect();
        const distanceFromTop = rect.top;

        const start = windowHeight * 0.9;
        const end = windowHeight * 0.3;

        if (distanceFromTop < start && distanceFromTop > end) {
        const progress = 1 - (distanceFromTop - end) / (start - end); // de 0 a 1
        el.style.opacity = progress;
        el.style.transform = `translateX(${(1 - progress) * -100}px)`; // negativo = izquierda
        } else if (distanceFromTop <= end) {
        el.style.opacity = 1;
        el.style.transform = 'translateX(0)';
        } else {
        el.style.opacity = 0;
        el.style.transform = 'translateX(-100px)';
        }
    });
    }

    window.addEventListener('scroll', animateLeftOnScroll);
    window.addEventListener('load', animateLeftOnScroll);



    /** videos YT */
    // const track = document.querySelector('.carrusel-track');
    // const slides = Array.from(document.querySelectorAll('.carrusel-slide')); 
    // const nextBtn = document.querySelector('.carrusel-btn.next');
    // const prevBtn = document.querySelector('.carrusel-btn.prev');

    // let currentSlide = 0;

    // function updateSlide(position) {
    //     const slideWidth = slides[0].getBoundingClientRect().width;
    //     track.style.transform = `translateX(-${slideWidth * position}px)`;
    // }

    // if(slides && slides.length <= 1 ) {
    //     nextBtn.classList.add('d-none');
    //     prevBtn.classList.add('d-none');
    // }

    // nextBtn.addEventListener('click', () => {
    //     currentSlide = (currentSlide + 1) % slides.length;
    //     updateSlide(currentSlide);
    // });

    // prevBtn.addEventListener('click', () => {
    //     currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    //     updateSlide(currentSlide);
    // });

    // window.addEventListener('resize', () => {
    //     updateSlide(currentSlide);
    // });


    /* 
    * sección arboristas 
    */

    const cards = document.querySelectorAll('.asesor-card');
    const container = document.querySelector('.asesores-container');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const isActive = card.classList.contains('active');

            // Cierra todos
            cards.forEach(c => c.classList.remove('active'));
            container.classList.remove('expand-mode');

            // Si no estaba activo, activarlo
            if (!isActive) {
            card.classList.add('active');
            container.classList.add('expand-mode');
            }
        });
    });




    




})