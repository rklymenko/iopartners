<div class="page-header">
    <div class="container">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="breadcrumb">','</div>');
		}?>
    </div>
</div>
<article <?php post_class(); ?>>
    <div class="container">
        <header class="entry-header">
		    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header>
        <?php
        if ( $page_excerpt = get_field('page_excerpt') ) { ?>
            <div class="row">
                <div class="col-12 col-lg-8"><?php echo $page_excerpt; ?></div>
            </div>
        <?php } ?>
    </div>
	<?php
	if (has_post_thumbnail()){
		$thumb = wp_get_attachment_image_url( get_post_thumbnail_id(get_the_ID()), 'full' );?>

        <div class="fullwidth-img mb-0">
            <img src="<?php echo $thumb?>" class="img-responsive" alt="<?php the_title() ?>">
        </div>
	<?php } ?>
    <?php

    $items = get_posts(array(
	    'order'          => 'ASC',
	    'orderby'        => 'menu_order',
	    'post_type'      => 'reference',
	    'post_status'    => 'publish',
	    'numberposts'    => -1
    ));
    if ($items) {?>
        <div class="references">
	        <?php foreach($items as $id => $item){?>
                <div class="references-item <?php echo ($id % 2 === 0) ? 'bg-gray': ''?>">
                    <div class="container">
                        <h4 class="references-item__title"><?php echo $item->post_title; ?></h4>
                        <div class="align-items-center row">
                            <div class="col-12 col-md-7 col-lg-5">
                                <div class="references-item__text"><?php echo apply_filters('the_content', $item->post_content); ?></div>
                            </div>
                            <div class="col-12 col-md-2"><div class="references-item__separator mt-4 mb-4 mt-md-0 mb-md-0"></div></div>
                            <div class="col-12 col-md-3 col-lg-5">
		                        <?php
		                        if (has_post_thumbnail($item->ID)){
			                        $thumb = wp_get_attachment_image_url( get_post_thumbnail_id($item->ID), 'full' );?>

                                    <div class="references-item__logo">
                                        <img src="<?php echo $thumb?>" class="img-responsive" alt="<?php echo $item->post_title; ?>">
                                    </div>
		                        <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
	        <?php }
	        wp_reset_postdata();?>
        </div>
     <?php } ?>
	<?php if (get_the_content()){ ?>
        <div class="entry-content">
			<?php the_content(); ?>
        </div>
	<?php } ?>


</article>
