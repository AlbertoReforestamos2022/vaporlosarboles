<?php
function cargar_scripts_especialistas() {
    # Sólo se cargan los archivos del directorio verde
    
    # Encolar Style formulario Directorio verde
    wp_enqueue_style(
        'formulario-directorio-verde',
        get_template_directory_uri() . '/inc/directorio-verde/src/css/style.css',
        '1.0.0'
    );

    # Encolar Script del formulario
    wp_enqueue_script(
        'formulario-directorio',
        get_template_directory_uri() . '/inc/directorio-verde/src/js/formulario.js', 
        array('jquery'),
        '1.0.0',
        true
    ); 

    # Encolar el escript del mapa iteractivo
    wp_enqueue_script(
        'mapa_directorio_verde',
        get_template_directory_uri() . '/inc/directorio-verde/src/js/actions-map.js',
        array('jquery'),
        '1.0.0',
        true
    );

    # Pasar datos al script
    wp_localize_script(
        'mapa_directorio_verde',
        'especialistasData',
        array(
            'ajaxUrl'        => admin_url('admin-ajax.php'),
            'nonce'          => wp_create_nonce('especialistas_nonce'),
            'estadosJsonUrl' => get_template_directory_uri() . '/src/json-files/division_politica_estados.geojson'
        )
    ); 
}
add_action('wp_enqueue_scripts', 'cargar_scripts_especialistas');

# Obtener datos espacialistas
function obtener_datos_especialistas() {
    check_ajax_referer('especialistas_nonce', 'nonce');
    
    // Obtener todos los posts
    $args = array(
        'post_type'      => 'evpla_especialista',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    );
    
    $query = new WP_Query($args);
    $especialistas = array(); 
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            $lugar_clave = get_post_meta(get_the_ID(), 'vpla_cpt_lugar_especialista', true);
            $especialista_clave = get_post_meta(get_the_ID(), 'vpla_cpt_especialidad_especialista', true);
            
            $especialistas[] = array(
                'id' => get_the_ID(),
                'nombre' => get_the_title(),
                'especialidad_clave' => $especialista_clave,
                'especialidad' => obtener_nombre_especialidad($especialista_clave),
                'empresa' => get_post_meta(get_the_ID(), 'vpla_cpt_nombre_empresa', true),
                'correo' => get_post_meta(get_the_ID(), 'vpla_cpt_correo_especialista', true),
                'telefono' => get_post_meta(get_the_ID(), 'vpla_cpt_telefono_especialista', true),
                'lugar_clave' => $lugar_clave, // Solo la clave del estado
                'lugar_nombre' => obtener_nombre_estado($lugar_clave),
                'actividades' => get_post_meta(get_the_ID(), 'vpla_cpt_actividades_especialista', true),

            );
        }
        wp_reset_postdata(); 
    }
    
    wp_send_json_success($especialistas); 
}
add_action('wp_ajax_obtener_datos_especialistas', 'obtener_datos_especialistas');
add_action('wp_ajax_nopriv_obtener_datos_especialistas', 'obtener_datos_especialistas');

// Función para obtener el nombre del estado
function obtener_nombre_estado($cve_ent) {
    if (empty($cve_ent)) {
        return '';
    }
    
    $json_file = get_template_directory() . '/src/json-files/division_politica_estados.geojson'; 
    
    if (!file_exists($json_file)) {
        return $cve_ent;
    }
    
    $json_content = file_get_contents($json_file);
    $data = json_decode($json_content, true);
    
    if (isset($data['features'])) {
        foreach ($data['features'] as $feature) {
            if ($feature['properties']['CVE_ENT'] === $cve_ent) {
                return $feature['properties']['NOM_ENT'];
            }
        }
    }
    
    return $cve_ent;
}

## función para obtener nombre especialidad
function obtener_nombre_especialidad($cve_cat) {
    if(empty($cve_cat)) {
        return ''; 
    }

    $json_specialists_file = get_template_directory() . '/inc/directorio-verde/src/json-files/directory_data.json';

    if(!file_exists($json_specialists_file)) {
        return $cve_cat;
    }

    $json_specialists_content = file_get_contents($json_specialists_file);
    $data_specialists = json_decode($json_specialists_content, true); 

    if(isset($data_specialists['categories'])) {
        foreach($data_specialists['categories'] as $specialist) {
            if($specialist['properties']['CVE_CAT'] === $cve_cat) {
                return $specialist['properties']['NOM_CAT'];
            }
        }
    }

    return $cve_cat;
}