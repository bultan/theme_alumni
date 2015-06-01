<?php
/**
 * @package alumni
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta posted-date">
			<?php echo get_the_date('d.m.y'); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="post-thumb">
		<?php 
		    if (has_post_thumbnail()) {
		        echo '<div class="single-post-thumbnail clear">';
		        echo '<a href="'.esc_url( get_permalink() ).'" rel="bookmark">';
		        echo the_post_thumbnail('index-thumb');
		        echo '</a></div>';
		    } 
		    else {
		    	echo '<div class="single-post-thumbnail clear">';
		        echo '<a href="'.esc_url( get_permalink() ).'" rel="bookmark">';
		        echo '<img src="'.site_url().'/wp-content/themes/alumni/images/Alumni.jpg" />';
		        echo '</a></div>';
		    }
		?>
	</div>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer continue-reading">
    	<?php echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'alumni') . get_the_title() . '" rel="bookmark">Continue Reading<i class="icon icon-arrow-circle-right"></i></a>'; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->