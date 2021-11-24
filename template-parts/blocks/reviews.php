<?php

    $team_position = get_field('references_items', get_the_ID());
    $refs_args = array(
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_type'      => 'reference',
		'post_status'    => 'publish',
		'numberposts'    => 5
	);

    if( !empty($team_position) && is_array($team_position) ) {
		$refs_args['post__in'] = $team_position;
    }

    $items = get_posts($refs_args);
    $reference_page = get_field('reference_page', 'options');

    if ($items) {?>
	    <div class="site-block padding60 site-block--reviews">
		    <div class="container">
			    <div class="row align-items-center">
				    <div class="col-12 col-lg-3 mr-auto pr-lg-0">
					    <h2><?php _e('What we’ve done so far', 'textdomain'); ?></h2>
					    <p><?php echo sprintf( __("See our latest reference. You can find more of our references <a href='%s' class='text-link'>here</a>.", 'textdomain'), $reference_page ? get_the_permalink($reference_page->ID) : '#'); ?></p>
				    </div>
				    <div class="col-12 col-lg-8">
					    <div class="references-carousel bg-blue">
						    <div class="owl-carousel">
							    <?php foreach($items as $item){
							    	$review_text = get_field('references_review', $item->ID); ?>
								    <div class="references-item p-0 d-flex flex-column">
									    <h4 class="references-item__title"><?php echo $item->post_title; ?></h4>
									    <div class="references-item__text"><?php echo apply_filters('the_content', $review_text); ?></div>
									    <?php
									    if (has_post_thumbnail($item->ID)){
										    $thumb = wp_get_attachment_image_url( get_post_thumbnail_id($item->ID), 'full' );?>

										    <div class="references-item__logo mt-auto">
											    <img src="<?php echo $thumb?>" class="img-responsive" alt="<?php echo $item->post_title; ?>">
										    </div>
									    <?php } ?>
								    </div>
							    <?php }
							    wp_reset_postdata();?>
						    </div>
					    </div>
					    <div class="references-carousel-dots owl-dots">
	                        <?php foreach($items as $item){
	                        	echo '<div class="references-carousel__dot owl-dot"></div>';
	                        } ?>
					    </div>
				    </div>
			    </div>
		    </div>
	    </div>


    <?php } ?>