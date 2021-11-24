<?php

$about_block = get_field('about_us_block', 'options');

if ($about_block) {?>
<div class="site-block site-block--about bg-blue-dark">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 text-white">
				<?php echo $about_block; ?>
			</div>
		</div>
	</div>
</div>
<?php }?>