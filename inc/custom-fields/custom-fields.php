<?php

// Sección hero
add_action('cmb2_admin_init', 'vpla_hero');
function vpla_hero() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front');

    $vpla_hero = new_cmb2_box( array(
        'id'           => $prefix . 'hero',
        'title'        => esc_html__('Sección Hero', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));

    $vpla_hero -> add_field( array(
        'name' => esc_html__('Contenido hero'),
        'id'   => 'titulo_hero',
        'type' => 'title'
    )); 

    $vpla_hero -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid

        'name' => esc_html__('Texto uno Va Por Los Árboles'),
        'id' => 'texto_uno_hero',
        'type' => 'wysiwyg'
    ));

    $vpla_hero -> add_field( array(
        'name' => esc_html__('Imagen Arturo hero Va Por Los Árboles'),
        'id' => 'img_arturo_hero',
        'type' => 'file',

        'after_row' => '</div>' // cerrar grid        
    ));        

    // Imagen centinelas
    $vpla_hero -> add_field( array(
        'name' => esc_html__('Imágen de fondo Centinelas'),
        'id'   => 'titulo_fondo_centinelas',
        'type' => 'title'
    )); 
    $vpla_hero -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('Imagen de fondo Centinelas - Va Por Los Árboles'),
        'id' => 'imagen_fondo_centinelas',
        'type' => 'file'
    ));

    $vpla_hero -> add_field( array(
        'name' => esc_html__('Autor de la imagen Centinelas - Va Por Los Árboles'),
        'id' => 'autor_fondo_centinelas',
        'type' => 'wysiwyg'
    ));

    $vpla_hero -> add_field( array(
        'name' => esc_html__('Texto concurso imagen Centinelas - Va Por Los Árboles'),
        'id' => 'texto_concurso_centinelas',
        'type' => 'text',
        'after_row' => '</div>', // cerrar grid
    ));    

}

// Sección logos
add_action('cmb2_admin_init', 'vpla_logos');
function vpla_logos() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front');

    $vpla_logos = new_cmb2_box( array(
        'id'           => $prefix . 'logos',
        'title'        => esc_html__('Sección de Logos', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'side',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));
    

    $vpla_logos -> add_field( array(
        'name' => esc_html__('Logo Reforestamos México'),
        'id' => 'reforestamos_logo',
        'type' => 'file'
    ));    
   
    $vpla_logos -> add_field( array(
        'name' => esc_html__('Logo Supercivicos'),
        'id' => 'supercivicos_logo',
        'type' => 'file'
    ));

    $vpla_logos -> add_field( array(
        'name' => esc_html__('Logo Imperfect proyect'),
        'id' => 'imperfect_proyect_logo',
        'type' => 'file'
    ));

}

// Sección acciones
add_action('cmb2_admin_init', 'vpla_acciones');
function vpla_acciones() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front');

    $vpla_acciones = new_cmb2_box( array(
        'id'           => $prefix . 'acciones',
        'title'        => esc_html__('Sección plugin Lista de reproducción YT', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'side',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));
    

    $vpla_acciones -> add_field( array(
        'id' => 'seccion_plugin_yt',
        'type' => 'wysiwyg'
    ));    

}

# Sección videos tiktok
add_action('cmb2_admin_init', 'vpla_feed_tiktok'); 
function vpla_feed_tiktok() {
    $prefix = 'vpla_group_';
    $id_home = get_option('page_on_front');

	$vpla_feed_tiktok = new_cmb2_box( array(
		'id'           => $prefix . 'feed_tiktok',
		'title'        => esc_html__( 'Sección feed tik-tok', 'cmb2' ),
		'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'high', 
        'show_names'   => true,
		'show_on'      => array(
			'id' => array( $id_home ),
		),
	) );

    // Descripción sección 
    $vpla_feed_tiktok -> add_field( array(
        'description' => esc_html__('video más reciente'),
        'id' => 'video_reciente',
        'type' => 'textarea_code'
    )); 


	$group_field_id = $vpla_feed_tiktok->add_field( array(
		'id'          => $prefix . 'videos_feed_tik_tok',
		'type'        => 'group',
		'description' => esc_html__( 'Sección Videos Tiktok', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'video {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Agregar grupo', 'cmb2' ),
			'remove_button'  => esc_html__( 'Eliminar', 'cmb2' ),
			'sortable'       => true,
			'closed'      => true, // true to have the groups closed by default
 			'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );


	$vpla_feed_tiktok->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Nombre Video', 'cmb2' ),
		'id'   => 'video_id',
		'type' => 'textarea',
	) ); 
}

