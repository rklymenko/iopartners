<?php
/*
 * Template Name: Values
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page-values' );

endwhile;
?>
<?php
get_footer();
