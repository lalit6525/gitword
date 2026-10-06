<?php
function chromax_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_options', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header Options', 'chromax'),
		) 
	);
	
	/*=========================================
	Chromax Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','chromax'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Logo Width // 
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_logo_size',
			array(
				'default'			=> '150',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'chromax_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Chromax_Customizer_Range_Control( $wp_customize, 'hdr_logo_size', 
			array(
				'label'      => __( 'Logo Size', 'chromax' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
					),
			) ) 
		);
	}
	
	
	// Site Title Size // 
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_title_size',
			array(
				'default'			=> '55',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'chromax_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Chromax_Customizer_Range_Control( $wp_customize, 'hdr_site_title_size', 
			array(
				'label'      => __( 'Site Title Size', 'chromax' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
					),
			) ) 
		);
	}
	
	// Site Tagline Size // 
	if ( class_exists( 'Chromax_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_desc_size',
			array(
				'default'			=> '16',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'chromax_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Chromax_Customizer_Range_Control( $wp_customize, 'hdr_site_desc_size', 
			array(
				'label'      => __( 'Site Tagline Size', 'chromax' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
					),
			) ) 
		);
	}
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'chromax_title_tagline_seo' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_title_tagline_seo', 
		array(
			'label'	      => esc_html__( 'Enable Hidden Title (h1 missing SEO issue)', 'chromax' ),
			'section'     => 'title_tagline',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Top Header
	=========================================*/
	$wp_customize->add_section(
        'chromax_top_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Top Header','chromax'),
			'panel'  		=> 'header_options',
		)
    );	
	
	/*=========================================
	Global Setting
	=========================================*/
	$wp_customize->add_setting(
		'chromax_hdr_top'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_top',
		array(
			'type' => 'hidden',
			'label' => __('Global Setting','chromax'),
			'section' => 'chromax_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'chromax_hs_hdr' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_top_header',
			'type'        => 'checkbox'
		) 
	);		
	
	/*=========================================
	Email
	=========================================*/
	$wp_customize->add_setting(
		'chromax_hdr_top_email'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_top_email',
		array(
			'type' => 'hidden',
			'label' => __('Email','chromax'),
			'section' => 'chromax_top_header',
		)
	);
	$wp_customize->add_setting( 
		'chromax_hs_hdr_email' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_email', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'chromax_hdr_email_icon',
    	array(
	        'default' => 'far fa-envelope-open',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Chromax_Icon_Picker_Control($wp_customize, 
		'chromax_hdr_email_icon',
		array(
		    'label'   		=> __('Icon','chromax'),
		    'section' 		=> 'chromax_top_header',
			'iconset' => 'fa',
			
		))  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'chromax_hdr_email_title',
    	array(
	        'default'			=> __('info@example.com','chromax'),
			'sanitize_callback' => 'chromax_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_email_title',
		array(
		    'label'   		=> __('Title','chromax'),
		    'section' 		=> 'chromax_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'chromax_hdr_email_link',
    	array(
			'default'=> 'mailto:info@example.com',
			'sanitize_callback' => 'chromax_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_email_link',
		array(
		    'label'   		=> __('Link','chromax'),
		    'section' 		=> 'chromax_top_header',
			'type'		 =>	'text'
		)  
	);
	
	
	/*=========================================
	Time
	=========================================*/
	$wp_customize->add_setting(
		'chromax_hdr_top_time'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 14,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_top_time',
		array(
			'type' => 'hidden',
			'label' => __('Time','chromax'),
			'section' => 'chromax_top_header',
		)
	);
	$wp_customize->add_setting( 
		'chromax_hs_hdr_time' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 14,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_time', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'chromax_hdr_time_icon',
    	array(
	        'default' => 'far fa-clock',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Chromax_Icon_Picker_Control($wp_customize, 
		'chromax_hdr_time_icon',
		array(
		    'label'   		=> __('Icon','chromax'),
		    'section' 		=> 'chromax_top_header',
			'iconset' => 'fa',
			
		))  
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'chromax_hdr_time_title',
    	array(
	        'default'			=> __('Mon-Sat: 9.00am To 7.00pm','chromax'),
			'sanitize_callback' => 'chromax_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_time_title',
		array(
		    'label'   		=> __('Title','chromax'),
		    'section' 		=> 'chromax_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'chromax_hdr_time_link',
    	array(
			'sanitize_callback' => 'chromax_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_time_link',
		array(
		    'label'   		=> __('Link','chromax'),
		    'section' 		=> 'chromax_top_header',
			'type'		 =>	'text'
		)  
	);
	
	/*=========================================
	Address
	=========================================*/
	$wp_customize->add_setting(
		'chromax_hdr_top_ads'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_top_ads',
		array(
			'type' => 'hidden',
			'label' => __('Address','chromax'),
			'section' => 'chromax_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'chromax_hs_hdr_top_ads', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_top_ads', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_top_header',
			'type'        => 'checkbox'
		) 
	);	
	// icon // 
	$wp_customize->add_setting(
    	'chromax_hdr_top_ads_icon',
    	array(
	        'default' => 'fas fa-location-arrow',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Chromax_Icon_Picker_Control($wp_customize, 
		'chromax_hdr_top_ads_icon',
		array(
		    'label'   		=> __('Icon','chromax'),
		    'section' 		=> 'chromax_top_header',			
		))  
	);
	
	// title // 
	$wp_customize->add_setting(
    	'chromax_hdr_top_ads_title',
    	array(
	        'default'			=> __('60 Golden Street, New York','chromax'),
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_top_ads_title',
		array(
		    'label'   		=> __('Title','chromax'),
		    'section' 		=> 'chromax_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'chromax_hdr_top_ads_link',
    	array(
			'sanitize_callback' => 'chromax_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 11,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_top_ads_link',
		array(
		    'label'   		=> __('Link','chromax'),
		    'section' 		=> 'chromax_top_header',
			'type'		 =>	'text'
		)  
	);
		
	
	/*=========================================
	Social
	=========================================*/
	$wp_customize->add_setting(
		'Chromax_hdr_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'Chromax_hdr_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','chromax'),
			'section' => 'chromax_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'chromax_hs_hdr_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 25,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'chromax_hdr_social', 
			array(
			 'sanitize_callback' => 'chromax_repeater_sanitize',
			 'priority' => 26,
			 'default' => chromax_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new CHROMAX_Repeater( $wp_customize, 
				'chromax_hdr_social', 
					array(
						'label'   => esc_html__('Social Icons','chromax'),
						'section' => 'chromax_top_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'chromax_social_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 26,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'chromax_social_option_upsale', 
				array(
					'label'      => __( 'Icons', 'chromax' ),
					'section'    => 'chromax_top_header'
				) 
			) 
		);	
	}
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'chromax_hdr_nav',
        array(
        	'priority'      => 4,
            'title' 		=> __('Navigation Bar','chromax'),
			'panel'  		=> 'header_options',
		)
    );
	
	/*=========================================
	Header Account
	=========================================*/	
	$wp_customize->add_setting(
		'chromax_hdr_account'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_account',
		array(
			'type' => 'hidden',
			'label' => __('My Account','chromax'),
			'section' => 'chromax_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'chromax_hs_hdr_account' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_account', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	
	/*=========================================
	Header Cart
	=========================================*/	
	$wp_customize->add_setting(
		'chromax_hdr_cart'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_cart',
		array(
			'type' => 'hidden',
			'label' => __('WooCommerce Cart','chromax'),
			'section' => 'chromax_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'chromax_hs_hdr_cart' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Search
	=========================================*/	
	$wp_customize->add_setting(
		'chromax_hdr_search'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_search',
		array(
			'type' => 'hidden',
			'label' => __('Site Search','chromax'),
			'section' => 'chromax_hdr_nav',
		)
	);
	$wp_customize->add_setting( 
		'chromax_hs_hdr_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Button
	=========================================*/	
	$wp_customize->add_setting(
		'chromax_hdr_button'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_button',
		array(
			'type' => 'hidden',
			'label' => __('Button','chromax'),
			'section' => 'chromax_hdr_nav',
		)
	);
	
	// icon // 
	$wp_customize->add_setting(
    	'chromax_hdr_btn_icon',
    	array(
	        'default' => 'fal fa-arrow-right-long',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Chromax_Icon_Picker_Control($wp_customize, 
		'chromax_hdr_btn_icon',
		array(
		    'label'   		=> __('Icon','chromax'),
		    'section' 		=> 'chromax_hdr_nav',
			'iconset' => 'fa',
			
		))  
	);
	

	$wp_customize->add_setting(
		'chromax_hs_hdr_btn' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_hdr_nav',
			'type'        => 'checkbox'
		) 
	);
	
	// Button Label // 
	$wp_customize->add_setting(
    	'chromax_hdr_btn_lbl',
    	array(
	        'default'			=> __('Get A Quote','chromax'),
			'sanitize_callback' => 'chromax_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_btn_lbl',
		array(
		    'label'   		=> __('Button Label','chromax'),
		    'section' 		=> 'chromax_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'chromax_hdr_btn_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'chromax_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_btn_link',
		array(
		    'label'   		=> __('Button Link','chromax'),
		    'section' 		=> 'chromax_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'chromax_hdr_btn_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hdr_btn_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'chromax' ),
			'section'     => 'chromax_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Contact
	=========================================*/	
	$wp_customize->add_setting(
		'chromax_hdr_contact'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_contact',
		array(
			'type' => 'hidden',
			'label' => __('Contact','chromax'),
			'section' => 'chromax_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'chromax_hs_hdr_contact' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_contact', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	// icon // 
	$wp_customize->add_setting(
    	'chromax_hdr_contact_icon',
    	array(
	        'default' => 'fal fa-phone-volume',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Chromax_Icon_Picker_Control($wp_customize, 
		'chromax_hdr_contact_icon',
		array(
		    'label'   		=> __('Icon','chromax'),
		    'section' 		=> 'chromax_hdr_nav',
			'iconset' => 'fa',
			
		))  
	);
	
	// Title // 
	$wp_customize->add_setting(
    	'chromax_hdr_contact_ttl',
    	array(
	        'default'			=> __('Call Anytime','chromax'),
			'sanitize_callback' => 'chromax_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_contact_ttl',
		array(
		    'label'   		=> __('Title','chromax'),
		    'section' 		=> 'chromax_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Text // 
	$wp_customize->add_setting(
    	'chromax_hdr_contact_txt',
    	array(
			'default'			=> '<a href="tel:+1237878222">+123 7878 222</a>',
			'sanitize_callback' => 'chromax_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'chromax_hdr_contact_txt',
		array(
		    'label'   		=> __('Text','chromax'),
		    'section' 		=> 'chromax_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'chromax_sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Sticky','chromax'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'chromax_hdr_sticky'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_hdr_sticky',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','chromax'),
			'section' => 'chromax_sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'chromax_hs_hdr_sticky' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_hdr_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax' ),
			'section'     => 'chromax_sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'chromax_header_customize_settings' );