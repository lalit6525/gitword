<?php
function chromax_theme_options_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'chromax_theme_options', array(
			'priority' => 31,
			'title' => esc_html__( 'Theme Options', 'chromax' ),
		)
	);
	
	/*=========================================
	General Options
	=========================================*/
	$wp_customize->add_section(
		'site_general_options', array(
			'title' => esc_html__( 'General Options', 'chromax' ),
			'priority' => 1,
			'panel' => 'chromax_theme_options',
		)
	);
	
	
	/*=========================================
	Preloader
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'chromax_preloader_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_preloader_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Preloader','chromax'),
			'section' => 'site_general_options',
		)
	);
	
	
	// Hide/ Show
	$wp_customize->add_setting( 
		'chromax_hs_preloader_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_preloader_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'chromax' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Scroller
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'chromax_scroller_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'chromax_scroller_option',
		array(
			'type' => 'hidden',
			'label' => __('Top Scroller','chromax'),
			'section' => 'site_general_options',
		)
	);
	
	// Hide/show
	$wp_customize->add_setting( 
		'chromax_hs_scroller_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_scroller_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'chromax' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Chromax Container
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'chromax_site_container_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'chromax_site_container_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Container','chromax'),
			'section' => 'site_general_options',
		)
	);
	
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
		//container width
		$wp_customize->add_setting(
			'chromax_site_container_width',
			array(
				'default'			=> '2304',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'chromax_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'      => 6,
			)
		);
		$wp_customize->add_control( 
		new Chromax_Customizer_Range_Control( $wp_customize, 'chromax_site_container_width', 
			array(
				'label'      => __( 'Container Width', 'chromax' ),
				'section'  => 'site_general_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 768,
                        'max'           => 2500,
                        'step'          => 1,
                        'default_value' => 2304,
                    ),
                ),
			) ) 
		);
	}
	
	/*=========================================
	Chromax Search Result
	=========================================*/
	
	//  Head // 
	$wp_customize->add_setting(
		'chromax_search_result_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'chromax_search_result_head',
		array(
			'type' => 'hidden',
			'label' => __('Search Result','chromax'),
			'section' => 'site_general_options',
		)
	);
	
	//  Style
	$wp_customize->add_setting( 
		'chromax_search_result' , 
			array(
			'default' => 'post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 8,
		) 
	);

	$wp_customize->add_control(
	'chromax_search_result' , 
		array(
			'label'          => __( 'Search Result Page will Show ?', 'chromax' ),
			'section'        => 'site_general_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'post' 	=> __( 'Posts', 'chromax' ),
				'product' 	=> __( 'WooCommerce Products', 'chromax' ),
			) 
		) 
	);
	
	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'chromax_site_breadcrumb', array(
			'title' => esc_html__( 'Site Breadcrumb', 'chromax' ),
			'priority' => 12,
			'panel' => 'chromax_theme_options',
		)
	);
	
	// Heading
	$wp_customize->add_setting(
		'chromax_site_breadcrumb_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_site_breadcrumb_option',
		array(
			'type' => 'hidden',
			'label' => __('Settings','chromax'),
			'section' => 'chromax_site_breadcrumb',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'chromax_hs_site_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_site_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'chromax' ),
			'section'     => 'chromax_site_breadcrumb',
			'type'        => 'checkbox'
		) 
	);
	
	// Breadcrumb Content Section // 
	$wp_customize->add_setting(
		'chromax_site_breadcrumb_content'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'chromax_site_breadcrumb_content',
		array(
			'type' => 'hidden',
			'label' => __('Content','chromax'),
			'section' => 'chromax_site_breadcrumb',
		)
	);
	
	
	// Type
	$wp_customize->add_setting( 
		'chromax_breadcrumb_type' , 
			array(
			'default' => 'theme',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'chromax_breadcrumb_type' , 
		array(
			'label'          => __( 'Select Breadcrumb Type', 'chromax' ),
			'description'          => __( 'You need to install and activate the respected plugin to show their Breadcrumb. Otherwise, your default theme Breadcrumb will appear. If you see error in search console, then we recommend to use plugin Breadcrumb.', 'chromax' ),
			'section'        => 'chromax_site_breadcrumb',
			'type'           => 'select',
			'choices'        => 
			array(
				'theme' 	=> __( 'Theme Default', 'chromax' ),
				'yoast' 	=> __( 'Yoast Plugin', 'chromax' ),
				'rankmath' 	=> __( 'Rank Math Plugin', 'chromax' ),
				'navxt' 	=> __( 'NavXT Plugin', 'chromax' ),
			) 
		) 
	);
		
	// Background // 
	$wp_customize->add_setting(
		'chromax_breadcrumb_bg_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'chromax_breadcrumb_bg_options',
		array(
			'type' => 'hidden',
			'label' => __('Background','chromax'),
			'section' => 'chromax_site_breadcrumb',
		)
	);
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'chromax_breadcrumb_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/pagetitle.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'chromax_breadcrumb_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'chromax'),
			'section'        => 'chromax_site_breadcrumb',
		) 
	));
	
	$wp_customize->add_setting(
	'chromax_breadcrumb_opacity_color', 
	array(
		'default' => '#00022A',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'  => 12,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'chromax_breadcrumb_opacity_color', 
			array(
				'label'      => __( 'Opacity Color', 'chromax'),
				'section'    => 'chromax_site_breadcrumb',
			) 
		) 
	);
	
	// Typography
	$wp_customize->add_setting(
		'chromax_breadcrumb_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority'  => 13,
		)
	);

	$wp_customize->add_control(
	'chromax_breadcrumb_typography',
		array(
			'type' => 'hidden',
			'label' => __('Typography','chromax'),
			'section' => 'chromax_site_breadcrumb',
		)
	);
	
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
	// Title size // 
	$wp_customize->add_setting(
    	'chromax_breadcrumb_title_size',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority'  => 14,
		)
	);
	$wp_customize->add_control( 
	new Chromax_Customizer_Range_Control( $wp_customize, 'chromax_breadcrumb_title_size', 
		array(
			'label'      => __( 'Title Font Size', 'chromax' ),
			'section'  => 'chromax_site_breadcrumb',
			'media_query'   => true,
			'input_attr'    => array(
				'mobile'  => array(
					'min'           => 0,
					'max'           => 20,
					'step'          => 1,
					'default_value' => 8,
				),
				'tablet'  => array(
					'min'           => 0,
					'max'           => 20,
					'step'          => 1,
					'default_value' => 8,
				),
				'desktop' => array(
					'min'           => 0,
					'max'           => 20,
					'step'          => 1,
					'default_value' => 8,
				),
			),
		) ) 
	);
	// Content size // 
	$wp_customize->add_setting(
    	'chromax_breadcrumb_content_size',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority'  => 15,
		)
	);
	$wp_customize->add_control( 
	new Chromax_Customizer_Range_Control( $wp_customize, 'chromax_breadcrumb_content_size', 
		array(
			'label'      => __( 'Content Font Size', 'chromax' ),
			'section'  => 'chromax_site_breadcrumb',
			'media_query'   => true,
			'input_attr'    => array(
				'mobile'  => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 2,
				),
				'tablet'  => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 2,
				),
				'desktop' => array(
					'min'           => 0,
					'max'           => 10,
					'step'          => 1,
					'default_value' => 2,
				),
			),
		) ) 
	);
	}
	
	
	/*=========================================
	Chromax Blog 
	=========================================*/
	$wp_customize->add_section(
        'site_blog_options',
        array(
        	'priority'      => 8,
            'title' 		=> __('Blog Options','chromax'),
			'panel'  		=> 'chromax_theme_options',
		)
    );
	
	/*=========================================
	Excerpt
	=========================================*/
	$wp_customize->add_setting(
		'chromax_blog_excerpt_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'chromax_blog_excerpt_options',
		array(
			'type' => 'hidden',
			'label' => __('Post Excerpt','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// Enable Excerpt
	$wp_customize->add_setting(
		'chromax_enable_post_excerpt'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 5,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_excerpt',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Excerpt','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// post Exerpt // 
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'chromax_post_excerpt_length',
			array(
				'default'     	=> '30',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'chromax_sanitize_range_value',
				'priority'      => 5,
			)
		);
		$wp_customize->add_control( 
		new Chromax_Customizer_Range_Control( $wp_customize, 'chromax_post_excerpt_length', 
			array(
				'label'      => __( 'Excerpt Length', 'chromax' ),
				'section'  => 'site_blog_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 1000,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
				)	
			) ) 
		);
	}
	
	// excerpt more // 
	$wp_customize->add_setting(
    	'chromax_blog_excerpt_more',
    	array(
			'default'      => '...',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'chromax_blog_excerpt_more',
		array(
		    'label'   => esc_html__('Excerpt More','chromax'),
		    'section' => 'site_blog_options',
			'type' => 'text',
		)  
	);
	
	
	// Enable Excerpt
	$wp_customize->add_setting(
		'chromax_show_post_btn'
			,array(
			'default'      => '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 5,
		)
	);

	$wp_customize->add_control(
	'chromax_show_post_btn',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Read More Button','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Readmore button
	$wp_customize->add_setting(
		'chromax_read_btn_txt'
			,array(
			'default' => __('Read more','chromax'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'priority'      => 5,
		)
	);

	$wp_customize->add_control(
	'chromax_read_btn_txt',
		array(
			'type' => 'text',
			'label' => __('Read More Button Text','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// Hide/Show Category
	$wp_customize->add_setting(
		'chromax_enable_post_cat'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_cat',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Category ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Date
	$wp_customize->add_setting(
		'chromax_enable_post_date'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_date',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Date ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Author
	$wp_customize->add_setting(
		'chromax_enable_post_author'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_author',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Author ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Comments
	$wp_customize->add_setting(
		'chromax_enable_post_comments'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_comments',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Comments ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Views
	$wp_customize->add_setting(
		'chromax_enable_post_views'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_views',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Views ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Reading Time
	$wp_customize->add_setting(
		'chromax_enable_post_rt'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_rt',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Reading Time ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Tag
	$wp_customize->add_setting(
		'chromax_enable_post_tag'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_tag',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Tag ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	
	// Hide/Show Title
	$wp_customize->add_setting(
		'chromax_enable_post_ttl'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority'      => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_enable_post_ttl',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Title ?','chromax'),
			'section' => 'site_blog_options',
		)
	);
	/*=========================================
	Chromax Sidebar
	=========================================*/
	$wp_customize->add_section(
        'chromax_sidebar_options',
        array(
        	'priority'      => 8,
            'title' 		=> __('Sidebar Options','chromax'),
			'panel'  		=> 'chromax_theme_options',
		)
    );
	
	//  Pages Layout // 
	$wp_customize->add_setting(
		'chromax_pages_sidebar_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_pages_sidebar_option',
		array(
			'type' => 'hidden',
			'label' => __('Sidebar Layout','chromax'),
			'section' => 'chromax_sidebar_options',
		)
	);
	
	// Default Page
	$wp_customize->add_setting( 
		'chromax_default_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 2,
		) 
	);

	$wp_customize->add_control(
	'chromax_default_pg_sidebar_option' , 
		array(
			'label'          => __( 'Default Page Sidebar Option', 'chromax' ),
			'section'        => 'chromax_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'chromax' ),
				'right_sidebar' 	=> __( 'Right Sidebar', 'chromax' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'chromax' ),
			) 
		) 
	);
	
	// Archive Page
	$wp_customize->add_setting( 
		'chromax_archive_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 3,
		) 
	);

	$wp_customize->add_control(
	'chromax_archive_pg_sidebar_option' , 
		array(
			'label'          => __( 'Archive Page Sidebar Option', 'chromax' ),
			'section'        => 'chromax_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'chromax' ),
				'right_sidebar' => __( 'Right Sidebar', 'chromax' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'chromax' ),
			) 
		) 
	);
	
	
	// Single Page
	$wp_customize->add_setting( 
		'chromax_single_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'chromax_single_pg_sidebar_option' , 
		array(
			'label'          => __( 'Single Page Sidebar Option', 'chromax' ),
			'section'        => 'chromax_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'chromax' ),
				'right_sidebar' => __( 'Right Sidebar', 'chromax' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'chromax' ),
			) 
		) 
	);
	
	
	// Blog Page
	$wp_customize->add_setting( 
		'chromax_blog_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'chromax_blog_pg_sidebar_option' , 
		array(
			'label'          => __( 'Blog Page Sidebar Option', 'chromax' ),
			'section'        => 'chromax_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'chromax' ),
				'right_sidebar' => __( 'Right Sidebar', 'chromax' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'chromax' ),
			) 
		) 
	);
	
	// Search Page
	$wp_customize->add_setting( 
		'chromax_search_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'chromax_search_pg_sidebar_option' , 
		array(
			'label'          => __( 'Search Page Sidebar Option', 'chromax' ),
			'section'        => 'chromax_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'chromax' ),
				'right_sidebar' => __( 'Right Sidebar', 'chromax' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'chromax' ),
			) 
		) 
	);
	
	
	// WooCommerce Page
	$wp_customize->add_setting( 
		'chromax_shop_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_select',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'chromax_shop_pg_sidebar_option' , 
		array(
			'label'          => __( 'WooCommerce Page Sidebar Option', 'chromax' ),
			'section'        => 'chromax_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'chromax' ),
				'right_sidebar' => __( 'Right Sidebar', 'chromax' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'chromax' ),
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'chromax_sidebar_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 7,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'chromax_sidebar_option_upsale', 
				array(
					'label'      => __( 'Sidebar Features', 'chromax' ),
					'section'    => 'chromax_sidebar_options'
				) 
			) 
		);	
	}
	
	// Widget options
	$wp_customize->add_setting(
		'sidebar_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority'  => 6
		)
	);

	$wp_customize->add_control(
	'sidebar_options',
		array(
			'type' => 'hidden',
			'label' => __('Options','chromax'),
			'section' => 'chromax_sidebar_options',
		)
	);
	// Sidebar Width 
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'chromax_sidebar_width',
			array(
				'default'	      => esc_html__( '33', 'chromax' ),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'chromax_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'  => 7
			)
		);
		$wp_customize->add_control( 
		new Chromax_Customizer_Range_Control( $wp_customize, 'chromax_sidebar_width', 
			array(
				'label'      => __( 'Sidebar Width', 'chromax' ),
				'section'  => 'chromax_sidebar_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 25,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 33,
						),
					),
			) ) 
		);
	}
	
	// Widget Typography
	$wp_customize->add_setting(
		'sidebar_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'sidebar_typography',
		array(
			'type' => 'hidden',
			'label' => __('Typography','chromax'),
			'section' => 'chromax_sidebar_options',
			'priority'  => 21,
		)
	);
	
	// Widget Title // 
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'chromax_widget_ttl_size',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'chromax_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new Chromax_Customizer_Range_Control( $wp_customize, 'chromax_widget_ttl_size', 
			array(
				'label'      => __( 'Widget Title Font Size', 'chromax' ),
				'section'  => 'chromax_sidebar_options',
				'priority'  => 22,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 35,
                    ),
                    'tablet'  => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 35,
                    ),
                    'desktop' => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 35,
                    ),
                ),
			) ) 
		);
	}	
}
add_action( 'customize_register', 'chromax_theme_options_customize' );