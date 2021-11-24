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

        <div class="fullwidth-img">
            <img src="<?php echo $thumb?>" class="img-responsive" alt="<?php the_title() ?>">
        </div>
	<?php } ?>
    <?php if (get_the_content()){ ?>
        <div class="entry-content mb-0">
		    <?php the_content(); ?>
        </div>
    <?php } ?>
    <?php
       if ( $team_member = get_field('employee_сontacts') ) {

	       $position    = get_field('team_position', $team_member->ID);
	       $phone       = get_field('team_phone', $team_member->ID);
	       $email       = get_field('team_email', $team_member->ID);
	       $linkedin    = get_field('team_linkedin', $team_member->ID);

	     if ($position || $phone || $email || $linkedin) { ?>
             <div class="container">
                 <div class="values-contact">
                     <h3><?php echo $team_member->post_title ?></h3>
	                 <?php if ($position) { ?>
                         <div class="meta mb-4">
                             <div class="meta__position"><span><?php echo $position ?></span></div>
                         </div>
	                 <?php }?>
                     <div class="team-contacts">
                         <ul class="list-unstyled">
			                 <?php if ($phone) { ?>
                                 <li class="team-contacts__item">
                                     <a href="tel:<?php echo $phone; ?>"><svg class="icon-svg"><use xlink:href="#phone"></use></svg> <?php echo $phone; ?></a>
                                 </li>
			                 <?php }?>
			                 <?php if ($email) { ?>
                                 <li class="team-contacts__item">
                                     <a href="mailto:<?php echo $email; ?>"><svg class="icon-svg"><use xlink:href="#email"></use></svg> <?php echo $email; ?></a>
                                 </li>
			                 <?php }?>
			                 <?php if ($linkedin) { ?>
                                 <li class="team-contacts__item">
                                     <a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener noreferrer"><svg class="icon-svg"><use xlink:href="#linkin"></use></svg> <?php _e('LinkedIn', 'textdomain'); ?></a>
                                 </li>
			                 <?php }?>
                         </ul>
                     </div>
                 </div>

             </div>

            <?php }
       }
    ?>

</article>
