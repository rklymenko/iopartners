<?php
/**
 * custom_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package custom_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.172' );
}

if ( ! function_exists( 'custom_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function custom_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on custom_theme, use a find and replace
		 * to change 'custom_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'custom_theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support ('align-wide');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu' => esc_html__( 'Primary', 'custom_theme' ),
				'footer' => esc_html__( 'Footer', 'custom_theme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		add_image_size('thumb_16x9_2x', 750, 422, true);
		add_image_size('thumb_16x9_3x', 1500, 844, true);
		add_image_size('thumb_4x3_1x', 360, 270, true);
		add_image_size('thumb_4x3_2x', 720, 540, true);
		add_image_size('thumb_4x3_3x', 1200, 900, true);
		add_image_size('thumb_576_336', 576, 336, true);
		add_image_size('thumb_576_0', 576, 0, true);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'custom_theme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'custom_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'custom_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'custom_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function custom_theme_scripts() {
	wp_enqueue_style( 'custom_theme-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', false, null, false );


	wp_enqueue_script( 'functions-js', get_template_directory_uri() . '/js/scripts.js', array(), _S_VERSION, true );

	global $post;

	wp_localize_script( 'functions-js', 'ajax_var',
		array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('send_request_from_client'),
			'postID' => ($post->post_type == 'post' ? $post->ID : '')
		)
	);

}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );


function remove_wp_version() {
	return '';
}
add_filter('the_generator', 'remove_wp_version');

function vc_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
//add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

function footer_enqueue_scripts(){
	add_action('wp_footer','wp_print_scripts',5);
	add_action('wp_footer','wp_enqueue_scripts',5);
	add_action('wp_footer','wp_print_head_scripts',5);
}
add_action('after_setup_theme','footer_enqueue_scripts');

function true_completely_remove_css_class( $classes ) {
	foreach( $classes as $key => $class ) {
		if(strstr($class, "comment-author-")) {
			unset( $classes[$key] );
		}
	}
	return $classes;
}
add_filter('comment_class', 'true_completely_remove_css_class');



function modify_adminy_url_for_ajax( $url, $path, $blog_id ) {
	if ( 'admin-ajax.php' == $path ) {
		$url = site_url('/ajax.php');
	}

	return $url;
}
add_filter( 'admin_url', 'modify_adminy_url_for_ajax', 10, 3 );



remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'wpcf7_form_elements', 'imp_wpcf7_form_elements' );
function imp_wpcf7_form_elements( $content ) {
	$str_pos = strpos( $content, 'type="tel"' );
	if ($str_pos) {
		$content = substr_replace( $content, ' autocomplete="both" autocomplete="off" ', $str_pos, 0 );
	}

	$str_pos = strpos( $content, 'type="text"' );
	if ($str_pos) {
		$content = substr_replace( $content, ' autocomplete="both" autocomplete="off" ', $str_pos, 0 );
	}

	return $content;
}


add_filter( 'wpseo_breadcrumb_links', 'wpseo_breadcrumb_add_woo_shop_link' );

function wpseo_breadcrumb_add_woo_shop_link( $links ) {

	if ( is_singular('team') ) {

		$group = get_field('team_block', 'options');

		if (isset($group['team_page']) ) {
			$breadcrumb[] = array(
				'url' => get_the_permalink($group['team_page']->ID),
				'text' => $group['team_page']->post_title,
			);

			array_splice( $links, 1, -2, $breadcrumb );
		}

	}elseif ( is_singular('job') ) {

		$obj = get_field('careers_page', 'options');

		if (isset($obj) ) {
			$breadcrumb[] = array(
				'url' => get_the_permalink($obj->ID),
				'text' => $obj->post_title,
			);

			array_splice( $links, 1, -2, $breadcrumb );
		}


	}elseif ( is_singular('practices') ) {

		$obj = get_field('practices_page', 'options');

		if (isset($obj) ) {
			$breadcrumb[] = array(
				'url' => get_the_permalink($obj->ID),
				'text' => $obj->post_title,
			);

			array_splice( $links, 1, -2, $breadcrumb );
		}

	}

	return $links;
}


function shareBlock(){?>
	<div class="share mt-4">
		<ul class="list-inline mb-0">
			<li class="list-inline-item"><button class="btn btn-border" type="button" data-sharer="email" data-title="<?php the_title() ?>" data-url="<?php the_permalink() ?>" data-subject="<?php the_title() ?>"><svg class="icon-svg icon-svg--share"><use xlink:href="#share"></use></svg> Share</button></li>
			<li class="list-inline-item"><button class="btn btn-border" type="button" data-sharer="twitter" data-title="<?php the_title() ?>" data-url="<?php the_permalink() ?>"><svg class="icon-svg icon-svg--twitter"><use xlink:href="#twitter"></use></svg> Tweet</button></li>
			<li class="list-inline-item"><button class="btn btn-border" type="button" data-sharer="facebook" data-title="<?php the_title() ?>" data-url="<?php the_permalink() ?>"><svg class="icon-svg icon-svg--facebook"><use xlink:href="#facebook"></use></svg> Post</button></li>
		</ul>
	</div>
	<?php
}