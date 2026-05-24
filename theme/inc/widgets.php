<?php
/**
 * Nest Homepage Section Widgets.
 *
 * Each widget wraps the existing template-part markup so the front-end
 * looks identical. Admins can reorder sections by dragging widgets inside
 * the "Homepage Sections" sidebar (Appearance > Widgets).
 *
 * @package Nest
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =======================================================================
 * Register sidebars used by widgets.
 * ===================================================================== */

add_action( 'widgets_init', 'nest_homepage_sidebars_init' );

function nest_homepage_sidebars_init() {

	// Homepage sections – drag-and-drop ordering.
	register_sidebar( array(
		'name'          => __( 'Homepage Sections', 'nest' ),
		'id'            => 'homepage-sections',
		'description'   => __( 'Kéo thả các section widget để sắp xếp thứ tự hiển thị trên Trang chủ.', 'nest' ),
		'before_widget' => '', // Widgets output their own wrappers.
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	// Header promo (topbar text / widget area).
	register_sidebar( array(
		'name'          => __( 'Header Promo', 'nest' ),
		'id'            => 'header-promo',
		'description'   => __( 'Hiển thị nội dung ở thanh topbar. Nếu để trống sẽ dùng Topbar promo text trong Nest Settings.', 'nest' ),
		'before_widget' => '<span class="truncate">',
		'after_widget'  => '</span>',
		'before_title'  => '<span class="sr-only">',
		'after_title'   => '</span>',
	) );

	// Footer menu columns (2, 3, 4). Column 1 is the brand block (logo+contact)
	// and stays hardcoded in template-parts/layout/footer-content.php.
	for ( $i = 2; $i <= 4; $i ++ ) {
		register_sidebar( array(
			/* translators: %d: column number */
			'name'          => sprintf( __( 'Footer – Column %d', 'nest' ), $i ),
			'id'            => 'footer-col-' . $i,
			'description'   => __( 'Widgets hiển thị ở cột footer này. Trên mobile mỗi widget hiển thị dạng accordion (mặc định đóng).', 'nest' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		) );
	}
}

/* =======================================================================
 * Register all 7 widgets.
 * ===================================================================== */

add_action( 'widgets_init', 'nest_register_homepage_widgets' );

function nest_register_homepage_widgets() {
	register_widget( 'Nest_Widget_Hero_Slider' );
	register_widget( 'Nest_Widget_Services' );
	register_widget( 'Nest_Widget_Banner_Collection' );
	register_widget( 'Nest_Widget_About' );
	register_widget( 'Nest_Widget_Product_Tabs' );
	register_widget( 'Nest_Widget_Coupon_Slider' );
	register_widget( 'Nest_Widget_Why_Choose' );
	register_widget( 'Nest_Widget_News' );
	register_widget( 'Nest_Widget_Partners' );
	register_widget( 'Nest_Widget_Footer_Menu' );
	register_widget( 'Nest_Widget_Footer_Images' );
}

/* =======================================================================
 * 1. Hero Slider Widget
 * ===================================================================== */

class Nest_Widget_Hero_Slider extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_hero_slider',
			__( '[Home] Hero Slider', 'nest' ),
			array( 'description' => __( 'Hero slider cho trang chủ.', 'nest' ) )
		);
	}

	public function widget( $args, $instance ) {
		$slides = isset( $instance['slides'] ) ? $instance['slides'] : array();

		// Fallback to theme default images if no slides configured.
		if ( empty( $slides ) ) {
			$slides = array(
				array(
					'image' => get_template_directory_uri() . '/assets/images/slider_1.jpg',
					'link'  => '#',
					'alt'   => '',
				),
				array(
					'image' => get_template_directory_uri() . '/assets/images/slider_2.jpg',
					'link'  => '#',
					'alt'   => '',
				),
			);
		}
		?>
		<section class="section-slider group/slider relative">
			<div class="swiper hero-slider">
				<div class="swiper-wrapper">
					<?php foreach ( $slides as $slide ) : ?>
						<div class="swiper-slide">
							<a href="<?php echo esc_url( $slide['link'] ); ?>">
								<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="<?php echo esc_attr( $slide['alt'] ); ?>" class="w-full h-auto object-cover">
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-button-prev">
					<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect>
						<rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect>
						<path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						<path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</div>
				<div class="swiper-button-next">
					<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect>
						<rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect>
						<path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						<path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</div>
				<div class="absolute bottom-0 left-0 w-full h-1 z-10">
					<div class="hero-slider-progress h-full bg-secondary" style="width:0"></div>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$slides = isset( $instance['slides'] ) ? $instance['slides'] : array();
		$count  = max( count( $slides ), 2 );
		?>
		<p><strong><?php esc_html_e( 'Slides (tối thiểu 2):', 'nest' ); ?></strong></p>
		<?php for ( $i = 0; $i < $count; $i ++ ) : ?>
			<div style="border:1px solid #ddd;padding:8px;margin-bottom:8px;">
				<p><strong><?php printf( esc_html__( 'Slide %d', 'nest' ), $i + 1 ); ?></strong></p>
				<p>
					<label><?php esc_html_e( 'Image URL:', 'nest' ); ?></label><br>
					<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'slides' ) ); ?>[<?php echo $i; ?>][image]" type="text" value="<?php echo esc_attr( isset( $slides[ $i ]['image'] ) ? $slides[ $i ]['image'] : '' ); ?>">
				</p>
				<p>
					<label><?php esc_html_e( 'Link URL:', 'nest' ); ?></label><br>
					<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'slides' ) ); ?>[<?php echo $i; ?>][link]" type="text" value="<?php echo esc_attr( isset( $slides[ $i ]['link'] ) ? $slides[ $i ]['link'] : '#' ); ?>">
				</p>
				<p>
					<label><?php esc_html_e( 'Alt text:', 'nest' ); ?></label><br>
					<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'slides' ) ); ?>[<?php echo $i; ?>][alt]" type="text" value="<?php echo esc_attr( isset( $slides[ $i ]['alt'] ) ? $slides[ $i ]['alt'] : '' ); ?>">
				</p>
			</div>
		<?php endfor; ?>
		<p class="description"><?php esc_html_e( 'Thêm slide bằng cách lưu rồi thêm dòng mới. Để trống Image URL sẽ bỏ qua slide đó.', 'nest' ); ?></p>
		<p>
			<label><?php esc_html_e( 'Số slide mong muốn:', 'nest' ); ?></label>
			<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'slide_count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>" min="2" max="10" style="width:60px">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$slides   = array();

		if ( isset( $new_instance['slides'] ) && is_array( $new_instance['slides'] ) ) {
			foreach ( $new_instance['slides'] as $slide ) {
				$image = isset( $slide['image'] ) ? esc_url_raw( trim( $slide['image'] ) ) : '';
				if ( ! $image ) {
					continue;
				}
				$slides[] = array(
					'image' => $image,
					'link'  => isset( $slide['link'] ) ? esc_url_raw( trim( $slide['link'] ) ) : '#',
					'alt'   => isset( $slide['alt'] ) ? sanitize_text_field( $slide['alt'] ) : '',
				);
			}
		}

		// If user wants more slides than data.
		$count = isset( $new_instance['slide_count'] ) ? absint( $new_instance['slide_count'] ) : count( $slides );
		$count = max( $count, 2 );
		while ( count( $slides ) < $count ) {
			$slides[] = array( 'image' => '', 'link' => '#', 'alt' => '' );
		}

		$instance['slides'] = $slides;
		return $instance;
	}
}

/* =======================================================================
 * 2. Services Widget
 * ===================================================================== */

