<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

	<?php $coa_id = get_post_meta( get_the_ID(), 'coa_meta_coa_id', true );?>

    <header>
      <h1 tabindex="6" class="entry-title"><?php the_title(); ?>, COA <?=$coa_id; ?></h1>
    </header>

    <?php $the_compass_field = get_post_meta( get_the_ID(), 'coa_meta_compass-link', true );
        if ( ! empty($the_compass_field) ): ?>
        <?php include(locate_template('templates/compass-view.php')); ?>
    <?php endif; ?>


    <div class="entry-content">

        <?php get_template_part('templates/featured-thumbnail'); ?>

		<div class="row">
			<div class="col-sm-9">
				<?php the_content(); ?>
			</div>
			<div class="col-sm-2 coa-id">
				<div class="btn btn-primary">

					<h3 class="panel-title" data-toggle="tooltip" data-placement="bottom" title="<?php echo ocs_get_option('coa-id') ?>">
						COA ID <span class="badge"><?=$coa_id; ?></span>
					</h3>
				</div>
			</div>
		</div>





		<section class="cmb2-wrap-group coa_meta_special_features">
			<h2 data-toggle="tooltip" data-placement="right" title="<?php echo ocs_get_option('coa-special-features') ?>">Special Features</h2>


			<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_special_features', true );
			if ( !empty ($the_field) ): ?>
			<h3>General</h3>
			<ul class="coa-detail-listing">

				<?php foreach($the_field as $entries => $entry ) { ?>
					<li><?php echo $entry['coa_meta_special_features_title'];?>
					<?php if ( !empty($entry['coa_meta_special_features_value']) ): ?>
						<a href="<?=$entry['coa_meta_special_features_value'];?>"><?=$entry['coa_meta_special_features_value'];?></a>
					<?php endif; ?>
					</li>
				<?php } ?>
			</ul>
			<?php endif; ?>



			<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_special_features_2006', true );
			if ( !empty ($the_field) ): ?>
			<h3  data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('coa-special-features-2006') ?>">2006
				<abbr class="c2c-text-hover" title="Oregon Department of Fish and Wildlife">ODFW</abbr>
				<abbr class="c2c-text-hover" title="Conservation Opportunity Area">COA</abbr>
			</h3>
			<ul class="coa-detail-listing">
				<?php foreach($the_field as $entry ) { ?>
					<li><?php echo esc_html( $entry ); ?></li>
				<?php } ?>
			</ul>
			<?php endif; ?>


			<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_special_features_protected_area', true );
			$size = count($the_field) > 8 ? " long-list " : "";
			if ( !empty ($the_field) ): ?>
			<h3  data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('coa-special-features-protected-areas') ?>">Protected Areas</h3>
			<ul class="coa-detail-listing <?=$size; ?>">

				<?php foreach($the_field as $entries => $entry ) { ?>
					<li><?php echo $entry['coa_meta_special_features_protected_area_title'];?>
					<?php if ( !empty($entry['coa_meta_special_features_protected_area_link']) ): ?>
						<a href="<?=$entry['coa_meta_special_features_protected_area_link'];?>">
							<?=$entry['coa_meta_special_features_protected_area_link'];?>
						</a>
					<?php endif; ?>
					</li>
				<?php } ?>
			</ul>
			<?php endif; ?>




			<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_kci_connections', true );
			if ( !empty ($the_field) ): ?>
				<div class="cmb2-wrap-text coa_meta_kci_connections">
					<h2 data-toggle="tooltip" title="<?php echo ocs_get_option('coa-special-features-KCI-connections') ?>">KCI Connections</h2>

					<p class="cmb2-text">
						<?php echo esc_html( $the_field ); ?>
					</p>
				</div>
			<?php endif; ?>


		</section>


		<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_recommended_conservation_actions', true );
		if ( !empty ($the_field) ): ?>
			<section class="cmb2-wrap-textarea_small coa_meta_recommended_conservation_actions">
				<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('coa-special-features') ?>">Recommended Conservation Actions</h2>

				<ul class="coa-detail-listing">
					<?php foreach($the_field as $entry ) { ?>
						<li><?php echo esc_html( $entry ); ?></li>
					<?php } ?>
				</ul>
			</section>
		<?php endif; ?>


		<section class="associated-ecoregions listings-wrap">
			<h2 data-toggle="tooltip" data-placement="right" title="<?php echo ocs_get_option('') ?>">Ecoregions</h2>

			<div class="grid-layout">
				<?php
					// Some of these were stored as a string(single), some as an array (on CSV import)
					$the_ecoregions = get_post_meta( get_the_ID(), 'coa_meta_attached_ecoregions', true );
					// so let's make sure it's an array
					$the_ecoregions_array = is_array($the_ecoregions) ? $the_ecoregions : explode(",", $the_ecoregions);
					Roots\Sage\CPT\ocs_list_ecoregions($the_ecoregions_array);
				?>
			</div>
		</section>


		<section class="associated-habitats listings-wrap">

			<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('coa-strategy-habitats') ?>">Strategy Habitats</h2>

			<div class="grid-layout">
				<?php
					// Some of these were stored as a string(single), some as an array (on CSV import)
					$the_habitats = get_post_meta( get_the_ID(), 'coa_meta_attached_habitats', true );
					// so let's make sure it's an array
					$the_habitats_array = is_array($the_habitats) ? $the_habitats : explode(",", $the_habitats);
					Roots\Sage\CPT\ocs_list_strategy_habitats($the_habitats_array);

				?>
			</div>
		</section>


		<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_specialized_local_habitats', true );
			if ( !empty ($the_field) ): ?>

			<section class="cmb2-wrap-text coa_meta_specialized_local_habitats">
				<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('coa-specialized-habitats') ?>">Specialized Local Habitats</h2>

				<ul class="coa-detail-listing">
					<?php foreach($the_field as $entry ) { ?>
						<li><?php echo esc_html( $entry ); ?></li>
					<?php } ?>
				</ul>
			</section>
		<?php endif; ?>



		<section class="associated-species listings-wrap">

			<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('coa-strategy-species') ?>">Strategy Species</h2>

			<div class="grid-layout">

			<?php
				$the_species = get_post_meta( get_the_ID(), 'coa_meta_strategy_species', true );
				Roots\Sage\CPT\ocs_list_coa_strategy_species($the_species,"", true);
			?>

			</div>
		</section>


		<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_local_conservation_actions_and_plans', true );
		if ( !empty ($the_field) ): ?>

		<section class="cmb2-wrap-group coa_meta_local_conservation_actions_and_plans">
			<h2 data-toggle="tooltip" data-placement="right"  title="<?php echo ocs_get_option('coa-conservations-actions') ?>">
			Local Conservation Actions and Plans</h2>

			<ul>
			<?php
				foreach($the_field as $entries => $entry ) {
					if ( ! empty ( $entry['coa_meta_local_plan_link'] ) ) : ?>
						<li><a href="<?= $entry['coa_meta_local_plan_link']; ?>"><?= $entry['coa_meta_local_plan_title']; ?></a></li>
					<?php else: ?>
						<li><?php echo $entry['coa_meta_local_plan_title'];?></li>
					<?php endif; ?>

			<?php } ?>
			</ul>
		</section>
		<?php endif; ?>


		<section class="cmb2-wrap-group coa_meta_potential_partners">
			<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('coa-potential-partners') ?>">Potential Partners</h2>

			<ul>
			<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_potential_partners', true );

				foreach($the_field as $entries => $entry ) {
					if ( ! empty ( $entry['coa_meta_potential_partner_link'] ) ) : ?>
						<li><a href="<?= $entry['coa_meta_potential_partner_link']; ?>"><?= $entry['coa_meta_potential_partner_title']; ?></a></li>
					<?php else: ?>
						<li><?php echo $entry['coa_meta_potential_partner_title'];?></li>
					<?php endif; ?>

			<?php } ?>
			</ul>
		</section>


		<?php get_template_part('templates/content', 'success-story'); ?>

    </div> <!-- /.entry-content -->


  </article>
<?php endwhile; ?>
