<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

	<?php $coa_id = get_post_meta( get_the_ID(), 'coa_meta_coa_id', true );?>

    <header>
      <h1 class="entry-title"><?php the_title(); ?>, COA <?=$coa_id; ?></h1>
    </header>

    <?php $the_compass_field = get_post_meta( get_the_ID(), 'coa_meta_compass-link', true );
        if ( ! empty($the_compass_field) ): ?>
            <div class="compass main">
                <div class="compass-container">
                    <span class="compass-close">
                        <i class="glyphicon glyphicon-remove-circle"></i>
                    </span>
                    <div class="view-external-compass">
                        <a href="<?php echo external_odfw_compass_url($the_compass_field) ?>"  target="_blank">
                            <i class="glyphicon glyphicon-dashboard"></i>
                            VIEW DATA LAYERS IN COMPASS
                        </a>
                    </div>
                    <?php the_odfw_compass_iframe($the_compass_field); ?>
                </div>
            </div>
    <?php endif; ?>


    <div class="entry-content">

        <?php get_template_part('templates/featured-thumbnail'); ?>

		<div class="row">
			<div class="col-sm-9">
				<?php the_content(); ?>
			</div>
			<div class="col-sm-2 coa-id">
				<div class="btn btn-primary">

					<h3 class="panel-title" data-toggle="tooltip" data-placement="bottom" title="Identification number, unique to each COA.">
						COA ID <span class="badge"><?=$coa_id; ?></span>
					</h3>
				</div>
			</div>
		</div>





		<section class="cmb2-wrap-group coa_meta_special_features">
			<h2 data-toggle="tooltip" data-placement="right" title="Unique attributes that might be found in this area, and may have contributed to the
		area being designated as a COA.">Special Features</h2>


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
			<h3>2006 <abbr class="c2c-text-hover" title="Oregon Department of Fish and Wildlife">ODFW</abbr> <abbr class="c2c-text-hover" title="Conservation Opportunity Area">COA</abbr></h3>
			<ul class="coa-detail-listing">
				<?php foreach($the_field as $entry ) { ?>
					<li><?php echo esc_html( $entry ); ?></li>
				<?php } ?>
			</ul>
			<?php endif; ?>


			<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_special_features_protected_area', true );
			$size = count($the_field) > 8 ? " long-list " : "";
			if ( !empty ($the_field) ): ?>
			<h3>Protected Areas</h3>
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
					<h2 data-toggle="tooltip" title="">KCI Connections</h2>

					<p class="cmb2-text">
						<?php echo esc_html( $the_field ); ?>
					</p>
				</div>
			<?php endif; ?>


		</section>


		<section class="cmb2-wrap-textarea_small coa_meta_recommended_conservation_actions">
			<h2 data-toggle="tooltip"  data-placement="right" title="Priority conservation actions recommended for this COA. Conservation actions need
		to be compatible with local priorities, local comprehensive plans and land use ordinances, as well as other local,
		state, or federal laws. Actions on federal lands must undergo federal planning processes prior to implementation to
		ensure consistency with existing plans and management objectives for the area.">Recommended Conservation Actions</h2>

			<ul class="coa-detail-listing">
				<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_recommended_conservation_actions', true );
				foreach($the_field as $entry ) { ?>
					<li><?php echo esc_html( $entry ); ?></li>
				<?php } ?>
			</ul>
		</section>


		<section class="cmb2-wrap-custom_attached_posts coa_meta_attached_ecoregions">
			<h2 data-toggle="tooltip" data-placement="right" title="Ecoregion(s) that contain this COA">Ecoregions</h2>

			<?php
					// Some of these were stored as a string(single), some as an array (on CSV import)
					$the_ecoregions = get_post_meta( get_the_ID(), 'coa_meta_attached_ecoregions', true );
					// so let's make sure it's an array
					$the_ecoregions_array = is_array($the_ecoregions) ? $the_ecoregions : explode(",", $the_ecoregions);
					ocs_list_ecoregions($the_ecoregions_array);
		?>
		</section>


		<section class="cmb2-wrap-custom_attached_posts coa_meta_attached_habitats">
			<h2 data-toggle="tooltip"  data-placement="right" title="Strategy Habitat(s) with documented distribution in this COA.">Strategy Habitats</h2>

				<?php
					// Some of these were stored as a string(single), some as an array (on CSV import)
					$the_habitats = get_post_meta( get_the_ID(), 'coa_meta_attached_habitats', true );
					// so let's make sure it's an array
					$the_habitats_array = is_array($the_habitats) ? $the_habitats : explode(",", $the_habitats);
					ocs_list_strategy_habitats($the_habitats_array);

				?>
		</section>


		<section class="cmb2-wrap-text coa_meta_specialized_local_habitats">
			<h2 data-toggle="tooltip"  data-placement="right" title="Smaller, localized habitats and habitat features that are important to Strategy Species and likely to be found in this COA.">Specialized Local Habitats</h2>

			<ul class="coa-detail-listing">
				<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_specialized_local_habitats', true );
				foreach($the_field as $entry ) { ?>
					<li><?php echo esc_html( $entry ); ?></li>
				<?php } ?>
			</ul>
		</section>


		<section class="cmb2-wrap-group coa_meta_strategy_species">
			<h2 data-toggle="tooltip"  data-placement="right" title="">Strategy Species</h2>

			<div class="cmb2-group">

			<?php
				$the_species = get_post_meta( get_the_ID(), 'coa_meta_strategy_species', true );
				ocs_list_coa_strategy_species($the_species);
			?>

			</div>
		</section>



		<section class="cmb2-wrap-group coa_meta_local_conservation_actions_and_plans">
			<h2 data-toggle="tooltip" data-placement="right"  title="Current references to specific conservation planning efforts and/or
			ongoing projects within this COA. List of references will be updated as needed.
			Please contact ODFW if you would like to propose additional plans added to this area.">
			Local Conservation Actions and Plans</h2>

			<ul>
			<?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_local_conservation_actions_and_plans', true );

				foreach($the_field as $entries => $entry ) {
					if ( ! empty ( $entry['coa_meta_local_plan_link'] ) ) : ?>
						<li><a href="<?= $entry['coa_meta_local_plan_link']; ?>"><?= $entry['coa_meta_local_plan_title']; ?></a></li>
					<?php else: ?>
						<li><?php echo $entry['coa_meta_local_plan_title'];?></li>
					<?php endif; ?>

			<?php } ?>
			</ul>
		</section>


		<section class="cmb2-wrap-group coa_meta_potential_partners">
			<h2 data-toggle="tooltip"  data-placement="right" title="Organizations with a potential, or ongoing interest in this COA. Users are
		encouraged to contact these organizations if you are interested in more detailed information about this COA. If your
		organization would like to be listed, and is not currently, please contact ODFW. ">Potential Partners</h2>

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



    </div> <!-- /.entry-content -->

		<?php get_template_part('templates/content', 'success-story'); ?>

  </article>
<?php endwhile; ?>