class Nest_Widget_Services extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_services',
			__( '[Home] Services', 'nest' ),
			array( 'description' => __( 'Dải dịch vụ cam kết.', 'nest' ) )
		);
	}

	private function get_defaults() {
		return array(
			array( 'icon' => get_template_directory_uri() . '/assets/images/ser_1.png', 'title' => __( 'Giao hàng siêu tốc', 'nest' ), 'desc' => __( 'Giao hàng trong 24h', 'nest' ) ),
			array( 'icon' => get_template_directory_uri() . '/assets/images/ser_2.png', 'title' => __( 'Tư vấn miễn phí', 'nest' ), 'desc' => __( 'Đội ngũ tư vấn tận tình', 'nest' ) ),
			array( 'icon' => get_template_directory_uri() . '/assets/images/ser_3.png', 'title' => __( 'Thanh toán', 'nest' ), 'desc' => __( 'Thanh toán an toàn', 'nest' ) ),
			array( 'icon' => get_template_directory_uri() . '/assets/images/ser_4.png', 'title' => __( 'Giải pháp quà tặng', 'nest' ), 'desc' => __( 'Dành cho doanh nghiệp', 'nest' ) ),
		);
	}

	public function widget( $args, $instance ) {
		$services = isset( $instance['items'] ) && ! empty( $instance['items'] ) ? $instance['items'] : $this->get_defaults();
		?>
		<section class="section-services py-[30px]">
			<div class="container mx-auto px-4">
				<div class="relative bg-white p-1">
					<!-- Wire decorations -->
					<div class="absolute bottom-full left-[17px] w-px h-[30px] bg-primary"></div>
					<div class="absolute bottom-full right-[17px] w-px h-[30px] bg-primary"></div>
					<div class="absolute top-[14px] left-[14px] w-[7px] h-[7px] border border-primary"></div>
					<div class="absolute top-[5px] left-[17px] w-px h-[13px] bg-primary"></div>
					<div class="absolute top-[14px] right-[14px] w-[7px] h-[7px] border border-primary"></div>
					<div class="absolute top-[5px] right-[17px] w-px h-[13px] bg-primary"></div>

					<div class="border border-primary">
						<div class="flex flex-wrap">
							<?php foreach ( $services as $index => $service ) : ?>
								<div class="service-item w-1/2 md:w-1/4 py-2.5 px-3 lg:py-2.5 lg:px-4 text-center lg:text-left border-primary transition-all duration-300 flex flex-col lg:flex-row items-center gap-1 lg:gap-2.5 <?php echo 3 !== $index ? 'border-r max-md:[&:nth-child(2)]:border-r-0' : ''; ?> <?php echo $index < 2 ? 'max-md:border-b' : ''; ?>">
									<div class="relative w-10 h-10 shrink-0">
										<span class="absolute -bottom-[5px] -left-[5px] w-[50px] h-[50px] rounded-full bg-[#fff3e1] hidden lg:block"></span>
										<img src="<?php echo esc_url( $service['icon'] ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>" class="relative w-full h-full object-contain" width="40" height="40">
									</div>
									<div>
										<h3 class="text-lg font-semibold text-primary leading-tight mb-0.5"><?php echo esc_html( $service['title'] ); ?></h3>
										<span class="text-sm text-gray-500 leading-tight"><?php echo esc_html( $service['desc'] ); ?></span>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$items = isset( $instance['items'] ) && ! empty( $instance['items'] ) ? $instance['items'] : $this->get_defaults();
		?>
		<p><strong><?php esc_html_e( 'Dịch vụ (4 items):', 'nest' ); ?></strong></p>
		<?php for ( $i = 0; $i < 4; $i ++ ) : $item = isset( $items[ $i ] ) ? $items[ $i ] : array(); ?>
			<div style="border:1px solid #ddd;padding:8px;margin-bottom:8px;">
				<p><strong><?php printf( esc_html__( 'Item %d', 'nest' ), $i + 1 ); ?></strong></p>
				<p><label><?php esc_html_e( 'Icon URL:', 'nest' ); ?></label><br>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][icon]" type="text" value="<?php echo esc_attr( isset( $item['icon'] ) ? $item['icon'] : '' ); ?>"></p>
				<p><label><?php esc_html_e( 'Title:', 'nest' ); ?></label><br>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][title]" type="text" value="<?php echo esc_attr( isset( $item['title'] ) ? $item['title'] : '' ); ?>"></p>
				<p><label><?php esc_html_e( 'Description:', 'nest' ); ?></label><br>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][desc]" type="text" value="<?php echo esc_attr( isset( $item['desc'] ) ? $item['desc'] : '' ); ?>"></p>
			</div>
		<?php endfor; ?>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$items    = array();
		if ( isset( $new_instance['items'] ) && is_array( $new_instance['items'] ) ) {
			foreach ( $new_instance['items'] as $item ) {
				$items[] = array(
					'icon'  => isset( $item['icon'] ) ? esc_url_raw( trim( $item['icon'] ) ) : '',
					'title' => isset( $item['title'] ) ? sanitize_text_field( $item['title'] ) : '',
					'desc'  => isset( $item['desc'] ) ? sanitize_text_field( $item['desc'] ) : '',
				);
			}
		}
		$instance['items'] = $items;
		return $instance;
	}
}

/* =======================================================================
 * 3. Banner Collection Widget
 * ===================================================================== */

class Nest_Widget_Banner_Collection extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_banner_collection',
			__( '[Home] Banner Collection', 'nest' ),
			array( 'description' => __( 'Bộ 4 banner quà tặng.', 'nest' ) )
		);
	}

	private function get_defaults() {
		return array(
			array( 'image' => get_template_directory_uri() . '/assets/images/img_4banner_1.jpg', 'title' => __( 'Bộ quà 4 mùa', 'nest' ), 'price' => __( 'Giá chỉ từ 499k', 'nest' ), 'url' => '#' ),
			array( 'image' => get_template_directory_uri() . '/assets/images/img_4banner_2.jpg', 'title' => __( 'Bộ quà Lộc Phát', 'nest' ), 'price' => __( 'Giá chỉ từ 599k', 'nest' ), 'url' => '#' ),
			array( 'image' => get_template_directory_uri() . '/assets/images/img_4banner_3.jpg', 'title' => __( 'Bộ quà Thịnh Vượng', 'nest' ), 'price' => __( 'Giá chỉ từ 799k', 'nest' ), 'url' => '#' ),
			array( 'image' => get_template_directory_uri() . '/assets/images/img_4banner_4.jpg', 'title' => __( 'Bộ quà Tài Lộc', 'nest' ), 'price' => __( 'Giá chỉ từ 999k', 'nest' ), 'url' => '#' ),
		);
	}

	public function widget( $args, $instance ) {
		$eyebrow  = isset( $instance['eyebrow'] ) && $instance['eyebrow'] ? $instance['eyebrow'] : get_bloginfo( 'name' );
		$title    = isset( $instance['title'] ) && $instance['title'] ? $instance['title'] : __( 'Bộ sưu tập quà tặng cao cấp', 'nest' );
		$subtitle = isset( $instance['subtitle'] ) ? $instance['subtitle'] : __( 'Bộ quà tặng Lucky là giải pháp quà Tết, quà Trung Thu, quà tặng doanh nghiệp,.. được lựa chọn để kết nối các mối quan hệ xã hội, kết nối tình thân, vun đắp các mối quan hệ thêm bền chặt gắn kết.', 'nest' );
		$banners  = isset( $instance['banners'] ) && ! empty( $instance['banners'] ) ? $instance['banners'] : $this->get_defaults();
		?>
		<section class="section-index py-[30px] max-md:py-[25px]">
			<div class="container mx-auto px-4">

				<div class="section-title text-center relative mb-6">
					<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( $eyebrow ); ?></span>
					<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php echo esc_html( $title ); ?></h2>
					<?php if ( $subtitle ) : ?>
						<div class="text-base max-md:text-sm mx-auto mt-1 max-w-[760px]"><?php echo esc_html( $subtitle ); ?></div>
					<?php endif; ?>
					<div class="section-separator flex justify-center relative mt-2.5">
						<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
					</div>
				</div>

				<div class="flex flex-nowrap md:flex-wrap md:-mx-2.5 max-md:overflow-x-auto max-md:snap-x max-md:snap-mandatory max-md:-mx-4 max-md:px-4 max-md:gap-4">
					<?php foreach ( $banners as $banner ) : ?>
						<div class="w-[65%] shrink-0 snap-start md:w-1/4 md:shrink md:px-2.5">
							<a href="<?php echo esc_url( $banner['url'] ); ?>" class="group/banner block relative overflow-hidden aspect-[382/574]" title="<?php echo esc_attr( $banner['title'] ); ?>">
								<span class="absolute inset-1 border border-white/50 z-[1] pointer-events-none"></span>
								<img src="<?php echo esc_url( $banner['image'] ); ?>" alt="<?php echo esc_attr( $banner['title'] ); ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover/banner:scale-[1.03]" width="382" height="574" loading="lazy">
								<div class="absolute left-0 w-full p-4 max-lg:p-2.5 bg-black/70 backdrop-blur-sm text-white border-t-2 border-secondary z-[1] transition-all duration-300 bottom-0 lg:-bottom-9 lg:group-hover/banner:bottom-0">
									<h3 class="text-lg max-lg:text-sm font-bold leading-tight mb-0"><?php echo esc_html( $banner['title'] ); ?></h3>
									<span class="block text-sm max-lg:text-xs mt-1"><?php echo esc_html( $banner['price'] ); ?></span>
									<span class="hidden lg:block mt-1.5 text-sm italic text-secondary hover:text-hover"><?php esc_html_e( 'Xem ngay »', 'nest' ); ?></span>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$eyebrow  = isset( $instance['eyebrow'] ) ? $instance['eyebrow'] : '';
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$subtitle = isset( $instance['subtitle'] ) ? $instance['subtitle'] : '';
		$banners  = isset( $instance['banners'] ) && ! empty( $instance['banners'] ) ? $instance['banners'] : $this->get_defaults();
		?>
		<p><label><?php esc_html_e( 'Eyebrow:', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'eyebrow' ) ); ?>" value="<?php echo esc_attr( $eyebrow ); ?>">
		<span class="description"><?php esc_html_e( 'Để trống sẽ hiện tên site.', 'nest' ); ?></span></p>
		<p><label><?php esc_html_e( 'Title:', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"></p>
		<p><label><?php esc_html_e( 'Subtitle:', 'nest' ); ?></label>
		<textarea class="widefat" rows="3" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>"><?php echo esc_textarea( $subtitle ); ?></textarea></p>
		<hr>
		<?php for ( $i = 0; $i < 4; $i ++ ) : $b = isset( $banners[ $i ] ) ? $banners[ $i ] : array(); ?>
			<div style="border:1px solid #ddd;padding:8px;margin-bottom:8px;">
				<p><strong>Banner <?php echo $i + 1; ?></strong></p>
				<p><label>Image URL:</label><br><input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'banners' ) ); ?>[<?php echo $i; ?>][image]" value="<?php echo esc_attr( isset( $b['image'] ) ? $b['image'] : '' ); ?>"></p>
				<p><label>Title:</label><br><input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'banners' ) ); ?>[<?php echo $i; ?>][title]" value="<?php echo esc_attr( isset( $b['title'] ) ? $b['title'] : '' ); ?>"></p>
				<p><label>Label/Price:</label><br><input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'banners' ) ); ?>[<?php echo $i; ?>][price]" value="<?php echo esc_attr( isset( $b['price'] ) ? $b['price'] : '' ); ?>"></p>
				<p><label>URL:</label><br><input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'banners' ) ); ?>[<?php echo $i; ?>][url]" value="<?php echo esc_attr( isset( $b['url'] ) ? $b['url'] : '#' ); ?>"></p>
			</div>
		<?php endfor; ?>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['eyebrow']  = sanitize_text_field( $new_instance['eyebrow'] ?? '' );
		$instance['title']    = sanitize_text_field( $new_instance['title'] ?? '' );
		$instance['subtitle'] = sanitize_text_field( $new_instance['subtitle'] ?? '' );

		$banners = array();
		if ( isset( $new_instance['banners'] ) && is_array( $new_instance['banners'] ) ) {
			foreach ( $new_instance['banners'] as $b ) {
				$banners[] = array(
					'image' => esc_url_raw( $b['image'] ?? '' ),
					'title' => sanitize_text_field( $b['title'] ?? '' ),
					'price' => sanitize_text_field( $b['price'] ?? '' ),
					'url'   => esc_url_raw( $b['url'] ?? '#' ),
				);
			}
		}
		$instance['banners'] = $banners;
		return $instance;
	}
}

