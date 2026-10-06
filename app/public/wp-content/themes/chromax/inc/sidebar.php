<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function chromax_widgets_init() {	
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name' => __( 'WooCommerce Widget Area', 'chromax' ),
			'id' => 'chromax-woocommerce-sidebar',
			'description' => __( 'This Widget area for WooCommerce Widget', 'chromax' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'chromax' ),
		'id' => 'chromax-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'chromax' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	
	$chromax_footer_widget_column = get_theme_mod('chromax_footer_widget_column','4');
	for ($i=1; $i<=$chromax_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'chromax' )  . $i,
			'id' => 'chromax-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'chromax' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
}
add_action( 'widgets_init', 'chromax_widgets_init' );