<?php

if ( ! function_exists( 'theme_pagination' ) ) {
	function theme_pagination() {

		global $wp_query;

		$big = 999999999;

		$max = $wp_query->max_num_pages;

		$args = array(
			'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format'    => '',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $max,
			'mid_size'  => '3',
			'type'      => 'array',
			'prev_text' => '<',
			'next_text' => '>'
		);

		$result = paginate_links( $args );

		if ( $result ) { ?>
			<div class="col-12 pagination">
				<ul class="list-inline">
					<?php foreach ( $result as $page ) {
						$page_item = str_replace( '/page/1/', '', $page );
						echo '<li class="list-inline-item">' . $page_item . '</li>';
					} ?>
				</ul>
			</div>
		<?php }
	}
}

if ( ! function_exists( 'ex_content' ) ) {
	function ex_content( $content, $length = 156 ) {
		if ( $content ) {
			$content = strip_shortcodes( $content );
			$content = preg_replace( "/<img[^>]+\>/i", "", strip_tags( $content ) );
			if ( strlen( trim( $content ) ) > $length ) {
				$return_text = mb_substr( $content, 0, $length, 'UTF-8' ) . '...';
			} else {
				$return_text = $content;
			}

			return $return_text;
		}
	}
}

if ( ! function_exists( 'post_tags' ) ) {
	function post_tags() {
		if ( 'post' === get_post_type() ) {
			if ( get_the_tag_list() ) {
				echo get_the_tag_list(
					'<div class="post-tags-container"><div class="post-tags">',
					'',
					'</div></div>'
				);
			}
		}
	}
}


if ( ! function_exists('share_btns' ) ) {
	function share_btns( $class = 'share', $type = 'normal' ){
		if ( is_single() ) {
			global $post;
			$url = get_permalink($post->ID);
			$title = $post->post_title;

			if( has_post_thumbnail( $post->ID ) ) {
				$thumb = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'full' );
			}else{
				$thumb = '';
			}
			?>
			<div class="<?=$class?>">
				<?php if ( $type == 'normal' ) {
					echo '<div class="share-text">Поделиться:</div>';
				}else{
					echo '<button class="btn share-dropdown-btn"><i class="sl sl-icon-share"></i></button>';
				}?>

				<ul class="share-btn-group list-inline">
					<li class="list-inline-item">
						<button class="sharer" data-sharer="vk" data-caption="" data-image="<?=$thumb?>" data-title="<?=$title?>" data-url="<?=$url?>">
							<i class="fab fa-vk" aria-hidden="true"></i>
						</button>
					</li>
					<li class="list-inline-item">
						<button class="sharer" data-sharer="facebook" data-url="<?=$url?>">
							<i class="fab fa-facebook-f" aria-hidden="true"></i>
						</button>
					</li>
					<li class="list-inline-item">
						<button class="sharer" data-sharer="telegram" data-title="<?=$title?>" data-url="<?=$url?>">
							<i class="fab fa-telegram-plane" aria-hidden="true"></i>
						</button>
					</li>
					<li class="list-inline-item">
						<button class="sharer" data-sharer="twitter" data-caption="" data-title="<?=$title?>" data-hashtags="" data-url="<?=$url?>">
							<i class="fab fa-twitter" aria-hidden="true"></i>
						</button>
					</li>
					<li class="list-inline-item">
						<button class="sharer" data-sharer="okru" data-title="<?=$title?>" data-url="<?=$url?>">
							<i class="fab fa-odnoklassniki" aria-hidden="true"></i>
						</button>
					</li>
				</ul>
			</div>
		<?php }
	}
}

add_filter( 'get_the_archive_title', function ($title) {

	if( is_category() || is_tax() ) {
		$title = single_cat_title( '', false );
	}

	return $title;

});


