<?php
/*
Template name: Right sidebar
*
* mods
* - put post_meta:  top_content above the content;
*/
get_header(); ?>

<?php if( has_excerpt() ) { ?>
<div class="page-header">
	<?php the_excerpt(); ?>
</div>
<?php } ?>

<div class="page-wrapper page-right-sidebar">
	<?php $top_content = get_post_meta(get_the_ID(), 'top_content', true);
	if (!empty($top_content)) {
		echo '<div id="contenttop-widetarea">';
		//echo do_shortcode($top_cotent);
		echo do_shortcode($top_content);
		echo '</div><!-- end contenttop-widgetarea -->';
	} ?>
<div class="row">

<div id="content" class="large-9 left columns" role="main">
	<div class="page-inner">

			<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>

			<?php endwhile; // end of the loop. ?>

	</div><!-- .page-inner -->
</div><!-- .#content large-9 left -->

<div class="large-3 columns right">
<?php get_sidebar(); ?>
</div><!-- .sidebar -->

</div><!-- .row -->
</div><!-- .page-right-sidebar container -->

<?php get_footer(); ?>
