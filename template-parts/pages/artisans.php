<?php
/**
 * Page content — Artisan Guilds.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_guilds = array(
	array(
		'title' => __( 'Bengal Delta Eco-Guild', 'gv-craft' ),
		'place' => __( 'Sundarbans Honey & Woven Grass', 'gv-craft' ),
		'people' => __( '32 women weavers • Wild tidal marsh reed fibres', 'gv-craft' ),
		'image' => 'delta-jute-tote.jpg',
		'badge' => __( 'Cluster No. 04', 'gv-craft' ),
		'text'  => __( 'Loop weaving has become an instrument of financial independence and ecological stewardship for families living at the edge of the delta.', 'gv-craft' ),
	),
	array(
		'title' => __( 'Terracotta Heritage Council', 'gv-craft' ),
		'place' => __( 'Bishnupur Clay Artisans', 'gv-craft' ),
		'people' => __( '18 master sculptors • Alluvial riverbed clay', 'gv-craft' ),
		'image' => 'celadon-ceramic-planter.jpg',
		'badge' => __( 'Cluster No. 09', 'gv-craft' ),
		'text'  => __( 'Kilns run on rice husk fuel and closed-loop filtration, so the smoke and the effluent stay inside the village boundary.', 'gv-craft' ),
	),
	array(
		'title' => __( 'Timber Conservationists', 'gv-craft' ),
		'place' => __( 'Salvaged Orchard Woodworkers', 'gv-craft' ),
		'people' => __( '11 master turners • Storm-felled teak & mango', 'gv-craft' ),
		'image' => 'reclaimed-wood-tableware.jpg',
		'badge' => __( 'Cluster No. 12', 'gv-craft' ),
		'text'  => __( 'Every board is traced to a felled tree, dried in solar kilns and finished with food-grade virgin beeswax.', 'gv-craft' ),
	),
	array(
		'title' => __( 'Coastal Weavers Syndicate', 'gv-craft' ),
		'place' => __( 'Botanical Tufting Studio', 'gv-craft' ),
		'people' => __( '24 tufters • Hand-spun highland wool', 'gv-craft' ),
		'image' => 'botanical-tufted-rug.jpg',
		'badge' => __( 'Cluster No. 04', 'gv-craft' ),
		'text'  => __( 'Natural chlorophyll, madder and marigold dyes are extracted within five miles of the studio.', 'gv-craft' ),
	),
);
?>

<div class="gvc-split gvc-split--6-6" style="align-items: center;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper">
			<?php gvc_icon( 'groups', 'gvc-icon--sm' ); ?>
			<?php esc_html_e( 'Regional provenance', 'gv-craft' ); ?>
		</div>
		<h2 style="margin: 0.75rem 0;"><?php esc_html_e( 'The hands behind every piece', 'gv-craft' ); ?></h2>
		<p class="gvc-body-lg gvc-muted">
			<?php esc_html_e( 'Direct support to indigenous clusters keeping ancestral crafts alive. Every guild is paid a forward purchase price before the first cut of fibre, and every workshop is equipped with clean energy and safe water treatment by Resilient GreenVision engineers.', 'gv-craft' ); ?>
		</p>

		<div class="gvc-grid gvc-grid--2" style="gap: 1rem; margin-top: 1.5rem;">
			<div class="gvc-surface" style="padding: 1rem; display: flex; gap: 0.625rem; align-items: center;">
				<?php gvc_icon( 'verified_user', 'gvc-icon--sm' ); ?>
				<span class="gvc-label-sm"><?php esc_html_e( '100% direct-to-artisan pricing', 'gv-craft' ); ?></span>
			</div>
			<div class="gvc-surface" style="padding: 1rem; display: flex; gap: 0.625rem; align-items: center;">
				<?php gvc_icon( 'energy_savings_leaf', 'gvc-icon--sm' ); ?>
				<span class="gvc-label-sm"><?php esc_html_e( 'Zero fossil-fuel kiln firing', 'gv-craft' ); ?></span>
			</div>
		</div>
	</div>

	<div>
		<img src="<?php echo esc_url( GVC_URI . 'assets/img/demo/rug-texture-macro.jpg' ); ?>" alt="<?php esc_attr_e( 'Hand tufted wool texture', 'gv-craft' ); ?>" style="border-radius: var(--gvc-radius-md); width: 100%;" loading="lazy" />
	</div>
</div>

<div class="gvc-grid gvc-grid--2" style="margin-top: 3rem; gap: 1.5rem;">
	<?php foreach ( $gvc_guilds as $gvc_guild ) : ?>
		<article class="gvc-card" style="overflow: hidden;">
			<div class="gvc-media gvc-media--wide">
				<img src="<?php echo esc_url( GVC_URI . 'assets/img/demo/' . $gvc_guild['image'] ); ?>" alt="<?php echo esc_attr( $gvc_guild['place'] ); ?>" loading="lazy" />
				<span class="gvc-badge gvc-badge--floating" style="position: absolute; top: 0.75rem; left: 0.75rem;">
					<?php echo esc_html( $gvc_guild['badge'] ); ?>
				</span>
			</div>
			<div style="padding: 1.5rem;">
				<h3 class="gvc-title-lg" style="margin: 0 0 0.25rem; color: var(--gvc-primary);"><?php echo esc_html( $gvc_guild['place'] ); ?></h3>
				<p class="gvc-label-md" style="color: var(--gvc-secondary); margin: 0 0 0.5rem;"><?php echo esc_html( $gvc_guild['title'] ); ?></p>
				<p class="gvc-body-sm gvc-muted"><?php echo esc_html( $gvc_guild['people'] ); ?></p>
				<p class="gvc-body-md gvc-muted" style="margin-top: 0.75rem;"><?php echo esc_html( $gvc_guild['text'] ); ?></p>
			</div>
		</article>
	<?php endforeach; ?>
</div>

<div class="gvc-card" style="padding: 2rem; margin-top: 3rem; background: var(--gvc-forest); border-color: var(--gvc-forest);">
	<h3 class="gvc-title-lg" style="margin: 0 0 0.75rem; color: #fff;"><?php esc_html_e( 'Work with a guild', 'gv-craft' ); ?></h3>
	<p class="gvc-body-md" style="color: var(--gvc-surface-variant); max-width: 40rem; margin: 0 0 1.5rem;">
		<?php esc_html_e( 'We welcome interior designers, hospitality groups and retailers who want to commission pieces directly from the cooperatives.', 'gv-craft' ); ?>
	</p>
	<a class="gvc-btn gvc-btn--mint" href="<?php echo esc_url( home_url( '/wholesale-inquiries/' ) ); ?>">
		<?php esc_html_e( 'Start a conversation', 'gv-craft' ); ?>
		<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
	</a>
</div>
