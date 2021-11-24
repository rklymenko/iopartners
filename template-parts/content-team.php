<?php
	$team_position = get_field('team_position');
?>
<div class="col-12 col-sm-6 col-md-4 team-wrap">
	<div class="card card--team">
		<?php
		if (has_post_thumbnail()){
			$thumb = wp_get_attachment_image_url( get_post_thumbnail_id(get_the_ID()), 'thumb_576_0' ); ?>
			<div class="card-img">
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb ?>" class="card-img-top img-responsive" alt="<?php the_title() ?>"></a>
			</div>
		<?php } ?>
		<div class="card-body">
			<h5 class="card-title"><?php the_title() ?></h5>
			<?php if ($team_position){ ?>
				<div class="meta">
					<div class="meta__position"><span><?php echo $team_position; ?></span></div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>