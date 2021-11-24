<?php get_header(); ?>



    <div class="page-header">
        <div class="container">
	        <?php
	        if ( function_exists('yoast_breadcrumb') ) {
		        yoast_breadcrumb('<div class="breadcrumb">','</div>');
	        }?>
        </div>
    </div>
    <div class="container">
    <?php if ( have_posts() ) : ?>
        <div class="row">
	        <?php
            $idx = 1;
	        while ( have_posts() ) :
		        the_post();

                if ($idx == 1) {
	                get_template_part( 'template-parts/content', 'post-big' );
                }else{
	                get_template_part( 'template-parts/content', 'post' );
                }
		        $idx++;
	        endwhile;
	        ?>
        </div>
        <?php theme_pagination(); ?>

        <?php else :
            get_template_part( 'template-parts/content', 'none' );
        endif;?>
    </div>


<?php get_footer();
