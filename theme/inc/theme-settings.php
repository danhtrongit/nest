<?php
/**
 * Nest Theme Settings – Admin page & helper functions.
 *
 * Stores all options in a single DB row: `nest_theme_options`.
 *
 * @package Nest
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -----------------------------------------------------------------------
 * 1. Helper: nest_get_option( $key, $default )
 * --------------------------------------------------------------------- */

/**
 * Get a single theme option from the centralised array.
 *
 * @param string $key     Option key.
 * @param mixed  $default Fallback value.
 * @return mixed
 */
function nest_get_option( $key = '', $default = '' ) {
	$options  = get_option( 'nest_theme_options', array() );
	$defaults = nest_get_defaults();

	if ( '' === $key ) {
		return wp_parse_args( $options, $defaults );
	}

	if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
		return $options[ $key ];
	}

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : $default;
}

/**
 * Default values for every option.
 *
 * @return array
 */
function nest_get_defaults() {
	return array(
		// Contact.
		'hotline_label'   => __( 'Tư vấn mua hàng', 'nest' ),
		'hotline_number'  => '1900 6750',
		'topbar_promo'    => __( 'Chào mừng bạn đến với cửa hàng!', 'nest' ),
		'address'         => '70 Lữ Gia, Phường 15, Quận 11, Tp.HCM',
		'email'           => 'support@example.com',

		// Important URLs.
		'store_url'       => '/he-thong-cua-hang',
		'wishlist_url'    => '/danh-sach-yeu-thich',
		'hot_deal_url'    => '/san-pham-khuyen-mai',
		'about_url'       => '/gioi-thieu',

		// Social.
		'social_facebook'  => 'https://facebook.com/',
		'social_instagram' => 'https://instagram.com/',
		'social_shopee'    => 'https://shopee.vn/',
		'social_lazada'    => 'https://lazada.vn/',
		'social_tiktok'    => 'https://tiktok.com/',

		// Copyright.
		'copyright_text'   => '',
		'powered_by_text'  => __( 'Cung cấp bởi', 'nest' ),
		'powered_by_name'  => 'WordPress',
		'powered_by_url'   => 'https://wordpress.org/',
	);
}

/* -----------------------------------------------------------------------
 * 2. Register setting (single option array).
 * --------------------------------------------------------------------- */

add_action( 'admin_init', 'nest_register_settings' );

function nest_register_settings() {
	register_setting( 'nest_theme_options_group', 'nest_theme_options', array(
		'type'              => 'array',
		'sanitize_callback' => 'nest_sanitize_options',
	) );

	/* --- Section: Contact ------------------------------------------------ */
	add_settings_section( 'nest_contact_section', __( 'Thông tin liên hệ', 'nest' ), '__return_false', 'nest-theme-settings' );

	$contact_fields = array(
		'hotline_label'  => array( 'label' => __( 'Hotline label', 'nest' ), 'type' => 'text' ),
		'hotline_number' => array( 'label' => __( 'Hotline number', 'nest' ), 'type' => 'text' ),
		'topbar_promo'   => array( 'label' => __( 'Topbar promo text', 'nest' ), 'type' => 'text', 'desc' => __( 'Hiển thị khi không có widget header-promo.', 'nest' ) ),
		'address'        => array( 'label' => __( 'Địa chỉ', 'nest' ), 'type' => 'text' ),
		'email'          => array( 'label' => __( 'Email', 'nest' ), 'type' => 'email' ),
	);

	foreach ( $contact_fields as $key => $args ) {
		add_settings_field( $key, $args['label'], 'nest_render_field', 'nest-theme-settings', 'nest_contact_section', array_merge( $args, array( 'key' => $key ) ) );
	}

	/* --- Section: Important URLs ----------------------------------------- */
	add_settings_section( 'nest_urls_section', __( 'Các liên kết quan trọng', 'nest' ), '__return_false', 'nest-theme-settings' );

	$url_fields = array(
		'store_url'    => array( 'label' => __( 'URL cửa hàng', 'nest' ), 'type' => 'url' ),
		'wishlist_url' => array( 'label' => __( 'URL danh sách yêu thích', 'nest' ), 'type' => 'url' ),
		'hot_deal_url' => array( 'label' => __( 'URL khuyến mãi (Hot deal)', 'nest' ), 'type' => 'url' ),
		'about_url'    => array( 'label' => __( 'URL giới thiệu', 'nest' ), 'type' => 'url' ),
	);

	foreach ( $url_fields as $key => $args ) {
		add_settings_field( $key, $args['label'], 'nest_render_field', 'nest-theme-settings', 'nest_urls_section', array_merge( $args, array( 'key' => $key ) ) );
	}

	/* --- Section: Social ------------------------------------------------- */
	add_settings_section( 'nest_social_section', __( 'Mạng xã hội', 'nest' ), '__return_false', 'nest-theme-settings' );

	$social_fields = array(
		'social_facebook'  => array( 'label' => 'Facebook URL', 'type' => 'url' ),
		'social_instagram' => array( 'label' => 'Instagram URL', 'type' => 'url' ),
		'social_shopee'    => array( 'label' => 'Shopee URL', 'type' => 'url' ),
		'social_lazada'    => array( 'label' => 'Lazada URL', 'type' => 'url' ),
		'social_tiktok'    => array( 'label' => 'TikTok URL', 'type' => 'url' ),
	);

	foreach ( $social_fields as $key => $args ) {
		add_settings_field( $key, $args['label'], 'nest_render_field', 'nest-theme-settings', 'nest_social_section', array_merge( $args, array( 'key' => $key ) ) );
	}

	/* --- Section: Copyright ---------------------------------------------- */
	add_settings_section( 'nest_copyright_section', __( 'Copyright / Footer bottom', 'nest' ), '__return_false', 'nest-theme-settings' );

	$copy_fields = array(
		'copyright_text'  => array( 'label' => __( 'Copyright text (tuỳ chỉnh)', 'nest' ), 'type' => 'text', 'desc' => __( 'Để trống sẽ hiện mặc định: "Bản quyền thuộc về {Site Name}"', 'nest' ) ),
		'powered_by_text' => array( 'label' => __( 'Powered by label', 'nest' ), 'type' => 'text' ),
		'powered_by_name' => array( 'label' => __( 'Powered by name', 'nest' ), 'type' => 'text' ),
		'powered_by_url'  => array( 'label' => __( 'Powered by URL', 'nest' ), 'type' => 'url' ),
	);

	foreach ( $copy_fields as $key => $args ) {
		add_settings_field( $key, $args['label'], 'nest_render_field', 'nest-theme-settings', 'nest_copyright_section', array_merge( $args, array( 'key' => $key ) ) );
	}
}

