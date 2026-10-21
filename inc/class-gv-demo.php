<?php
/**
 * GV Craft by JarvanIT — demo content importer.
 *
 * Adds the artisan catalogue, the craft categories and the journal posts so the
 * designed homepage is populated the moment the theme is switched on.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Demo importer.
 */
class GV_Craft_Demo {

	/**
	 * Run the import.
	 */
	public static function import() {
		if ( ! class_exists( 'WC_Product' ) ) {
			return;
		}

		self::create_categories();
		self::create_products();
		self::create_posts();

		update_option( 'gvc_demo_imported', 1 );
	}

	/**
	 * Craft disciplines (product categories).
	 */
	public static function create_categories() {
		$categories = array(
			'mats-rugs'             => array( 'Mats & Rugs', 'Hand-tufted botanical rugs, low-pile hearth mats and woven runners.', '1b4332' ),
			'ceramics'              => array( 'Ceramics', 'Wheel-thrown stoneware, celadon glazes and river-clay vessels.', '2c694e' ),
			'jute-fibers'           => array( 'Jute & Wild Fibers', 'Rain-fed golden jute, cane and natural bast fiber weaving.', '40916c' ),
			'woodcraft'             => array( 'Woodcraft', 'Salvaged teak, bamboo and reclaimed orchard timber turned by hand.', '0b3b24' ),
			'sustainable-tableware'  => array( 'Sustainable Tableware', 'Compostable kitchen and dining tools with zero synthetic binders.', '74c69d' ),
			'botanical-decor'       => array( 'Botanical Decor', 'Hand-poured candles, planters and objects for mindful rooms.', 'aeeecb' ),
			'zero-waste-kitchen'    => array( 'Zero-Waste Kitchen', 'Refillable, reusable and plastic-free everyday essentials.', 'dcfce7' ),
		);

		foreach ( $categories as $slug => $data ) {
			$term = get_term_by( 'slug', $slug, 'product_cat' );

			if ( ! $term ) {
				$result = wp_insert_term( $data[0], 'product_cat', array( 'slug' => $slug, 'description' => $data[1] ) );

				if ( is_wp_error( $result ) ) {
					continue;
				}
			}
		}
	}

	/**
	 * Sideload a bundled demo image into the media library.
	 *
	 * @param string $filename File name inside assets/img/demo.
	 * @param string $title    Attachment title.
	 * @return int Attachment ID.
	 */
	public static function sideload( $filename, $title ) {
		$source = GVC_DIR . 'assets/img/demo/' . $filename;

		if ( ! file_exists( $source ) ) {
			return 0;
		}

		$upload = wp_upload_bits( $filename, null, file_get_contents( $source ) );

		if ( ! empty( $upload['error'] ) ) {
			return 0;
		}

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$attachment_id = media_handle_sideload(
			array(
				'name'     => sanitize_file_name( $filename ),
				'tmp_name' => $upload['file'],
			),
			0,
			$title
		);

		if ( is_wp_error( $attachment_id ) ) {
			return 0;
		}

		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $title );

