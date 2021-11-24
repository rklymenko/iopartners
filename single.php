<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package custom_theme
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', 'post-single' );

endwhile
?>
<?php get_template_part( 'template-parts/blocks/related', 'news' ); ?>
<?php
get_footer();
