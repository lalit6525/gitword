</div></div>
<?php 
if(!is_404()):
?>	
<footer id="dt_footer" class="dt_footer dt_footer--one clearfix">
	<?php 	
		// Footer Widget
		do_action('chromax_footer_widget');

		// Footer Copyright
		do_action('chromax_footer_bottom'); 	
	?>
</footer>
<?php 
// Top Scroller
do_action('chromax_top_scroller'); 
endif;
wp_footer(); ?>
</body>
</html>