// Sección calendario
add_action('cmb2_admin_init', 'vpla_calendario'); 
function vpla_calendario() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front'); 

    $vpla_calendario = new_cmb2_box( array(
        'id'           => $prefix . 'calendario',
        'title'        => esc_html__('Sección calendario', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'side',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )        
    )); 

    // Descripción sección 
    $vpla_calendario -> add_field( array(
        'description' => esc_html__('Agrega el shortcode del plugin Eventos para poder ver el calendario con los eventos.'),
        'id' => 'shorcode_calendario',
        'type' => 'text'
    )); 

}

// Sección herramientas
add_action('cmb2_admin_init', 'vpla_herramientas');
function vpla_herramientas() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front');

    $vpla_herramientas = new_cmb2_box( array(
        'id'           => $prefix . 'herramientas',
        'title'        => esc_html__('Sección Herramientas', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));

    // Descripción sección 
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Descripción sección herramientas'),
        'id' => 'descripcion_herramientas',
        'type' => 'textarea'
    )); 

    /* 
    * !Naturalist 
    */
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('!Naturalist'),
        'id'   => 'titulo_naturalist',
        'type' => 'title'
    ));  
    
    // Titulo 
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Título'),
        'id' => 'naturalist_titulo_logo',
        'type' => 'text'
    ));    

    // Icono Logo
    $vpla_herramientas -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('icono !Naturalist'),
        'id' => 'naturalist_icono',
        'type' => 'file'
    ));

    // Logo color 
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Logo color'),
        'id' => 'naturalist_logo_color',
        'type' => 'file'
    ));

    // Logo blanco
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Logo blanco'),
        'id' => 'naturalist_logo_blanco',
        'type' => 'file'
    ));
    

    // Descripción Naturalista
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Descripción Naturalist'),
        'id' => 'descripcion_naturalist',
        'type' => 'wysiwyg'
    ));

    // link sitio web
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Link sitio web Naturalist'),
        'id' => 'link_sitio_naturalist',
        'type' => 'text',
        'after_row' => '</div>', // cerrar grid
    ));

    /* 
    * IDarbol 
    */
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('IDárbol'),
        'id'   => 'titulo_idarbol',
        'type' => 'title'
    ));     

    // Titulo
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Título'),
        'id' => 'idarbol_titulo',
        'type' => 'text'
    ));

    // Logo 
    $vpla_herramientas -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('Logo IDárbol'),
        'id' => 'idarbol_logo',
        'type' => 'file'
    ));     

    // Descripción 
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Descripción IDárbol'),
        'id' => 'descripcion_idarbol',
        'type' => 'wysiwyg'
    ));

    // link app IOS
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Link descarga app IOS'),
        'id' => 'link_descarga_ios_idarbol',
        'type' => 'text'
    ));

    // link app Android
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Link descarga app Android'),
        'id' => 'link_descarga_android_idarbol',
        'type' => 'text',
        'after_row' => '</div>', // cerrar grid
    ));

    /* 
    * Mi policia 
    */
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Mi Policía'),
        'id'   => 'titulo_mi_policia',
        'type' => 'title'
    ));

    // Titulo
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Título'),
        'id' => 'mi_policia_titulo',
        'type' => 'text'
    ));

    // Logo 
    $vpla_herramientas -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('Logo Mi Policía'),
        'id' => 'mi_policia_logo',
        'type' => 'file'
    ));    

    // Descripción
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Descripción Mi Policía'),
        'id' => 'descripcion_mi_policia',
        'type' => 'wysiwyg'
    ));

    // link sitio web
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Link sitio web Mi Policía'),
        'id' => 'link_sitio_mi_policia',
        'type' => 'text',
        'after_row' => '</div>', // cerrar grid
    ));    


    /*
    * Guía sobre el arbolado urbano 
    */
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Guía sobre el arbolado urbano'),
        'id'   => 'titulo_guia_arbolado',
        'type' => 'title'
    ));     

    $vpla_herramientas -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('Titulo Guía arbolado'),
        'id' => 'titulo_guia',
        'type' => 'text'
    ));    

    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Documento arbolado urbano'),
        'id' => 'documento_guia_arbolado',
        'type' => 'file',
        'after_row' => '</div>', // cerrar grid
    ));   

    /**
     * Capacitación sobre el arbolado Urbano (Link YouTube)
    **/
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Capacitación para el manejo del arbolado urbano'),
        'id'   => 'titulo_seccion_capacitacion_arbolado',
        'type' => 'title'
    ));     

    $vpla_herramientas -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('Titulo sección de la capacitación arbolado'),
        'id' => 'titulo_capactitacion_arbolado',
        'type' => 'text'
    ));    

    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Link lista de reproducción YouTube'),
        'id' => 'documento_capacitacion_arbolado',
        'type' => 'text',
        'after_row' => '</div>', // cerrar grid
    ));


    /* 
    * Directorio Verde 
    */
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Directorio Verde'),
        'id'   => 'titulo_directorio_verde',
        'type' => 'title'
    )); 

    // Titulo
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Título'),
        'id' => 'directorio_verde_titulo',
        'type' => 'text'
    ));    

    // Logo directorio
    $vpla_herramientas -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('Logo directorio'),
        'id' => 'directorio_verde_logo',
        'type' => 'file'
    ));    

    // Descriptción directorio
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Descripción'),
        'id' => 'descripcion_directorio_verde',
        'type' => 'wysiwyg'
    ));

    // Documento directorio
    $vpla_herramientas -> add_field( array(
        'name' => esc_html__('Documento'),
        'id' => 'link_directorio_verde',
        'type' => 'file',
        'after_row' => '</div>', // cerrar grid
    ));     

}