/* =======================================================================
 * 4. About Widget
 * ===================================================================== */

class Nest_Widget_About extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_about',
			__( '[Home] About', 'nest' ),
			array( 'description' => __( 'Section giới thiệu thương hiệu.', 'nest' ) )
		);
	}

	public function widget( $args, $instance ) {
		$eyebrow    = isset( $instance['eyebrow'] ) && $instance['eyebrow'] ? $instance['eyebrow'] : get_bloginfo( 'name' );
		$title      = isset( $instance['title'] ) && $instance['title'] ? $instance['title'] : __( 'Câu chuyện về Lucky', 'nest' );
		$content    = isset( $instance['content'] ) && $instance['content'] ? $instance['content'] : __( 'Như quý vị đã biết: "Tài sản lớn nhất của đời người là sức khỏe và trí tuệ", có sức khỏe và trí tuệ thì sẽ có tất cả. Sản phẩm yến sào là thực phẩm bổ dưỡng mang lại cho Quý vị sức khỏe, trí tuệ và sự trẻ trung. Yến sào được thị trường đón nhận với phương châm: "Chất lượng uy tín là thương hiệu".', 'nest' );
		$btn_text   = isset( $instance['btn_text'] ) && $instance['btn_text'] ? $instance['btn_text'] : __( 'Xem chi tiết', 'nest' );
		$btn_url    = isset( $instance['btn_url'] ) && $instance['btn_url'] ? $instance['btn_url'] : home_url( nest_get_option( 'about_url', '/gioi-thieu' ) );
		$bg_image   = isset( $instance['bg_image'] ) && $instance['bg_image'] ? $instance['bg_image'] : get_template_directory_uri() . '/assets/images/section_about_bg.jpg';
		$prod_image = isset( $instance['product_image'] ) && $instance['product_image'] ? $instance['product_image'] : get_template_directory_uri() . '/assets/images/section_about_product_1.png';
		?>
		<section class="section-index py-[30px] max-md:py-[25px]">
			<div class="relative overflow-hidden bg-primary bg-cover bg-bottom bg-no-repeat border-y-4 border-hover py-20 max-lg:py-10" style="background-image: url('<?php echo esc_url( $bg_image ); ?>')">
				<div class="container mx-auto px-4">
					<div class="flex flex-wrap -mx-2.5">
						<div class="w-full lg:w-1/2 px-2.5 flex items-center max-lg:mb-8">
							<div class="relative text-center p-7 max-md:p-5 bg-black/20 z-[1] before:content-[''] before:absolute before:inset-2 before:border before:border-secondary/50 before:-z-[1]">
								<div class="section-title text-center relative mb-6">
									<span class="block w-full font-medium uppercase text-white text-sm"><?php echo esc_html( $eyebrow ); ?></span>
									<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0 text-secondary drop-shadow-md"><?php echo esc_html( $title ); ?></h2>
									<div class="section-separator section-separator--light flex justify-center relative mt-2.5">
										<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"></div>
									</div>
								</div>
								<div class="text-white text-justify text-sm leading-relaxed"><?php echo wp_kses_post( nl2br( $content ) ); ?></div>
								<a href="<?php echo esc_url( $btn_url ); ?>" class="nest-btn mt-5" title="<?php echo esc_attr( $btn_text ); ?>">
									<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
									<span class="nest-btn__text"><?php echo esc_html( $btn_text ); ?></span>
									<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
								</a>
							</div>
						</div>
						<div class="w-full lg:w-1/2 px-2.5 flex justify-center items-center">
							<div class="max-w-[600px] w-full aspect-[600/371]">
								<img src="<?php echo esc_url( $prod_image ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-full h-full object-contain" width="600" height="371" loading="lazy">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$fields = array(
			'eyebrow'       => array( 'label' => __( 'Eyebrow (để trống = tên site)', 'nest' ), 'default' => '' ),
			'title'         => array( 'label' => __( 'Title', 'nest' ), 'default' => '' ),
			'content'       => array( 'label' => __( 'Nội dung', 'nest' ), 'default' => '', 'type' => 'textarea' ),
			'btn_text'      => array( 'label' => __( 'Button text', 'nest' ), 'default' => __( 'Xem chi tiết', 'nest' ) ),
			'btn_url'       => array( 'label' => __( 'Button URL', 'nest' ), 'default' => '' ),
			'bg_image'      => array( 'label' => __( 'Background image URL', 'nest' ), 'default' => '' ),
			'product_image' => array( 'label' => __( 'Product image URL', 'nest' ), 'default' => '' ),
		);
		foreach ( $fields as $key => $f ) :
			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $f['default'];
			$type  = isset( $f['type'] ) ? $f['type'] : 'text';
			?>
			<p>
				<label><?php echo esc_html( $f['label'] ); ?>:</label><br>
				<?php if ( 'textarea' === $type ) : ?>
					<textarea class="widefat" rows="5" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
				<?php else : ?>
					<input class="widefat" type="text" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" value="<?php echo esc_attr( $value ); ?>">
				<?php endif; ?>
			</p>
		<?php endforeach;
	}

	public function update( $new_instance, $old_instance ) {
		return array(
			'eyebrow'       => sanitize_text_field( $new_instance['eyebrow'] ?? '' ),
			'title'         => sanitize_text_field( $new_instance['title'] ?? '' ),
			'content'       => wp_kses_post( $new_instance['content'] ?? '' ),
			'btn_text'      => sanitize_text_field( $new_instance['btn_text'] ?? '' ),
			'btn_url'       => esc_url_raw( $new_instance['btn_url'] ?? '' ),
			'bg_image'      => esc_url_raw( $new_instance['bg_image'] ?? '' ),
			'product_image' => esc_url_raw( $new_instance['product_image'] ?? '' ),
		);
	}
}

/* =======================================================================
 * 5. Product Tabs Widget
 * ===================================================================== */

