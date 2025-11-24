<?php


add_action( 'cmb2_admin_init', 'yourprefix_register_theme_options_metabox' );
function yourprefix_register_theme_options_metabox() {
	$cmb_options = new_cmb2_box( array(
		'id'           => 'VPLA_options_',
		'title'        => esc_html__( 'Opciones del tema', 'cmb2' ),
		'object_types' => array( 'options-page' ),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'opciones_del_tema', // The option key and admin menu page slug.
		'icon_url'        => 'dashicons-paperclip', // Menu icon. Only applicable if 'parent_slug' is left empty.
		'menu_title'              => esc_html__( 'Opciones del tema', 'cmb2' ), // Falls back to 'title' (above).
		// 'parent_slug'             => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'              => 'manage_options', // Cap required to view options-page.
		// 'position'                => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook'         => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'priority'                => 10, // Define the page-registration admin menu hook priority.
		// 'display_cb'              => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		'save_button'             => esc_html__( 'Guardar cambios', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'              => 'yourprefix_options_page_message_callback',
		// 'tab_group'               => '', // Tab-group identifier, enables options page tab navigation.
		// 'tab_title'               => null, // Falls back to 'title' (above).
		// 'autoload'                => false, // Defaults to true, the options-page option will be autloaded.
	) );

    # Opciones del tema
    # Logo Reforestamos México
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Logo Reforestamos México, Pleca Negra Menú', 'cmb2' ),
		'id'      => 'logo_reforestamos',
		'type'    => 'file',
	) );    

    # Logo Supercivicos
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Logo Supercívicos, Pleca Negra Menú', 'cmb2' ),
		'id'      => 'logo_supercivicos',
		'type'    => 'file',
	) );  
    
    # Logo Imperfect Proyect
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Logo Imperfect Proyect, Pleca Negra Menú', 'cmb2' ),
		'id'      => 'logo_imperfectproyect',
		'type'    => 'file',
	) );      

}

## Redes Sociales Reforestamos México

## Redes Sociales Supercivicos


## Redes Sociales Imperfect Proyect