document.addEventListener('DOMContentLoaded', ()=> {
    // contenedor principal
    let contenedorPrincipal = document.querySelector('#directorio_content'); 

    // Comprobar que la información está guardada en localstorge 
    if(localStorage.getItem('StatusCorreo', true) ) {

       let contenedorFormulario = document.querySelector('#formulario_content');  
       contenedorFormulario.classList.add('d-none'); 
    }

    // inicio dots formulario 
    let contenedorDots = document.querySelector('.loading-content'); 
    contenedorDots.style.opacity = 0; 

    // función agregar spinner cargando
    function spinnerCargando() {
        let contenedorDots = document.querySelector('.loading-content'); 
        // quitamos el opacity para que se vean los dots de cargando
        contenedorDots.style.opacity = 1; 


        // Condicional para ver el opacity
        if(!contenedorDots.style.opacity == 1) {
            contenedorDots.style.opacity = 1; 
            
            return; 
        }


        // Quitar los dots con opacity = 1  
        setTimeout(()=> {
            contenedorDots.style.opacity = 0; 
        }, 5000); 

    }

    // Función quitar formulario
    function quitarFormulario(mensajeStatus) {
        // quitar formulario de suscripción
        const formulario = document.querySelector('.content-formulario'); 
        formulario.style.opacity = 0; 

        // Agregar mensaje de agradecimiento
        const mensaje = document.querySelector('#mensaje-directorio-verde'); 
        mensaje.innerHTML = `<h5 class="text-center text-primary my-3">${mensajeStatus}</h5>`
        mensaje.style.opacity = 1; 

        setTimeout(()=> {
            mensaje.style.opacity = 0; 
        }, 6000);

        // Quitar elemento del formulario
        let contenedorFormulario = document.querySelector('#formulario_content');  

        setTimeout(()=> {
            contenedorFormulario.classList.add('d-none'); 
        }, 8000)

        guardarLocalStorage(); 

    }

    // guardar información en local Storage
    function guardarLocalStorage() {
        // comprobar que el formaulario ya está enviado
        // guardar información en localStorgae
        let statusLocalStorage = localStorage.setItem('StatusCorreo', true); 
    }
    
    document.querySelector('#content-formulario').addEventListener("submit", async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append("action", "formulario_directorio_verde");

        try {
            const response = await fetch(ajax_object.ajax_url, { method: "POST", body: formData });
            const data = await response.json();

            if (data.success) {
                spinnerCargando() 
                quitarFormulario(data.data.message);

            } else {
                const msgError = data.data?.message || 'Hubo un error al enviar el formulario.';
                spinnerCargando() 
                quitarFormulario(data.data.message);
                console.error('Error real de PHP/PHPMailer:', msgError);
            }
        } catch (error) {
            console.error('Error en el envío del formulario:', error);
            spinnerCargando() 
            quitarFormulario('Hubo un error al enviar el formulario. Revisa la consola.');
        }
    });

})