<?php
    $team_block = get_field('team_block', 'options');
    $title = $team_block['title'];
    $text = $team_block['text'];
    $image = $team_block['image'];
?>
<div class="site-block site-block--team pb-0">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="heading">
                    <?php if ($title) {  ?>
                        <h4 class="heading__title"><?php echo $title ?></h4>
                    <?php }?>
                    <?php if ($text) {  ?>
                        <div class="heading__desc"><?php echo $text ?></div>
                    <?php }?>
				</div>
			</div>
		</div>
	</div>
    <?php if ($image) { ?>
        <div class="fullwidth-img">
            <img src="<?php echo $image; ?>" class="img-responsive" alt="<?php echo $title ?>">
        </div>
    <?php }?>

</div>