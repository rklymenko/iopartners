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
        <header class="entry-header text-white">
	        <?php the_content(); ?>
        </header>
        <?php
        if ( $page_excerpt = get_field('page_excerpt') ) { ?>
            <div class="row">
                <div class="col-12 col-lg-4 text-white"><?php echo $page_excerpt; ?></div>
            </div>
        <?php } ?>
    </div>
	<?php
	if (has_post_thumbnail()){
		$thumb = wp_get_attachment_image_url( get_post_thumbnail_id(get_the_ID()), 'full' );?>

        <div class="fullwidth-img">
            <img src="<?php echo $thumb?>" class="img-responsive" alt="<?php the_title() ?>">
        </div>
	<?php } ?>
</article>
