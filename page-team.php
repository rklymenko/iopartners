<?php
/*
 * Template Name: Our Team
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page-team' );

endwhile;
?>
<?php
get_footer();