class Nest_Widget_Product_Tabs extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_product_tabs',
			__( '[Home] Product Tabs', 'nest' ),
			array( 'description' => __( 'Hiển thị sản phẩm theo danh mục cha, tab = danh mục con.', 'nest' ) )
		);
	}

	public function widget( $args, $instance ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$cat_id      = isset( $instance['parent_cat_id'] ) ? absint( $instance['parent_cat_id'] ) : 0;
		$per_page    = isset( $instance['per_page'] ) ? absint( $instance['per_page'] ) : 8;
		$show_tabs   = isset( $instance['show_tabs'] ) ? (bool) $instance['show_tabs'] : true;

		// Resolve parent category.
		$parent_cat = null;
		if ( $cat_id ) {
			$parent_cat = get_term( $cat_id, 'product_cat' );
			if ( is_wp_error( $parent_cat ) || ! $parent_cat ) {
				$parent_cat = null;
			}
		}

		// Fallback: pick the most popular category.
		if ( ! $parent_cat ) {
			$cats = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'number'     => 1,
				'orderby'    => 'count',
				'order'      => 'DESC',
				'exclude'    => array( get_option( 'default_product_cat' ) ),
			) );
			$parent_cat = ! empty( $cats ) ? $cats[0] : null;
		}

		if ( ! $parent_cat ) {
			return;
		}

		$child_cats = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'parent'     => $parent_cat->term_id,
			'orderby'    => 'menu_order',
		) );

		if ( empty( $child_cats ) ) {
			$child_cats = array( $parent_cat );
		}

		$first_cat = $child_cats[0];

		$products = new WP_Query( array(
			'post_type'      => 'product',
			'posts_per_page' => $per_page,
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $first_cat->term_id,
				),
			),
		) );

		// Re-use existing section template part for rendering.
		?>
		<section class="section-index section-product-tab py-[30px] max-md:py-[25px]">
			<div class="container mx-auto px-4">
				<div class="section-title text-center relative mb-6">
					<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
					<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0">
						<a href="<?php echo esc_url( get_term_link( $parent_cat ) ); ?>" title="<?php echo esc_attr( $parent_cat->name ); ?>"><?php echo esc_html( $parent_cat->name ); ?></a>
					</h2>
					<div class="section-separator flex justify-center relative mt-2.5">
						<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
					</div>

					<?php if ( $show_tabs && count( $child_cats ) > 1 ) : ?>
						<div class="mt-4 flex justify-center flex-wrap gap-2">
							<?php foreach ( $child_cats as $index => $cat ) : ?>
								<button class="product-tab-btn px-4 py-2 text-sm font-medium border border-primary/30 transition-all duration-200 hover:bg-primary hover:text-white <?php echo 0 === $index ? 'bg-primary text-white' : 'bg-white text-foreground'; ?>" data-tab="<?php echo esc_attr( $cat->slug ); ?>" data-cat-id="<?php echo esc_attr( $cat->term_id ); ?>">
									<?php echo esc_html( $cat->name ); ?>
								</button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="product-tab-content section-slider">
					<?php if ( $products->have_posts() ) : ?>
						<div class="swiper product-slider">
							<div class="swiper-wrapper">
								<?php
								while ( $products->have_posts() ) :
									$products->the_post();
									global $product;
									$permalink     = get_permalink( $product->get_id() );
									$title         = get_the_title( $product->get_id() );
									$image         = $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'duration-300 w-full h-auto', 'loading' => 'lazy' ) );
									$regular_price = $product->get_regular_price();
									$sale_price    = $product->get_sale_price();
									$is_on_sale    = $product->is_on_sale();

									$percent = 0;
									if ( $is_on_sale && (float) $regular_price > 0 ) {
										if ( $product->is_type( 'variable' ) ) {
											$rp = (float) $product->get_variation_regular_price( 'max' );
											$sp = (float) $product->get_variation_sale_price( 'min' );
										} else {
											$rp = (float) $regular_price;
											$sp = (float) $sale_price;
										}
										$percent = round( ( ( $rp - $sp ) / $rp ) * 100 );
									}

									$promotions = array();
									if ( function_exists( 'get_field' ) ) {
										$acf_promos = get_field( 'product_promotions', $product->get_id() );
										if ( $acf_promos && is_array( $acf_promos ) ) {
											foreach ( $acf_promos as $promo ) {
												if ( ! empty( $promo['promotion_text'] ) ) {
													$promotions[] = $promo['promotion_text'];
												}
											}
										}
									}
									if ( empty( $promotions ) ) {
										$meta_promos = get_post_meta( $product->get_id(), 'nest_product_promotions', true );
										if ( $meta_promos ) {
											$promotions = array_filter( array_map( 'trim', preg_split( '/[\n,]+/', $meta_promos ) ) );
										}
									}
									?>
									<div class="swiper-slide">
										<div class="item_product_main">
											<div class="product-action item-product-main duration-300">
												<?php if ( $is_on_sale && $percent > 0 ) : ?>
													<span class="flash-sale">-<?php echo esc_html( $percent ); ?>%</span>
												<?php endif; ?>

												<?php if ( ! empty( $promotions ) ) : ?>
													<div class="tag-promo" title="<?php esc_attr_e( 'Quà tặng', 'nest' ); ?>">
														<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 512 512"><path d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path></svg>
														<div class="promotion-content">
															<div class="line-clamp-5-new">
																<?php foreach ( $promotions as $promo ) : ?>
																	<p><?php echo wp_kses_post( '- ' . $promo ); ?></p>
																<?php endforeach; ?>
															</div>
														</div>
													</div>
												<?php endif; ?>

												<div class="product-thumbnail">
													<a class="image_thumb scale_hover" href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>">
														<?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
													</a>
												</div>

												<div class="product-info">
													<div class="name-price">
														<h3 class="product-name line-clamp-2-new">
															<a href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title ); ?></a>
														</h3>
														<div class="product-price-cart">
															<?php if ( $is_on_sale ) : ?>
																<span class="compare-price"><?php echo wp_kses_post( wc_price( $regular_price ) ); ?></span>
																<span class="price"><?php echo wp_kses_post( wc_price( $sale_price ) ); ?></span>
															<?php elseif ( $product->get_price() ) : ?>
																<span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
															<?php else : ?>
																<span class="price"><?php esc_html_e( 'Liên hệ', 'nest' ); ?></span>
															<?php endif; ?>
														</div>
													</div>
													<div class="product-button">
														<?php if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) : ?>
															<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" class="btn-cart btn-views add_to_cart btn btn-primary ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" title="<?php esc_attr_e( 'Thêm vào giỏ hàng', 'nest' ); ?>">
																<span><?php esc_html_e( 'Thêm vào giỏ', 'nest' ); ?></span>
																<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 32 32"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"></path></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"></path></g></g></svg>
															</a>
														<?php else : ?>
															<a href="<?php echo esc_url( $permalink ); ?>" class="btn-cart btn-views btn btn-primary" title="<?php esc_attr_e( 'Tùy chọn', 'nest' ); ?>">
																<span><?php esc_html_e( 'Tùy chọn', 'nest' ); ?></span>
																<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 32 32"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"></path></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"></path></g></g></svg>
															</a>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
							<div class="swiper-button-prev">
								<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
							</div>
							<div class="swiper-button-next">
								<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
							</div>
						</div>
						<?php wp_reset_postdata(); ?>
					<?php else : ?>
						<p class="text-center text-sm text-gray-400 py-8"><?php esc_html_e( 'Chưa có sản phẩm trong danh mục này.', 'nest' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$cat_id    = isset( $instance['parent_cat_id'] ) ? absint( $instance['parent_cat_id'] ) : 0;
		$per_page  = isset( $instance['per_page'] ) ? absint( $instance['per_page'] ) : 8;
		$show_tabs = isset( $instance['show_tabs'] ) ? (bool) $instance['show_tabs'] : true;

		$categories = array();
		if ( class_exists( 'WooCommerce' ) ) {
			$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'exclude'    => array( get_option( 'default_product_cat' ) ),
			) );
		}
		?>
		<p>
			<label><?php esc_html_e( 'Danh mục cha:', 'nest' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'parent_cat_id' ) ); ?>">
				<option value="0"><?php esc_html_e( '-- Tự động (danh mục nhiều sản phẩm nhất) --', 'nest' ); ?></option>
				<?php foreach ( $categories as $cat ) : ?>
					<option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php selected( $cat_id, $cat->term_id ); ?>><?php echo esc_html( $cat->name ); ?> (<?php echo esc_html( $cat->count ); ?>)</option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label><?php esc_html_e( 'Số sản phẩm:', 'nest' ); ?></label>
			<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'per_page' ) ); ?>" value="<?php echo esc_attr( $per_page ); ?>" min="1" max="20" style="width:60px">
		</p>
		<p>
			<input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'show_tabs' ) ); ?>" value="1" <?php checked( $show_tabs ); ?>>
			<label><?php esc_html_e( 'Hiển thị tabs danh mục con', 'nest' ); ?></label>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return array(
			'parent_cat_id' => absint( $new_instance['parent_cat_id'] ?? 0 ),
			'per_page'      => absint( $new_instance['per_page'] ?? 8 ),
			'show_tabs'     => ! empty( $new_instance['show_tabs'] ),
		);
	}
}

/* =======================================================================
 * 6. Coupon Slider Widget
 * ===================================================================== */

class Nest_Widget_Coupon_Slider extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_coupon_slider',
			__( '[Home] Coupon Slider', 'nest' ),
			array( 'description' => __( 'Slider mã giảm giá.', 'nest' ) )
		);
	}

	public function widget( $args, $instance ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$title    = isset( $instance['title'] ) && $instance['title'] ? $instance['title'] : __( 'Mã giảm giá dành cho bạn', 'nest' );
		$eyebrow  = isset( $instance['eyebrow'] ) && $instance['eyebrow'] ? $instance['eyebrow'] : get_bloginfo( 'name' );
		$count    = isset( $instance['count'] ) ? absint( $instance['count'] ) : 8;
		$fallback = isset( $instance['fallback_image'] ) ? $instance['fallback_image'] : '';

		$coupons = get_posts( array(
			'post_type'      => 'shop_coupon',
			'posts_per_page' => $count,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );

		if ( empty( $coupons ) ) {
			return;
		}
		?>
		<section class="section-index section-coupon py-[30px] max-md:py-[25px]">
			<div class="container mx-auto px-4">
				<div class="section-title text-center relative mb-6">
					<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( $eyebrow ); ?></span>
					<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php echo esc_html( $title ); ?></h2>
					<div class="section-separator flex justify-center relative mt-2.5">
						<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
					</div>
				</div>

				<div class="section-slider">
					<div class="swiper coupon-slider">
						<div class="swiper-wrapper">
							<?php foreach ( $coupons as $index => $coupon_post ) :
								$wc_coupon     = new WC_Coupon( $coupon_post->ID );
								$code          = $wc_coupon->get_code();
								$amount        = $wc_coupon->get_amount();
								$discount_type = $wc_coupon->get_discount_type();
								$date_expires  = $wc_coupon->get_date_expires();
								$description   = $coupon_post->post_excerpt;

								if ( 'percent' === $discount_type ) {
									$label = sprintf( __( 'Giảm %s%% giá trị đơn hàng', 'nest' ), $amount );
								} else {
									$label = sprintf( __( 'Giảm %s giá trị đơn hàng', 'nest' ), wc_price( $amount ) );
								}

								$expiry_str = $date_expires ? date_i18n( 'd/m/Y', $date_expires->getTimestamp() ) : '';

								$image_index = ( $index % 4 ) + 1;
								$image_url   = $fallback ? $fallback : get_template_directory_uri() . '/assets/images/img_coupon_' . $image_index . '.jpg';
								if ( has_post_thumbnail( $coupon_post->ID ) ) {
									$image_url = get_the_post_thumbnail_url( $coupon_post->ID, 'thumbnail' );
								}
							?>
								<div class="swiper-slide h-auto py-1">
									<div class="box-coupon relative flex items-center rounded p-2 h-full" style="filter: drop-shadow(0px 0px 3px rgba(0,0,0,0.15));">
										<div class="coupon-mask absolute inset-0 bg-white rounded" style="-webkit-mask: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/ticket5.svg' ); ?>') no-repeat; mask: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/ticket5.svg' ); ?>') no-repeat; mask-size: cover; -webkit-mask-size: cover;"></div>
										<div class="relative w-1/3 flex-none flex items-center justify-center aspect-square max-h-[70px]">
											<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( strtoupper( $code ) ); ?>" class="w-full h-full object-contain" width="88" height="88" loading="lazy">
										</div>
										<div class="relative flex-1 flex flex-col justify-between pl-3 min-h-[70px]">
											<div>
												<span class="block text-base font-bold leading-tight"><?php echo esc_html( strtoupper( $code ) ); ?></span>
												<span class="block text-xs text-gray-600 font-medium line-clamp-2 mt-0.5"><?php echo esc_html( $description ? $description : wp_strip_all_tags( $label ) ); ?></span>
											</div>
											<div class="flex items-end justify-between gap-1 mt-1.5">
												<?php if ( $expiry_str ) : ?>
													<span class="text-[11px] text-gray-500 font-medium"><?php printf( esc_html__( 'HSD: %s', 'nest' ), esc_html( $expiry_str ) ); ?></span>
												<?php endif; ?>
												<button class="js-copy-coupon bg-primary text-white text-[11px] font-medium px-2 py-0.5 relative cursor-pointer hover:bg-hover transition-colors before:content-[''] before:absolute before:inset-[2px] before:border before:border-white/30" data-code="<?php echo esc_attr( strtoupper( $code ) ); ?>"><?php esc_html_e( 'Copy mã', 'nest' ); ?></button>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-button-prev">
							<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
						</div>
						<div class="swiper-button-next">
							<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$eyebrow  = isset( $instance['eyebrow'] ) ? $instance['eyebrow'] : '';
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$count    = isset( $instance['count'] ) ? absint( $instance['count'] ) : 8;
		$fallback = isset( $instance['fallback_image'] ) ? $instance['fallback_image'] : '';
		?>
		<p><label><?php esc_html_e( 'Eyebrow:', 'nest' ); ?></label><br>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'eyebrow' ) ); ?>" value="<?php echo esc_attr( $eyebrow ); ?>"></p>
		<p><label><?php esc_html_e( 'Title:', 'nest' ); ?></label><br>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"></p>
		<p><label><?php esc_html_e( 'Số coupon hiển thị:', 'nest' ); ?></label>
		<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>" min="1" max="20" style="width:60px"></p>
		<p><label><?php esc_html_e( 'Fallback image URL (khi coupon không có thumbnail):', 'nest' ); ?></label><br>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'fallback_image' ) ); ?>" value="<?php echo esc_attr( $fallback ); ?>"></p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return array(
			'eyebrow'        => sanitize_text_field( $new_instance['eyebrow'] ?? '' ),
			'title'          => sanitize_text_field( $new_instance['title'] ?? '' ),
			'count'          => absint( $new_instance['count'] ?? 8 ),
			'fallback_image' => esc_url_raw( $new_instance['fallback_image'] ?? '' ),
		);
	}
}

