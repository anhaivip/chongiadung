<div class="ticker-section">

<script type="text/javascript">

(function($) {
    $(function() {
		$(".ticker").show();
        $("#scroller").simplyScroll({
        autoMode: 'loop',
        startOnLoad: true
        });
    });
})(jQuery);
</script>
	<div class="inner-wrap">
		<div class="ticker">
			
			<div class="title">
				<i class="fa fa-angle-right"></i>
				<?php printf(__( 'Dòng %ssự kiện%s', 'nglh' ), '<span class="main-color">', '</span>' ); ?>
			</div>		
			
			<ul id="scroller">
				<?php
					$args = array(
						'posts_per_page' => 10,
						'orderby' => 'rand',
						'post_status' => 'publish',
					);
				?>
				<?php $query = new WP_Query( $args ); ?>
					<?php if ( $query -> have_posts() ) : ?>
						<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
							<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>							
						<?php endwhile; ?>
					<?php endif; ?>
				<?php wp_reset_query();?>
			</ul>
		</div>		
	</div>
</div>