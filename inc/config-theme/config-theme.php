<?php

/** Carga los scripts y css del theme **/
function VPLA_scripts() {
    /** Scripts and Styles Leafleat */

    /** 
     * Styles header 
    **/
    wp_enqueue_style('style', get_stylesheet_uri(), '1.0.0'); 
    wp_enqueue_style('style-inicio', get_template_directory_uri() . '/src/css/templates/style.css' , '1.0.0'); 
    wp_enqueue_style('chatbot', get_template_directory_uri() . '/src/css/templates/chat-bot.css' , '1.0.0'); 
    

    /** 
     * Bootstrap Styles header 
    **/
    // Bootstrap icons
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/node_modules/bootstrap-icons/font/bootstrap-icons.css');
    // Custom bootstrap
    wp_enqueue_style('bootstrap-style', get_template_directory_uri(). '/src/css/bootstrap/style.css', '1.0.0');  

    /** 
     * Bootstrap JS footer 
    **/
    wp_enqueue_script('popperBootstrap', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', array(), '1.0.0', true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js',array(), '5.3.0', true);

    /** 
     * Scripts Footer
    **/
    wp_enqueue_script('jquery');
    wp_enqueue_script('jqueryWeb', 'https://code.jquery.com/jquery-3.6.1.min.js', '3.6.1', false);
    // Header - nav script
    wp_enqueue_script('header-js', get_template_directory_uri() . '/src/js/header.js', '1.0.0', array(), null, true); 
    // Body
    wp_enqueue_script('body-js', get_template_directory_uri() . '/src/js/body.js', '1.0.0', array(), null, true);
    
    /**
     * json-files - scripts chatbot actions map
     */
    if(is_front_page()) {
        // Chatbot
        wp_enqueue_script('chatbot', get_template_directory_uri() . '/src/js/chat-bot.js', array('jquery'),null, true);

        // Formulario reconoce
        wp_enqueue_script('formulario_reconoce', get_template_directory_uri(). '/src/js/formulario.js', array('jquery'), null, true); 

        // Formulario Directorio verde
        // wp_enqueue_script('formulario_directorio_verde', get_template_directory_uri() . '/src/js/formulario_directorio_verde.js', array('jquery'), null, true);      

        $ajax_data = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            # Chatbot (otro script donde se cargan respuestas automáticas del proyecto)
            'respuestas_chatbot' => get_template_directory_uri() . '/src/json-files/respuestas.json',

            # coordenadas actions map
            // 'CDMX_coords' => get_template_directory_uri() . '/src/json-files/division_politica_cdmx.geojson',
            // 'actions_map_JSON' => get_template_directory_uri() . '/src/json-files/ubicaciones_acciones.json'
        );            

        wp_localize_script('chatbot', 'ajax_object', $ajax_data); 

    }


}
add_action('wp_enqueue_scripts', 'VPLA_scripts');

// Quitar el editor principal de todas las páginas
add_action('init', 'quitar_editor_principal'); 
function quitar_editor_principal() {
    remove_post_type_support('page', 'editor'); 
}


## Acciones perfiles de editor 
function limitar_editor_eventos() {
    $user = wp_get_current_user();

    if (in_array('editor', (array) $user->roles)) {

        // Elimina menús generales del panel
        remove_menu_page('edit.php');                 // Entradas
        remove_menu_page('edit.php?post_type=page');  // Páginas
        remove_menu_page('upload.php');               // Medios
        remove_menu_page('themes.php');               // Apariencia
        // remove_menu_page('plugins.php');              // Plugins
        remove_menu_page('tools.php');                // Herramientas
        remove_menu_page('options-general.php');      // Ajustes

        // Mantiene visible solo el menú de Eventos
        // (ejemplo con The Events Calendar)
        remove_menu_page('edit.php?post_type=yt_feed');
    }
}
add_action('admin_menu', 'limitar_editor_eventos', 999);