		return (int) $attachment_id;
	}

	/**
	 * Build the demo catalogue.
	 */
	public static function create_products() {
		$image_rug   = self::sideload( 'botanical-tufted-rug.jpg', __( 'Botanical tufted rug in a sunlit living room', 'gv-craft' ) );
		$image_macro = self::sideload( 'rug-texture-macro.jpg', __( 'Macro detail of the hand-tufted wool loops', 'gv-craft' ) );
		$image_jute  = self::sideload( 'delta-jute-tote.jpg', __( 'Handwoven jute market tote', 'gv-craft' ) );
		$image_wood  = self::sideload( 'reclaimed-wood-tableware.jpg', __( 'Reclaimed wood and bamboo tableware set', 'gv-craft' ) );
		$image_clay  = self::sideload( 'celadon-ceramic-planter.jpg', __( 'Celadon glazed stoneware planter', 'gv-craft' ) );

		$products = array(
			array(
				'name'        => 'Botanical Leaf Hand-Tufted Wool & Linen Mat',
				'slug'        => 'botanical-leaf-hand-tufted-wool-linen-mat',
				'price'       => '128.00',
				'regular'     => '150.00',
				'cat'         => 'mats-rugs',
				'images'      => array( $image_rug, $image_macro ),
				'badges'      => '100% GOTS Organic|Zero Microplastics',
				'guild'       => 'Coastal Weavers Syndicate',
				'batch'       => 'Batch #084',
				'craft_hours' => '18',
				'impact_1'    => '3.2 kg | Ocean plastic diverted',
				'impact_2'    => '100% | Plant-dyed botanical',
				'impact_3'    => '2 Trees | Mangroves planted',
				'material'    => 'Every loop in this botanical silhouette is hand-tufted using handspun organic wool, anchored with botanical chlorophyll mordant dyes and back-sealed with pure wild hevea latex rubber. No synthetic glues, no petroleum polyester and no toxic mordants.',
				'colorways'   => 'Botanical Moss & Cream | #3d654c | #f4f2ec, Raw Earth Ochre | #b87c4c | #eee5d8, Unbleached Flax Natural | #d6cfc4 | #fbf9f5',
				'short'       => 'A sculptural high-low tufted mat shaped from hand-spun wool and organic linen, dyed with pomegranate rind, wild indigo and marigold.',
				'description' => "<!-- wp:paragraph -->\n<p>A botanical leaf silhouette tufted by 32 master weavers of the Bengal Delta Eco-Guild, cluster No. 04. Every loop is hand punched, so no two mats are identical.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h3>Why it matters</h3>\n<!-- /wp:heading -->\n<!-- wp:list -->\n<ul><li>18 hours of hand craft per piece</li><li>Closed-loop botanical dye vats with zero effluent runoff</li><li>Biodegradable natural hevea latex backing</li></ul>\n<!-- /wp:list -->",
				'featured'    => true,
				'variable'    => array(
					'attribute' => 'Dimension',
					'options'   => array(
						array( '3ft x 5ft', 'Accent Mat', '128.00' ),
						array( '2ft x 3ft', 'Compact Runner', '88.00' ),
						array( '4ft x 6ft', 'Living Area', '240.00' ),
					),
				),
			),
			array(
				'name'        => 'Sundarbans Woven Jute Carrier',
				'slug'        => 'sundarbans-woven-jute-carrier',
				'price'       => '54.00',
				'regular'     => '66.00',
				'cat'         => 'jute-fibers',
				'images'      => array( $image_jute ),
				'badges'      => '100% Organic|Plastic-Free',
				'guild'       => 'Bengal Craft Guild',
				'batch'       => 'Batch #212',
				'craft_hours' => '9',
				'impact_1'    => '1.4 kg | Plastic replaced',
				'impact_2'    => '100% | Compostable',
				'impact_3'    => '1 Tree | Sapling planted',
				'material'    => 'Rain-fed golden jute reeds harvested from the tidal marshes, braided with traditional loop binds and finished with vegetable-tanned leather handles.',
				'short'       => 'A high-tensile market carrier woven from fast-renewable golden jute with vegetable-tanned leather straps.',
				'description' => "<!-- wp:paragraph -->\n<p>Braided by hand from rain-fed golden jute and finished with vegetable-tanned leather straps. Naturally compostable within 90 days.</p>\n<!-- /wp:paragraph -->",
				'featured'    => true,
			),
			array(
				'name'        => 'Celadon Mist Ceramic Planter',
				'slug'        => 'celadon-mist-ceramic-planter',
				'price'       => '42.00',
				'regular'     => '',
				'cat'         => 'botanical-decor',
				'images'      => array( $image_clay ),
				'badges'      => 'Fair Trade|Non-toxic glaze',
				'guild'       => 'Rupganj Kilns',
				'batch'       => 'Batch #063',
				'craft_hours' => '12',
				'impact_1'    => '0.8 kg | Plastic replaced',
				'impact_2'    => '100% | Non-toxic mineral',
				'impact_3'    => '0 fossil fuel | Kiln firing',
				'material'    => 'Wheel-thrown from alluvial river clay and fired in low-emission brick kilns that burn rice husk fuel. Glazed with mineral oxides only.',
				'short'       => 'Speckled stoneware fired with rice-husk fuel and glazed with reclaimed mineral oxides.',
				'description' => "<!-- wp:paragraph -->\n<p>A wheel-thrown stoneware planter from the Rupganj kilns, fired in a low-emission brick kiln burning rice husk fuel.</p>\n<!-- /wp:paragraph -->",
				'featured'    => true,
			),
			array(
				'name'        => 'Carved Teak Feast Bowl & Servers',
				'slug'        => 'carved-teak-feast-bowl-servers',
				'price'       => '68.00',
				'regular'     => '',
				'cat'         => 'woodcraft',
				'images'      => array( $image_wood ),
				'badges'      => '100% Upcycled|FSC Salvaged Timber',
				'guild'       => 'Timber Conservationists',
				'batch'       => 'Batch #041',
				'craft_hours' => '14',
				'impact_1'    => '2.1 kg | Timber rescued',
				'impact_2'    => '0% | Synthetic finish',
				'impact_3'    => 'Beeswax | Food grade seal',
				'material'    => 'Storm-felled teak and mango orchard wood, turned by master lathe workers and sealed with food-grade virgin beeswax.',
				'short'       => 'Salvaged orchard timber turned by hand and sealed with food-grade virgin beeswax.',
				'description' => "<!-- wp:paragraph -->\n<p>A feast bowl and server set turned from storm-felled teak, sealed with food-grade virgin beeswax and free of synthetic lacquers.</p>\n<!-- /wp:paragraph -->",
				'featured'    => true,
			),
			array(
				'name'        => 'Sage Foliage Low-Pile Hearth Mat',
				'slug'        => 'sage-foliage-low-pile-hearth-mat',
				'price'       => '128.00',
				'regular'     => '160.00',
				'cat'         => 'mats-rugs',
				'images'      => array( $image_rug ),
				'badges'      => 'Zero Microplastics|Hand-tufted',
				'guild'       => 'Coastal Weavers Syndicate',
				'batch'       => 'Batch #077',
				'craft_hours' => '16',
				'impact_1'    => '3.0 kg | Plastic diverted',
				'import_2'    => '100% | Plant-dyed',
				'impact_2'    => '100% | Plant-dyed',
				'impact_3'    => '2 Trees | Mangroves planted',
				'material'    => 'A dense low-pile mat tufted with unbleached organic yarn and plant-derived sage pigments, sealed with natural latex.',
				'short'       => 'Dense tactile foliage patterns tufted with unbleached organic yarns.',
				'description' => "<!-- wp:paragraph -->\n<p>A dense low-pile hearth mat tufted with unbleached organic yarn and plant-derived sage pigments.</p>\n<!-- /wp:paragraph -->",
				'featured'    => true,
			),
			array(
				'name'        => 'Braided Delta Jute Market Tote',
				'slug'        => 'braided-delta-jute-market-tote',
				'price'       => '58.00',
				'regular'     => '',
				'cat'         => 'jute-fibers',
				'images'      => array( $image_jute ),
				'badges'      => 'Fair Trade Guild|Compostable',
				'guild'       => 'Bengal Craft Guild',
				'batch'       => 'Batch #188',
				'craft_hours' => '11',
				'impact_1'    => '1.6 kg | Plastic replaced',
				'impact_2'    => '100% | Fast renewable',
				'impact_3'    => '12 women | Living wage',
				'material'    => 'Hand-twisted wild golden grass totes with plant-dyed hemp hardware and vegetable-oil tanned leather accents.',
				'short'       => 'Hand-twisted wild golden grass totes with plant-dyed hemp hardware.',
				'description' => "<!-- wp:paragraph -->\n<p>Hand-twisted wild golden grass totes with plant-dyed hemp hardware and vegetable-oil tanned leather accents.</p>\n<!-- /wp:paragraph -->",
				'featured'    => true,
			),
			array(
				'name'        => 'Sun-Fired Botanical Planter',
				'slug'        => 'sun-fired-botanical-planter',
				'price'       => '64.00',
				'regular'     => '',
				'cat'         => 'ceramics',
				'images'      => array( $image_clay ),
				'badges'      => 'Handmade|Zero fossil fuel kiln',
				'guild'       => 'Terracotta Heritage Council',
				'batch'       => 'Batch #097',
				'craft_hours' => '13',
				'impact_1'    => '0.9 kg | Plastic replaced',
				'impact_2'    => '100% | River clay',
				'impact_3'    => '0 fossil fuel | Kiln firing',
				'material'    => 'Glazed with reclaimed mineral oxides and alluvial river clay, finished with a food-safe ash glaze.',
				'short'       => 'Glazed with reclaimed mineral oxides and river clay.',
				'description' => "<!-- wp:paragraph -->\n<p>Glazed with reclaimed mineral oxides and alluvial river clay, finished with a food-safe ash glaze.</p>\n<!-- /wp:paragraph -->",
				'featured'    => true,
			),
			array(
				'name'        => 'Reclaimed Bamboo Tasting Set',
				'slug'        => 'reclaimed-bamboo-tasting-set',
				'price'       => '46.00',
				'regular'     => '',
				'cat'         => 'sustainable-tableware',
				'images'      => array( $image_wood ),
				'badges'      => 'Zero-Waste Wood|Compostable',
				'guild'       => 'Timber Conservationists',
				'batch'       => 'Batch #122',
				'craft_hours' => '8',
				'impact_1'    => '1.2 kg | Timber rescued',
				'impact_2'    => '100% | Reclaimed',
				'impact_3'    => 'Beeswax | Food grade seal',
				'material'    => 'Bamboo and reclaimed wood tableware sealed with natural tung oil, built to last for decades.',
				'short'       => 'Carved by master lathe woodworkers with a natural tung oil seal.',
				'description' => "<!-- wp:paragraph -->\n<p>Reclaimed bamboo and wood tableware carved by master lathe woodworkers and sealed with natural tung oil.</p>\n<!-- /wp:paragraph -->",
				'featured'    => true,
			),
		);

		foreach ( $products as $data ) {
			self::create_product( $data );
		}
	}

	/**
	 * Create a single demo product.
	 *
	 * @param array $data Product definition.
	 */
	public static function create_product( $data ) {
		$existing = get_page_by_path( $data['slug'], OBJECT, 'product' );

		if ( $existing ) {
			return;
		}

		$product = new WC_Product_Simple();

		$product->set_name( $data['name'] );
		$product->set_slug( $data['slug'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_short_description( $data['short'] );
		$product->set_description( $data['description'] );
		$product->set_regular_price( $data['regular'] ? $data['regular'] : $data['price'] );
		$product->set_sale_price( $data['regular'] ? $data['price'] : '' );
		$product->set_reviews_allowed( true );
		$product->set_category_ids( self::term_ids( $data['cat'] ) );
		$product->set_featured( ! empty( $data['featured'] ) );

		$product_id = $product->save();

		if ( ! $product_id ) {
			return;
		}

		// Images.
		$position = 0;

		foreach ( $data['images'] as $attachment_id ) {
			if ( ! $attachment_id ) {
				continue;
			}

			if ( 0 === $position ) {
				set_post_thumbnail( $product_id, $attachment_id );
			} else {
				update_post_meta( $product_id, '_product_image_gallery', (string) $attachment_id );
			}

			$position++;
		}

		// Eco meta.
		$meta = array(
			'badges'      => $data['badges'],
			'guild'       => $data['guild'],
			'batch'       => $data['batch'],
			'craft_hours' => $data['craft_hours'],
			'impact_1'    => $data['impact_1'],
			'impact_2'    => $data['impact_2'],
			'impact_3'    => $data['impact_3'],
			'material'    => $data['material'],
			'colorways'   => isset( $data['colorways'] ) ? $data['colorways'] : '',
			'provenance'  => '',
		);

		foreach ( $meta as $key => $value ) {
			update_post_meta( $product_id, '_gvc_' . $key, $value );
		}

		// Variable dimensions.
		if ( ! empty( $data['variable'] ) ) {
			self::add_variations( $product_id, $data['variable'], $data['images'] );
		}
	}

	/**
	 * Resolve category term IDs.
	 *
	 * @param string $slug Category slug.
	 * @return array
	 */
	public static function term_ids( $slug ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );

		return $term ? array( (int) $term->term_id ) : array();
	}

	/**
	 * Turn a simple product into a variable product with size variations.
	 *
	 * @param int   $product_id Product ID.
	 * @param array $spec       Variable specification.
	 * @param array $images     Attachment IDs.
	 */
	public static function add_variations( $product_id, $spec, $images = array() ) {
		$attribute = new WC_Product_Attribute();
		$attribute->set_name( $spec['attribute'] );
		$attribute->set_options( wp_list_pluck( $spec['options'], 0 ) );
		$attribute->set_visible( true );
		$attribute->set_variation( true );

		$product = new WC_Product_Variable( $product_id );
		$product->set_attributes( array( $attribute ) );

		$product->save();

		foreach ( $spec['options'] as $option ) {
			list( $value, $label, $price ) = $option;

			$variation = new WC_Product_Variation();
			$variation->set_parent_id( $product_id );
			$variation->set_attributes( array( 'attribute_' . sanitize_title( $spec['attribute'] ) => $value ) );
			$variation->set_regular_price( $price );
			$variation->set_price( $price );
			$variation->set_status( 'publish' );

			if ( ! empty( $images ) ) {
				$variation->set_image_id( $images[0] );
			}

			$variation->save();
		}

		// Sync stock.
		WC_Product_Variable::sync( $product_id );
	}

	/**
	 * Create the journal posts.
	 */
	public static function create_posts() {
		$posts = array(
			array(
				'title'   => __( 'How to care for a hand-tufted wool mat', 'gv-craft' ),
				'excerpt' => __( 'Rotate twice a year, vacuum on low suction and keep the botanical dyes bright for generations.', 'gv-craft' ),
				'cat'     => __( 'Material Stories', 'gv-craft' ),
				'content' => "<!-- wp:paragraph -->\n<p>Hand-tufted wool is a living material. With a little attention it will soften and deepen in colour for decades rather than fading like a synthetic print.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h3>Your seasonal ritual</h3>\n<!-- /wp:heading -->\n<!-- wp:list -->\n<ul><li>Vacuum on low suction without a rotary beater bar.</li><li>Blot spills immediately with unbleached damp cotton and cold water.</li><li>Rotate the mat twice a year for an even natural patina.</li></ul>\n<!-- /wp:list -->",
			),
			array(
				'title'   => __( 'Inside the Sundarbans weaving cooperatives', 'gv-craft' ),
				'excerpt' => __( 'How forward purchase agreements and community water treatment changed the economics of hand weaving.', 'gv-craft' ),
				'cat'     => __( 'Guild Reports', 'gv-craft' ),
				'content' => "<!-- wp:paragraph -->\n<p>Buying directly from the guild means 50% of the price is paid before a single tuft is punched. That single change removed the middlemen who had kept cluster weavers below the regional wage line.</p>\n<!-- /wp:paragraph -->",
			),
			array(
				'title'   => __( 'Reading our ecological ledger', 'gv-craft' ),
				'excerpt' => __( 'What every metric on the impact ledger actually measures, and how we verify it.', 'gv-craft' ),
				'cat'     => __( 'Impact', 'gv-craft' ),
				'content' => "<!-- wp:paragraph -->\n<p>Every number on this site is traceable to a batch tag. Scan the tag on a piece you own and you will see the exact cooperative, the dye vat and the kilograms of plastic diverted.</p>\n<!-- /wp:paragraph -->",
			),
		);

		foreach ( $posts as $post ) {
			$slug = sanitize_title( $post['title'] );

			if ( get_page_by_path( $slug, OBJECT, 'post' ) ) {
				continue;
			}

			$post_id = wp_insert_post(
				array(
					'post_title'   => $post['title'],
					'post_name'    => $slug,
					'post_content' => $post['content'],
					'post_excerpt' => $post['excerpt'],
					'post_status'  => 'publish',
					'post_type'    => 'post',
				)
			);

			if ( ! $post_id || is_wp_error( $post_id ) ) {
				continue;
			}

			$category = get_term_by( 'name', $post['cat'], 'category' );

			if ( ! $category ) {
				$created = wp_insert_term( $post['cat'], 'category' );

				if ( ! is_wp_error( $created ) ) {
					wp_set_post_terms( $post_id, array( $created['term_id'] ), 'category' );
				}
			} else {
				wp_set_post_terms( $post_id, array( (int) $category->term_id ), 'category' );
			}
		}
	}
}
