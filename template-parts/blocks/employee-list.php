<?php if ( $contacts = get_field('job_contacts')) { ?>
	<div class="site-block bg-gray">
		<div class="container">
			<div class="row">
				<?php foreach($contacts as $team_member){

					if ($team_member['employee']) {
						$position    = $team_member['position'];
						$phone       = get_field('team_phone', $team_member['employee']->ID);
						$email       = get_field('team_email', $team_member['employee']->ID);
						$linkedin    = get_field('team_linkedin', $team_member['employee']->ID);

						?>
						<div class="col-12 col-md-6 col-lg-4">
							<div class="values-contact mb-lg-0">
								<?php if ($position) { ?>
									<h3><?php echo $position ?></h3>
								<?php }?>
								<div class="meta mb-4">
									<div class="meta__position"><span><?php echo $team_member['employee']->post_title ?></span></div>
								</div>
								<div class="team-contacts mb-0">
									<ul class="list-unstyled">
										<?php if ($phone) { ?>
											<li class="team-contacts__item">
												<a href="tel:<?php echo $phone; ?>"><svg class="icon-svg"><use xlink:href="#phone"></use></svg> <?php echo $phone; ?></a>
											</li>
										<?php }?>
										<?php if ($email) { ?>
											<li class="team-contacts__item">
												<a href="mailto:<?php echo $email; ?>"><svg class="icon-svg"><use xlink:href="#email"></use></svg> <?php echo $email; ?></a>
											</li>
										<?php }?>
										<?php if ($linkedin) { ?>
											<li class="team-contacts__item">
												<a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener noreferrer"><svg class="icon-svg"><use xlink:href="#linkin"></use></svg> <?php _e('LinkedIn', 'textdomain'); ?></a>
											</li>
										<?php }?>
									</ul>
								</div>
							</div>
						</div>
					<?php }

				}?>
			</div>
		</div>
	</div>
<?php }?>