# Sección herramientas dinámico
## Pendiente
add_action('cmb2_admin_init', 'vpla_herramientas_dinamicas');
function vpla_herramientas_dinamicas() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front'); 

    $herramientas_box = new_cmb2_box(array(
        'id'           => $prefix . 'herramientas_dinamicas',
        'title'        => esc_html__('Herramientas dinámicas', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));

    $herramientas_box->add_field(array(
        'id'          => $prefix . 'grupo_herramientas',
        'type'        => 'group',
        'description' => esc_html__('Agrega herramientas con campos dinámicos', 'cmb2'),
        'options'     => array(
            'group_title'   => esc_html__('Herramienta {#}', 'cmb2'),
            'add_button'    => esc_html__('Agregar herramienta', 'cmb2'),
            'remove_button' => esc_html__('Eliminar herramienta', 'cmb2'),
            'sortable'      => true,
        ),
    ));

    // Tipo de herramienta
    $herramientas_box->add_group_field($prefix . 'grupo_herramientas', array(
        'name'    => 'Tipo de herramienta',
        'id'      => 'tipo',
        'type'    => 'select',
        'options' => array(
            'link'        => 'Solo link',
            'popup'       => 'Con pop-up',
        ),
    ));

    // Campo link
    $herramientas_box->add_group_field($prefix . 'grupo_herramientas', array(

        'name' => 'Título herramienta',
        'id'   => 'titulo_herramienta',
        'type' => 'text',
    ));

    $herramientas_box->add_group_field($prefix . 'grupo_herramientas', array(
        'name' => 'Logo herramienta',
        'id'   => 'logo_herramienta',
        'type' => 'file',
    ));

    $herramientas_box->add_group_field($prefix . 'grupo_herramientas', array(
        'name' => 'Link uno (opcional)',
        'id'   => 'link_uno',
        'type' => 'text_url',
    ));

    $herramientas_box->add_group_field($prefix . 'grupo_herramientas', array(
        'name' => 'Link dos (opcional)',
        'id'   => 'link_dos',
        'type' => 'text_url',
    ));

    ## Campos para pop-up
    $herramientas_box->add_group_field($prefix . 'grupo_herramientas', array(
        'name' => 'Contenido del pop-up',
        'id'   => 'popup_contenido',
        'type' => 'textarea',
    ));
}

// Aliados
add_action('cmb2_admin_init', 'vpla_aliados');
function vpla_aliados() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front');

    $vpla_aliados = new_cmb2_box( array(
        'id'           => $prefix . 'aliados',
        'title'        => esc_html__('Sección de Aliados', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));
    

    $vpla_aliados -> add_field( array(
        'name' => esc_html__('Logo Grupo Bimbo'),
        'id' => 'bimbo_logo',
        'type' => 'file'
    ));    
   
    $vpla_aliados -> add_field( array(
        'name' => esc_html__('Logo Fundación Pepe'),
        'id' => 'fundacion_pepe_logo',
        'type' => 'file'
    ));


}

