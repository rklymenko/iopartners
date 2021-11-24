<?php


    if (is_page_template('page-practices.php')){
	    $show_header = false;
	    $image_id = 'image_2';
    }else{
	    $show_header = true;
	    $image_id = 'image_3';
    }


	$items = get_posts(array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_type'      => 'practices',
		'post_status'    => 'publish',
		'numberposts'    => -1,
	));
?>
<div class="site-block site-block--practices">
	<div class="container">
        <?php
        $practices_block = get_field('practices_block', 'options');
        $title = $practices_block['title'];
        $text = $practices_block['text'];
        $image = $practices_block['image'];
        $image_grid = $practices_block[$image_id];

        if ($show_header == true) { ?>
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-6 order-2 order-lg-1">
				<div class="heading">
                    <?php if ($title) { ?>
                        <h4 class="heading__title"><?php echo $title ?></h4>
                    <?php } ?>

                    <?php if ($text) { ?>
                        <div class="heading__desc"><?php echo $text ?></div>
                    <?php } ?>
				</div>
			</div>
            <?php if ($image) { ?>
                <div class="col-12 col-lg-4 p-lg-0 ml-auto text-center order-1 order-lg-2">
                    <div class="practices__img">
                        <img src="<?php echo $image; ?>" class="img-responsive" alt="<?php echo $title ?>" >
                    </div>
                </div>
            <?php }?>
		</div>
        <?php } ?>
		<div class="practices-grid">
			<div class="row">
				<?php foreach($items as $id => $item){
					switch ($id){
                        case 0:
                            $bg = 'bg-pink';
                            break;
                        case 1:
                        case 3:
                            $bg = 'bg-gray';
                            break;
                        default:
	                        $bg = '';
	                        break;
                    }
                    $post_content = wp_strip_all_tags(get_field('page_excerpt', $item->ID, false));
					$post_trimmed = substr($post_content, 0, 229);
					?>
					<div class="col-12 col-md-6 col-lg-4 p-0">
						<div class="card card--practice <?=$bg?>">
							<div class="card-body d-flex flex-column">
								<h5 class="card-title"><?php echo $item->post_title; ?></h5>
								<p class="card-text"><?php echo $post_trimmed . '...'; ?></p>
								<a href="<?php echo get_the_permalink($item->ID)?>" class="text-link mt-auto"><?php _e( 'Read More', 'textdomain' ) ?></a>
							</div>
						</div>
					</div>
				<?php }?>
                <?php if ($image_grid) { ?>
                    <div class="col-12 col-md-6 col-lg-4 p-0">
                        <div class="card card--practice card--practice-image p-0" style="background-image: url(<?php echo $image_grid; ?>);">
                        </div>
                    </div>
                <?php } ?>

			</div>
		</div>
	</div>
</div>