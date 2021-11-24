<?php
/*
 * Template Name: Careers
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page-careers' );

endwhile;
?>
<?php
get_footer();
