<?php
/*
 *  Customizer Notifications
 */
require get_template_directory() . '/inc/customizer/customizer-plugin-notice/chromax-customizer-notify.php';
$chromax_config_customizer = array(
    'recommended_plugins' => array( 
        'desert-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the features and sections of the Theme. please install and activate %s plugin', 'chromax' ), '<strong>Desert Companion</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'chromax' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'chromax' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'chromax' ),
	'activate_button_label'     => esc_html__( 'Activate', 'chromax' ),
	'chromax_deactivate_button_label'   => esc_html__( 'Deactivate', 'chromax' ),
);
Chromax_Customizer_Notify::init( apply_filters( 'chromax_customizer_notify_array', $chromax_config_customizer ) );