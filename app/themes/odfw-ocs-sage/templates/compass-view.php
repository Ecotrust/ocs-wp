<div class="compass main">
    <div class="compass-container">                 
        <span class="compass-close">
            <i class="glyphicon glyphicon-remove-circle"></i>
        </span>
        <div class="view-external-compass">
            <a href="<?php echo external_odfw_compass_url($the_compass_field) ?>"  target="_blank">
                <span class="compass-icon">VIEW DATA LAYERS IN COMPASS</span> 
            </a>
        </div>
        <?php the_odfw_compass_iframe($the_compass_field); ?>
    </div>
</div>