// Reporta 
add_action('cmb2_admin_init', 'vpla_reporta');
function vpla_reporta() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front');

    $vpla_reporta = new_cmb2_box( array(
        'id'           => $prefix . 'reporta',
        'title'        => esc_html__('Sección reporta PAOT', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));

    // Foto de fondo Centinelas 
    $vpla_reporta -> add_field( array(
        'name' => esc_html__('Imagen de fondo Centienlas'),
        'id'   => 'titulo_imagen_centinelas',
        'type' => 'title'
    )); 

    $vpla_reporta -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
        'name' => esc_html__('Imagén de fondo'),
        'id' => 'imagen_centinelas_reporta',
        'type' => 'file'
    ));  

    $vpla_reporta -> add_field( array(
        'name' => esc_html__('Créditos foto'),
        'id' => 'creditos_centinelas',
        'type' => 'wysiwyg',
        'after_row' => '</div>', // cerrar grid    
    )); 
    
    // Sección reporta
    $vpla_reporta -> add_field( array(
        'name' => esc_html__('Sección Reporta'),
        'id'   => 'titulo_seccion_reporta',
        'type' => 'title'
    )); 

    $vpla_reporta -> add_field( array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid        
        'name' => esc_html__('Titulo reporta'),
        'id' => 'titulo_reporta',
        'type' => 'text'
    ));    
   
    $vpla_reporta -> add_field( array(
        'name' => esc_html__('Texto reporta'),
        'id' => 'descripcion_reporta',
        'type' => 'textarea'
    ));

    $vpla_reporta -> add_field( array(
        'name' => esc_html__('Link página PAOT'),
        'id' => 'url_paot',
        'type' => 'text',
        'after_row' => '</div>', // cerrar grid         
    ));

}


// Arboristas
add_action( 'cmb2_admin_init', 'vpla_arboristas' );
function vpla_arboristas() {
    $prefix = 'vpla_group_';
    $id_home = get_option('page_on_front');

	$vpla_arboristas = new_cmb2_box( array(
		'id'           => $prefix . 'arboristas',
		'title'        => esc_html__( 'Sección de arboristas', 'cmb2' ),
		'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'high', 
        'show_names'   => true,
		'show_on'      => array(
			'id' => array( $id_home ),
		),
	) );


	$group_field_id = $vpla_arboristas->add_field( array(
		'id'          => $prefix . 'arboristas_semblanzas',
		'type'        => 'group',
		'description' => esc_html__( 'Sección Arboristas', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Arborista {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Agregar grupo', 'cmb2' ),
			'remove_button'  => esc_html__( 'Eliminar', 'cmb2' ),
			'sortable'       => true,
			'closed'      => true, // true to have the groups closed by default
 			'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );


	$vpla_arboristas->add_group_field( $group_field_id, array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
		'name' => esc_html__( 'Nombre arborista', 'cmb2' ),
		'id'   => 'nombre_arborista',
		'type' => 'text',
	) );

	$vpla_arboristas->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'imagen arborista', 'cmb2' ),
		'id'   => 'imagen_arborista',
		'type' => 'file',
	) );

	$vpla_arboristas->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Semblanza arborista', 'cmb2' ),
		'id'   => 'semblanza_arbosrista',
		'type' => 'wysiwyg',
        'after_row' => '</div>', // cerrar grid
	) );


	
}

// GoFoundMe