/* -----------------------------------------------------------------------
 * 3. Render individual field.
 * --------------------------------------------------------------------- */

function nest_render_field( $args ) {
	$key   = $args['key'];
	$type  = isset( $args['type'] ) ? $args['type'] : 'text';
	$value = nest_get_option( $key );
	$name  = "nest_theme_options[{$key}]";
	$desc  = isset( $args['desc'] ) ? $args['desc'] : '';

	switch ( $type ) {
		case 'textarea':
			printf(
				'<textarea name="%s" rows="4" class="large-text">%s</textarea>',
				esc_attr( $name ),
				esc_textarea( $value )
			);
			break;

		case 'email':
		case 'url':
		case 'text':
		default:
			printf(
				'<input type="%s" name="%s" value="%s" class="regular-text" />',
				esc_attr( $type ),
				esc_attr( $name ),
				esc_attr( $value )
			);
			break;
	}

	if ( $desc ) {
		printf( '<p class="description">%s</p>', esc_html( $desc ) );
	}
}

/* -----------------------------------------------------------------------
 * 4. Sanitize callback.
 * --------------------------------------------------------------------- */

function nest_sanitize_options( $input ) {
	$sanitized = array();
	$defaults  = nest_get_defaults();

	if ( ! is_array( $input ) ) {
		return $defaults;
	}

	foreach ( $defaults as $key => $default ) {
		if ( ! isset( $input[ $key ] ) ) {
			$sanitized[ $key ] = $default;
			continue;
		}

		$raw = $input[ $key ];

		// Determine sanitize type by key prefix / name.
		if ( 'email' === $key ) {
			$sanitized[ $key ] = sanitize_email( $raw );
		} elseif ( false !== strpos( $key, '_url' ) || 0 === strpos( $key, 'social_' ) || 'powered_by_url' === $key ) {
			$sanitized[ $key ] = esc_url_raw( $raw );
		} elseif ( 'topbar_promo' === $key || 'copyright_text' === $key ) {
			$sanitized[ $key ] = wp_kses_post( $raw );
		} else {
			$sanitized[ $key ] = sanitize_text_field( $raw );
		}
	}

	return $sanitized;
}

/* -----------------------------------------------------------------------
 * 5. Admin menu page.
 * --------------------------------------------------------------------- */

add_action( 'admin_menu', 'nest_add_settings_page' );

function nest_add_settings_page() {
	add_theme_page(
		__( 'Nest Theme Settings', 'nest' ),
		__( 'Nest Settings', 'nest' ),
		'manage_options',
		'nest-theme-settings',
		'nest_settings_page_html'
	);
}

function nest_settings_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Show admin notices (saved, errors).
	settings_errors( 'nest_theme_options' );
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'nest_theme_options_group' );
			do_settings_sections( 'nest-theme-settings' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/* -----------------------------------------------------------------------
 * 6. Migrate old Customizer values on first load (one-time).
 * --------------------------------------------------------------------- */

add_action( 'after_switch_theme', 'nest_migrate_customizer_to_options' );
add_action( 'admin_init', 'nest_maybe_migrate_customizer' );

function nest_maybe_migrate_customizer() {
	if ( get_option( 'nest_theme_options' ) ) {
		return; // Already has options, skip.
	}
	nest_migrate_customizer_to_options();
}

function nest_migrate_customizer_to_options() {
	$map = array(
		'nest_footer_address'   => 'address',
		'nest_footer_phone'     => 'hotline_number',
		'nest_footer_email'     => 'email',
		'nest_social_facebook'  => 'social_facebook',
		'nest_social_instagram' => 'social_instagram',
		'nest_social_shopee'    => 'social_shopee',
		'nest_social_lazada'    => 'social_lazada',
		'nest_social_tiktok'    => 'social_tiktok',
	);

	$options  = array();
	$defaults = nest_get_defaults();
	$migrated = false;

	foreach ( $map as $customizer_key => $option_key ) {
		$val = get_theme_mod( $customizer_key );
		if ( $val && $val !== ( isset( $defaults[ $option_key ] ) ? $defaults[ $option_key ] : '' ) ) {
			$options[ $option_key ] = $val;
			$migrated               = true;
		}
	}

	if ( $migrated ) {
		update_option( 'nest_theme_options', wp_parse_args( $options, $defaults ) );
	}
}
