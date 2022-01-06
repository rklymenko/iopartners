<?php
    $team_block = get_field('team_block', 'options');
    $title = $team_block['title'];
    $text = $team_block['text'];
    $image = $team_block['image'];
?>
<div class="site-block site-block--christmas py-0 mt-3">
	<div class="container">
		<div class="row">
    <div class="col-12 col-lg-4">
      <img src="https://www.iopartners.fi/wp-content/uploads/2021/11/joulukerays_2021_fb_ig_tw_en.jpeg" class="img-responsive" alt="<?php echo $title ?>">
      </div>
			<div class="col-12 col-lg-7 d-flex align-items-center">
				<div class="heading">
                    <?php if ($title) {  ?>
                        <h4 class="heading__title">We Support Local Children</h4>
                    <?php }?>
                    <?php if ($text) {  ?>
                        <div class="heading__desc">
                          During Christmas 2021 – instead of traditional Christmas cards and presents – we are making a donation to a local charity, Pelastakaa Lapset ry, to support their domestic work with children in Finland. These donations are used to help the less fortunate children and families, and to prevent social exclusion in  youth.</div>
                    <?php }?>
				</div>
			</div>
		</div>
	</div><!--
    <?php if ($image) { ?>
        <div class="fullwidth-img">
            <img src="<?php echo $image; ?>" class="img-responsive" alt="<?php echo $title ?>">
        </div>
    <?php }?>-->

</div>

<style>
  .site-block.site-block--christmas {
    padding-top: 0;
    background-color: #dbe3e9; //#fde9e0;
  }
  .site-block.site-block--christmas h4.heading__title {
      font-size: 1.5rem;
      margin-bottom: 30px;
  }
</style>