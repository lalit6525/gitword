<?php
/**
 * Chromax Customizer Class
 *
 * @package Chromax
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 if ( ! class_exists( 'Chromax_Customizer' ) ) :

	class Chromax_Customizer {

		// Constructor customizer
		public function __construct() {
			add_action( 'customize_register',array( $this, 'chromax_customizer_register' ) );
			add_action( 'customize_register',array( $this, 'chromax_customizer_sainitization_selective_refresh' ) );
			add_action( 'customize_register',array( $this, 'chromax_customizer_control' ) );
			add_action( 'customize_preview_init',array( $this, 'chromax_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts',array( $this, 'chromax_customizer_navigation_script' ) );
			add_action( 'after_setup_theme',array( $this, 'chromax_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function chromax_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';
		}
		
		// Register custom controls
		public function chromax_customizer_control( $wp_customize ) {
			
			$chromax_control_dir =  CHROMAX_THEME_INC_DIR . '/customizer/controls';
			
			// Load custom control classes.
			$wp_customize->register_control_type( 'Chromax_Customizer_Range_Control' );
			require $chromax_control_dir . '/code/chromax-slider-control.php';
			require $chromax_control_dir . '/code/chromax-icon-picker-control.php';
			require $chromax_control_dir . '/code/chromax-category-dropdown-control.php';
			require $chromax_control_dir . '/code/editor/class/class-chromax-page-editor.php';

		}
		
		// selective refresh.
		public function chromax_customizer_sainitization_selective_refresh() {

			require CHROMAX_THEME_INC_DIR . '/customizer/sanitization.php';

		}

		// Theme Customizer preview reload changes asynchronously.
		public function chromax_customize_preview_js() {
			wp_enqueue_script( 'chromax-customizer', CHROMAX_THEME_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), CHROMAX_THEME_VERSION, true );
		}
		
		public function chromax_customizer_navigation_script() {
			 wp_enqueue_script( 'chromax-customizer-section', CHROMAX_THEME_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}
		

		// Include customizer settings.
			
		public function chromax_customizer_settings() {
			// Recommended Plugin
			require CHROMAX_THEME_INC_DIR . '/customizer/customizer-plugin-notice/chromax-notify-plugin.php';
			
			// Upsale
			require CHROMAX_THEME_INC_DIR . '/customizer/controls/code/upgrade/class-customize.php';
			
			$chromax_customize_dir =  CHROMAX_THEME_INC_DIR . '/customizer/customizer-settings';
			require $chromax_customize_dir . '/chromax-header-customize-setting.php';
			require $chromax_customize_dir . '/chromax-footer-customize-setting.php';
			require $chromax_customize_dir . '/chromax-theme-customize-setting.php';
			require $chromax_customize_dir . '/chromax-typography-customize-setting.php';
			require CHROMAX_THEME_INC_DIR . '/customizer/chromax-selective-partial.php';
			require CHROMAX_THEME_INC_DIR . '/customizer/chromax-selective-refresh.php';
		}

	}
endif;
new Chromax_Customizer();