// Reconoce
add_action('cmb2_admin_init', 'vpla_reconoce');
function vpla_reconoce() {
    $prefix = 'vpla_group_';

    $id_home = get_option('page_on_front');

    $vpla_reconoce = new_cmb2_box( array(
        'id'           => $prefix . 'testimoniales',
        'title'        => esc_html__('Sección testimoniales', 'cmb2'),
        'object_types' => array('page'),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => 'true',
        'show_on'      => array(
            'id'       => array( $id_home ),
        )
    ));
    

    $vpla_reconoce -> add_field( array(
        'name' => esc_html__('Texto introducción'),
        'id' => 'texto_intro',
        'type' => 'textarea'
    ));    
   
    // Campos información para testimoniales reconocimiento
	$group_field_id = $vpla_reconoce->add_field( array(
		'id'          => $prefix . 'informacion_testimoniales',
		'type'        => 'group',
		'description' => esc_html__( 'Testinomiales', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Testimonial {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Agregar grupo', 'cmb2' ),
			'remove_button'  => esc_html__( 'Eliminar', 'cmb2' ),
			'sortable'       => true,
			'closed'      => true, // true to have the groups closed by default
 			'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );

    // Nombre completo
	$vpla_reconoce->add_group_field( $group_field_id, array(
        'before_row' => '<div class="cmb2-grid">', // abrir grid
		'name' => esc_html__( 'Nombre persona reconocida', 'cmb2' ),
		'id'   => 'nombre_reconocido',
		'type' => 'text',
	) );

    // Descripción de la acción 
    $vpla_reconoce->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Nombre persona reconocida', 'cmb2' ),
		'id'   => 'descripcion_reconocido',
		'type' => 'textarea',
	) );

    // Foto Antes 
    $vpla_reconoce->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Foto del antes de la acción reconocida', 'cmb2' ),
		'id'   => 'foto_antes_reconocido',
		'type' => 'file',
	) );

    // Foto Después
    $vpla_reconoce->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Foto del después de la acción reconocida', 'cmb2' ),
		'id'   => 'foto_despues_reconocido',
		'type' => 'file',
        
        'after_row' => '</div>', // cerrar grid
	) );    

}

// estilos css para la sección de herramientas
add_action('admin_enqueue_scripts', 'estilos_herramientas');
function estilos_herramientas() {

    $estilos_custom = "
        .cmb-type-title {
            padding: 0!important;
        }
        .cmb-type-title h5 {
            color: #fff;
            font-size: 20px;
            width: fit-content;
            padding: 8px!important;
            margin-top: 20px!important;
            margin-bottom: 20px!important;
            margin-right: 20px!important;
            margin-left: 20px!important;
            background-color: #0073AA;
            border-radius: 4px;
        }

        .cmb-th {
            width: 90%!important;
            margin: 15px auto;
        }

        .cmb-td {
            width: 100%!important;
        }

        .cmb2-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 columnas */
            gap: 20px;
            align-items: start;

            margin-top: 30px!important;
            margin-bottom: 30px!important;
            margin-right: 20px!important;
            margin-left: 20px!important;
        }

        .cmb2-grid .cmb-row {
            margin: 0 !important;
        }
    "; 

    wp_add_inline_style('wp-admin', $estilos_custom); 
}


## Pendiente
add_action('admin_footer', 'vpla_inline_script_herramientas');
function vpla_inline_script_herramientas() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function toggleFields(groupWrapper) {
            const tipoSelect = groupWrapper.querySelector('select[name*="[tipo]"]');
            if (!tipoSelect) return;

            const tipo = tipoSelect.value;

            // Mostrar siempre el campo tipo
            const tipoRow = tipoSelect.closest('.cmb-row');
            if (tipoRow) tipoRow.style.display = '';

            // Ocultar todos los demás campos
            const rows = groupWrapper.querySelectorAll('.cmb-row');
            rows.forEach(function (row) {
                const input = row.querySelector('input, textarea, select');
                if (!input || input.name.includes('[tipo]')) return; // no ocultar tipo
                row.style.display = 'none';
            });

            // Mostrar campos según el tipo
            const camposPorTipo = {
                link: ['titulo_herramienta', 'logo_herramienta', 'link_uno'],
                popup: ['titulo_herramienta', 'logo_herramienta', 'popup_contenido', 'link_uno', 'link_dos' ]
            };

            const camposMostrar = camposPorTipo[tipo] || [];
            camposMostrar.forEach(function (campo) {
                const input = groupWrapper.querySelector('[name*="[' + campo + ']"]');
                if (input) {
                    const row = input.closest('.cmb-row');
                    if (row) row.style.display = '';
                }
            });
        }

        function initGroups() {
            const groupWrappers = document.querySelectorAll('.cmb-repeatable-group');
            groupWrappers.forEach(function (groupWrapper) {
                toggleFields(groupWrapper);

                const tipoSelect = groupWrapper.querySelector('select[name*="[tipo]"]');
                if (tipoSelect) {
                    tipoSelect.addEventListener('change', function () {
                        toggleFields(groupWrapper);
                    });
                }
            });
        }

        initGroups();

        // Detectar nuevos grupos agregados dinámicamente
        document.body.addEventListener('click', function (e) {
            if (e.target && e.target.getAttribute('vpla_group_grupo_herramientas_repeat')) {
                setTimeout(initGroups, 200); // esperar a que se renderice el nuevo grupo
            }
        });
    });
    </script>
    <?php
}