/* =======================================================================
 * 7. Why Choose Widget
 * ===================================================================== */

class Nest_Widget_Why_Choose extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_why_choose',
			__( '[Home] Why Choose', 'nest' ),
			array( 'description' => __( 'Vì sao chọn chúng tôi – 6 lý do.', 'nest' ) )
		);
	}

	private function get_defaults() {
		$uri = get_template_directory_uri() . '/assets/images/';
		return array(
			array( 'icon' => $uri . 'why_choise_1_icon.png', 'title' => __( 'Yến sào cao cấp', 'nest' ), 'desc' => __( 'Hoàn toàn được gia công', 'nest' ) ),
			array( 'icon' => $uri . 'why_choise_2_icon.png', 'title' => __( 'Chất lượng tuyệt đối', 'nest' ), 'desc' => __( '100% tự nhiên', 'nest' ) ),
			array( 'icon' => $uri . 'why_choise_3_icon.png', 'title' => __( 'Sản phẩm', 'nest' ), 'desc' => __( 'Đạt chuẩn ATVSTP', 'nest' ) ),
			array( 'icon' => $uri . 'why_choise_4_icon.png', 'title' => __( 'Giá cả hợp lý', 'nest' ), 'desc' => __( 'Không qua trung gian', 'nest' ) ),
			array( 'icon' => $uri . 'why_choise_5_icon.png', 'title' => __( 'Giao hàng', 'nest' ), 'desc' => __( 'Siêu tốc trong 24h', 'nest' ) ),
			array( 'icon' => $uri . 'why_choise_6_icon.png', 'title' => __( 'Thanh toán', 'nest' ), 'desc' => __( 'Đa dạng và an toàn', 'nest' ) ),
		);
	}

	public function widget( $args, $instance ) {
		$eyebrow      = isset( $instance['eyebrow'] ) && $instance['eyebrow'] ? $instance['eyebrow'] : get_bloginfo( 'name' );
		$title        = isset( $instance['title'] ) && $instance['title'] ? $instance['title'] : __( 'Vì sao chọn chúng tôi', 'nest' );
		$center_image = isset( $instance['center_image'] ) && $instance['center_image'] ? $instance['center_image'] : get_template_directory_uri() . '/assets/images/banner_choise.png';
		$items        = isset( $instance['items'] ) && ! empty( $instance['items'] ) ? $instance['items'] : $this->get_defaults();

		$left_items  = array_slice( $items, 0, 3 );
		$right_items = array_slice( $items, 3, 3 );
		?>
		<section class="section-index section-why-choose py-[30px] max-md:py-[25px]">
			<div class="container mx-auto px-4">
				<div class="section-title text-center relative mb-6">
					<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( $eyebrow ); ?></span>
					<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php echo esc_html( $title ); ?></h2>
					<div class="section-separator flex justify-center relative mt-2.5">
						<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
					</div>
				</div>

				<!-- Desktop: 3-column layout -->
				<div class="flex flex-wrap items-center -mx-2.5 max-md:hidden">
					<div class="w-full md:w-1/3 px-2.5">
						<?php foreach ( $left_items as $index => $item ) : ?>
							<div class="why-choose-item group flex items-center flex-row-reverse justify-between py-2.5 mb-5 <?php echo 1 === $index ? 'xl:mr-[10%]' : ''; ?>">
								<div class="why-choose-icon flex items-center justify-center w-[90px] h-[90px] lg:w-[70px] lg:h-[70px] rounded-full bg-gradient-to-r from-secondary to-hover transition-all duration-500 lg:group-hover:[transform:rotateY(180deg)] shrink-0">
									<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="w-16 h-16 lg:w-11 lg:h-11" width="64" height="64" loading="lazy">
								</div>
								<div class="flex-1 text-right pr-3">
									<h3 class="font-bold text-primary text-xl lg:text-base mb-0"><?php echo esc_html( $item['title'] ); ?></h3>
									<p class="mt-1.5 text-base lg:text-sm font-medium leading-snug mb-0"><?php echo esc_html( $item['desc'] ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="w-full md:w-1/3 px-2.5 flex justify-center">
						<div class="w-full aspect-[429/499]">
							<img src="<?php echo esc_url( $center_image ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="w-full h-full object-contain" width="429" height="499" loading="lazy">
						</div>
					</div>
					<div class="w-full md:w-1/3 px-2.5">
						<?php foreach ( $right_items as $index => $item ) : ?>
							<div class="why-choose-item group flex items-center justify-between py-2.5 mb-5 <?php echo 1 === $index ? 'xl:ml-[10%]' : ''; ?>">
								<div class="why-choose-icon flex items-center justify-center w-[90px] h-[90px] lg:w-[70px] lg:h-[70px] rounded-full bg-gradient-to-r from-secondary to-hover transition-all duration-500 lg:group-hover:[transform:rotateY(180deg)] shrink-0">
									<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="w-16 h-16 lg:w-11 lg:h-11" width="64" height="64" loading="lazy">
								</div>
								<div class="flex-1 text-left pl-3">
									<h3 class="font-bold text-primary text-xl lg:text-base mb-0"><?php echo esc_html( $item['title'] ); ?></h3>
									<p class="mt-1.5 text-base lg:text-sm font-medium leading-snug mb-0"><?php echo esc_html( $item['desc'] ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- Mobile: horizontal scroll -->
				<div class="md:hidden">
					<div class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory -mx-[14px] px-[7px] scrollbar-none mb-3">
						<?php foreach ( $items as $item ) : ?>
							<div class="flex-none w-4/5 snap-start px-[7px]">
								<div class="flex items-center py-0 mb-3">
									<div class="flex items-center justify-center w-[70px] h-[70px] rounded-full bg-gradient-to-r from-secondary to-hover shrink-0 order-1">
										<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="w-12 h-12" width="48" height="48" loading="lazy">
									</div>
									<div class="flex-1 text-left pl-3 order-0">
										<h3 class="font-bold text-primary text-base mb-0"><?php echo esc_html( $item['title'] ); ?></h3>
										<p class="mt-1 text-sm font-medium leading-snug mb-0"><?php echo esc_html( $item['desc'] ); ?></p>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="flex justify-center">
						<div class="max-w-[280px] w-full">
							<img src="<?php echo esc_url( $center_image ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="w-full h-auto" width="429" height="499" loading="lazy">
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$eyebrow      = isset( $instance['eyebrow'] ) ? $instance['eyebrow'] : '';
		$title        = isset( $instance['title'] ) ? $instance['title'] : '';
		$center_image = isset( $instance['center_image'] ) ? $instance['center_image'] : '';
		$items        = isset( $instance['items'] ) && ! empty( $instance['items'] ) ? $instance['items'] : $this->get_defaults();
		?>
		<p><label><?php esc_html_e( 'Eyebrow:', 'nest' ); ?></label><br>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'eyebrow' ) ); ?>" value="<?php echo esc_attr( $eyebrow ); ?>"></p>
		<p><label><?php esc_html_e( 'Title:', 'nest' ); ?></label><br>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"></p>
		<p><label><?php esc_html_e( 'Center image URL:', 'nest' ); ?></label><br>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'center_image' ) ); ?>" value="<?php echo esc_attr( $center_image ); ?>"></p>
		<hr>
		<p><strong><?php esc_html_e( '6 lý do (items):', 'nest' ); ?></strong></p>
		<?php for ( $i = 0; $i < 6; $i ++ ) : $item = isset( $items[ $i ] ) ? $items[ $i ] : array(); ?>
			<div style="border:1px solid #ddd;padding:8px;margin-bottom:8px;">
				<p><strong><?php printf( esc_html__( 'Item %d', 'nest' ), $i + 1 ); ?></strong></p>
				<p><label>Icon URL:</label><br><input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][icon]" value="<?php echo esc_attr( $item['icon'] ?? '' ); ?>"></p>
				<p><label>Title:</label><br><input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>"></p>
				<p><label>Description:</label><br><input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][desc]" value="<?php echo esc_attr( $item['desc'] ?? '' ); ?>"></p>
			</div>
		<?php endfor; ?>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'eyebrow'      => sanitize_text_field( $new_instance['eyebrow'] ?? '' ),
			'title'        => sanitize_text_field( $new_instance['title'] ?? '' ),
			'center_image' => esc_url_raw( $new_instance['center_image'] ?? '' ),
		);

		$items = array();
		if ( isset( $new_instance['items'] ) && is_array( $new_instance['items'] ) ) {
			foreach ( $new_instance['items'] as $item ) {
				$items[] = array(
					'icon'  => esc_url_raw( $item['icon'] ?? '' ),
					'title' => sanitize_text_field( $item['title'] ?? '' ),
					'desc'  => sanitize_text_field( $item['desc'] ?? '' ),
				);
			}
		}
		$instance['items'] = $items;
		return $instance;
	}
}

