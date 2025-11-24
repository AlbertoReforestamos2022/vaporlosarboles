<?php
# form_directorio_verde

// Asegurarse de que PHPMailer esté cargado correctamente
function formulario_directorio_verde() {
    if (!isset($_POST['formulario_directorio_verde']) || !wp_verify_nonce($_POST['formulario_directorio_verde'], 'submit_directorio_verde_form')) {
        wp_send_json_error(['message' => 'Nonce no válido']);
        wp_die();
    }

    $name    = sanitize_text_field($_POST['nombre'] ?? '');
    $email   = sanitize_email($_POST['correo'] ?? '');

    if (empty($name) || empty($email)) {
        wp_send_json_error(['message' => 'Faltan campos por completar']);
        wp_die();
    }
    
    // Preparar correo principal
    $to = ['albertocortes@reforestamos.org', 'alberto3000cortes0003@gmail.com'];
    $subject = "Formulario Reconoce Va Por Los Árboles";
    $headers = [
        "Content-Type: text/html; charset=UTF-8",
        "From: $email",
        "Reply-To: $email"
    ];

    $body = '
    <html>
        <style>
            body {
                padding: 8px;
                border-radius: 4px;
                box-shadow: 5px 5px 15px rgba(0,0,0, .3);
            }
            h3, .verde-primary {
                background-color: rgba(33, 137, 30, .8);
                color: #fff;
                padding: 8px;
                border-radius: 6px;
            }
            p {
                font-size: 18px;
                color: rgba(96, 72, 43, 1);
            }
            img {
                max-width: 100%;
                margin-bottom: 12px;
                border-radius: 6px;
                box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            }
        </style>

        <body>
            <h3 style="text-align:center;">Formulario directorio verde</h3>
            <p><strong>Nombre:</strong><br>' . $name . '</p>
            <p><strong>Correo:</strong><br>' . $email . '</p>
        </body>
    </html>
    ';
    // Enviar correo principal usando la configuración SMTP de WordPress
    $sent = wp_mail($to, $subject, $body, $headers, $attachments);

    // Correo de confirmación al remitente
    $confirmation_subject = "Gracias por ser parte del movimiento";
    $confirmation_message = "Hola $name, gracias por estar interesado por las actividades del programa Va Por Los Árboles";
    $confirmation_headers = [
        "From: contacto@reforestamos.org",
        "Content-Type: text/html; charset=UTF-8"
    ];
    $send_confirmation = wp_mail($email, $confirmation_subject, $confirmation_message, $confirmation_headers);

    // Enviar respuesta a JS
    if ($sent && $send_confirmation) {
        wp_send_json_success(['message' => 'Correo enviado correctamente.']);
    } else {
        $error_msg = !$sent ? 'Error al enviar el correo principal.' : 'Error al enviar el correo de confirmación.';
        wp_send_json_error(['message' => $error_msg]);
    }

    wp_die();
}

add_action('wp_ajax_formulario_directorio_verde', 'formulario_directorio_verde');
add_action('wp_ajax_nopriv_formulario_directorio_verde', 'formulario_directorio_verde');