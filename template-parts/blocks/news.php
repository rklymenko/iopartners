<?php
$items = get_posts(array(
	'order'          => 'DESC',
	'orderby'        => 'date',
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'numberposts'    => 3,
));

if ($items) { ?>
	<div class="site-block site-block--news">
		<div class="container">
			<div class="heading">
				<h4 class="heading__title"><?php _e( 'Latest News', 'textdomain' ) ?></h4>
			</div>
			<div class="row">
				<?php foreach($items as $post) {
					setup_postdata($post);
					get_template_part( 'template-parts/content', 'post' );
				}
				wp_reset_postdata();?>
			</div>
		</div>
	</div>
<?php }?>