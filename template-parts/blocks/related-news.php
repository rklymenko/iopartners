<?php
global $post;
$temp_post = $post;
$items = get_posts(array(
	'order'          => 'DESC',
	'orderby'        => 'date',
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'numberposts'    => 3,
	'exclude'        => $post->ID,
));

if ($items) { ?>
	<div class="site-block site-block--relatednews bg-blue-dark p-0">
		<div class="container">
			<div class="row">
				<?php foreach($items as $post) {
					setup_postdata($post);
					get_template_part( 'template-parts/content', 'post', array('color' => 'text-white') );
				}
				wp_reset_postdata();
				$post = $temp_post;
				?>
			</div>
		</div>
	</div>
<?php }?>