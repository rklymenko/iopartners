<div class="page-header">
    <div class="container">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="breadcrumb">','</div>');
		}?>
    </div>
</div>
<article <?php post_class(); ?>>

    <?php
    $team_highlights  = get_field('team_highlights');
    $team_education  = get_field('team_education');
    $team_languages   = get_field('team_languages');
    $team_career      = get_field('team_career');
    $team_memberships = get_field('team_memberships');

    get_template_part( 'template-parts/blocks/employee');

    if (
    $team_highlights ||
    $team_education  ||
    $team_languages   ||
    $team_career      ||
    $team_memberships
    ) { ?>
        <div class="site-block site-block--teaminfo bg-gray">
            <div class="container">
                <div class="row">
	                <?php if ($team_highlights) { ?>
                        <div class="col-12">
                            <div class="team-info">
                                <div class="team-info__title"><?php _e('Highlights:', 'textdomain');?></div>
                                <div class="team-info__text"><?php echo $team_highlights; ?></div>
                            </div>
                        </div>
	                <?php }?>
	                <?php if ($team_education || $team_career) { ?>
                        <div class="col-12 col-md-5 mr-md-auto">
	                        <?php if ($team_education) { ?>
                            <div class="team-info">
                                <div class="team-info__title"><?php _e('Education:', 'textdomain');?></div>
                                <div class="team-info__text"><?php echo $team_education; ?></div>
                            </div>
                            <?php } ?>
	                        <?php if ($team_career) { ?>
                            <div class="team-info">
                                <div class="team-info__title"><?php _e('Career:', 'textdomain');?></div>
                                <div class="team-info__text"><?php echo $team_career; ?></div>
                            </div>
                            <?php } ?>
                        </div>
	                <?php }?>
	                <?php if ($team_languages || $team_memberships) { ?>
                        <div class="col-12 col-md-5">
	                        <?php if ($team_languages) { ?>
                            <div class="team-info">
                                <div class="team-info__title"><?php _e('Languages:', 'textdomain');?></div>
                                <div class="team-info__text"><?php echo $team_languages; ?></div>
                            </div>
	                        <?php } ?>
	                        <?php if ($team_memberships) { ?>
                            <div class="team-info">
                                <div class="team-info__title"><?php _e('Memberships:', 'textdomain');?></div>
                                <div class="team-info__text"><?php echo $team_memberships; ?></div>
                            </div>
	                        <?php } ?>
                        </div>
	                <?php }?>
                </div>
            </div>
        </div>
   <?php }?>
</article>