function filenames_to_latin_plugin_sanitize( $filename ) {

	$chars_table = array(

		// Cyrillic alphabet
		'/А/' => 'a', '/Б/' => 'b', '/В/' => 'v', '/Г/' => 'g', '/Д/' => 'd',
		'/а/' => 'a', '/б/' => 'b', '/в/' => 'v', '/г/' => 'g', '/д/' => 'd',

		'/Е/' => 'e', '/Ж/' => 'zh', '/З/' => 'z', '/И/' => 'i', '/Й/' => 'j',
		'/е/' => 'e', '/ж/' => 'zh', '/з/' => 'z', '/и/' => 'i', '/й/' => 'j',

		'/К/' => 'k', '/Л/' => 'l', '/М/' => 'm', '/Н/' => 'n', '/О/' => 'o',
		'/к/' => 'k', '/л/' => 'l', '/м/' => 'm', '/н/' => 'n', '/о/' => 'o',

		'/П/' => 'p', '/Р/' => 'r', '/С/' => 's', '/Т/' => 't', '/У/' => 'u',
		'/п/' => 'p', '/р/' => 'r', '/с/' => 's', '/т/' => 't', '/у/' => 'u',

		'/Ф/' => 'f', '/Х/' => 'h', '/Ц/' => 'c', '/Ч/' => 'ch', '/Ш/' => 'sh',
		'/ф/' => 'f', '/х/' => 'h', '/ц/' => 'c', '/ч/' => 'ch', '/ш/' => 'sh',

		'/Щ/' => 'shch', '/Ь/' => '', '/Ю/' => 'ju', '/Я/' => 'ja',
		'/щ/' => 'shch', '/ь/' => '', '/ю/' => 'ju', '/я/' => 'ja',

		// Ukrainian
		'/Ґ/' => 'g', '/Є/' => 'ye', '/І/' => 'i', '/Ї/' => 'yi',
		'/ґ/' => 'g', '/є/' => 'ye', '/і/' => 'i', '/ї/' => 'yi',

		// Russian
		'/Ё/' => 'yo', '/Ы/' => 'y', '/Ъ/' => '', '/Э/' => 'e',
		'/ё/' => 'yo', '/ы/' => 'y', '/ъ/' => '', '/э/' => 'e',

		// Belorussian
		'/Ў/' => 'u',
		'/ў/' => 'u',

		// German
		'/Ä/' => 'ae', '/Ö/' => 'oe', '/Ü/' => 'ue', '/ß/' => 'ss',
		'/ä/' => 'ae', '/ö/' => 'oe', '/ü/' => 'ue',

		// Polish
		'/Ą/' => 'a', '/Ć/' => 'c', '/Ę/' => 'e', '/Ł/' => 'l', '/Ń/' => 'n',
		'/ą/' => 'a', '/ć/' => 'c', '/ę/' => 'e', '/ł/' => 'l', '/ń/' => 'n',
		'/Ó/' => 'o', '/Ś/' => 's', '/Ź/' => 'z', '/Ż/' => 'z',
		'/ó/' => 'o', '/ś/' => 's', '/ź/' => 'z', '/ż/' => 'z',

		// Hungarian
		'/Ő/' => 'o', '/Ű/' => 'u',
		'/ő/' => 'o', '/ű/' => 'u',

		// Czech
		'/Ě/' => 'e', '/Š/' => 's', '/Č/' => 'c', '/Ř/' => 'r', '/Ž/' => 'z',
		'/ě/' => 'e', '/š/' => 's', '/č/' => 'c', '/ř/' => 'r', '/ž/' => 'z',

		'/Ý/' => 'y', '/Á/' => 'a', '/É/' => 'e', '/Ď/' => 'd', '/Ť/' => 't',
		'/ý/' => 'y', '/á/' => 'a', '/é/' => 'e', '/ď/' => 'd', '/ť/' => 't',

		'/Ň/' => 'n', '/Ú/' => 'u', '/Ů/' => 'u',
		'/ň/' => 'n', '/ú/' => 'u', '/ů/' => 'u',

		// Latvian
		'/Ā/' => 'aa', '/Ē/' => 'ee', '/Ū/' => 'uu', '/Ī/' => 'ii',
		'/ā/' => 'aa', '/ē/' => 'ee', '/ū/' => 'uu', '/ī/' => 'ii',
		'/Ō/' => 'o', '/Ŗ/' => 'r', '/Ģ/' => 'g',
		'/ō/' => 'o', '/ŗ/' => 'r', '/ģ/' => 'g',
		'/Ķ/' => 'k', '/Ļ/' => 'l',
		'/ķ/' => 'k', '/ļ/' => 'l',
		'/Ņ/' => 'n', '/ņ/' => 'n',

		// Slovak
		'/Ĺ/' => 'l', '/Ľ/' => 'l', '/Ŕ/' => 'r',
		'/ĺ/' => 'l', '/ľ/' => 'l', '/ŕ/' => 'r',

		// Greek alphabet & modern polytonic characters
		'/Α/' => 'a', '/Β/' => 'v', '/Γ/' => 'g', '/Δ/' => 'd', '/Ε/' => 'e',
		'/α/' => 'a', '/β/' => 'v', '/γ/' => 'g', '/δ/' => 'd', '/ε/' => 'e',

		'/Ζ/' => 'z', '/Η/' => 'i', '/Θ/' => 'th', '/Ι/' => 'i', '/Κ/' => 'k',
		'/ζ/' => 'z', '/η/' => 'i', '/θ/' => 'th', '/ι/' => 'i', '/κ/' => 'k',

		'/Λ/' => 'l', '/Μ/' => 'm', '/Ν/' => 'n', '/Ξ/' => 'x', '/Ο/' => 'o',
		'/λ/' => 'l', '/μ/' => 'm', '/ν/' => 'n', '/ξ/' => 'x', '/ο/' => 'o',

		'/Π/' => 'p', '/Ρ/' => 'r', '/Σ/' => 's', '/Τ/' => 't', '/Υ/' => 'y',
		'/π/' => 'p', '/ρ/' => 'r', '/σ/' => 's', '/τ/' => 't', '/υ/' => 'y',

		'/Φ/' => 'f', '/Χ/' => 'ch', '/Ψ/' => 'ps', '/Ω/' => 'o', '/Ά/' => 'a',
		'/φ/' => 'f', '/χ/' => 'ch', '/ψ/' => 'ps', '/ω/' => 'o', '/ά/' => 'a',

		'/Έ/' => 'e', '/Ή/' => 'i', '/Ί/' => 'i', '/Ό/' => 'o', '/Ύ/' => 'y',
		'/έ/' => 'e', '/ή/' => 'i', '/ί/' => 'i', '/ό/' => 'o', '/ύ/' => 'y',

		'/Ώ/' => 'o', '/Ϊ/' => 'i', '/Ϋ/' => 'y',
		'/ώ/' => 'o', '/ς/' => 's', '/ΐ/' => 'i', '/ϊ/' => 'i', '/ϋ/' => 'y', '/ΰ/' => 'y',

		// Extra chars (http://www.atm.ox.ac.uk/user/iwi/charmap.html)
		'/À/' => 'a', '/Á/' => 'a', '/Â/' => 'a', '/Ã/' => 'a', '/Å/' => 'a',
		'/à/' => 'a', '/á/' => 'a', '/â/' => 'a', '/ã/' => 'a', '/å/' => 'a',

		'/Æ/' => 'ae', '/Ç/' => 'c', '/È/' => 'e', '/É/' => 'e', '/Ê/' => 'e',
		'/æ/' => 'ae', '/ç/' => 'c', '/è/' => 'e', '/é/' => 'e', '/ê/' => 'e',

		'/Ë/' => 'e', '/Ì/' => 'i', '/Í/' => 'i', '/Î/' => 'i', '/Ï/' => 'i',
		'/ë/' => 'e', '/ì/' => 'i', '/í/' => 'i', '/î/' => 'i', '/ï/' => 'i',

		'/Ð/' => 'd', '/Ñ/' => 'n', '/Ò/' => 'o', '/Ô/' => 'o', '/Õ/' => 'o',
		'/ð/' => 'd', '/ñ/' => 'n', '/ò/' => 'o', '/ô/' => 'o', '/õ/' => 'o',
		'/ó/' => 'o', '/Ó/' => 'o',

		'/×/' => 'x', '/Ø/' => 'o', '/Ù/' => 'u', '/Ú/' => 'u', '/Û/' => 'u',
		'/×/' => 'x', '/ø/' => 'o', '/ù/' => 'u', '/ú/' => 'u', '/û/' => 'u',

		'/Þ/' => 'p', '/Ÿ/' => 'y',
		'/þ/' => 'p', '/ÿ/' => 'y',

		// Other
		'/№/' => '', '/“/' => '', '/”/' => '', '/«/' => '', '/»/' => '',
		'/„/' => '', '/@/' => '', '/%/' => '', '/‘/' => '', '/’/' => '',
		'/`/' => '', '/´/' => '', '/º/' => 'o', '/ª/' => 'a', '/ /' => '-'

	);

	// override some chars for some languages
	$locale = get_locale();
	switch ( $locale ) {
		case 'uk_UA': // Ukrainian
		case 'uk_ua':
		case 'uk':
			$chars_table_ext = array(
				'/Г/' => 'h',
				'/г/' => 'h',
				'/И/' => 'y',
				'/и/' => 'y'
			);
			$chars_table = array_merge( $chars_table, $chars_table_ext );
			break;
		case 'sv_SE': // Swedish
		case 'sv_se':
		case 'fi': // Finnish
			$chars_table_ext = array(
				'/Ä/' => 'a',
				'/ä/' => 'a',
				'/Ö/' => 'o',
				'/ö/' => 'o'
			);
			$chars_table = array_merge( $chars_table, $chars_table_ext );
			break;
		case 'bg_BG': // Bulgarian
		case 'bg_bg':
			$chars_table_ext = array(
				'/Щ/' => 'sht',
				'/щ/' => 'sht',
				'/Ъ/' => 'a',
				'/ъ/' => 'a'
			);
			$chars_table = array_merge( $chars_table, $chars_table_ext );
			break;
		case 'lv_LV': // Latvian
		case 'lv_lv':
		case 'lv':
			$chars_table_ext = array(
				'/Š/' => 'sh',
				'/š/' => 'sh',
				'/Ž/' => 'zh',
				'/ž/' => 'zh',
				'/Č/' => 'ch',
				'/č/' => 'ch'
			);
			$chars_table = array_merge( $chars_table, $chars_table_ext );
			break;
		case 'et': // Estonian
			$chars_table_ext = array(
				'/Ä/' => 'a',
				'/ä/' => 'a',
				'/Ö/' => 'o',
				'/ö/' => 'o',
				'/Ü/' => 'u',
				'/ü/' => 'u'
			);
			$chars_table = array_merge( $chars_table, $chars_table_ext );
			break;
		case 'mn': // Mongolian
			$chars_table_ext = array(
				'/Е/' => 'ye',
				'/е/' => 'ye',
				'/Ё/' => 'yo',
				'/ё/' => 'yo',
				'/Ж/' => 'j',
				'/ж/' => 'j',
				'/Й/' => 'i',
				'/й/' => 'i',
				'/Х/' => 'kh',
				'/х/' => 'kh',
				'/Ъ/' => 'i',
				'/ъ/' => 'i',
				'/Ь/' => 'i',
				'/ь/' => 'i',
				'/Ц/' => 'ts',
				'/ц/' => 'ts',
				'/Ю/' => 'yu',
				'/ю/' => 'yu',
				'/Я/' => 'ya',
				'/я/' => 'ya',
				'/Ө/' => 'o',
				'/ө/' => 'o',
				'/Ү/' => 'u',
				'/ү/' => 'u'
			);
			$chars_table = array_merge( $chars_table, $chars_table_ext );
			break;
	}

	$friendly_filename = preg_replace( array_keys( $chars_table ), array_values( $chars_table ), $filename );

	return strtolower( $friendly_filename );
}
add_filter( 'sanitize_file_name', 'filenames_to_latin_plugin_sanitize', 10 );

