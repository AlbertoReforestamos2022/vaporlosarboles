document.addEventListener('DOMContentLoaded', function() {

    function medirContenedor() {
    // wpadminbar
    
    const menu = document.querySelector('#navegacion'); 
    const alto = menu.offsetHeight;

    const marginafterMenu = document.querySelector('.first-content-after-menu');
    marginafterMenu.style.marginTop = `${alto}px`; 

    }

    // llamamos a la función
    medirContenedor();

    window.addEventListener('resize', medirContenedor); 


    // animation scroll menu
    let lastScrollTop = 0;
    const menu = document.querySelector('#navegacion');

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || this.document.documentElement.scrollTop;

        if(scrollTop > lastScrollTop) {
            // scroll hacia abajo
            menu.classList.add('shrink');
        } else {
            // scrolling hacia arriba
            menu.classList.remove('shrink');
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // evita valores negativos
    })
})

