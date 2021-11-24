<?php
/*
 * Template Name: Practices
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page-practices' );

endwhile;
?>
<?php
get_footer();
