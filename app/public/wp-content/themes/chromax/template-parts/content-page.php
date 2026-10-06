<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chromax
 */
$chromax_enable_post_excerpt	= get_theme_mod('chromax_enable_post_excerpt','1'); 
$chromax_enable_post_cat		= get_theme_mod('chromax_enable_post_cat','1'); 
$chromax_enable_post_date		= get_theme_mod('chromax_enable_post_date','1'); 
$chromax_enable_post_author		= get_theme_mod('chromax_enable_post_author','1'); 
$chromax_enable_post_comments	= get_theme_mod('chromax_enable_post_comments'); 
$chromax_enable_post_views		= get_theme_mod('chromax_enable_post_views'); 
$chromax_enable_post_rt			= get_theme_mod('chromax_enable_post_rt'); 
$chromax_enable_post_tag		= get_theme_mod('chromax_enable_post_tag'); 
$chromax_enable_post_ttl		= get_theme_mod('chromax_enable_post_ttl','1'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('dt_post_item'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="image">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
			<?php the_post_thumbnail(); ?>
		</div>
	<?php } ?>
	<div class="inner">
		<?php if($chromax_enable_post_date=='1'): ?>
		<div class="meta-up">
			<div class="date">
				<?php echo esc_html(get_the_date('d/')); ?><span><?php echo esc_html(get_the_date('m/ Y')); ?></span>
			</div>
		</div>
		<?php endif; ?>
		<div class="meta">
			<ul>
				<?php if($chromax_enable_post_author=='1'): ?>
					<li>
						<div class="author">                                                    
							<i class="far fa-user" aria-hidden="true"></i>
							<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php esc_html(the_author()); ?></a>
						</div>
					</li>
				<?php endif; ?>
				
				<?php if($chromax_enable_post_comments=='1'): ?>
					<li>
						<div class="comments">
							<i class="far fa-comments" aria-hidden="true"></i> 
							<span><?php echo esc_html(get_comments_number($post->ID)); ?></span>
						</div>
					</li>    
				<?php endif; ?>
				
				<?php if($chromax_enable_post_cat=='1'): ?>	
					<li>
						<div class="category">
							<i class="far fa-tags" aria-hidden="true"></i> 
							<a href="<?php echo esc_url( get_permalink() ); ?>" rel="category tag"><?php the_category(' , '); ?></a>
						</div>
					</li>
				<?php endif; ?>
				
				<?php if($chromax_enable_post_views=='1'): ?>
					<li><i class="far fa-eye"></i> <?php echo wp_kses_post(chromax_get_post_view(get_the_ID())); ?></li>
				<?php endif; ?>	
				
				<?php if($chromax_enable_post_rt=='1'): ?>
					<li><i class="fa-solid fa-eye"></i> <?php echo esc_html(chromax_read_time()); ?></li>
				<?php endif; ?>
				
				<?php if($chromax_enable_post_tag=='1'): ?>
					<li>
						<i class="fa-solid fa-tag"></i>
					<?php
						$posttags = get_tags();
						if($posttags):
							foreach($posttags as $index=>$tag){
								echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">' .esc_html($tag->name). '</a>, ';
								 if($index>7){break;}
							}
						endif; 
					 ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php     
			if($chromax_enable_post_ttl=='1'):
				if ( is_single() ) :
				
				the_title('<h5 class="title">', '</h5>' );
				
				else:
				
				the_title( sprintf( '<h5 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
				
				endif; 
			endif; 
		?> 
		<div class="content">
			<?php 
			  if($chromax_enable_post_excerpt == '1' && !is_single()):
			  
				the_excerpt();
				if ( function_exists( 'chromax_execerpt_btn' ) ) : chromax_execerpt_btn(); endif; 
				
				else:
				
				the_content( 
						sprintf( 
							__( 'Read More', 'chromax' ), 
							'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
						) 
					);
					
				endif;	
			?>
		</div>
	</div>
</article>