/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/**
     * Outputs custom css for responsive controls
     * @param  {[string]} setting customizer setting
     * @param  {[string]} css_selector
     * @param  {[array]} css_prop css property to write
     * @param  {String} ext css value extension eg: px, in
     * @return {[string]} css output
     */
    function range_live_media_load( setting, css_selector, css_prop, ext = '' ) {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var values          = JSON.parse( to );
                        var desktop_value   = JSON.parse( values.desktop );
                        var tablet_value    = JSON.parse( values.tablet );
                        var mobile_value    = JSON.parse( values.mobile );

                        var class_name      = 'customizer-' + setting;
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var desktop_css     = '';
                        var tablet_css      = '';
                        var mobile_css      = '';

                        if ( property_name.length == 1 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                        } else if ( property_name.length == 2 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var desktop_css     = desktop_css + property_name[1] + ': ' + desktop_value + ext + ';';

                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var tablet_css      = tablet_css + property_name[1] + ': ' + tablet_value + ext + ';';

                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                            var mobile_css      = mobile_css + property_name[1] + ': ' + mobile_value + ext + ';';
                        }

                        var head_append     = '<style class="' + class_name + '">@media (min-width: 320px){ ' + selector_name + ' { ' + mobile_css + ' } } @media (min-width: 720px){ ' + selector_name + ' { ' + tablet_css + ' } } @media (min-width: 960px){ ' + selector_name + ' { ' + desktop_css + ' } }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( "head" ).append( head_append );
                        }
                    }
                );
            }
        );
    }
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	$(document).ready(function ($) {
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).prev('.cs-range-value').html(val);
            $(this).val(val);
        });
    })
	
	/**
	 * hdr_logo_size
	 */
	range_live_media_load( 'hdr_logo_size', '.site--logo img', [ 'max-width' ], 'px !important' );
	
	
	/**
	 * hdr_site_title_size
	 */
	range_live_media_load( 'hdr_site_title_size', '.site--logo .site-title', [ 'font-size' ], 'px !important' );
	
	/**
	 * hdr_site_desc_size
	 */
	range_live_media_load( 'hdr_site_desc_size', '.site--logo .site-description', [ 'font-size' ], 'px !important' );
	
	//chromax_hdr_email_title
	wp.customize(
		'chromax_hdr_email_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_header-topbar .widget_contact.email .contact__body .title a' ).text( newval );
				}
			);
		}
	);
	
	//chromax_hdr_top_ads_title
	wp.customize(
		'chromax_hdr_top_ads_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_header-topbar .widget_contact.address .contact__body  h6' ).text( newval );
				}
			);
		}
	);
	
	//chromax_hdr_time_title
	wp.customize(
		'chromax_hdr_time_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_header-topbar .widget_contact.time .contact__body .title' ).text( newval );
				}
			);
		}
	);
	
	//chromax_hdr_btn_lbl
	wp.customize(
		'chromax_hdr_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_navbar-button-item .dt-btn' ).text( newval );
				}
			);
		}
	);
	
	//chromax_hdr_contact_ttl
	wp.customize(
		'chromax_hdr_contact_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_navbar-info-contact .contact__body.one .title' ).text( newval );
				}
			);
		}
	);
	
	//chromax_hdr_contact_txt
	wp.customize(
		'chromax_hdr_contact_txt', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_header .dt_navbar-info-contact .contact__body.one .description' ).text( newval );
				}
			);
		}
	);
	
	//chromax_footer_mid_ttl
	wp.customize(
		'chromax_footer_mid_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.dt_footer_middle .bounce-text a' ).text( newval );
				}
			);
		}
	);
	
	//chromax_about_left_ttl
	wp.customize(
		'chromax_about_left_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-about .section-title .sub-title .text-animate' ).text( newval );
				}
			);
		}
	);
	
	//chromax_about_left_subttl
	wp.customize(
		'chromax_about_left_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-about .section-title .title' ).text( newval );
				}
			);
		}
	);
	
	//chromax_service_ttl
	wp.customize(
		'chromax_service_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-service .section-title .sub-title .text-animate' ).text( newval );
				}
			);
		}
	);
	
	//chromax_service_subttl
	wp.customize(
		'chromax_service_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-service .section-title .title' ).text( newval );
				}
			);
		}
	);
	
	//chromax_service_text
	wp.customize(
		'chromax_service_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-service .dt-mt-5.dt-text-center .text' ).text( newval );
				}
			);
		}
	);
	
	//chromax_service_btn_lbl
	wp.customize(
		'chromax_service_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-service .dt-mt-5.dt-text-center .dt-btn' ).text( newval );
				}
			);
		}
	);
	
	//chromax_why_choose_left_ttl
	wp.customize(
		'chromax_why_choose_left_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-whychooseus .section-title .sub-title .text-animate' ).text( newval );
				}
			);
		}
	);
	
	//chromax_why_choose_left_subttl
	wp.customize(
		'chromax_why_choose_left_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-whychooseus .section-title .title' ).text( newval );
				}
			);
		}
	);	
	
	//chromax_why_choose_left_text
	wp.customize(
		'chromax_why_choose_left_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-clients .section-title .desc' ).text( newval );
				}
			);
		}
	);
	
	//chromax_blog_ttl
	wp.customize(
		'chromax_blog_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-posts .section-title .sub-title .text-animate' ).text( newval );
				}
			);
		}
	);
	
	//chromax_blog_subttl
	wp.customize(
		'chromax_blog_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-posts .section-title .title' ).text( newval );
				}
			);
		}
	);
	
	//chromax_cta_ttl
	wp.customize(
		'chromax_cta_ttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-cta .section-title .sub-title .text-animate' ).text( newval );
				}
			);
		}
	);
	
	//chromax_cta_subttl
	wp.customize(
		'chromax_cta_subttl', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-cta .section-title .title' ).text( newval );
				}
			);
		}
	);
	
	//chromax_cta_text
	wp.customize(
		'chromax_cta_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.front-cta .section-title .desc' ).text( newval );
				}
			);
		}
	);
	
	//chromax_cta_btn_lbl
	wp.customize(
		'chromax_cta_btn_lbl', function( value ) {
			value.bind(
				function( newval ) {
					$( '..front-cta .dt-btn' ).text( newval );
				}
			);
		}
	);
	
	/**
	 * Container Width
	 */
	wp.customize( 'chromax_site_container_width', function( value ) {
		
		value.bind( function( chromax_site_container_width ) {
			var class_name      = 'chromax_site_container_width'; // Used as id in gfont link
			var css_class       = $( '.' + class_name );			
			
			if (chromax_site_container_width >= 768 && chromax_site_container_width < 2000){
				var head_append     = '<style class="' + class_name + '">.dt-container,.dt_slider .dt_owl_carousel.owl-carousel .owl-nav,.dt_slider .dt_owl_carousel.owl-carousel .owl-dots{ max-width: ' + chromax_site_container_width + 'px;}.header--eight .dt-container{ max-width: calc(' + chromax_site_container_width + 'px + 7.15rem);}</style>';
			}

			if ( css_class.length ) {
				css_class.replaceWith( head_append );
			} else {
				$( 'head' ).append( head_append );
			}
			
		});
		
	} );
	
	/**
	 * Breadcrumb Typography
	 */
	range_live_media_load( 'chromax_breadcrumb_title_size', '.dt_pagetitle .dt_pagetitle_content .title>*, .dt_pagetitle .dt_pagetitle_bigtitle', [ 'font-size' ], 'rem' );
	range_live_media_load( 'chromax_breadcrumb_content_size', '.dt_pagetitle .dt_pagetitle_content .dt_pagetitle_breadcrumb li', [ 'font-size' ], 'rem' );
	
	
	/**
	 * Sidebar width.
	 */
	wp.customize( 'chromax_sidebar_width', function( value ) {		
            'use strict';
            value.bind(
                function( to ){
                    var class_name      = 'customizer-sidebar-width'; // Used as id in gfont link
                    var css_class       = $( '.' + class_name );

                    var sidebar_width   = to;
                    var content_width   = ( 100 - to );

                    var head_append     = '<style class="' + class_name + '">@media (min-width: 992px){#dt-sidebar { max-width: ' + sidebar_width + '%;flex-basis: ' + sidebar_width + '%; } #dt-main { max-width: ' + content_width + '%;flex-basis: ' + content_width + '%; }}</style>';

                    if ( css_class.length ) {
                        css_class.replaceWith( head_append );
                    } else {
                        $( 'head' ).append( head_append );
                    }
                }
            );
        }
    );
	
	
	/**
	 * chromax_widget_ttl_size
	 */
	range_live_media_load( 'chromax_widget_ttl_size', '.dt_widget-area .widget .widget-title,.dt_widget-area .widget .wp-block-heading', [ 'font-size' ], 'px' );
	
	/**
	 * Body font size
	 */
	
	range_live_media_load( 'chromax_body_font_size_option', 'body', [ 'font-size' ], 'px' );
	
	/**
	 * Body Letter Spacing
	 */
	
	range_live_media_load( 'chromax_body_ltr_space_option', 'body', [ 'letter-spacing' ], 'px' );
	
	/**
	 * Body font weight
	 */
	wp.customize( 'chromax_body_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'body' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * Body font style
	 */
	wp.customize( 'chromax_body_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'body' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * Body Text Decoration
	 */
	wp.customize( 'chromax_body_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'body, a' ).css( 'text-decoration', decoration );
		} );
	} );
	/**
	 * Body text tranform
	 */
	wp.customize( 'chromax_body_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'body' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * chromax_body_line_height
	 */
	range_live_media_load( 'chromax_body_line_height_option', 'body', [ 'line-height' ] );
	
	
	/**
	 * H1 font size
	 */
	range_live_media_load( 'chromax_h1_font_size_option', 'h1', [ 'font-size' ], 'px' );
	
	/**
	 * H1 font style
	 */
	wp.customize( 'chromax_h1_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h1' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H1 Text Decoration
	 */
	wp.customize( 'chromax_h1_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h1' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H1 font weight
	 */
	wp.customize( 'chromax_h1_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h1' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H1 text tranform
	 */
	wp.customize( 'chromax_h1_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h1' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H1 line height
	 */
	range_live_media_load( 'chromax_h1_line_height_option', 'h1', [ 'line-height' ] );
	
	/**
	 * H1 Letter Spacing
	 */
	 
	range_live_media_load( 'chromax_h1_ltr_space_option', 'h1', [ 'letter-spacing' ], 'px' );
	
	
	/**
	 * H2 font size
	 */
	range_live_media_load( 'chromax_h2_font_size_option', 'h2', [ 'font-size' ], 'px' );
	
	/**
	 * H2 font style
	 */
	wp.customize( 'chromax_h2_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h2' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H2 Text Decoration
	 */
	wp.customize( 'chromax_h2_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h2' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H2 font weight
	 */
	wp.customize( 'chromax_h2_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h2' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H2 text tranform
	 */
	wp.customize( 'chromax_h2_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h2' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H2 line height
	 */
	range_live_media_load( 'chromax_h2_line_height_option', 'h2', [ 'line-height' ]);
	
	/**
	 * H2 Letter Spacing
	 */
	
	range_live_media_load( 'chromax_h2_ltr_space_option', 'h2', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H3 font size
	 */
	range_live_media_load( 'chromax_h3_font_size_option', 'h3', [ 'font-size' ], 'px' );
	
	/**
	 * H3 font style
	 */
	wp.customize( 'chromax_h3_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h3' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H3 Text Decoration
	 */
	wp.customize( 'chromax_h3_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h3' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H3 font weight
	 */
	wp.customize( 'chromax_h3_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h3' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H3 text tranform
	 */
	wp.customize( 'chromax_h3_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h3' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H3 line height
	 */
	range_live_media_load( 'chromax_h3_line_height_option', 'h3', [ 'line-height' ]);
	
	/**
	 * H3 Letter Spacing
	 */
	
	range_live_media_load( 'chromax_h3_ltr_space_option', 'h3', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H4 font size
	 */
	range_live_media_load( 'chromax_h4_font_size_option', 'h4', [ 'font-size' ], 'px' );
	
	/**
	 * H4 font style
	 */
	wp.customize( 'chromax_h4_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h4' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H4 Text Decoration
	 */
	wp.customize( 'chromax_h4_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h4' ).css( 'text-decoration', decoration );
		} );
	} );
	
	/**
	 * H4 font weight
	 */
	wp.customize( 'chromax_h4_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h4' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H4 text tranform
	 */
	wp.customize( 'chromax_h4_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h4' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H4 line height
	 */
	range_live_media_load( 'chromax_h4_line_height_option', 'h4', [ 'line-height' ]);
	
	/**
	 * H4 Letter Spacing
	 */
	
		range_live_media_load( 'chromax_h4_ltr_space_option', 'h4', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H5 font size
	 */
	range_live_media_load( 'chromax_h5_font_size_option', 'h5', [ 'font-size' ], 'px' );
	
	/**
	 * H5 font style
	 */
	wp.customize( 'chromax_h5_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h5' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H5 Text Decoration
	 */
	wp.customize( 'chromax_h5_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h5' ).css( 'text-decoration', decoration );
		} );
	} );
	
	
	/**
	 * H5 font weight
	 */
	wp.customize( 'chromax_h5_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h5' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H5 text tranform
	 */
	wp.customize( 'chromax_h5_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h5' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H5 line height
	 */
	range_live_media_load( 'chromax_h5_line_height_option', 'h5', [ 'line-height' ]);
	
	/**
	 * H5 Letter Spacing
	 */
	
	range_live_media_load( 'chromax_h5_ltr_space_option', 'h5', [ 'letter-spacing' ], 'px' );
	
	/**
	 * H6 font size
	 */
	range_live_media_load( 'chromax_h6_font_size_option', 'h6', [ 'font-size' ], 'px' );
	
	/**
	 * H6 font style
	 */
	wp.customize( 'chromax_h6_font_style_option', function( value ) {
		value.bind( function( font_style_option ) {
			jQuery( 'h6' ).css( 'font-style', font_style_option );
		} );
	} );
	
	/**
	 * H6 Text Decoration
	 */
	wp.customize( 'chromax_h6_txt_decoration_option', function( value ) {
		value.bind( function( decoration ) {
			jQuery( 'h6' ).css( 'text-decoration', decoration );
		} );
	} );
	
	
	/**
	 * H6 font weight
	 */
	wp.customize( 'chromax_h6_font_weight_option', function( value ) {
		value.bind( function( font_weight_option ) {
			jQuery( 'h6' ).css( 'font-weight', font_weight_option );
		} );
	} );
	
	/**
	 * H6 text tranform
	 */
	wp.customize( 'chromax_h6_text_transform_option', function( value ) {
		value.bind( function( text_tranform ) {
			jQuery( 'h6' ).css( 'text-transform', text_tranform );
		} );
	} );
	
	/**
	 * H6 line height
	 */
	range_live_media_load( 'chromax_h6_line_height_option', 'h6', [ 'line-height' ]);
	
	/**
	 * H6 Letter Spacing
	 */
	
	range_live_media_load( 'chromax_h6_ltr_space_option', 'h6', [ 'letter-spacing' ], 'px' );
	
} )( jQuery );