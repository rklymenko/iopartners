<?php
$items = get_posts(array(
	'post_type'      => 'job',
	'post_status'    => 'publish',
	'numberposts'    => -1,
	'meta_query' => [
		[
			'key' => 'job_apply_by',
			'value' => date('Ymd'),
			'compare' => '>',
			'type'    => 'DATETIME'
		]
	],
	'orderby' => 'meta_value',
	'meta_key' => 'job_apply_by',
	'meta_value_num' => true,
	'order' => 'DESC'
));

if ($items) { ?>
	<div class="site-block site-block--jobslist bg-gray">
		<div class="container">
            <div class="heading">
                <h4 class="heading__title"><?php _e('We are looking for...', 'textdomain' );?></h4>
            </div>
			<div class="row">
                <?php foreach($items as $item){ ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="job-item">
                            <h4 class="job-title"><?php echo $item->post_title; ?></h4>
                            <div class="meta">
                                <span class="meta__date"><?php
                                    $job_apply_by = get_field('job_apply_by', $item->ID);
                                    echo sprintf(__('Apply by: %s'), date( 'Y.m.d', strtotime($job_apply_by))); ?></span>
                            </div>
                            <a href="<?php echo get_the_permalink($item->ID) ?>" class="text-link"><?php _e( 'Read More', 'textdomain' ) ?></a>
                        </div>
                    </div>

                <?php }?>
			</div>
		</div>
	</div>
<?php }?>