<?php

$welcome_block = get_field('welcome_block', 'options');
$text = $welcome_block['text'];
$video = $welcome_block['video'];

?>
<div class="align-items-end bg-blue-dark d-flex site-block site-block--welcome">
    <?php if ($video) { ?>
        <div class="welcome-video">
            <video id="hero-video" autoplay muted playsinline loop preload="none">
                <source src="<?php echo $video; ?>" type="video/mp4">
            </video>
            <div class="loader"></div>
        </div>
    <?php }?>

	<div class="container">
		<div class="align-items-end pb-0 row welcome-inner">
			<div class="col-12 text-white">
                <?php if ($text) {?>
	                <?php echo $text; ?>
                <?php }?>
			</div>
		</div>
	</div>
</div>
