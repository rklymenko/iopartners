<?php


	if (is_singular('team')) {
		global $post;
		$args['employee'] = $post;
    }

	$employee = isset($args['employee']) ? $args['employee'] : false;

	if ($employee) { ?>

        <div class="card card--article-big">
            <div class="container">
                <div class="row">
                    <div class="col-12"><h2 class='contact-person-title'><?php _e('Contact person', 'textdomain'); ?></h2></div>
					<?php
					$team_position = get_field('team_position', $employee->ID);
					$team_phone = get_field('team_phone', $employee->ID);
					$team_email = get_field('team_email', $employee->ID);
					$team_linkedin = get_field('team_linkedin', $employee->ID);


					$class = 'col-12 d-flex flex-column justify-content-between';

					if (has_post_thumbnail($employee->ID)){
						$class = 'col-12 col-md-7 d-flex flex-column justify-content-between';
						$thumb = wp_get_attachment_image_url( get_post_thumbnail_id($employee->ID), 'thumb_576_0' ); ?>
                        <div class="col-12 col-md-4 mr-auto">
                            <img src="<?php echo $thumb ?>" class="card-img-top img-responsive mb-sm-0" alt="<?php echo $employee->post_title ?>">
                        </div>
					<?php } ?>
                    <div class="<?php echo $class?> ">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $employee->post_title ?></h5>
							<?php if ($team_position) { ?>
                                <div class="meta">
                                    <div class="meta__position"><span><?php echo $team_position ?></span></div>
                                </div>
							<?php }?>
                            <div class="card-content">
								<?php echo apply_filters('the_content', $employee->post_content) ?>
                            </div>
                        </div>
						<?php if ($team_phone || $team_email || $team_linkedin) {?>
                            <div class="team-contacts">
                                <ul class="list-unstyled d-flex flex-wrap align-items-center justify-content-between mb-0">
									<?php if ($team_phone) { ?>
                                        <li class="team-contacts__item">
                                            <a href="tel:<?php echo $team_phone; ?>"><svg class="icon-svg"><use xlink:href="#phone"></use></svg> <?php echo $team_phone; ?></a>
                                        </li>
									<?php }?>
									<?php if ($team_email) { ?>
                                        <li class="team-contacts__item">
                                            <a href="mailto:<?php echo $team_email; ?>"><svg class="icon-svg"><use xlink:href="#email"></use></svg> <?php echo $team_email; ?></a>
                                        </li>
									<?php }?>
									<?php if ($team_linkedin) { ?>
                                        <li class="team-contacts__item">
                                            <a href="<?php echo $team_linkedin; ?>" target="_blank" rel="noopener noreferrer"><svg class="icon-svg"><use xlink:href="#linkin"></use></svg> <?php _e('LinkedIn', 'textdomain'); ?></a>
                                        </li>
									<?php }?>
                                </ul>
                            </div>
						<?php }?>
                    </div>
                </div>
            </div>
        </div>
	<?php }
?>