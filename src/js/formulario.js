document.querySelector(".formulario_reconoce").addEventListener("submit", async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("action", "formulario_reconoce");

    function Msj_status(idContent, classStatus, mensajeStatus) {
        const msj_status = document.querySelector(idContent);
        msj_status.classList.add(classStatus);
        msj_status.innerHTML = `<h5>${mensajeStatus}</h5>`;
        msj_status.style.opacity = 1;

        setTimeout(() => {
            msj_status.style.opacity = 0;
            setTimeout(() => location.reload(), 1000);
        }, 5000);
    }

    try {
        const response = await fetch(ajax_object.ajax_url, { method: "POST", body: formData });
        const data = await response.json();

        if (data.success) {
            Msj_status('#mensaje-formulario', 'bg-primary', data.data.message);
        } else {
            const msgError = data.data?.message || 'Hubo un error al enviar el formulario.';
            Msj_status('#mensaje-formulario', 'bg-danger', msgError);
            console.error('Error real de PHP/PHPMailer:', msgError);
        }
    } catch (error) {
        console.error('Error en el envío del formulario:', error);
        Msj_status('#mensaje-formulario', 'bg-danger', 'Hubo un error al enviar el formulario. Revisa la consola.');
    }
});
