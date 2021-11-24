<?php
    $color = isset($args['color']) ? $args['color'] : '';
?>
<div class="col-12 col-md-6 col-lg-4">
	<div class="card card--news">
		<div class="card-body">
			<?php if (has_post_thumbnail()){
				$thumb = wp_get_attachment_image_url( get_post_thumbnail_id(get_the_ID()), 'thumb_576_336' ); ?>

				<a href="<?php the_permalink() ?>">
					<img src="<?php echo $thumb ?>" class="card-img-top img-responsive" alt="<?php the_title() ?>">
				</a>
			<?php } ?>
            <h5 class="card-title"><a href="<?php the_permalink() ?>" class="<?php echo $color; ?>"><?php the_title() ?></a></h5>
			<div class="meta">
				<div class="meta__date <?php echo $color; ?>"><span><?php echo get_the_date('d.m.Y') ?></span></div>
			</div>
            <p class="card-text"><a href="<?php the_permalink() ?>" class="<?php echo $color; ?>"><?php echo ex_content(get_the_content()); ?></a></p>
			<a href="<?php the_permalink() ?>" class="text-link <?php echo $color; ?>"><?php _e( 'Read More', 'textdomain' ) ?></a>
		</div>
	</div>
</div>