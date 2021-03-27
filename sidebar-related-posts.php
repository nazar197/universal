<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal-theme
 */

if ( ! is_active_sidebar( 'sidebar-related-posts' ) ) {
	return;
}
?>

<aside class="related-posts-sidebar">
	<?php dynamic_sidebar( 'sidebar-related-posts' ); ?>
</aside><!-- #secondary -->