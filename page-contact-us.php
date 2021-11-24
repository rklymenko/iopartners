<?php
/*
 * Template Name: Contact Us
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'page-contact' );

endwhile;
?>
<?php
get_footer();
