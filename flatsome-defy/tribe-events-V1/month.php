<?php
/**
 * Month View Template
 * The wrapper template for month view. 
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 *
 */
/* 
 * zig:  add calendar in column9 & add main sidebar column 3 (flatsome)
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php do_action( 'tribe_events_before_template' ) ?>

<!-- Tribe Bar -->

<?php /*zig add column 9 for main content if there's a sidebar */
	$sidebar_name = 'sidebar-main';
	$do_columns = is_active_sidebar($sidebar_name);
	if ($do_columns) {
		echo '<div class="large-9 left columns">';
	}
?>
<?php tribe_get_template_part( 'modules/bar' ); ?>
<!-- Main Events Content -->
<?php tribe_get_template_part('month/content'); ?>

<?php if ($do_columns) { /*zig add sidebar */
	echo '</div>';
	echo '<div id="sidebar" class="large-3 columns right">';
	dynamic_sidebar( 'sidebar-main' ) ;
	echo '</div>';
} ?>

<?php do_action( 'tribe_events_after_template' ) ?>
