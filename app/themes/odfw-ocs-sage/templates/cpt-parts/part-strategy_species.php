<?php
	//global $specID,$specAsc; //Using set_query_var() instead of global
	$spec = get_post($specID);
	if($spec->post_type == 'strategy_species') {

	$scienctific_name = get_post_meta( $specID, 'species_meta_species-scientific-name', true );
	$assoc = get_post_meta( $specID, 'coa_meta_strategy_species_association', true );

?>

	<article id="strategy-species-item-<?php echo $specID; ?>"  <?php post_class('grid-item'); ?>>
		<a href="<?php the_permalink($specID); ?>">
				<div class="image-grid-container">
					<?php
						//$the_field = get_post_meta( get_the_ID(), 'species_meta_image-url', true );
						$the_field_thumbnail = get_post_meta( $specID, 'species_meta_image-thumb-url', true );
					?>
					<?php if ( has_post_thumbnail($specID) ) : ?>
						<?php echo get_the_post_thumbnail($specID, 'grid') ?>
					<?php else: ?>
						<img class="img-responsive" src="http://placehold.it/297X215/aaaaaa/ffffff?text=%20">
					<?php endif; ?>
				</div>
			<h3 class="cpt-title"><?php echo get_the_title($specID); ?>
			<?php

				if ( $specAsc ) { ?>
					<span class='species-association'>(<?php echo $specAsc ?>)</span></li>
			<?php	} ?>
			</h3>
			<p><?php echo esc_html( $scienctific_name ); ?></p>
		</a>
	</article>
	<?php 	}
?>
