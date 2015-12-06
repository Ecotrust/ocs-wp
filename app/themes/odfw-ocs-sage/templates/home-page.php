<?php
	$the_items = get_post_meta( get_the_ID(), '_home_rotator_repeat_group', true );
?>
<div class="svg-mask carousel slide" id="myCarousel" data-ride="carousel">

     <div class="carousel-inner" role="listbox">

	<?php $i=0;
		foreach($the_items as $item): ?>
        <div class="item <?php echo $i == 0 ? 'active' : '' ?>">

		<?php $url = esc_url( get_permalink($item['_home_linked-post']) );
		$url .= $item["_home_success-story"] == "on" ? "#success-story"  : "";
	 ?>
			<a href="<?php echo $url; ?>">
				<div class="carousel-caption">
					<h3 class="carousel-headline"><?php echo esc_html($item['_home_headline']); ?></h3>
					<p class="carousel-subtext"><?php echo esc_html($item['_home_caption']); ?></p>
				</div>

			  <svg width="100%" height="100%" baseProfile="full" version="1.2">
				  <defs>
					  <mask id="svgmask2" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
						  <image width="100%" height="100%" xlink:href="app/themes/odfw-ocs-sage/dist/images/or.png" />
					  </mask>
				  </defs>
				  <image id="the-mask" mask="url(#svgmask2)" width="100%" height="100%" y="0" x="0" xlink:href="<?php echo esc_html($item['_home_image']); ?>" />
			  </svg>

			</a>
		</div>

	<?php $i++;
		endforeach; ?>

      <a href="#myCarousel" class="control_next" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      </a>
      <a href="#myCarousel" class="control_prev" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      </a>

</div>

<ol class="carousel-indicators">
	<?php
		for($i = 0; $i < count($the_items); ++$i) { ?>
			<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : '' ?>"></li>
	<?php }	?>
</ol>
