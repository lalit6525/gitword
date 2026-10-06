<?php
/**
 * Theme functions and definitions
 *
 * @package Flexua
 */

/**
 * After setup theme hook
 */
function flexua_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'flexua' );	
}
add_action( 'after_setup_theme', 'flexua_theme_setup' );

/**
 * Load assets.
 */

function flexua_theme_css() {
	wp_enqueue_style( 'flexua-parent-theme-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'flexua_theme_css', 99);

/**
 * Import Options From Parent Theme
 *
 */
function flexua_parent_theme_options() {
	$chromax_mods = get_option( 'theme_mods_chromax' );
	if ( ! empty( $chromax_mods ) ) {
		foreach ( $chromax_mods as $chromax_mod_k => $chromax_mod_v ) {
			set_theme_mod( $chromax_mod_k, $chromax_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'flexua_parent_theme_options' );

/**
 * Sample implementation of the Custom Header feature
 */
function flexua_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'flexua_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1920,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'chromax_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'flexua_custom_header_setup' );