/* =======================================================================
 * 8. News Widget (Tin tức)
 * ===================================================================== */

class Nest_Widget_News extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_news',
			__( '[Home] News', 'nest' ),
			array( 'description' => __( 'Section Tin tức – 1 bài nổi bật + danh sách bài viết.', 'nest' ) )
		);
	}

	public function widget( $args, $instance ) {
		$eyebrow  = isset( $instance['eyebrow'] ) && $instance['eyebrow'] ? $instance['eyebrow'] : get_bloginfo( 'name' );
		$title    = isset( $instance['title'] ) && $instance['title'] ? $instance['title'] : __( 'Tin tức - Tư vấn từ Nest', 'nest' );
		$cat_id   = isset( $instance['cat_id'] ) ? absint( $instance['cat_id'] ) : 0;
		$count    = isset( $instance['count'] ) ? absint( $instance['count'] ) : 7;
		$btn_text = isset( $instance['btn_text'] ) && $instance['btn_text'] ? $instance['btn_text'] : __( 'Xem thêm', 'nest' );
		$btn_url  = isset( $instance['btn_url'] ) && $instance['btn_url'] ? $instance['btn_url'] : '';

		if ( ! $btn_url ) {
			$btn_url = $cat_id ? get_category_link( $cat_id ) : get_permalink( get_option( 'page_for_posts' ) );
			if ( ! $btn_url ) {
				$btn_url = home_url( '/' );
			}
		}

		$query_args = array(
			'post_type'      => 'post',
			'posts_per_page' => max( 1, $count ),
			'post_status'    => 'publish',
			'ignore_sticky_posts' => true,
		);
		if ( $cat_id ) {
			$query_args['cat'] = $cat_id;
		}

		$posts_query = new WP_Query( $query_args );

		if ( ! $posts_query->have_posts() ) {
			return;
		}

		$posts = $posts_query->posts;
		$featured = array_shift( $posts );
		$rest     = $posts;
		?>
		<section class="section-index section-news py-[30px] max-md:py-[25px]">
			<div class="container mx-auto px-4">
				<div class="section-title text-center relative mb-6">
					<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( $eyebrow ); ?></span>
					<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0">
						<a href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title ); ?></a>
					</h2>
					<div class="section-separator flex justify-center relative mt-2.5">
						<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
					</div>
				</div>

				<div class="flex flex-wrap -mx-2.5">
					<!-- Featured (big) post -->
					<?php if ( $featured ) :
						$f_id    = $featured->ID;
						$f_title = get_the_title( $f_id );
						$f_link  = get_permalink( $f_id );
						$f_thumb = get_the_post_thumbnail_url( $f_id, 'large' );
						$f_date  = get_the_date( 'd/m/Y', $f_id );
						$f_excerpt = wp_strip_all_tags( $featured->post_excerpt ? $featured->post_excerpt : wp_trim_words( $featured->post_content, 40 ) );
						?>
						<div class="w-full lg:w-1/3 px-2.5 mb-5 lg:mb-0">
							<a href="<?php echo esc_url( $f_link ); ?>" title="<?php echo esc_attr( $f_title ); ?>" class="news-item news-item--featured group block h-full bg-white border border-primary/10 overflow-hidden transition-shadow duration-300 hover:shadow-lg">
								<div class="relative overflow-hidden aspect-[4/3]">
									<?php if ( $f_thumb ) : ?>
										<img src="<?php echo esc_url( $f_thumb ); ?>" alt="<?php echo esc_attr( $f_title ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
									<?php else : ?>
										<div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm"><?php esc_html_e( 'No image', 'nest' ); ?></div>
									<?php endif; ?>
								</div>
								<div class="p-4">
									<h3 class="font-bold text-base lg:text-lg leading-snug mb-2 line-clamp-2 group-hover:text-hover transition-colors"><?php echo esc_html( $f_title ); ?></h3>
									<?php if ( $f_excerpt ) : ?>
										<p class="text-sm text-gray-600 leading-relaxed mb-3 line-clamp-3"><?php echo esc_html( $f_excerpt ); ?></p>
									<?php endif; ?>
									<p class="flex items-center gap-1.5 text-xs text-gray-500 mb-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"></path><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"></path></svg>
										<span><?php echo esc_html( $f_date ); ?></span>
									</p>
								</div>
							</a>
						</div>
					<?php endif; ?>

					<!-- Rest of posts grid -->
					<?php if ( ! empty( $rest ) ) : ?>
						<div class="w-full lg:w-2/3 px-2.5">
							<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
								<?php foreach ( $rest as $post_obj ) :
									$p_id    = $post_obj->ID;
									$p_title = get_the_title( $p_id );
									$p_link  = get_permalink( $p_id );
									$p_thumb = get_the_post_thumbnail_url( $p_id, 'medium' );
									$p_date  = get_the_date( 'd/m/Y', $p_id );
									?>
									<a href="<?php echo esc_url( $p_link ); ?>" title="<?php echo esc_attr( $p_title ); ?>" class="news-item group block bg-white border border-primary/10 overflow-hidden transition-shadow duration-300 hover:shadow-lg">
										<div class="relative overflow-hidden aspect-[4/3]">
											<?php if ( $p_thumb ) : ?>
												<img src="<?php echo esc_url( $p_thumb ); ?>" alt="<?php echo esc_attr( $p_title ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
											<?php else : ?>
												<div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs"><?php esc_html_e( 'No image', 'nest' ); ?></div>
											<?php endif; ?>
										</div>
										<div class="p-3">
											<h3 class="font-semibold text-sm leading-snug mb-1.5 line-clamp-2 group-hover:text-hover transition-colors"><?php echo esc_html( $p_title ); ?></h3>
											<p class="flex items-center gap-1 text-[11px] text-gray-500 mb-0">
												<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"></path><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"></path></svg>
												<span><?php echo esc_html( $p_date ); ?></span>
											</p>
										</div>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="flex justify-center mt-7">
					<a href="<?php echo esc_url( $btn_url ); ?>" class="nest-btn" title="<?php echo esc_attr( $btn_text ); ?>">
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						<span class="nest-btn__text"><?php echo esc_html( $btn_text ); ?></span>
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					</a>
				</div>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	}

	public function form( $instance ) {
		$eyebrow  = isset( $instance['eyebrow'] ) ? $instance['eyebrow'] : '';
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$cat_id   = isset( $instance['cat_id'] ) ? absint( $instance['cat_id'] ) : 0;
		$count    = isset( $instance['count'] ) ? absint( $instance['count'] ) : 7;
		$btn_text = isset( $instance['btn_text'] ) ? $instance['btn_text'] : '';
		$btn_url  = isset( $instance['btn_url'] ) ? $instance['btn_url'] : '';

		$categories = get_categories( array( 'hide_empty' => false ) );
		?>
		<p><label><?php esc_html_e( 'Eyebrow:', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'eyebrow' ) ); ?>" value="<?php echo esc_attr( $eyebrow ); ?>"></p>
		<p><label><?php esc_html_e( 'Title:', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"></p>
		<p>
			<label><?php esc_html_e( 'Danh mục bài viết:', 'nest' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'cat_id' ) ); ?>">
				<option value="0"><?php esc_html_e( '-- Tất cả --', 'nest' ); ?></option>
				<?php foreach ( $categories as $cat ) : ?>
					<option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php selected( $cat_id, $cat->term_id ); ?>><?php echo esc_html( $cat->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p><label><?php esc_html_e( 'Số bài hiển thị (1 nổi bật + còn lại trong lưới):', 'nest' ); ?></label>
		<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>" min="1" max="13" style="width:60px"></p>
		<p><label><?php esc_html_e( 'Button text:', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'btn_text' ) ); ?>" value="<?php echo esc_attr( $btn_text ); ?>"></p>
		<p><label><?php esc_html_e( 'Button URL (để trống = trang danh mục):', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" value="<?php echo esc_attr( $btn_url ); ?>"></p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return array(
			'eyebrow'  => sanitize_text_field( $new_instance['eyebrow'] ?? '' ),
			'title'    => sanitize_text_field( $new_instance['title'] ?? '' ),
			'cat_id'   => absint( $new_instance['cat_id'] ?? 0 ),
			'count'    => max( 1, absint( $new_instance['count'] ?? 7 ) ),
			'btn_text' => sanitize_text_field( $new_instance['btn_text'] ?? '' ),
			'btn_url'  => esc_url_raw( $new_instance['btn_url'] ?? '' ),
		);
	}
}

/* =======================================================================
 * 9. Partners Widget (Đối tác)
 * ===================================================================== */

