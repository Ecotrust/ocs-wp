<?php
	$the_items = get_post_meta( get_the_ID(), '_home_rotator_repeat_group', true );
?>
<div class="carousel slide container-fluid" id="myCarousel">
    <a href="#myCarousel" class="control_next" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    </a>
    <a href="#myCarousel" class="control_prev" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    </a>
    <div class="carousel-wrapper">
        <div class="carousel-inner" role="listbox">
            <img class="carousel-overlay" src="app/themes/odfw-ocs-sage/dist/images/oregon.png"/>

    	<?php $i=0;
    		foreach($the_items as $item): ?>
            <div class="item <?php echo $i == 0 ? 'active' : '' ?>">

    		<?php $url = esc_url( get_permalink($item['_home_linked-post']) );
    		$url .= !empty($item["_home_success-story"] ) && $item["_home_success-story"] == "on" ? "#success-story"  : "";
    	 ?>
    			<a href="<?php echo $url; ?>">
    				<div class="carousel-caption">
                        <?php if ( !empty($item['_home_headline']) ) : ?>
    					   <h3 class="carousel-headline"><?php echo esc_html($item['_home_headline']); ?></h3>
                        <?php endif; ?> 
                        <?php if ( !empty($item['_home_caption']) ) : ?>  
    					   <p class="carousel-subtext"><?php echo esc_html($item['_home_caption']); ?></p>
                        <?php endif; ?> 
    				</div>

    				<image src="<?php echo esc_html($item['_home_image']); ?>" />

    			</a>
    		</div>

    	<?php $i++;
    		endforeach; ?>

        </div>

        <ol class="carousel-indicators">
            <?php
                for($i = 0; $i < count($the_items); ++$i) { ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : '' ?>"></li>
            <?php } ?>
        </ol>
    </div>
</div>

