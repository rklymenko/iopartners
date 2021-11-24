<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package custom_theme
 */

get_header();
?><div class="page-header">
    <div class="container">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="breadcrumb">','</div>');
		}?>
    </div>
    </div>

    <div class="container">
        <header class="entry-header">
            <h1 class="page-title">404</h1>
        </header>
    </div>
    <div class="entry-content">
        <p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'textdomain' ); ?></p>
    </div>
<?php
get_footer();