function rutranslit($title) {
	$chars = array(
//rus
		"А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
		"Е"=>"E","Ё"=>"YO","Ж"=>"ZH",
		"З"=>"Z","И"=>"I","Й"=>"Y","К"=>"K","Л"=>"L",
		"М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R",
		"С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"KH",
		"Ц"=>"C","Ч"=>"CH","Ш"=>"SH","Щ"=>"SHH","Ъ"=>"",
		"Ы"=>"Y","Ь"=>"","Э"=>"YE","Ю"=>"YU","Я"=>"YA",
		"а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
		"е"=>"e","ё"=>"yo","ж"=>"zh",
		"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
		"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
		"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"kh",
		"ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"shh","ъ"=>"",
		"ы"=>"i","ь"=>"","э"=>"ye","ю"=>"yu","я"=>"ya",
//spec
		"—"=>"-","«"=>"","»"=>"","…"=>"","№"=>"N",
		"—"=>"-","«"=>"","»"=>"","…"=>""," " => "","?"=>"", '"' => '',
		"!"=>"","@"=>"","#"=>"","$"=>"","%"=>"","^"=>"","&"=>"", " " => "-",
//ukr
		"Ї"=>"Yi","ї"=>"i","Ґ"=>"G","ґ"=>"g",
		"Є"=>"Ye","є"=>"ie","І"=>"I","і"=>"i",
//kazakh
		"Ә"=>"A","Ғ"=>"G","Қ"=>"K","Ң"=>"N","Ө"=>"O","Ұ"=>"U","Ү"=>"U","H"=>"H",
		"ә"=>"a","ғ"=>"g","қ"=>"k","ң"=>"n","ө"=>"o", "ұ"=>"u","h"=>"h"
	);

	if (seems_utf8($title)) $title = urldecode($title);

	$title = preg_replace('/\.+/','.',$title);
	$r = strtr($title, $chars);

	return $r;
}
add_filter('sanitize_file_name','rutranslit');
add_filter('sanitize_title','rutranslit');



