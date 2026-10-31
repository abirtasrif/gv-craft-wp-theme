<?php
/**
 * Page content — About Us.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="gvc-split gvc-split--6-6 gvc-about__intro" style="align-items: center;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper">
			<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
			<?php esc_html_e( 'An initiative of Resilient GreenVision', 'gv-craft' ); ?>
		</div>

		<h2 style="margin: 0.75rem 0;"><?php esc_html_e( 'Pioneering Sustainability', 'gv-craft' ); ?></h2>

		<p class="gvc-body-lg gvc-muted">
			<?php esc_html_e( 'Green Vision Craft connects shoppers with handcrafted home goods made by artisan communities in Bangladesh, including jute and fiber pieces, ceramics, woodcraft and sustainable tableware.', 'gv-craft' ); ?>
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
		<div class="gvc-media gvc-media--wide gvc-card gvc-about__image" style="border-radius: var(--gvc-radius-md);">
			<img src="<?php echo esc_url( GVC_URI . 'assets/img/demo/celadon-ceramic-planter.jpg' ); ?>" alt="<?php esc_attr_e( 'Handcrafted artisan ceramics', 'gv-craft' ); ?>" loading="lazy" />
		</div>

		<div class="gvc-grid gvc-about__stats" style="margin-top: 1.5rem; gap: 1rem;">
			<div class="gvc-surface gvc-about__stat" style="padding: 1rem; text-align: center;">
				<strong style="display: block; font-family: var(--gvc-font-head); font-size: 22px; color: var(--gvc-forest);">4,200+</strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Mangroves planted', 'gv-craft' ); ?></span>
			</div>
			<div class="gvc-surface gvc-about__stat" style="padding: 1rem; text-align: center;">
				<strong style="display: block; font-family: var(--gvc-font-head); font-size: 22px; color: var(--gvc-forest);">184</strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Living-wage artisans', 'gv-craft' ); ?></span>
			</div>
			<div class="gvc-surface gvc-about__stat" style="padding: 1rem; text-align: center;">
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

	<section class="gvc-about__resources" aria-labelledby="gvc-about-resources-title">
		<div class="gvc-section-head" style="margin-top: 4rem;">
			<div>
				<div class="gvc-eyebrow gvc-eyebrow--upper"><?php esc_html_e( 'Learn more', 'gv-craft' ); ?></div>
				<h2 id="gvc-about-resources-title"><?php esc_html_e( 'Our impact and policies', 'gv-craft' ); ?></h2>
				<p class="gvc-muted"><?php esc_html_e( 'Find out how we work with artisan communities and how our store operates.', 'gv-craft' ); ?></p>
			</div>
		</div>

		<div class="gvc-grid gvc-about__resource-grid">
			<a class="gvc-card gvc-card--hover gvc-about__resource" href="<?php echo esc_url( home_url( '/impact-ledger/' ) ); ?>">
				<span class="gvc-eyebrow"><?php gvc_icon( 'monitoring', 'gvc-icon--sm' ); ?> <?php esc_html_e( 'Transparency', 'gv-craft' ); ?></span>
				<strong class="gvc-title-md"><?php esc_html_e( 'Impact Ledger', 'gv-craft' ); ?></strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Read about the environmental and community commitments behind each order.', 'gv-craft' ); ?></span>
				<span class="gvc-about__resource-link"><?php esc_html_e( 'View the ledger', 'gv-craft' ); ?> <span aria-hidden="true">&rarr;</span></span>
			</a>

			<a class="gvc-card gvc-card--hover gvc-about__resource" href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>">
				<span class="gvc-eyebrow"><?php gvc_icon( 'description', 'gvc-icon--sm' ); ?> <?php esc_html_e( 'Shopping information', 'gv-craft' ); ?></span>
				<strong class="gvc-title-md"><?php esc_html_e( 'Terms & Conditions', 'gv-craft' ); ?></strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Review the terms that apply to orders, delivery, returns and use of this website.', 'gv-craft' ); ?></span>
				<span class="gvc-about__resource-link"><?php esc_html_e( 'Read the terms', 'gv-craft' ); ?> <span aria-hidden="true">&rarr;</span></span>
			</a>

			<a class="gvc-card gvc-card--hover gvc-about__resource" href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">
				<span class="gvc-eyebrow"><?php gvc_icon( 'shield', 'gvc-icon--sm' ); ?> <?php esc_html_e( 'Your information', 'gv-craft' ); ?></span>
				<strong class="gvc-title-md"><?php esc_html_e( 'Privacy Policy', 'gv-craft' ); ?></strong>
				<span class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Learn what information the store uses and how to contact us with a privacy request.', 'gv-craft' ); ?></span>
				<span class="gvc-about__resource-link"><?php esc_html_e( 'Read the policy', 'gv-craft' ); ?> <span aria-hidden="true">&rarr;</span></span>
			</a>
		</div>
	</section>

	<section class="gvc-about__faq gvc-faq" aria-labelledby="gvc-about-faq-title">
		<div class="gvc-section-head" style="margin-top: 4rem;">
			<div>
				<div class="gvc-eyebrow gvc-eyebrow--upper"><?php esc_html_e( 'Craft guide', 'gv-craft' ); ?></div>
				<h2 id="gvc-about-faq-title"><?php esc_html_e( 'About handcrafted crafts from Bangladesh', 'gv-craft' ); ?></h2>
			</div>
		</div>

		<details>
			<summary><?php esc_html_e( 'What handcrafted items can I find at Green Vision Craft?', 'gv-craft' ); ?><?php gvc_icon( 'expand_more', 'gvc-icon--sm' ); ?></summary>
			<p><?php esc_html_e( 'Browse artisan-made mats and rugs, jute and fiber goods, woodcraft, ceramics and sustainable tableware. Product pages provide the available details about each piece.', 'gv-craft' ); ?></p>
		</details>
		<details>
			<summary><?php esc_html_e( 'Where are Green Vision Craft products made?', 'gv-craft' ); ?><?php gvc_icon( 'expand_more', 'gvc-icon--sm' ); ?></summary>
			<p><?php esc_html_e( 'Green Vision Craft works with artisan guilds and cooperative communities in Bangladesh. Check each product page for the maker and provenance details available for that item.', 'gv-craft' ); ?></p>
		</details>
		<details>
			<summary><?php esc_html_e( 'What materials are used in the crafts?', 'gv-craft' ); ?><?php gvc_icon( 'expand_more', 'gvc-icon--sm' ); ?></summary>
			<p><?php esc_html_e( 'Materials vary by product and include jute and other natural fibers, ceramics, and reclaimed wood. Refer to the individual product listing for its specific materials and care information.', 'gv-craft' ); ?></p>
		</details>
	</section>
</div>
