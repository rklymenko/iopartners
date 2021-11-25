<div class="col-12">
    <div class="card card--article-big">
        <div class="row">
	        <?php
	        $class = 'col-12';
            if (has_post_thumbnail()){
	            $class = 'col-12 col-lg-6 pr-lg-0';
		        $thumb = wp_get_attachment_image_url( get_post_thumbnail_id(get_the_ID()), 'thumb_576_336' ); ?>
                <div class="col-12 col-lg-6 d-flex align-items-center">
                    <a href="<?php the_permalink() ?>">
                        <img src="<?php echo $thumb ?>" class="card-img-top img-responsive mb-lg-0 mx-auto" alt="<?php the_title() ?>">
                    </a>
                </div>
	        <?php } ?>
            <div class="<?php echo $class?> ">
                <div class="card-body">
                    <h5 class="card-title"><?php the_title() ?></h5>
                    <div class="meta">
                        <div class="meta__date"><span><?php the_date('d.m.Y') ?></span></div>
                    </div>
                    <p class="card-text"><?php echo ex_content(get_the_content(), 170); ?></p>
                    <a href="<?php the_permalink() ?>" class="btn btn-primary"><?php _e( 'Read More', 'textdomain' ) ?></a>
                </div>
            </div>
        </div>
    </div>
</div>