<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Chromax
 */
get_header();
?>
<section id="dt_not_found" class="dt_not_found" data-background="<?php echo esc_url(get_template_directory_uri() . '/assets/images/error_bg.jpg');?>">
	<div class="dt-container">
		<div class="dt-row dt-g-4">
			<div class="dt-col-lg-12 dt-col-sm-12 dt-col-12">
				<div class="dt-not-found-content">
				
					<h2><?php esc_html_e('404','chromax'); ?></h2>
					
					<h4><?php esc_html_e('Page not found','chromax'); ?></h4>
					
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="dt-btn dt-btn-primary"><?php esc_html_e('Back To Home','chromax'); ?></a>
					
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>