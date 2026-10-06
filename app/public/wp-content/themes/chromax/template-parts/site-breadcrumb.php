<?php 
$chromax_hs_site_breadcrumb     = get_theme_mod('chromax_hs_site_breadcrumb','1');
$chromax_breadcrumb_bg_img		= get_theme_mod('chromax_breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/pagetitle.jpg'));	
$chromax_breadcrumb_type    	= get_theme_mod('chromax_breadcrumb_type','theme');
if($chromax_hs_site_breadcrumb == '1'):	
?>
<section id="dt_pagetitle" class="dt_pagetitle dt-text-center">
	<?php if($chromax_breadcrumb_type == 'yoast' && (function_exists('yoast_breadcrumb'))):  yoast_breadcrumb(); ?>
		<?php elseif($chromax_breadcrumb_type == 'rankmath' && (function_exists('rank_math_the_breadcrumbs'))):  rank_math_the_breadcrumbs(); ?>	
		<?php elseif($chromax_breadcrumb_type == 'navxt' && (function_exists('bcn_display'))):  bcn_display(); else: ?>
		<?php
			echo '<div class="dt_pagetitle_bigtitle">'; echo single_post_title(); echo '</div>';
			
		?>
	<?php endif; ?>			
	<div class="dt_pagetitle_bgimage" data-background="<?php echo esc_url($chromax_breadcrumb_bg_img); ?>"></div>
	<div class="dt-container">
		<div class="dt_pagetitle_content">
			<?php if($chromax_breadcrumb_type == 'yoast' && (function_exists('yoast_breadcrumb'))):  yoast_breadcrumb(); ?>
			<?php elseif($chromax_breadcrumb_type == 'rankmath' && (function_exists('rank_math_the_breadcrumbs'))):  rank_math_the_breadcrumbs(); ?>	
			<?php elseif($chromax_breadcrumb_type == 'navxt' && (function_exists('bcn_display'))):  bcn_display(); else: ?>
				<div class="title">
					<?php
						if(is_home() || is_front_page()) {
							echo '<h1>'; echo single_post_title(); echo '</h1>';
						} else {
							chromax_theme_page_header_title();
						} 
					?>
				</div>
				<ul class="dt_pagetitle_breadcrumb">
					<?php chromax_page_header_breadcrumbs(); ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>	