class Nest_Widget_Partners extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_partners',
			__( '[Home] Partners', 'nest' ),
			array( 'description' => __( 'Section Đối tác – carousel logo thương hiệu.', 'nest' ) )
		);
	}

	private function get_defaults() {
		$uri = get_template_directory_uri() . '/assets/images/';
		return array(
			array( 'image' => $uri . 'partner_1.svg', 'url' => '#', 'title' => 'Partner 1' ),
			array( 'image' => $uri . 'partner_2.svg', 'url' => '#', 'title' => 'Partner 2' ),
			array( 'image' => $uri . 'partner_3.svg', 'url' => '#', 'title' => 'Partner 3' ),
			array( 'image' => $uri . 'partner_4.svg', 'url' => '#', 'title' => 'Partner 4' ),
			array( 'image' => $uri . 'partner_5.svg', 'url' => '#', 'title' => 'Partner 5' ),
			array( 'image' => $uri . 'partner_6.svg', 'url' => '#', 'title' => 'Partner 6' ),
		);
	}

	public function widget( $args, $instance ) {
		$eyebrow = isset( $instance['eyebrow'] ) && $instance['eyebrow'] ? $instance['eyebrow'] : get_bloginfo( 'name' );
		$title   = isset( $instance['title'] ) && $instance['title'] ? $instance['title'] : __( 'Đối tác của chúng tôi', 'nest' );
		$items   = isset( $instance['items'] ) && ! empty( $instance['items'] ) ? array_filter( $instance['items'], function ( $i ) { return ! empty( $i['image'] ); } ) : $this->get_defaults();

		if ( empty( $items ) ) {
			return;
		}
		?>
		<section class="section-index section-partners py-[30px] max-md:py-[25px]">
			<div class="container mx-auto px-4">
				<div class="section-title text-center relative mb-6">
					<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( $eyebrow ); ?></span>
					<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php echo esc_html( $title ); ?></h2>
					<div class="section-separator flex justify-center relative mt-2.5">
						<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
					</div>
				</div>

				<div class="section-slider section-slider--partners">
					<div class="swiper brands-slider">
						<div class="swiper-wrapper items-center">
							<?php foreach ( $items as $item ) :
								$img  = isset( $item['image'] ) ? $item['image'] : '';
								$url  = isset( $item['url'] ) && $item['url'] ? $item['url'] : '#';
								$alt  = isset( $item['title'] ) ? $item['title'] : '';
								?>
								<div class="swiper-slide">
									<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $alt ); ?>" class="brand-item block p-3 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100">
										<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="w-full h-auto max-h-[80px] object-contain mx-auto" width="225" height="113" loading="lazy">
									</a>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-button-prev">
							<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
						</div>
						<div class="swiper-button-next">
							<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	public function form( $instance ) {
		$eyebrow = isset( $instance['eyebrow'] ) ? $instance['eyebrow'] : '';
		$title   = isset( $instance['title'] ) ? $instance['title'] : '';
		$items   = isset( $instance['items'] ) && ! empty( $instance['items'] ) ? $instance['items'] : $this->get_defaults();
		$count   = max( count( $items ), 6 );
		?>
		<p><label><?php esc_html_e( 'Eyebrow:', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'eyebrow' ) ); ?>" value="<?php echo esc_attr( $eyebrow ); ?>"></p>
		<p><label><?php esc_html_e( 'Title:', 'nest' ); ?></label>
		<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"></p>
		<hr>
		<p><strong><?php esc_html_e( 'Logo đối tác:', 'nest' ); ?></strong></p>
		<?php for ( $i = 0; $i < $count; $i ++ ) : $item = isset( $items[ $i ] ) ? $items[ $i ] : array(); ?>
			<div style="border:1px solid #ddd;padding:8px;margin-bottom:8px;">
				<p><strong><?php printf( esc_html__( 'Partner %d', 'nest' ), $i + 1 ); ?></strong></p>
				<p><label><?php esc_html_e( 'Image URL:', 'nest' ); ?></label><br>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][image]" value="<?php echo esc_attr( $item['image'] ?? '' ); ?>"></p>
				<p><label><?php esc_html_e( 'Link URL:', 'nest' ); ?></label><br>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][url]" value="<?php echo esc_attr( $item['url'] ?? '#' ); ?>"></p>
				<p><label><?php esc_html_e( 'Tên/Alt:', 'nest' ); ?></label><br>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>"></p>
			</div>
		<?php endfor; ?>
		<p>
			<label><?php esc_html_e( 'Số lượng partner mong muốn:', 'nest' ); ?></label>
			<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'item_count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>" min="2" max="20" style="width:60px">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'eyebrow' => sanitize_text_field( $new_instance['eyebrow'] ?? '' ),
			'title'   => sanitize_text_field( $new_instance['title'] ?? '' ),
		);

		$items = array();
		if ( isset( $new_instance['items'] ) && is_array( $new_instance['items'] ) ) {
			foreach ( $new_instance['items'] as $item ) {
				$image = isset( $item['image'] ) ? esc_url_raw( trim( $item['image'] ) ) : '';
				if ( ! $image ) {
					continue;
				}
				$items[] = array(
					'image' => $image,
					'url'   => isset( $item['url'] ) ? esc_url_raw( trim( $item['url'] ) ) : '#',
					'title' => isset( $item['title'] ) ? sanitize_text_field( $item['title'] ) : '',
				);
			}
		}

		$count = isset( $new_instance['item_count'] ) ? absint( $new_instance['item_count'] ) : count( $items );
		$count = max( $count, 2 );
		while ( count( $items ) < $count ) {
			$items[] = array( 'image' => '', 'url' => '#', 'title' => '' );
		}

		$instance['items'] = $items;
		return $instance;
	}
}

/* =======================================================================
 * 10. Footer Menu Widget (link list with mobile accordion)
 * ===================================================================== */

class Nest_Widget_Footer_Menu extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_footer_menu',
			__( '[Footer] Menu links', 'nest' ),
			array( 'description' => __( 'Danh sách link cho cột footer. Trên mobile sẽ hiển thị dạng accordion (mặc định đóng).', 'nest' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$menu_loc = isset( $instance['menu_location'] ) ? $instance['menu_location'] : '';
		$links    = isset( $instance['links'] ) && is_array( $instance['links'] ) ? $instance['links'] : array();

		// Filter out empty link rows.
		$links = array_values( array_filter( $links, function ( $l ) {
			return ! empty( $l['label'] );
		} ) );

		// Render: must contain at least a title.
		if ( ! $title ) {
			return;
		}

		$has_menu  = $menu_loc && has_nav_menu( $menu_loc );
		$has_links = ! empty( $links );

		if ( ! $has_menu && ! $has_links ) {
			return;
		}

		$uid = wp_unique_id( 'footer-acc-' );
		?>
		<div class="footer-section" data-footer-accordion>
			<?php nest_render_footer_accordion_header( $title, $uid ); ?>
			<div id="<?php echo esc_attr( $uid ); ?>" class="footer-section__content max-md:hidden md:!block">
				<?php if ( $has_menu ) :
					wp_nav_menu(
						array(
							'theme_location' => $menu_loc,
							'container'      => false,
							'menu_class'     => 'footer-menu-list leading-[30px]',
							'depth'          => 1,
							'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
						)
					);
				else : ?>
					<ul class="footer-menu-list leading-[30px]">
						<?php foreach ( $links as $link ) :
							$label = $link['label'];
							$url   = isset( $link['url'] ) && $link['url'] ? $link['url'] : '#';
							?>
							<li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$menu_loc = isset( $instance['menu_location'] ) ? $instance['menu_location'] : '';
		$links    = isset( $instance['links'] ) && is_array( $instance['links'] ) ? $instance['links'] : array();
		$count    = max( count( $links ), 5 );

		$locations = get_registered_nav_menus();
		?>
		<p>
			<label><?php esc_html_e( 'Title:', 'nest' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label><?php esc_html_e( 'Sử dụng menu (ưu tiên nếu chọn):', 'nest' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'menu_location' ) ); ?>">
				<option value=""><?php esc_html_e( '-- Dùng link tùy chỉnh dưới đây --', 'nest' ); ?></option>
				<?php foreach ( $locations as $loc => $label ) : ?>
					<option value="<?php echo esc_attr( $loc ); ?>" <?php selected( $menu_loc, $loc ); ?>><?php echo esc_html( $label ); ?> (<?php echo esc_html( $loc ); ?>)</option>
				<?php endforeach; ?>
			</select>
		</p>
		<hr>
		<p><strong><?php esc_html_e( 'Hoặc nhập link tùy chỉnh:', 'nest' ); ?></strong></p>
		<?php for ( $i = 0; $i < $count; $i ++ ) : $link = isset( $links[ $i ] ) ? $links[ $i ] : array(); ?>
			<div style="border:1px solid #ddd;padding:6px;margin-bottom:6px;">
				<p style="margin:4px 0"><label><?php printf( esc_html__( 'Label %d:', 'nest' ), $i + 1 ); ?></label>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'links' ) ); ?>[<?php echo $i; ?>][label]" value="<?php echo esc_attr( $link['label'] ?? '' ); ?>"></p>
				<p style="margin:4px 0"><label><?php esc_html_e( 'URL:', 'nest' ); ?></label>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'links' ) ); ?>[<?php echo $i; ?>][url]" value="<?php echo esc_attr( $link['url'] ?? '#' ); ?>"></p>
			</div>
		<?php endfor; ?>
		<p>
			<label><?php esc_html_e( 'Số ô link mong muốn:', 'nest' ); ?></label>
			<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'link_count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>" min="1" max="20" style="width:60px">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'title'         => sanitize_text_field( $new_instance['title'] ?? '' ),
			'menu_location' => sanitize_key( $new_instance['menu_location'] ?? '' ),
		);

		$links = array();
		if ( isset( $new_instance['links'] ) && is_array( $new_instance['links'] ) ) {
			foreach ( $new_instance['links'] as $link ) {
				$label = isset( $link['label'] ) ? sanitize_text_field( $link['label'] ) : '';
				if ( ! $label ) {
					continue;
				}
				$links[] = array(
					'label' => $label,
					'url'   => isset( $link['url'] ) ? esc_url_raw( trim( $link['url'] ) ) : '#',
				);
			}
		}

		$count = isset( $new_instance['link_count'] ) ? absint( $new_instance['link_count'] ) : count( $links );
		$count = max( $count, 1 );
		while ( count( $links ) < $count ) {
			$links[] = array( 'label' => '', 'url' => '#' );
		}

		$instance['links'] = $links;
		return $instance;
	}
}

