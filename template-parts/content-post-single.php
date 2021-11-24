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
                        <img src="<?php echo $thumb ?>" class="card-img-top img-responsive mb-lg-0 mx-auto" alt="<?php the_title() ?>">
                    </div>
                <?php } ?>
                <div class="<?php echo $class?> ">
                    <div class="card-body card-body--pink">
                        <h5 class="card-title"><?php the_title() ?></h5>
                        <div class="meta">
                            <div class="meta__date"><span><?php the_date('d.m.Y') ?></span></div>
                        </div>
                        <?php shareBlock() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php if (get_the_content()){ ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-7 mx-auto">
                    <div class="entry-content">
						<?php the_content() ?>
                    </div>
                </div>
            </div>
        </div>
	<?php } ?>
</article>
