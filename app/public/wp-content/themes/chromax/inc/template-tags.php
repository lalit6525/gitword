<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Chromax
 */

/**
 * Theme Page Header Title
*/
function chromax_theme_page_header_title(){
	if( is_archive() )
	{
		echo '<h1>';
		if ( is_day() ) :
		/* translators: %1$s %2$s: date */	
		  printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('Archives','chromax'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */	
		  printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('Archives','chromax'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */	
		  printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('Archives','chromax'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */	
			printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('All posts by','chromax'), get_the_author() );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */	
			printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('Category','chromax'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */	
			printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('Tag','chromax'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */	
			printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('Shop','chromax'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		endif;
		echo '</h1>';
	}
	elseif( is_404() )
	{
		echo '<h1>';
		/* translators: %1$s: 404 */	
		printf( esc_html__( '%1$s ', 'chromax' ) , esc_html__('404','chromax') );
		echo '</h1>';
	}
	elseif( is_search() )
	{
		echo '<h1>';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'chromax' ), esc_html__('Search results for','chromax'), get_search_query() );
		echo '</h1>';
	}
	else
	{
		echo '<h1>'.esc_html( get_the_title() ).'</h1>';
	}
}


/**
 * Theme Breadcrumbs Url
*/
function chromax_page_url() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}


/**
 * Theme Breadcrumbs
*/
if( !function_exists('chromax_page_header_breadcrumbs') ) :
	function chromax_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = home_url();
								
		/* ---------- Front page ---------- */
		if ( is_front_page() ) :
			echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','chromax').'</a></li>';
			echo '<li class="breadcrumb-item active">' . get_bloginfo('name') . '</li>';

		/* ---------- Blog (latest posts) page ---------- */
		elseif ( is_home() ) :
			echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','chromax').'</a></li>';
			$posts_page_id = get_option('page_for_posts');
			if ( $posts_page_id ) {
				echo '<li class="breadcrumb-item active">'. get_the_title($posts_page_id) .'</li>';
			} else {
				echo '<li class="breadcrumb-item active">'. __('Blog','chromax') .'</li>';
			}

		else:
			echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','chromax').'</a></li>';

			/* ---------- WooCommerce Shop page ---------- */
			if ( function_exists('is_shop') && is_shop() ) {
				$shop_id = wc_get_page_id('shop');
				if ($shop_id > 0) {
					echo '<li class="breadcrumb-item active"><a href="'. get_permalink($shop_id) .'">'. get_the_title($shop_id) .'</a></li>';
				}

			/* ---------- WooCommerce Product Category ---------- */
			} elseif ( function_exists('is_product_category') && is_product_category() ) {
				$current_cat = get_queried_object();
				echo '<li class="breadcrumb-item"><a href="'. get_permalink( wc_get_page_id('shop') ) .'">'. get_the_title( wc_get_page_id('shop') ) .'</a></li>';
				echo '<li class="breadcrumb-item active"><a href="'. get_term_link($current_cat) .'">'. $current_cat->name .'</a></li>';

			/* ---------- Blog Category ---------- */
			} elseif ( is_category() ) {
			    echo '<li class="breadcrumb-item active"><a href="'. get_category_link(get_queried_object_id()) .'">' . single_cat_title('', false) . '</a></li>';

			/* ---------- Date Archives ---------- */
			} elseif ( is_day() ) {
				echo '<li class="breadcrumb-item"><a href="'. get_year_link(get_the_time('Y')) . '">'. get_the_time('Y') .'</a></li>';
				echo '<li class="breadcrumb-item"><a href="'. get_month_link(get_the_time('Y'),get_the_time('m')) .'">'. get_the_time('F') .'</a></li>';
				echo '<li class="breadcrumb-item active">'. get_the_time('d') .'</li>';

			} elseif ( is_month() ) {
				echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
				echo '<li class="breadcrumb-item active">'. get_the_time('F') .'</li>';

			} elseif ( is_year() ) {
			    echo '<li class="breadcrumb-item active">'. get_the_time('Y') .'</li>';

			/* ---------- WooCommerce Single Product ---------- */
			} elseif ( is_single() && get_post_type() == 'product' ) {
				$shop_id = wc_get_page_id('shop');
				if ($shop_id > 0) {
					echo '<li class="breadcrumb-item"><a href="'. get_permalink($shop_id) .'">'. get_the_title($shop_id) .'</a></li>';
				}

				// show product category
				$terms = get_the_terms( get_the_ID(), 'product_cat' );
				if ( $terms && ! is_wp_error( $terms ) ) {
					$first_term = current($terms);
					echo '<li class="breadcrumb-item"><a href="'. get_term_link($first_term) .'">'. $first_term->name .'</a></li>';
				}

				echo '<li class="breadcrumb-item active">'. get_the_title() .'</li>';

			/* ---------- WordPress Normal Page with Parents ---------- */
			} elseif ( is_page() && $post->post_parent ) {
			    $parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb;
				    echo '<li class="breadcrumb-item active">'. get_the_title() .'</li>';

			/* ---------- Search ---------- */
			} elseif( is_search() ) {
			    echo '<li class="breadcrumb-item active">'. sprintf( __('Search results for: %s','chromax'), get_search_query() ) .'</li>';

			/* ---------- 404 ---------- */
			} elseif( is_404() ) {
				echo '<li class="breadcrumb-item active">'.__('Error 404','chromax').'</li>';

			/* ---------- Default ---------- */
			} else { 
			    echo '<li class="breadcrumb-item active">'. get_the_title() .'</li>';
			}
		endif;
    }
endif;

// Chromax Excerpt Read More
if ( ! function_exists( 'chromax_execerpt_btn' ) ) :
function chromax_execerpt_btn() {
	$chromax_show_post_btn		= get_theme_mod('chromax_show_post_btn','1'); 
	$chromax_read_btn_txt		= get_theme_mod('chromax_read_btn_txt','Read more'); 
	if ( $chromax_show_post_btn == '1' ) {
	?>
	<a href="<?php echo esc_url(get_the_permalink()); ?>" class="more-link"><?php echo wp_kses_post($chromax_read_btn_txt); ?></a>
<?php }
	} 
endif;

// Chromax excerpt length
function chromax_site_excerpt_length( $length ) {
	 $chromax_post_excerpt_length= get_theme_mod('chromax_post_excerpt_length','30'); 
    if( $chromax_post_excerpt_length == 1000 ) {
        return 9999;
    }
    return esc_html( $chromax_post_excerpt_length );
}
add_filter( 'excerpt_length', 'chromax_site_excerpt_length', 999 );



// Chromax excerpt more
function chromax_site_excerpt_more( $more ) {
	return get_theme_mod('chromax_blog_excerpt_more','&hellip;');;
}
add_filter( 'excerpt_more', 'chromax_site_excerpt_more' );

/*=========================================
Register Google fonts for Chromax.
=========================================*/
function chromax_google_fonts_url() {
	
    $font_families = array('Space+Grotesk:wght@300;400;500;600;700;800;900');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

function chromax_google_fonts_scripts_styles() {
    wp_enqueue_style( 'chromax-google-fonts', chromax_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'chromax_google_fonts_scripts_styles' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function chromax_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	return $classes;
}
add_filter( 'body_class', 'chromax_body_classes' );

function chromax_post_classes( $classes ) {
	if ( is_single() ) : 
	$classes[]='single-post'; 
	endif;
	return $classes;
}
add_filter( 'post_class', 'chromax_post_classes' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 *
	 * @since 1.0.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('chromax_str_replace_assoc')) {

    /**
     * chromax_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function chromax_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

/*=========================================
Chromax Site Preloader
=========================================*/
if ( ! function_exists( 'chromax_site_preloader' ) ) :
function chromax_site_preloader() {
	$chromax_hs_preloader_option 	= get_theme_mod( 'chromax_hs_preloader_option','1'); 
	if($chromax_hs_preloader_option == '1') { 
	?>
		<div id="dt_preloader" class="dt_preloader">
			<button type="button" class="dt_preloader-close site--close"></button>
			<div class="dt_preloader-animation">
				<div class="dt_preloader-spinner"></div>
				<div class="dt_preloader-text">
					<?php 
						$chromax_preloader_string = get_bloginfo('name');
						//Using the explode method
						$chromax_preloader_arr_string = str_split($chromax_preloader_string);

						//foreach loop to display the returned array
						foreach($chromax_preloader_arr_string as $str){
							echo sprintf(__('<span class="splitted" data-char=%1$s>%1$s</span>', 'chromax'),$str);
						}
					?>
				</div>
				<p class="text-center"><?php esc_html_e('Loading','chromax'); ?></p>
			</div>
			<div class="loader">
				<div class="dt-row">
					<div class="dt-col-3 loader-section section-left">
						<div class="bg"></div>
					</div>
					<div class="dt-col-3 loader-section section-left">
						<div class="bg"></div>
					</div>
					<div class="dt-col-3 loader-section section-right">
						<div class="bg"></div>
					</div>
					<div class="dt-col-3 loader-section section-right">
						<div class="bg"></div>
					</div>
				</div>
			</div>
		</div>
	<?php }
	} 
endif;
add_action( 'chromax_site_preloader', 'chromax_site_preloader' );



/*=========================================
Chromax Site Header
=========================================*/
if ( ! function_exists( 'chromax_site_main_header' ) ) :
function chromax_site_main_header() {
	get_template_part('template-parts/site','header');
} 
endif;
add_action( 'chromax_site_main_header', 'chromax_site_main_header' );



/*=========================================
Chromax Header Image
=========================================*/
if ( ! function_exists( 'chromax_wp_hdr_image' ) ) :
function chromax_wp_hdr_image() {
	if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-header" id="custom-header" rel="home">
		<img src="<?php echo esc_url(get_header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>
<?php endif;
	} 
endif;
add_action( 'chromax_wp_hdr_image', 'chromax_wp_hdr_image' );


/*=========================================
Chromax Header Email
=========================================*/
if ( ! function_exists( 'chromax_header_email' ) ) :
function chromax_header_email() {
	$chromax_hs_hdr_email 	= get_theme_mod( 'chromax_hs_hdr_email','1'); 
	$chromax_hdr_email_icon 	= get_theme_mod( 'chromax_hdr_email_icon','far fa-envelope-open'); 
	$chromax_hdr_email_title = get_theme_mod( 'chromax_hdr_email_title','info@example.com');
	$chromax_hdr_email_link 	= get_theme_mod( 'chromax_hdr_email_link','mailto:info@example.com');
	if($chromax_hs_hdr_email=='1'): ?>
		<aside class="widget widget_contact email">
			<div class="contact__list">
				<?php if(!empty($chromax_hdr_email_icon)): ?>
					<i class="<?php echo esc_attr($chromax_hdr_email_icon); ?>" aria-hidden="true"></i>  
				<?php endif; ?>   
				<?php if(!empty($chromax_hdr_email_title)): ?>
					<div class="contact__body">
						<?php if(!empty($chromax_hdr_email_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($chromax_hdr_email_link); ?>"><?php echo wp_kses_post($chromax_hdr_email_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($chromax_hdr_email_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'chromax_header_email', 'chromax_header_email' );


/*=========================================
Chromax Header Address
=========================================*/
if ( ! function_exists( 'chromax_header_address' ) ) :
function chromax_header_address() {
	$chromax_hs_hdr_top_ads 	= get_theme_mod( 'chromax_hs_hdr_top_ads','1'); 
	$chromax_hdr_top_ads_icon= get_theme_mod( 'chromax_hdr_top_ads_icon','fas fa-location-arrow'); 
	$chromax_hdr_top_ads_title = get_theme_mod( 'chromax_hdr_top_ads_title','60 Golden Street, New York');
	$chromax_hdr_top_ads_link = get_theme_mod( 'chromax_hdr_top_ads_link');
	if($chromax_hs_hdr_top_ads=='1'): ?>
		<aside class="widget widget_contact address">
			<div class="contact__list">
				<?php if(!empty($chromax_hdr_top_ads_icon)): ?>
					<i class="<?php echo esc_attr($chromax_hdr_top_ads_icon); ?>" aria-hidden="true"></i>    
				<?php endif; ?>  
				<?php if(!empty($chromax_hdr_top_ads_title)): ?>
					<div class="contact__body">
						<?php if(!empty($chromax_hdr_top_ads_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($chromax_hdr_top_ads_link); ?>"><?php echo wp_kses_post($chromax_hdr_top_ads_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($chromax_hdr_top_ads_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'chromax_header_address', 'chromax_header_address' );


/*=========================================
Chromax Header Time
=========================================*/
if ( ! function_exists( 'chromax_header_time' ) ) :
function chromax_header_time() {
	$chromax_hs_hdr_time 	= get_theme_mod( 'chromax_hs_hdr_time','1'); 
	$chromax_hdr_time_icon= get_theme_mod( 'chromax_hdr_time_icon','far fa-clock'); 
	$chromax_hdr_time_title = get_theme_mod( 'chromax_hdr_time_title','Mon-Sat: 9.00am To 7.00pm');
	$chromax_hdr_time_link = get_theme_mod( 'chromax_hdr_time_link');
	if($chromax_hs_hdr_time=='1'): ?>
		<aside class="widget widget_contact time">
			<div class="contact__list">
				<?php if(!empty($chromax_hdr_time_icon)): ?>
					<i class="<?php echo esc_attr($chromax_hdr_time_icon); ?>" aria-hidden="true"></i>    
				<?php endif; ?>  
				<?php if(!empty($chromax_hdr_time_title)): ?>
					<div class="contact__body">
						<?php if(!empty($chromax_hdr_time_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($chromax_hdr_time_link); ?>"><?php echo wp_kses_post($chromax_hdr_time_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($chromax_hdr_time_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'chromax_header_time', 'chromax_header_time' );

/*
 *
 * Social Icon
 */
function chromax_get_social_icon_default() {
	return apply_filters(
		'chromax_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-facebook-f', 'chromax' ),
					'link'	  =>  esc_url( '#'),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-google-plus-g', 'chromax' ),
					'link'	  =>  esc_url( '#'),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-x-twitter', 'chromax' ),
					'link'	  =>  esc_url( '#'),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-tiktok', 'chromax' ),
					'link'	  =>  esc_url( '#'),
					'id'              => 'customizer_repeater_header_social_005',
				)
			)
		)
	);
}

/*=========================================
Chromax Social Icon
=========================================*/
if ( ! function_exists( 'chromax_site_social' ) ) :
function chromax_site_social() {
	// Social 
	$chromax_hs_hdr_social 	= get_theme_mod( 'chromax_hs_hdr_social','1'); 
	$chromax_hdr_social 		= get_theme_mod( 'chromax_hdr_social',chromax_get_social_icon_default());
	if($chromax_hs_hdr_social=='1'): ?>
		<aside class="widget widget_social">
			<ul>
				<?php
					$chromax_hdr_social = json_decode($chromax_hdr_social);
					if( $chromax_hdr_social!='' )
					{
					foreach($chromax_hdr_social as $item){	
					$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'chromax_translate_single_string', $item->icon_value, 'Header section' ) : '';	
					$social_link = ! empty( $item->link ) ? apply_filters( 'chromax_translate_single_string', $item->link, 'Header section' ) : '';
				?>
					<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a></li>
				<?php }} ?>
			</ul>
		</aside>
	<?php endif;
} 
endif;
add_action( 'chromax_site_social', 'chromax_site_social' );

/*=========================================
Chromax Site Header
=========================================*/
if ( ! function_exists( 'chromax_site_header' ) ) :
function chromax_site_header() {
$chromax_hs_hdr 	= get_theme_mod( 'chromax_hs_hdr','1');
if($chromax_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">                                
				<div class="dt-col-lg-6 dt-col-12">
					<div class="widget--left dt-text-lg-left">
						<?php  do_action('chromax_header_email'); ?>
						<?php  do_action('chromax_header_time'); ?>
					</div>
				</div>
				<div class="dt-col-lg-6 dt-col-12">
					<div class="widget--right dt-text-lg-right">
						<?php  do_action('chromax_header_address'); ?> 
						<?php  do_action('chromax_site_social'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'chromax_site_header', 'chromax_site_header' );



/*=========================================
Chromax Site Navigation
=========================================*/
if ( ! function_exists( 'chromax_site_header_navigation' ) ) :
function chromax_site_header_navigation() {
	wp_nav_menu( 
		array(  
			'theme_location' => 'primary_menu',
			'container'  => '',
			'menu_class' => 'dt_navbar-mainmenu',
			'fallback_cb' => 'chromax_fallback_page_menu',
			'walker' => new WP_Bootstrap_Navwalker()
			 ) 
		);
	} 
endif;
add_action( 'chromax_site_header_navigation', 'chromax_site_header_navigation' );


/*=========================================
Chromax Header Button
=========================================*/
if ( ! function_exists( 'chromax_header_button' ) ) :
function chromax_header_button() {
	$chromax_hs_hdr_btn 		= get_theme_mod( 'chromax_hs_hdr_btn','1'); 
	$chromax_hdr_btn_icon 		= get_theme_mod( 'chromax_hdr_btn_icon','fal fa-arrow-right-long'); 
	$chromax_hdr_btn_lbl 		= get_theme_mod( 'chromax_hdr_btn_lbl','Get A Quote'); 
	$chromax_hdr_btn_link 		= get_theme_mod( 'chromax_hdr_btn_link','#'); 
	$chromax_hdr_btn_target 		= get_theme_mod( 'chromax_hdr_btn_target');
	if($chromax_hdr_btn_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($chromax_hs_hdr_btn=='1'  && !empty($chromax_hdr_btn_lbl)):	
?>
	<li class="dt_navbar-button-item">
		<a href="<?php echo esc_url($chromax_hdr_btn_link); ?>" <?php echo esc_attr($target); ?> class="dt-btn dt-btn-primary"><?php echo wp_kses_post($chromax_hdr_btn_lbl); ?> <i class="<?php echo esc_attr($chromax_hdr_btn_icon); ?>"></i></a>
	</li>
<?php endif;
	} 
endif;
add_action( 'chromax_header_button', 'chromax_header_button' );


/*=========================================
Chromax Header Contact
=========================================*/
if ( ! function_exists( 'chromax_header_contact' ) ) :
function chromax_header_contact() {
	$chromax_hs_hdr_contact 		= get_theme_mod( 'chromax_hs_hdr_contact','1'); 
	$chromax_hdr_contact_icon 		= get_theme_mod( 'chromax_hdr_contact_icon','fas fa-phone-volume'); 
	$chromax_hdr_contact_ttl 		= get_theme_mod( 'chromax_hdr_contact_ttl','Call Anytime'); 
	$chromax_hdr_contact_txt 		= get_theme_mod( 'chromax_hdr_contact_txt','<a href="tel:+1237878222">+123 7878 222</a>'); 
	if($chromax_hs_hdr_contact=='1'):	
?>
	<li class="dt_navbar-info-contact">
		<aside class="widget widget_contact">
			<div class="contact__list">
				<?php if(!empty($chromax_hdr_contact_icon)): ?>
					<i class="<?php echo esc_attr($chromax_hdr_contact_icon); ?>" aria-hidden="true"></i>
				<?php endif; ?>	
				<div class="contact__body one">
					<?php if(!empty($chromax_hdr_contact_ttl)): ?>
						<h6 class="title"><?php echo wp_kses_post($chromax_hdr_contact_ttl); ?></h6>
					<?php endif; ?>
					<?php if(!empty($chromax_hdr_contact_txt)): ?>
						<p class="description"><?php echo wp_kses_post($chromax_hdr_contact_txt); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</aside>
	</li>
<?php endif;
	} 
endif;
add_action( 'chromax_header_contact', 'chromax_header_contact' );

/*=========================================
Chromax Site Search
=========================================*/
if ( ! function_exists( 'chromax_site_main_search' ) ) :
function chromax_site_main_search() {
	$chromax_hs_hdr_search 	= get_theme_mod( 'chromax_hs_hdr_search','1'); 
	$chromax_search_result 	= get_theme_mod( 'chromax_search_result','post');
	if($chromax_hs_hdr_search=='1'):	
?>
<li class="dt_navbar-search-item">
	<button type="button" class="dt_navbar-search-toggle"><i class="far fa-magnifying-glass" aria-hidden="true"></i></button>
	<div class="dt_search search--header">
		<form method="get" class="dt_search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'search again', 'chromax' ); ?>">
			<label for="dt_search-form-1">
				<?php if($chromax_search_result=='product' && class_exists('WooCommerce')):	?>
					<input type="hidden" name="post_type" value="product" />
				 <?php endif; ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'chromax' ); ?></span>
				<input type="search" id="dt_search-form-1" class="dt_search-field" placeholder="<?php esc_attr_e( 'search Here', 'chromax' ); ?>" value="" name="s" />
			</label>
			<button type="submit" class="dt_search-submit search-submit"><i class="far fa-magnifying-glass" aria-hidden="true"></i></button>
		</form>
		<button type="button" class="dt_search-close"><i class="far fa-arrow-up" aria-hidden="true"></i></button>
	</div>
</li>
<?php endif;
	} 
endif;
add_action( 'chromax_site_main_search', 'chromax_site_main_search' );



/*=========================================
Chromax WooCommerce Cart
=========================================*/
if ( ! function_exists( 'chromax_woo_cart' ) ) :
function chromax_woo_cart() {
	$chromax_hs_hdr_cart 	= get_theme_mod( 'chromax_hs_hdr_cart','1'); 
		if($chromax_hs_hdr_cart=='1' && class_exists( 'WooCommerce' )):	
	?>
	<li class="dt_navbar-cart-item">
		<a href="javascript:void(0);" class="dt_navbar-cart-icon">
			<span class="cart_icon">
				<i class="far fa-cart-shopping" aria-hidden="true"></i>
			</span>
			<?php 
				$count = WC()->cart->cart_contents_count;
				
				if ( $count > 0 ) {
				?>
					 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
				<?php 
				}
				else {
					?>
					<strong class="cart_count"><?php  esc_html_e('0','chromax'); ?></strong>
					<?php 
				}
		?>
		</a>
		<div class="dt_navbar-shopcart">
			<?php get_template_part('woocommerce/cart/mini','cart'); ?>
		</div>
	</li>
	<?php endif; 
	} 
endif;
add_action( 'chromax_woo_cart', 'chromax_woo_cart' );


 /**
 * Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
 */
function chromax_woo_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count; 
    ?> 
	<?php 
			$count = WC()->cart->cart_contents_count;
			
			if ( $count > 0 ) {
			?>
				 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
			<?php 
			}
			else {
				?>
				<strong class="cart_count"><?php esc_html_e('0','chromax'); ?></strong>
				<?php 
			}
	?>
	<?php
 
    $fragments['.cart_count'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'chromax_woo_add_to_cart_fragment' );


/*=========================================
Chromax My Account
=========================================*/
if ( ! function_exists( 'chromax_hdr_account' ) ) {
	function chromax_hdr_account() {	
		$chromax_hs_hdr_account 		= get_theme_mod( 'chromax_hs_hdr_account','1');
		if($chromax_hs_hdr_account=='1'): ?>
			<li class="dt_navbar-user-item">
				<?php if(is_user_logged_in()): ?>
					<a href="<?php echo esc_url(wp_logout_url( home_url())); ?>" class="dt_user_btn"><i class="fas fa-user"></i></a>
				<?php else: ?>
					<a href="<?php echo esc_url(wp_login_url( home_url())); ?>" class="dt_user_btn"><i class="fas fa-user"></i></a>
				<?php endif; ?>
			</li>
		<?php endif;
	}
}
add_action( 'chromax_hdr_account', 'chromax_hdr_account' );

/*=========================================
Chromax Site Logo
=========================================*/
if ( ! function_exists( 'chromax_site_logo' ) ) :
function chromax_site_logo() {
	$chromax_title_tagline_seo = get_theme_mod( 'chromax_title_tagline_seo');
		if(has_custom_logo())
			{	
				the_custom_logo();
			}
			else { 
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site--title">
				<h4 class="site-title">
					<?php 
						echo esc_html(get_bloginfo('name'));
					?>
				</h4>
			</a>	
		<?php 						
			}
		?>
		<?php if($chromax_title_tagline_seo=='1'): ?>	
			<h1 class="site-title" style="display: none;">
				<?php 
					echo esc_html(get_bloginfo('name'));
				?>
			</h1>
		<?php
			endif;
			$chromax_description = get_bloginfo( 'description');
			if ($chromax_description) : ?>
				<p class="site-description"><?php echo esc_html($chromax_description); ?></p>
		<?php endif;
	} 
endif;
add_action( 'chromax_site_logo', 'chromax_site_logo' );

/*=========================================
Chromax Footer Widget
=========================================*/
if ( ! function_exists( 'chromax_footer_widget' ) ) :
function chromax_footer_widget() {
	$chromax_footer_mid_ttl			= get_theme_mod('chromax_footer_mid_ttl','LET’S GET In TOUCH'); 
	$chromax_footer_mid_link		= get_theme_mod('chromax_footer_mid_link','#'); 
	$chromax_footer_mid_target		= get_theme_mod('chromax_footer_mid_target'); 
	$chromax_footer_widget_column	= get_theme_mod('chromax_footer_widget_column','4'); 
	if($chromax_footer_mid_target=='1'): $target='target=_blank'; else: $target=''; endif;
		if ($chromax_footer_widget_column == '4') {
				$column = '3';
			} elseif ($chromax_footer_widget_column == '3') {
				$column = '4';
			} elseif ($chromax_footer_widget_column == '2') {
				$column = '6';
			} else{
				$column = '12';
			}
	?>
	<div class="dt_footer_middle">
		<div class="dt-container">
			<?php if(!empty($chromax_footer_mid_ttl)): ?>
				<div class="dt-row">
                    <div class="dt-col-lg-12 dt-col-sm-12 dt-col-12 wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1000ms">
                        <div class="dt-footer-slug">
                            <h3 class="bounce-text" data-bounce-color="#ffffff"><a href="<?php echo esc_url($chromax_footer_mid_link); ?>" <?php echo esc_attr($target); ?>><?php echo wp_kses_post($chromax_footer_mid_ttl); ?></a></h3>
                        </div>
                    </div>
                </div>
			<?php endif; 
			if($chromax_footer_widget_column !==''): 
			?>
			<div class="dt-row dt-g-lg-4 dt-g-5">
				<?php if ( is_active_sidebar( 'chromax-footer-widget-1' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'chromax-footer-widget-1'); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'chromax-footer-widget-2' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'chromax-footer-widget-2'); ?>	
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'chromax-footer-widget-3' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'chromax-footer-widget-3'); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'chromax-footer-widget-4' ) ) : ?>
					<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'chromax-footer-widget-4'); ?>
					</div>
				<?php endif; ?>	
			</div>
			<?php endif; ?>	
		</div>
	</div>
	<?php 
	 } 
endif;
add_action( 'chromax_footer_widget', 'chromax_footer_widget' );


/*=========================================
Chromax Footer Bottom
=========================================*/
if ( ! function_exists( 'chromax_footer_bottom' ) ) :
function chromax_footer_bottom() {
	?>
	<div class="dt_footer_copyright">
		<div class="dt-container">
			<div class="dt-row dt-g-4 dt-mt-0">
				<div class="dt-col-md-12 dt-col-sm-12 dt-text-sm-center dt-text-center">
					<?php do_action('chromax_footer_copyright_data'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
	} 
endif;
add_action( 'chromax_footer_bottom', 'chromax_footer_bottom' );

/*=========================================
Chromax Footer Copyright
=========================================*/
if ( ! function_exists( 'chromax_footer_copyright_data' ) ) :
function chromax_footer_copyright_data() {
	$chromax_footer_copyright_text = get_theme_mod('chromax_footer_copyright_text','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
	?>
	<?php if(!empty($chromax_footer_copyright_text)): 
			$chromax_copyright_allowed_tags = array(
				'[current_year]' => date_i18n('Y'),
				'[site_title]'   => get_bloginfo('name'),
				'[theme_author]' => sprintf(__('<a href="#">Desert Themes</a>', 'chromax')),
			);
	?>
		<div class="dt_footer_copyright-text">
			<?php
				echo apply_filters('chromax_footer_copyright', wp_kses_post(chromax_str_replace_assoc($chromax_copyright_allowed_tags, $chromax_footer_copyright_text)));
			?>
		</div>
<?php endif;
	} 
endif;
add_action( 'chromax_footer_copyright_data', 'chromax_footer_copyright_data' );


/*=========================================
Chromax Scroller
=========================================*/
if ( ! function_exists( 'chromax_top_scroller' ) ) :
function chromax_top_scroller() {
	$chromax_hs_scroller_option	=	get_theme_mod('chromax_hs_scroller_option','1');
?>		
	<?php if ($chromax_hs_scroller_option == '1') { ?>
		 <button type="button" id="dt_uptop" class="dt_uptop">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: -0.0171453;"></path>
			</svg>
		</button>
	<?php }
	} 
endif;
add_action( 'chromax_top_scroller', 'chromax_top_scroller' );

function chromax_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'chromax_page_menu_args' );
function chromax_fallback_page_menu( $args = array() ) {
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );
	$menu = '';
	$list_args = $args;
	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = 'Home';
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
		{
		$class = 'class="nav-item menu-item active"';
		}
		else
		{
			$class = 'class="nav-item menu-item "';
		}
		$menu .= '<li ' . $class . '><a class="nav-link " href="' . esc_url(home_url( '/' )) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}
	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new chromax_walker_page_menu;
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
	if ( $menu )
		$menu = '<ul class="'. esc_attr($args['menu_class']) .'">' . $menu . '</ul>';

	$menu = $menu . "\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
class chromax_walker_page_menu extends Walker_Page{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<span class='dt_mobilenav-dropdown-toggle'><button type='button' class='fa fa-angle-right' aria-label='Mobile Dropdown Toggle'></button></span><ul class='dropdown-menu default'>\n";
	}
	function start_el( &$output, $page, $depth=0, $args = array(), $current_page = 0 )
	 {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		if($depth === 0)
		{
			$child_class='nav-link';
		}
		else if($depth > 0)
		{
			$child_class='dropdown-item';
		}
		else
		{
			$child_class='';
		}
		extract($args, EXTR_SKIP);
		if($has_children){
			$css_class = array('menu-item page_item dropdown menu-item-has-children', 'page-item-'.$page->ID);
		}else{
			 $css_class = array('menu-item page_item dropdown', 'page-item-'.$page->ID);
		 }
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'nav-item active';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}
		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$output .= $indent . '<li class="nav-item ' . $css_class . '"><a class="' . $child_class . '" href="' . esc_url(get_permalink($page->ID)) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;
			$output .= " " . mysql2date($date_format, $time);
		}
	}
}


// Function to retrieve the post views count
function chromax_get_post_view($post_id) {
    $count = get_post_meta( $post_id, 'post_views_count', true );
    if (!empty($count)) {
        return $count . " views";
    } else {
        return "0 views";
    }
}

// Function to increment the post views count
function chromax_set_post_view() {
    if (is_single()) {  // Only count views on single post page
        $post_id = get_the_ID();
        $key = 'post_views_count';
        $count = (int) get_post_meta( $post_id, $key, true );
        $count++;
        update_post_meta( $post_id, $key, $count );
    }
}
add_action('wp_head', 'chromax_set_post_view');  // Increment views when viewing a single post

// Add custom column for post views in admin posts list
function chromax_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';  // Add "Views" column
    return $columns;
}
add_filter('manage_posts_columns', 'chromax_posts_column_views');

// Display views count in the custom column for posts
function chromax_posts_custom_column_views( $column, $post_id ) {
    if ( $column === 'post_views') {
        echo chromax_get_post_view($post_id);  // Display views in the column
    }
}
add_action( 'manage_posts_custom_column', 'chromax_posts_custom_column_views', 10, 2 ); // Add second argument $post_id


/**
 * Calculate reading time by content length
 *
 * @param string  $text Content to calculate
 * @return int Number of minutes
 * @since  1.0
 */

if ( !function_exists( 'chromax_read_time' ) ):
	function chromax_read_time() {
		global $post;
		$content = get_post_field( 'post_content', $post->ID );
		$word_count = str_word_count( strip_tags( $content ) );
		$readingtime = ceil($word_count / 200);

		if ($readingtime == 1) {
		$timer = " minute Read";
		} else {
		$timer = " minutes Read";
		}
		$totalreadingtime = $readingtime . $timer;

		return $totalreadingtime;
	}
endif;


add_filter( 'woocommerce_show_admin_notice', function ( $show, $notice ) {
    if ( 'template_files' === $notice ) {
        return false;
    }

    return $show;
}, 10, 2 );