function feedFilter($query) {
	if ($query->is_feed) {
		add_filter('rss2_item', 'feedContentFilter');
	}

	return $query;
}

add_filter('pre_get_posts','feedFilter');

function feedContentFilter($item) {

	global $post;

	$args = array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => 1,
	);

	$attachments = get_posts($args);

	if ($attachments) {
		foreach ($attachments as $attachment) {
			$image = wp_get_attachment_image_src($attachment->ID, 'large');
			$mime = get_post_mime_type($attachment->ID);
		}
	}

	if ($image) {
		echo '<enclosure url="'.$image[0].'" length="" type="'.$mime.'"/>';
	}

	return $item;
}


add_filter('embed_oembed_html', function ($html, $url, $attr, $post_id) {
	if(strpos($html, 'youtube.com') !== false || strpos($html, 'youtu.be') !== false){
		return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
	} else {
		return $html;
	}
}, 10, 4);


add_filter('embed_oembed_html', function($code) {
	return str_replace('<iframe', '<iframe class="embed-responsive-item" ', $code);
});

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


function time_ago_in_php($timestamp, $format = ''){

	date_default_timezone_set('Etc/GMT-3');

	$time_ago        = strtotime($timestamp);

	$current_time    = time();
	$time_difference = $current_time - $time_ago;
	$seconds         = $time_difference;

	$minutes = round($seconds / 60);
	$hours   = round($seconds / 3600);
	$days    = round($seconds / 86400);

	if ( $format ) {
		$date_time_format = $format;
	}else{
		$date_time_format = get_option( 'date_format' ) . ', ' . get_option( 'time_format' );
	}

	if ($seconds <= 60){

		return "только что";

	} else if ($minutes <= 60){

		if ($minutes == 1){

			return "минуту назад";

		} else {

			return plural_form(
				$minutes,
				array(
					'%s минуты назад',
					'%s минут назад',
					'%s минут назад',
				)
			);
		}

	} else if ($hours <= 24){

		if ($hours == 1){

			return "час назад";

		} else {

			return plural_form(
				$hours,
				array(
					'%s час назад',
					'%s часа назад',
					'%s часов назад',
				)
			);
		}

	} else if ($days <= 7){

		if ($days == 1){

			return "вчера в " . mysql2date('H:i', $timestamp);

		} else {

			return mysql2date($date_time_format, $timestamp);

		}

	} else {
		return mysql2date($date_time_format, $timestamp);
	}
}

function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	return sprintf( $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ], $number  );
}

function remove_pages_from_search() {
	global $wp_post_types;
	$wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'remove_pages_from_search');
