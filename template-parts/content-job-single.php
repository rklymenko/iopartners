<div class="page-header">
    <div class="container">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="breadcrumb">','</div>');
		}?>
    </div>
</div>
<article <?php post_class(); ?>>
    <div class="card card--article-big">
        <div class="container">
            <div class="row">
                <?php
                $class = 'col-12';
                if (has_post_thumbnail()){
                    $class = 'col-12 col-lg-6';
                    $thumb = wp_get_attachment_image_url( get_post_thumbnail_id(get_the_ID()), 'thumb_576_336' ); ?>
                    <div class="col-12 col-lg-6 pr-lg-0">
                        <img src="<?php echo $thumb ?>" class="card-img-top img-responsive mb-0 mx-auto" alt="<?php the_title() ?>">
                    </div>
                <?php } ?>
                <div class="<?php echo $class?> ">
                    <div class="card-body">
                        <div class="meta">
                            <div class="meta__date"><span><?php
		                            $job_apply_by = get_field('job_apply_by');
                                    echo sprintf(__('Apply by: %s'), date( 'Y.m.d', strtotime($job_apply_by)) ); ?></span></div>
                        </div>
                        <h1 class="card-title"><?php the_title() ?></h1>
	                    <?php
	                    if ( $page_excerpt = get_field('page_excerpt') ) { ?>
                            <div class="card-text"><?php echo $page_excerpt; ?></div>
	                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php if (get_the_content()){ ?>
        <div class="site-block padding60">
            <div class="entry-content mt-0">
		        <?php the_content(); ?>
            </div>
        </div>
	<?php } ?>
	<?php get_template_part( 'template-parts/blocks/employee-list' ); ?>
</article>