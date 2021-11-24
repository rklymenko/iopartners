<div class="site-block site-block--message bg-blue-dark text-white">
	<div class="container">
		<div class="align-items-center justify-content-center message-wrap no-gap row">

			<?php if (is_singular('job')) { ?>
				<div class="col-12">
                    <div class="text-center message-wrap__text">
                        <h4><?php _e('Apply', 'textdomain'); ?></h4>
                    </div>
					<div class="message-form d-block" >
						<?php echo do_shortcode('[contact-form-7 id="383" title="Apply vacansies"]'); ?>
					</div>
				</div>
			<?php }else{ ?>
				<div class="col-12">
                    <div class="text-center message-wrap__text">
                        <h4><?php _e('Have a project in mind? Contact us.', 'textdomain'); ?></h4>
						<?php if (!is_page_template('page-contact-us.php')){?>
							<button type="button" class="btn btn-inverse show-form"><?php _e('Let’s Talk', 'textdomain'); ?></button>
						<?php } ?>
                    </div>
					<div class="message-form">
						<?php echo do_shortcode('[contact-form-7 id="16" title="Leave us a message"]'); ?>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
</div>
