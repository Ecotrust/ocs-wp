<?php
	$scienctific_name = get_post_meta( get_the_ID(), 'species_meta_species-scientific-name', true );
	$assoc = get_post_meta( get_the_ID(), 'coa_meta_strategy_species_association', true );
?>

	<article id="strategy-species-item-<?php echo $post->ID; ?>"  <?php post_class('grid-item'); ?>>
		<a href="<?php the_permalink(); ?>">
			<?php if ( !is_singular( 'ecoregion') ): ?>
				<div class="image-grid-container">
					<?php
						//$the_field = get_post_meta( get_the_ID(), 'species_meta_image-url', true );
						$the_field_thumbnail = get_post_meta( get_the_ID(), 'species_meta_image-thumb-url', true );
					?>
					<?php if ( !empty($the_field_thumbnail) ): ?>
						<img class="img-responsive" src="<?php echo esc_html( $the_field_thumbnail ); ?>">
					<?php else: ?>
						<img class="img-responsive" src="http://placehold.it/330x215/aaaaaa/ffffff?text=%20">
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<h3 class="cpt-title"><?php the_title(); ?>
			<?php
				$incAssoc =  get_query_var('coa-assoc', false);
				if ( $incAssoc ) { ?>
					<span class='species-association'>(<? echo $incAssoc ?>)</span></li>
			<?php	} ?>
			</h3>
			<p><?php echo esc_html( $scienctific_name ); ?></p>
		</a>
	</article>
