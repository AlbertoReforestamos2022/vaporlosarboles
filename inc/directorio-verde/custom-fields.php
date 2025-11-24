<?php
add_action('cmb2_admin_init', 'vpla_especialistas');
function vpla_especialistas() {
    $prefix = 'vpla_cpt_';

    	$vpla_especialistas = new_cmb2_box( array(
		'id'           => $prefix . 'especialistas',
		'title'        => esc_html__( 'Información de los integrantes', 'cmb2' ),
		'object_types' => array( 'evpla_especialista' ), 
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 

	) );

    # Nombre especialista

    # Nombre Empresa
    $vpla_especialistas->add_field( array(
        'name' => esc_html__( 'Empresa espacialista', 'cmb2' ),
        'id'   => $prefix . 'nombre_empresa',
        'type' => 'text',
    ) );

    #Correo 
    $vpla_especialistas->add_field( array(
        'name' => esc_html__( 'Correo espacialista', 'cmb2' ),
        'id'   => $prefix . 'correo_especialista',
        'type' => 'text',
    ) );    

    # Teléfono 
    $vpla_especialistas->add_field( array(
        'name' => esc_html__( 'Teléfono espacialista', 'cmb2' ),
        'id'   => $prefix . 'telefono_especialista',
        'type' => 'text',
    ) );    

    #Estado 
    $vpla_especialistas->add_field( array(
        'name'             => esc_html__( 'Lugar espacialista', 'cmb2' ),
        'id'               => $prefix . 'lugar_especialista',
		'type'             => 'select',
		'options'          => 'obtener_estados_json',
    ) );

    # Especialidad 
    $vpla_especialistas->add_field( array(
        'name'             => esc_html__( 'Especialidad espacialista', 'cmb2' ),
        'id'               => $prefix . 'especialidad_especialista',
		'type'             => 'select',
		'options'          => 'obtener_especialidad_json',
    ) );

    #Actividades 
    $vpla_especialistas->add_field( array(
        'name' => esc_html__( 'Actividades espacialista', 'cmb2' ),
        'id'   => $prefix . 'actividades_especialista',
        'type' => 'textarea',
    ) );

}

function obtener_estados_json() {
    # Ruta al archivo JSON
    $json_flie = get_template_directory() . '/inc/directorio-verde/src/json-files/directory_data.json'   ;
    
    
    # verificar si el archivo existe
    if (!file_exists( $json_flie )) {
        return array('' => 'No se encontró el archivo JSON'); 
    }


    # Leer el contenido del archivo
    $json_content = file_get_contents( $json_flie ); 

    # Decodificar el JSON
    $data = json_decode( $json_content, true ); 

    # preparar el array de opciones
    $options =  array( '' =>  'Selecciona un lugar' ); 

    if(isset($data['states']) && is_array($data['states'])) {
        foreach($data['states'] as $feature) {
            # Acceder a las propiedades
            $clave_estado = $feature['properties']['CVE_ENT'];
            $estado = $feature['properties']['NOM_ENT']; 

            # pasar option a 
            $options[ $clave_estado ] = $estado; 
        }
    }


    return $options;

}

function obtener_especialidad_json() {
    ## Ruta del archivo JSON 
    $json_especialidad_file = get_template_directory() . '/inc/directorio-verde/src/json-files/directory_data.json';

    ## Verificar la existencia del archivo
    if( !file_exists($json_especialidad_file) ) {
        return array('' => 'No se encontró el archivo JSON'); 
    }

    ## Leer el contenido del archivo
    $json_especialidad_content = file_get_contents( $json_especialidad_file ); 

    ## Decodificar el JSON
    $data_especialidad = json_decode( $json_especialidad_content, true); 
    
    # Preparar opciones
    $options_especialidad = array('' => 'Selecciona una especialidad'); 

    if(isset( $data_especialidad['categories']) && is_array($data_especialidad['categories'])) {
        foreach($data_especialidad['categories'] as $especialidad ) {
            ## Acceder a las propiedades
            $clave_especialidad = $especialidad['properties']['CVE_CAT']; 
            $nombre_especialidad = $especialidad['properties']['NOM_CAT']; 



            # Pasar los datos a option
            $options_especialidad[ $clave_especialidad ] = $nombre_especialidad; 
        }
    }

    return $options_especialidad;

}