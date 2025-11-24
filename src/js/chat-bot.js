const chatbotToggle = document.getElementById('chatbot-toggle');
const chatbot = document.getElementById('chatbot');
const chatBody = document.getElementById('chat-body');
const chatRespuesta = document.getElementById('chat-respuesta');
const respuestaContenido = document.getElementById('respuesta-contenido');
const cerrarRespuesta = document.getElementById('cerrar-respuesta');
const tituloPregunta = document.getElementById('titulo-pregunta');

const cerrarChat = document.querySelector('#close-chat');

let datosPreguntas = [];

// Ocultar el chatbot al cargar
document.addEventListener('DOMContentLoaded', () => {
  chatRespuesta.classList.remove('show'); // Oculto con animación lista
  chatBody.classList.add('show'); // Mostramos por defecto el body
});

// animaciones Mostrar - Ocultar chatbot 
function animacionMostrarChat() {
  chatbot.classList.add('show');
}

function animacionOcultarChat() {
  chatbot.classList.remove('show');
}

// Mostrar ocultar chat
cerrarChat.addEventListener('click', ()=> {
    if (chatbot.classList.contains('show')) {
    // Ocultar chatbot
    animacionOcultarChat();
    chatRespuesta.classList.remove('show');
    chatBody.classList.remove('show');
  } else {
    // Mostrar chatbot
    animacionMostrarChat();

    if (respuestaContenido && respuestaContenido.innerHTML.trim().length > 0) {
      // Hay contenido → mostrar respuestas
      chatRespuesta.classList.add('show');
      chatBody.classList.remove('show');
    } else {
      // No hay contenido → mostrar preguntas
      chatRespuesta.classList.remove('show');
      chatBody.classList.add('show');
    }
  }
})

// Mostrar/ocultar chatbot
chatbotToggle.addEventListener('click', () => {
  if (chatbot.classList.contains('show')) {
    // Ocultar chatbot
    animacionOcultarChat();
    chatRespuesta.classList.remove('show');
    chatBody.classList.remove('show');
  } else {
    // Mostrar chatbot
    animacionMostrarChat();

    if (respuestaContenido && respuestaContenido.innerHTML.trim().length > 0) {
      // Hay contenido → mostrar respuestas
      chatRespuesta.classList.add('show');
      chatBody.classList.remove('show');
    } else {
      // No hay contenido → mostrar preguntas
      chatRespuesta.classList.remove('show');
      chatBody.classList.add('show');
    }
  }
});

// Cargar JSON
fetch(ajax_object.respuestas_chatbot)
  .then(response => response.json())
  .then(data => {
    datosPreguntas = data.preguntas;
    mostrarPreguntas();
  })
  .catch(error => {
    chatBody.innerHTML = '<p>Error cargando preguntas.</p>';
    console.error(error);
  });

// Mostrar preguntas frecuentes
function mostrarPreguntas() {
  chatBody.innerHTML += '';
  datosPreguntas.forEach((item, index) => {
    const btnRow = document.createElement('div');
    btnRow.classList.add('row', 'row-cols-1', 'my-2', 'justify-content-center');

    const btnCol = document.createElement('div');
    btnCol.classList.add('col');

    const btn = document.createElement('button');
    btn.classList.add('btn', 'btn-success', 'w-100');
    btn.style.cssText = 'background-color: #21891ecc!important; border-color: transparent!important; border-radius: 25px;';
    btn.textContent = item.pregunta;
    btn.addEventListener('click', () => mostrarRespuestas(index));

    btnCol.appendChild(btn);
    btnRow.appendChild(btnCol);
    chatBody.appendChild(btnRow);
  });
}

// Mostrar respuestas
function mostrarRespuestas(index) {
  const item = datosPreguntas[index];
  const respuestas = item.respuestas || item.respuesta || [];

  tituloPregunta.textContent = item.pregunta;
  respuestaContenido.innerHTML = '';

  if (respuestas.length === 0) {
    respuestaContenido.innerHTML = '<p>No hay respuestas disponibles.</p>';
  } else {
    respuestas.forEach(r => {
      const p = document.createElement('p');
      p.classList.add('p-1', 'black-50', 'fw-light');
      p.textContent = r;
      respuestaContenido.appendChild(p);
    });
  }

  chatBody.classList.remove('show');
  chatRespuesta.classList.add('show');
}

// Cerrar respuestas
cerrarRespuesta.addEventListener('click', () => {
  chatRespuesta.classList.remove('show');
  chatBody.classList.add('show');
});

