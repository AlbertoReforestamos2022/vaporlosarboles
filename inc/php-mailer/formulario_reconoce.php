<?php
// Asegurarse de que PHPMailer esté cargado correctamente
function formulario_reconoce() {
    if (!isset($_POST['formulario_reconoce']) || !wp_verify_nonce($_POST['formulario_reconoce'], 'submit_contact_form')) {
        wp_send_json_error(['message' => 'Nonce no válido']);
        wp_die();
    }

    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $message = esc_textarea($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(['message' => 'Faltan campos por completar']);
        wp_die();
    }

    // Subir imágenes a la librería
    // if(!empty(media_handle_upload('beforePhoto', 0)) ) {
    //     $before_id = media_handle_upload('beforePhoto', 0);
    //     $before_path = get_attached_file($before_id);
    // }

    if(!empty(media_handle_upload('afterPhoto', 0))) {
        $after_id  = media_handle_upload('afterPhoto', 0);
        $after_path  = get_attached_file($after_id);
    }

    // is_wp_error($before_id) ||

    if (is_wp_error($after_id)) {
        wp_send_json_error(['message' => 'Error al subir las fotos']);
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
    <h3 style="text-align:center;">Nuevo Reconocimiento</h3>
    <p><strong>Nombre:</strong><br>' . $name . '</p>
    <p><strong>Correo:</strong><br>' . $email . '</p>
    <p><strong>Mensaje:</strong><br>' . $message . '</p>
    <p class="verde-primary"><strong>Las fotos del antes y después vienen como archivos adjuntos</strong></p>

    </body></html>
    ';

    // Adjuntos
    $attachments = [];
    if (file_exists($before_path)) $attachments[] = $before_path;
    if (file_exists($after_path))  $attachments[] = $after_path;

    // Enviar correo principal usando la configuración SMTP de WordPress
    $sent = wp_mail($to, $subject, $body, $headers, $attachments);

    // Correo de confirmación al remitente
    $confirmation_subject = "Gracias por tu reconocimiento";
    $confirmation_message = "Hola $name, gracias por contactarnos. Hemos recibido tu mensaje y te responderemos pronto.";
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

add_action('wp_ajax_formulario_reconoce', 'formulario_reconoce');
add_action('wp_ajax_nopriv_formulario_reconoce', 'formulario_reconoce');