/* =======================================================================
 * 11. Footer Images Widget (logos / payment / certification grid)
 * ===================================================================== */

class Nest_Widget_Footer_Images extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'nest_footer_images',
			__( '[Footer] Image grid', 'nest' ),
			array( 'description' => __( 'Lưới logo/hình (hỗ trợ thanh toán, chứng nhận…). Mobile hiển thị dạng accordion.', 'nest' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? $instance['items'] : array();
		$size  = isset( $instance['size'] ) ? $instance['size'] : 'sm';

		$items = array_values( array_filter( $items, function ( $i ) {
			return ! empty( $i['image'] );
		} ) );

		if ( ! $title || empty( $items ) ) {
			return;
		}

		$img_classes = 'lg' === $size
			? 'h-[45px] w-auto'
			: 'w-[63px] h-[29px] rounded-[5px] object-contain';

		$uid = wp_unique_id( 'footer-acc-' );
		?>
		<div class="footer-section" data-footer-accordion>
			<?php nest_render_footer_accordion_header( $title, $uid ); ?>
			<div id="<?php echo esc_attr( $uid ); ?>" class="footer-section__content max-md:hidden md:!block">
				<div class="flex flex-wrap gap-1.5 pt-2 md:pt-0">
					<?php foreach ( $items as $item ) :
						$img = $item['image'];
						$alt = $item['title'] ?? '';
						$url = isset( $item['url'] ) && $item['url'] ? $item['url'] : '';
						$img_tag = sprintf(
							'<img src="%s" alt="%s" class="%s" loading="lazy">',
							esc_url( $img ),
							esc_attr( $alt ),
							esc_attr( $img_classes )
						);
						if ( $url ) :
							?>
							<a href="<?php echo esc_url( $url ); ?>" class="inline-block"><?php echo $img_tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
						<?php else :
							echo $img_tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						endif;
					endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? $instance['items'] : array();
		$size  = isset( $instance['size'] ) ? $instance['size'] : 'sm';
		$count = max( count( $items ), 6 );
		?>
		<p>
			<label><?php esc_html_e( 'Title:', 'nest' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label><?php esc_html_e( 'Kích thước:', 'nest' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>">
				<option value="sm" <?php selected( $size, 'sm' ); ?>><?php esc_html_e( 'Nhỏ (63x29) – cho thanh toán', 'nest' ); ?></option>
				<option value="lg" <?php selected( $size, 'lg' ); ?>><?php esc_html_e( 'Lớn (cao 45px) – cho chứng nhận', 'nest' ); ?></option>
			</select>
		</p>
		<hr>
		<?php for ( $i = 0; $i < $count; $i ++ ) : $item = isset( $items[ $i ] ) ? $items[ $i ] : array(); ?>
			<div style="border:1px solid #ddd;padding:6px;margin-bottom:6px;">
				<p style="margin:4px 0"><label><?php printf( esc_html__( 'Hình %d - Image URL:', 'nest' ), $i + 1 ); ?></label>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][image]" value="<?php echo esc_attr( $item['image'] ?? '' ); ?>"></p>
				<p style="margin:4px 0"><label><?php esc_html_e( 'Tên/Alt:', 'nest' ); ?></label>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>"></p>
				<p style="margin:4px 0"><label><?php esc_html_e( 'Link (tùy chọn):', 'nest' ); ?></label>
				<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[<?php echo $i; ?>][url]" value="<?php echo esc_attr( $item['url'] ?? '' ); ?>"></p>
			</div>
		<?php endfor; ?>
		<p>
			<label><?php esc_html_e( 'Số ô mong muốn:', 'nest' ); ?></label>
			<input type="number" name="<?php echo esc_attr( $this->get_field_name( 'item_count' ) ); ?>" value="<?php echo esc_attr( $count ); ?>" min="1" max="20" style="width:60px">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'title' => sanitize_text_field( $new_instance['title'] ?? '' ),
			'size'  => in_array( $new_instance['size'] ?? 'sm', array( 'sm', 'lg' ), true ) ? $new_instance['size'] : 'sm',
		);

		$items = array();
		if ( isset( $new_instance['items'] ) && is_array( $new_instance['items'] ) ) {
			foreach ( $new_instance['items'] as $item ) {
				$image = isset( $item['image'] ) ? esc_url_raw( trim( $item['image'] ) ) : '';
				if ( ! $image ) {
					continue;
				}
				$items[] = array(
					'image' => $image,
					'title' => isset( $item['title'] ) ? sanitize_text_field( $item['title'] ) : '',
					'url'   => isset( $item['url'] ) ? esc_url_raw( trim( $item['url'] ) ) : '',
				);
			}
		}

		$count = isset( $new_instance['item_count'] ) ? absint( $new_instance['item_count'] ) : count( $items );
		$count = max( $count, 1 );
		while ( count( $items ) < $count ) {
			$items[] = array( 'image' => '', 'title' => '', 'url' => '' );
		}

		$instance['items'] = $items;
		return $instance;
	}
}

/* =======================================================================
 * 12. Seed default widgets on theme activation.
 * ===================================================================== */

add_action( 'after_switch_theme', 'nest_seed_default_homepage_widgets' );

function nest_seed_default_homepage_widgets() {
	$sidebars = get_option( 'sidebars_widgets', array() );

	// --- Homepage sections ---
	if ( empty( $sidebars['homepage-sections'] ) ) {
		$widgets_to_seed = array(
			'nest_hero_slider'       => array(),
			'nest_services'          => array(),
			'nest_banner_collection' => array(),
			'nest_about'             => array(),
			'nest_product_tabs'      => array(),
			'nest_coupon_slider'     => array(),
			'nest_why_choose'        => array(),
			'nest_news'              => array(),
			'nest_partners'          => array(),
		);

		$homepage_widgets = array();
		foreach ( $widgets_to_seed as $widget_id_base => $default_instance ) {
			$homepage_widgets[] = nest_register_widget_instance( $widget_id_base, $default_instance );
		}
		$sidebars['homepage-sections'] = $homepage_widgets;
	}

	// --- Footer columns ---
	$footer_uri = get_template_directory_uri() . '/assets/images/';

	$footer_seeds = array(
		'footer-col-2' => array(
			'nest_footer_menu' => array(
				'title'         => __( 'Chính sách', 'nest' ),
				'menu_location' => has_nav_menu( 'footer-policy' ) ? 'footer-policy' : '',
				'links'         => array(
					array( 'label' => __( 'Chính sách mua hàng', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Chính sách thanh toán', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Chính sách vận chuyển', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Cam kết cửa hàng', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Chính sách bảo mật', 'nest' ), 'url' => '#' ),
				),
			),
		),
		'footer-col-3' => array(
			'nest_footer_menu' => array(
				'title'         => __( 'Hướng dẫn', 'nest' ),
				'menu_location' => has_nav_menu( 'footer-guide' ) ? 'footer-guide' : '',
				'links'         => array(
					array( 'label' => __( 'Hướng dẫn mua hàng', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Hướng dẫn đổi trả', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Hướng dẫn thanh toán', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Quy định bảo hành', 'nest' ), 'url' => '#' ),
					array( 'label' => __( 'Hướng dẫn chuyển khoản', 'nest' ), 'url' => '#' ),
				),
			),
		),
		'footer-col-4' => array(
			'nest_footer_images_payment' => array(
				'_widget_id_base' => 'nest_footer_images',
				'title' => __( 'Hỗ trợ thanh toán', 'nest' ),
				'size'  => 'sm',
				'items' => array(
					array( 'image' => $footer_uri . 'payment_1.png', 'title' => 'MoMo', 'url' => '' ),
					array( 'image' => $footer_uri . 'payment_2.png', 'title' => 'ZaloPay', 'url' => '' ),
					array( 'image' => $footer_uri . 'payment_3.png', 'title' => 'VNPay', 'url' => '' ),
					array( 'image' => $footer_uri . 'payment_4.png', 'title' => 'Moca', 'url' => '' ),
					array( 'image' => $footer_uri . 'payment_5.png', 'title' => 'Visa', 'url' => '' ),
					array( 'image' => $footer_uri . 'payment_6.png', 'title' => 'ATM', 'url' => '' ),
				),
			),
			'nest_footer_images_cert' => array(
				'_widget_id_base' => 'nest_footer_images',
				'title' => __( 'Chứng nhận', 'nest' ),
				'size'  => 'lg',
				'items' => array(
					array( 'image' => $footer_uri . 'certifi_1.png', 'title' => __( 'Chứng nhận', 'nest' ), 'url' => '' ),
					array( 'image' => $footer_uri . 'certifi_2.png', 'title' => __( 'Chứng nhận', 'nest' ), 'url' => '' ),
				),
			),
		),
	);

	foreach ( $footer_seeds as $sidebar_id => $widgets ) {
		if ( ! empty( $sidebars[ $sidebar_id ] ) ) {
			continue;
		}
		$ids = array();
		foreach ( $widgets as $key => $instance ) {
			$widget_id_base = isset( $instance['_widget_id_base'] ) ? $instance['_widget_id_base'] : $key;
			unset( $instance['_widget_id_base'] );
			$ids[] = nest_register_widget_instance( $widget_id_base, $instance );
		}
		$sidebars[ $sidebar_id ] = $ids;
	}

	update_option( 'sidebars_widgets', $sidebars );
}

/**
 * Persist a single widget instance under widget_{base}, returning its id (base-N).
 */
function nest_register_widget_instance( $widget_id_base, $instance ) {
	$option_key = 'widget_' . $widget_id_base;
	$option     = get_option( $option_key, array() );

	$numbers = array_filter( array_keys( $option ), 'is_int' );
	$next    = empty( $numbers ) ? 2 : max( $numbers ) + 1;

	$option[ $next ]        = $instance;
	$option['_multiwidget'] = 1;
	update_option( $option_key, $option );

	return $widget_id_base . '-' . $next;
}
