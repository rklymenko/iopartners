<?php if (is_page_template(array('page-contact-us.php')) || is_front_page() || is_category() ) {
	$contacts = get_field('contacts_block', 'options');
	$address = $contacts['address'];
	$phone = $contacts['phone'];
	$email = $contacts['email'];
	$business_id = $contacts['business_id'];
	?>
	<div class="site-block site-block--contacts bg-blue-dark text-white">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-md-6 contacts-left">
					<div class="contacts-list">
						<?php if ($address){ ?>
							<div class="contacts-item">
								<div class="contacts-item__title"><?php _e('Visit us', 'textdomain');?></div>
								<div class="contacts-item__text"><p><?php echo $address; ?></p></div>
							</div>
						<?php } ?>

						<?php if ($phone || $email){ ?>
							<div class="contacts-item">
								<div class="contacts-item__title"><?php _e('Leave us a message', 'textdomain');?></div>
								<div class="contacts-item__text">
									<ul class="list-unstyled">
										<?php if ($phone) { ?>
											<li><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></li>
										<?php } ?>
										<?php if ($email) { ?>
											<li><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						<?php } ?>
                        <?php if ($business_id) {?>
                            <div class="contacts-item">
                                <div class="contacts-item__title"><?php _e('Business ID', 'textdomain');?></div>
                                <div class="contacts-item__text"><p><?php echo $business_id; ?></p></div>
                            </div>
                        <?php }?>

					</div>
				</div>
				<div class="col-12 col-md-6 pr-md-0 contacts-right">
	                <?php if ($address){
		                $address =  rawurlencode ($address); ?>
                        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=100%25&amp;hl=en&amp;q=<?= $address;?>+(<?= $address;?>)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    <?php } ?>

				</div>
			</div>
		</div>
	</div>
<?php }?>