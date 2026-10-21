<?php
/**
 * Page content — About Us.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="gvc-split gvc-split--6-6" style="align-items: center;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper">
			<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
			<?php esc_html_e( 'An initiative of Resilient GreenVision', 'gv-craft' ); ?>
		</div>

		<h2 style="margin: 0.75rem 0;"><?php esc_html_e( 'Pioneering Sustainability', 'gv-craft' ); ?></h2>

		<p class="gvc-body-lg gvc-muted">
			<?php esc_html_e( 'Innovations is committed to developing cutting-edge eco-friendly technologies and practices that reduce carbon footprints, conserve natural resources, and create a healthier planet for future generations.', 'gv-craft' ); ?>
		</p>

		<p class="gvc-body-lg gvc-muted">
			<?php esc_html_e( 'We are dedicated to safeguarding the environment through sustainable practices and ecological restoration. Our team of environmental experts and passionate individuals work tirelessly to restore ecosystems, promote renewable energy, and advocate for eco-conscious living.', 'gv-craft' ); ?>
		</p>

		<h3 style="margin-top: 2rem;"><?php esc_html_e( 'Protecting Nature’s Balance', 'gv-craft' ); ?></h3>

		<p class="gvc-body-md gvc-muted">
			<?php esc_html_e( 'Greenvision Craft is the artisan marketplace of that mission: a place where hand-made goods carry measurable ecological weight, and where every purchase funds treatment plants, restoration and living wages.', 'gv-craft' ); ?>
		</p>

		<ul class="gvc-checklist" style="margin-top: 1.5rem;">
			<li>
				<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
				<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Forward purchase agreements that pay artisan cooperatives before the craft begins.', 'gv-craft' ); ?></div>
			</li>
			<li>
				<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
				<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Closed-loop dye vats and community ETP installations across every cluster village.', 'gv-craft' ); ?></div>
			</li>
			<li>
				<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
				<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Compostable packaging, carbon-neutral delivery and a 10-year craft pledge.', 'gv-craft' ); ?></div>
			</li>
		</ul>
	</div>

	<div>
		<div class="gvc-media gvc-media--portrait gvc-card" style="border-radius: var(--gvc-radius-md); overflow: hidden;">
			<img src="<?php echo esc_url( GVC_URI . 'assets/img/demo/celadon-ceramic-planter.jpg' ); ?>" alt="<?php esc_attr_e( 'Handcrafted artisan ceramics', 'gv-craft' ); ?>" loading="lazy" />
		</div>

		<div class="gvc-grid gvc-grid--3" style="margin-top: 1.5rem; gap: 1rem;">
			<div class="gvc-surface" style="padding: 1rem; text-align: center;">
				<strong style="display: block; font-family: var(--gvc-font-head); font-size: 22px; color: var(--gvc-forest);">4,200+</strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Mangroves planted', 'gv-craft' ); ?></span>
			</div>
			<div class="gvc-surface" style="padding: 1rem; text-align: center;">
				<strong style="display: block; font-family: var(--gvc-font-head); font-size: 22px; color: var(--gvc-forest);">184</strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Living-wage artisans', 'gv-craft' ); ?></span>
			</div>
			<div class="gvc-surface" style="padding: 1rem; text-align: center;">
				<strong style="display: block; font-family: var(--gvc-font-head); font-size: 22px; color: var(--gvc-forest);">12.5 t</strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Plastic replaced', 'gv-craft' ); ?></span>
			</div>
		</div>
	</div>
</div>

<div class="gvc-section-head" style="margin-top: 4rem;">
	<div>
		<h2><?php esc_html_e( 'Our green footprint', 'gv-craft' ); ?></h2>
	</div>
</div>

<div class="gvc-value-grid">
	<div class="gvc-card" style="padding: 1.5rem;">
		<?php gvc_icon( 'water_drop', 'gvc-icon--lg' ); ?>
		<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Water treatment', 'gv-craft' ); ?></h3>
		<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'WTP, ETP, STP and ATP engineering for our cooperative villages.', 'gv-craft' ); ?></p>
	</div>
	<div class="gvc-card" style="padding: 1.5rem;">
		<?php gvc_icon( 'forest', 'gvc-icon--lg' ); ?>
		<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Restoration', 'gv-craft' ); ?></h3>
		<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Mangrove buffer belts that hold back cyclones and salinity.', 'gv-craft' ); ?></p>
	</div>
	<div class="gvc-card" style="padding: 1.5rem;">
		<?php gvc_icon( 'solar_power', 'gvc-icon--lg' ); ?>
		<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Clean energy', 'gv-craft' ); ?></h3>
		<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Off-grid solar looms and rice-husk kilns for every workshop.', 'gv-craft' ); ?></p>
	</div>
	<div class="gvc-card" style="padding: 1.5rem;">
		<?php gvc_icon( 'recycling', 'gvc-icon--lg' ); ?>
		<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Circular craft', 'gv-craft' ); ?></h3>
		<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Repair, trade-in and composting programs for every piece we sell.', 'gv-craft' ); ?></p>
	</div>
</div>

<div class="gvc-card" style="padding: 2rem; margin-top: 3rem; background: var(--gvc-cream-dark);">
	<h3 class="gvc-title-lg" style="margin: 0 0 0.75rem; color: var(--gvc-forest);"><?php esc_html_e( 'Visit our operational hubs', 'gv-craft' ); ?></h3>
	<div class="gvc-grid gvc-grid--2" style="gap: 1.5rem;">
		<div>
			<h4 class="gvc-title-md" style="margin: 0 0 0.25rem; color: var(--gvc-primary);"><?php esc_html_e( 'Corporate Office', 'gv-craft' ); ?></h4>
			<p class="gvc-body-sm gvc-muted" style="margin: 0;">
				<?php esc_html_e( '41/4, Moneshwar Road, Zigatola, Dhanmondi, Dhaka-1209', 'gv-craft' ); ?><br />
				<?php esc_html_e( 'Phone: +88 01825-339032', 'gv-craft' ); ?><br />
				<?php esc_html_e( 'Email: contact@resilientgreenvision.com', 'gv-craft' ); ?>
			</p>
		</div>
		<div>
			<h4 class="gvc-title-md" style="margin: 0 0 0.25rem; color: var(--gvc-primary);"><?php esc_html_e( 'Local Office', 'gv-craft' ); ?></h4>
			<p class="gvc-body-sm gvc-muted" style="margin: 0;">
				<?php esc_html_e( 'Radwana Tower (3rd Floor), Bhulta, Rupganj, Narayanganj-1462', 'gv-craft' ); ?><br />
				<?php esc_html_e( 'Phone: +88 01715-668510', 'gv-craft' ); ?><br />
				<?php esc_html_e( 'Email: resilientgreenvision@gmail.com', 'gv-craft' ); ?>
			</p>
		</div>
	</div>
</div>
