<?php
function chromax_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'chromax'),
		) 
	);
	
	/*=========================================
	Footer Widget
	=========================================*/
	$wp_customize->add_section(
        'chromax_footer_widget',
        array(
            'title' 		=> __('Footer Widget','chromax'),
			'panel'  		=> 'footer_options',
			'priority'      => 3,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'chromax_footer_mid_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'chromax_footer_mid_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Middle','chromax'),
			'section' => 'chromax_footer_widget',
			'priority'  => 1,
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'chromax_footer_mid_ttl',
    	array(
	        'default'			=> __('LET’S GET In TOUCH','chromax'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_footer_mid_ttl',
		array(
		    'label'   => __('Title','chromax'),
		    'section' => 'chromax_footer_widget',
			'type'           => 'text',
			'priority' => 1,
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'chromax_footer_mid_link',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_url',
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_footer_mid_link',
		array(
		    'label'   => __('Button Link','chromax'),
		    'section' => 'chromax_footer_widget',
			'type'           => 'text',
			'priority' => 1,
		)  
	);
	
	// Open New Tab
	$wp_customize->add_setting( 
		'chromax_footer_mid_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'chromax_footer_mid_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'chromax' ),
			'section'     => 'chromax_footer_widget',
			'type'        => 'checkbox',
			'priority' => 1,
		) 
	);	
	
	// Heading
	$wp_customize->add_setting(
		'chromax_footer_widget_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'chromax_footer_widget_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Widget','chromax'),
			'section' => 'chromax_footer_widget',
			'priority'  => 1,
		)
	);
	
	
	// column // 
	$wp_customize->add_setting(
    	'chromax_footer_widget_column',
    	array(
	        'default'			=> '4',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control(
		'chromax_footer_widget_column',
		array(
		    'label'   		=> __('Select Widget Column','chromax'),
		    'section' 		=> 'chromax_footer_widget',
			'type'			=> 'select',
			'choices'        => 
			array(
				'' => __( 'None', 'chromax' ),
				'1' => __( '1 Column', 'chromax' ),
				'2' => __( '2 Column', 'chromax' ),
				'3' => __( '3 Column', 'chromax' ),
				'4' => __( '4 Column', 'chromax' )
			) 
		) 
	);
	
	
	/*=========================================
	Footer Copright
	=========================================*/
	$wp_customize->add_section(
        'chromax_footer_copyright',
        array(
            'title' 		=> __('Footer Copright','chromax'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );	
	
	// Heading
	$wp_customize->add_setting(
		'chromax_footer_copyright_first_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'chromax_footer_copyright_first_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','chromax'),
			'section' => 'chromax_footer_copyright',
			'priority'  => 3,
		)
	);
	
	// footer third text // 
	$chromax_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'chromax' );
	$wp_customize->add_setting(
    	'chromax_footer_copyright_text',
    	array(
			'default' => $chromax_copyright,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'chromax_footer_copyright_text',
		array(
		    'label'   		=> __('Copyright','chromax'),
		    'section'		=> 'chromax_footer_copyright',
			'type' 			=> 'textarea',
			'priority'      => 4,
		)  
	);	
	
	/*=========================================
	Footer Background
	=========================================*/
	$wp_customize->add_section(
        'footer_background_options',
        array(
            'title' 		=> __('Footer Background','chromax'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	
	//  Footer Background Color
	$wp_customize->add_setting(
	'chromax_footer_bg_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'default' => '#222222'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'chromax_footer_bg_color', 
			array(
				'label'      => __( 'Footer Background Color', 'chromax' ),
				'section'    => 'footer_background_options',
			) 
		) 
	);
}
add_action( 'customize_register', 'chromax_footer_customize_settings' );