<?php
/**
 * Template part for displaying the header content
 *
 * @package Nest
 */

?>

<header id="masthead" class="font-sans">

	<!-- Topbar -->
	<div class="bg-primary text-white text-xs">
		<div class="container mx-auto px-4 flex items-center justify-between py-1.5">
			<div class="flex items-center gap-2 min-w-0">
				<svg class="w-4 h-4 shrink-0 fill-secondary" viewBox="0 0 166 197"><path d="M82.87,196.9C97.89,196.9,110.15,184.73,110.15,169.79H55.49C55.49,184.73,67.85,196.9,82.87,196.9Z"/><path d="M146.19,135.09V82.04c0-29.93-20.47-54.05-48.73-60.79V14.46C97.46,6.74,90.65,0,82.85,0S68.25,6.74,68.25,14.46v6.8C39.97,27.99,19.52,52.11,19.52,82.04v53.05L0,154.42v9.66H165.71v-9.66Z"/></svg>
				<div class="min-w-0 truncate" id="promo-text">
					<?php
					if ( is_active_sidebar( 'header-promo' ) ) :
						dynamic_sidebar( 'header-promo' );
					else :
						?>
						<span class="truncate"><?php echo esc_html( nest_get_option( 'topbar_promo' ) ); ?></span>
						<?php
					endif;
					?>
				</div>
			</div>
			<?php
			$hotline_number = nest_get_option( 'hotline_number' );
			$hotline_label  = nest_get_option( 'hotline_label' );
			$hotline_tel    = preg_replace( '/\s+/', '', $hotline_number );
			?>
			<a href="tel:<?php echo esc_attr( $hotline_tel ); ?>" class="hidden lg:flex items-center gap-2 shrink-0 text-white hover:text-secondary transition-colors duration-200" title="<?php echo esc_attr( $hotline_label ); ?>">
				<svg class="w-5 h-5 fill-current" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="m55.267 22.76h-13.732v-14.337c0-2.07-.809-4.019-2.276-5.486-1.468-1.467-3.416-2.276-5.486-2.276h-25.049c-4.28 0-7.762 3.482-7.762 7.762v16.699c0 4.28 3.482 7.762 7.762 7.762h.587v4.762c0 1.474.877 2.781 2.235 3.331.437.177.892.262 1.343.262.939 0 1.855-.373 2.528-1.067l7.04-7.002v14.05c0 4.279 3.486 7.761 7.77 7.761h11.021l7.312 7.273c.688.708 1.608 1.085 2.552 1.085.451 0 .906-.086 1.344-.264 1.356-.549 2.232-1.854 2.232-3.325v-4.77h.579c4.285 0 7.771-3.481 7.771-7.761v-16.7c0-4.277-3.486-7.759-7.771-7.759z"/></svg>
				<div class="flex flex-col leading-tight">
					<span class="text-[10px] opacity-80"><?php echo esc_html( $hotline_label ); ?></span>
					<span class="font-semibold"><?php echo esc_html( $hotline_number ); ?></span>
				</div>
			</a>
		</div>
	</div>

	<!-- Main Header -->
	<div class="bg-primary bg-repeat bg-center" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/header_pattent.png' ); ?>')">
		<div class="container mx-auto px-4 py-3">
			<div class="flex items-center gap-4 lg:gap-6">

				<!-- Logo -->
				<div class="shrink-0 w-[140px] lg:w-[200px]">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block" title="<?php bloginfo( 'name' ); ?>">
						<?php if ( has_custom_logo() ) : ?>
							<?php
							$custom_logo_id  = get_theme_mod( 'custom_logo' );
							$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
							?>
							<img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-full h-auto">
						<?php else : ?>
							<span class="text-xl font-heading font-bold text-white"><?php bloginfo( 'name' ); ?></span>
						<?php endif; ?>
					</a>
				</div>

				<!-- Search -->
				<div class="hidden lg:block flex-1">
					<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative">
						<input type="search" name="s" placeholder="<?php esc_attr_e( 'Tìm sản phẩm...', 'nest' ); ?>" value="<?php echo get_search_query(); ?>" class="w-full h-11 pl-4 pr-12 rounded-lg bg-white text-sm text-foreground placeholder:text-gray-400 outline-none focus:ring-2 focus:ring-secondary" autocomplete="off">
						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
							<input type="hidden" name="post_type" value="product">
						<?php endif; ?>
						<button type="submit" class="absolute right-0 top-0 h-11 w-11 flex items-center justify-center rounded-r-lg bg-secondary text-primary hover:bg-hover transition-colors duration-200" aria-label="<?php esc_attr_e( 'Tìm kiếm', 'nest' ); ?>">
							<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
						</button>
					</form>
				</div>

				<!-- Header Actions -->
				<div class="flex items-center gap-1 lg:gap-4 ml-auto lg:ml-0">

					<!-- Store -->
					<a href="<?php echo esc_url( home_url( nest_get_option( 'store_url' ) ) ); ?>" class="hidden lg:flex flex-col items-center gap-0.5 text-white hover:text-secondary transition-colors duration-200 px-2" title="<?php esc_attr_e( 'Cửa hàng', 'nest' ); ?>">
						<svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path d="M10 10.833a2.917 2.917 0 1 0 0-5.833 2.917 2.917 0 0 0 0 5.833Z"/><path d="M10 1.667c-3.225 0-5.833 2.608-5.833 5.833 0 4.375 5.833 10.833 5.833 10.833s5.833-6.458 5.833-10.833c0-3.225-2.608-5.833-5.833-5.833Z"/></svg>
						<span class="text-[10px]"><?php esc_html_e( 'Cửa hàng', 'nest' ); ?></span>
					</a>

					<!-- Wishlist -->
					<a href="<?php echo esc_url( home_url( nest_get_option( 'wishlist_url' ) ) ); ?>" class="hidden lg:flex flex-col items-center gap-0.5 text-white hover:text-secondary transition-colors duration-200 px-2 relative" title="<?php esc_attr_e( 'Yêu thích', 'nest' ); ?>">
						<svg class="w-5 h-5 fill-current" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg>
						<span class="text-[10px]"><?php esc_html_e( 'Yêu thích', 'nest' ); ?></span>
					</a>

					<!-- Account -->
					<div class="hidden lg:flex relative group/account">
						<?php
						$account_url = class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
						?>
						<a href="<?php echo esc_url( $account_url ); ?>" class="flex flex-col items-center gap-0.5 text-white hover:text-secondary transition-colors duration-200 px-2" title="<?php esc_attr_e( 'Tài khoản', 'nest' ); ?>">
							<svg class="w-5 h-5" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1" xmlns="http://www.w3.org/2000/svg"><circle cx="8" cy="5" r="3.5"/><path d="M1.5 14.5c0-2.5 2-4.5 6.5-4.5s6.5 2 6.5 4.5"/></svg>
							<span class="text-[10px]"><?php esc_html_e( 'Tài khoản', 'nest' ); ?></span>
						</a>
						<ul class="invisible opacity-0 group-hover/account:visible group-hover/account:opacity-100 absolute right-0 top-full z-50 min-w-[160px] bg-white shadow-lg rounded-lg py-2 transition-all duration-200">
							<?php if ( is_user_logged_in() ) : ?>
								<li><a href="<?php echo esc_url( $account_url ); ?>" class="block px-4 py-2 text-sm text-foreground hover:bg-gray-50 hover:text-primary"><?php esc_html_e( 'Tài khoản', 'nest' ); ?></a></li>
								<?php if ( class_exists( 'WooCommerce' ) ) : ?>
									<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="block px-4 py-2 text-sm text-foreground hover:bg-gray-50 hover:text-primary"><?php esc_html_e( 'Đơn hàng', 'nest' ); ?></a></li>
								<?php endif; ?>
								<li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="block px-4 py-2 text-sm text-foreground hover:bg-gray-50 hover:text-primary"><?php esc_html_e( 'Đăng xuất', 'nest' ); ?></a></li>
							<?php else : ?>
								<li><a href="<?php echo esc_url( $account_url ); ?>" class="block px-4 py-2 text-sm text-foreground hover:bg-gray-50 hover:text-primary"><?php esc_html_e( 'Đăng nhập', 'nest' ); ?></a></li>
								<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
									<li><a href="<?php echo esc_url( $account_url ); ?>" class="block px-4 py-2 text-sm text-foreground hover:bg-gray-50 hover:text-primary"><?php esc_html_e( 'Đăng ký', 'nest' ); ?></a></li>
								<?php endif; ?>
							<?php endif; ?>
						</ul>
					</div>

					<!-- Cart -->
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="flex flex-col items-center gap-0.5 text-white hover:text-secondary transition-colors duration-200 px-2 relative" title="<?php esc_attr_e( 'Giỏ hàng', 'nest' ); ?>">
							<span class="relative">
								<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
								<span class="absolute -top-2 -right-2 bg-secondary text-primary text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
							</span>
							<span class="text-[10px] hidden lg:block"><?php esc_html_e( 'Giỏ hàng', 'nest' ); ?></span>
						</a>
					<?php endif; ?>

					<!-- Mobile Menu Button -->
					<button id="btn-menu-mobile" class="lg:hidden flex items-center justify-center w-10 h-10 text-white" aria-label="<?php esc_attr_e( 'Menu', 'nest' ); ?>" aria-expanded="false" aria-controls="mobile-menu">
						<svg class="w-6 h-6 fill-current" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg>
					</button>
				</div>
			</div>

			<!-- Mobile Search -->
			<div class="mt-3 lg:hidden">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative">
					<input type="search" name="s" placeholder="<?php esc_attr_e( 'Tìm sản phẩm...', 'nest' ); ?>" value="<?php echo get_search_query(); ?>" class="w-full h-10 pl-4 pr-11 rounded-lg bg-white text-sm text-foreground placeholder:text-gray-400 outline-none" autocomplete="off">
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<input type="hidden" name="post_type" value="product">
					<?php endif; ?>
					<button type="submit" class="absolute right-0 top-0 h-10 w-10 flex items-center justify-center rounded-r-lg bg-secondary text-primary" aria-label="<?php esc_attr_e( 'Tìm kiếm', 'nest' ); ?>">
						<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Navigation -->
	<nav id="site-navigation" class="bg-primary border-t border-white/10 hidden lg:block" aria-label="<?php esc_attr_e( 'Main Navigation', 'nest' ); ?>">
		<div class="container mx-auto px-4">
			<div class="flex">

				<!-- Category Dropdown -->
				<div class="relative group/catmenu shrink-0 w-[260px]">
					<button class="flex items-center gap-2 w-full px-4 py-3 bg-secondary text-primary rounded-t-lg font-semibold text-sm" aria-expanded="false">
						<svg class="w-4 h-4 fill-primary" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M7 0H1C.45 0 0 .45 0 1v6c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V1c0-.55-.45-1-1-1ZM6 6H2V2h4v4ZM17 0h-6c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V1c0-.55-.45-1-1-1Zm-1 6h-4V2h4v4ZM7 10H1c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1Zm-1 6H2v-4h4v4ZM14 10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4Zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2Z"/></svg>
						<span><?php esc_html_e( 'Danh mục sản phẩm', 'nest' ); ?></span>
						<svg class="w-4 h-4 fill-current ml-auto transition-transform duration-200 group-hover/catmenu:rotate-180" viewBox="0 0 16 16"><path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
					</button>
					<div class="invisible opacity-0 group-hover/catmenu:visible group-hover/catmenu:opacity-100 absolute left-0 top-full z-50 w-full bg-white shadow-lg rounded-b-lg transition-all duration-200">
						<?php
						if ( has_nav_menu( 'category-menu' ) ) :
							wp_nav_menu(
								array(
									'theme_location' => 'category-menu',
									'container'      => false,
									'menu_class'     => 'py-2',
									'walker'         => new Nest_Category_Walker(),
									'depth'          => 3,
								)
							);
						else :
							?>
							<div class="p-4 text-sm text-gray-500"><?php esc_html_e( 'Vui lòng thiết lập menu "Category Menu" trong Appearance > Menus.', 'nest' ); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Primary Menu -->
				<div class="flex-1 flex items-center">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'container'      => false,
							'menu_class'     => 'flex items-center',
							'menu_id'        => 'primary-menu',
							'walker'         => new Nest_Nav_Walker(),
							'depth'          => 3,
							'fallback_cb'    => false,
						)
					);
					?>
				</div>

				<!-- Hot Deal Button -->
				<div class="flex items-center shrink-0">
					<a href="<?php echo esc_url( home_url( nest_get_option( 'hot_deal_url' ) ) ); ?>" class="flex items-center gap-1.5 px-4 py-2 bg-price text-white text-sm font-bold rounded-full hover:opacity-90 transition-opacity duration-200 animate-pulse" title="<?php esc_attr_e( 'Hot deal', 'nest' ); ?>">
						<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/></svg>
						<span>Hot deal</span>
					</a>
				</div>
			</div>
		</div>
	</nav>

	<!-- Mobile Menu -->
	<div id="mobile-menu" class="fixed inset-0 z-[100] invisible opacity-0 transition-all duration-300 lg:hidden" aria-hidden="true">
		<div class="absolute inset-0 bg-black/50" id="mobile-menu-overlay"></div>
		<div class="absolute left-0 top-0 bottom-0 w-[300px] max-w-[85vw] bg-white -translate-x-full transition-transform duration-300 overflow-y-auto" id="mobile-menu-panel">

			<!-- Mobile Menu Header -->
			<div class="flex items-center justify-between p-4 bg-primary text-white">
				<span class="font-heading font-bold text-lg"><?php esc_html_e( 'Menu', 'nest' ); ?></span>
				<button id="close-mobile-menu" class="w-8 h-8 flex items-center justify-center" aria-label="<?php esc_attr_e( 'Đóng menu', 'nest' ); ?>">
					<svg class="w-5 h-5 fill-current" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/></svg>
				</button>
			</div>

			<!-- Mobile Category Menu -->
			<?php if ( has_nav_menu( 'category-menu' ) ) : ?>
				<div class="border-b border-gray-100">
					<h3 class="px-4 py-3 text-sm font-bold text-primary uppercase"><?php esc_html_e( 'Danh mục', 'nest' ); ?></h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'category-menu',
							'container'      => false,
							'menu_class'     => 'mobile-category-menu',
							'depth'          => 2,
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
					?>
				</div>
			<?php endif; ?>

			<!-- Mobile Primary Menu -->
			<div class="border-b border-gray-100">
				<h3 class="px-4 py-3 text-sm font-bold text-primary uppercase"><?php esc_html_e( 'Menu', 'nest' ); ?></h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => false,
						'menu_class'     => 'mobile-nav-menu',
						'depth'          => 2,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
			</div>

			<!-- Mobile Account Links -->
			<div class="p-4 space-y-3">
				<a href="<?php echo esc_url( home_url( nest_get_option( 'hot_deal_url' ) ) ); ?>" class="flex items-center gap-2 text-sm text-price font-bold">
					<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933z"/><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/></svg>
					<?php esc_html_e( 'Hot deal', 'nest' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( nest_get_option( 'store_url' ) ) ); ?>" class="flex items-center gap-2 text-sm text-foreground hover:text-primary">
					<svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 0C6.123 0 2.969 3.154 2.969 7.031c0 1.31.363 2.588 1.05 3.698L9.6 19.723a.583.583 0 0 0 1.003-.008l5.437-9.081A7.03 7.03 0 0 0 17.031 7.03C17.031 3.154 13.877 0 10 0Z"/></svg>
					<?php esc_html_e( 'Cửa hàng', 'nest' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( nest_get_option( 'wishlist_url' ) ) ); ?>" class="flex items-center gap-2 text-sm text-foreground hover:text-primary">
					<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg>
					<?php esc_html_e( 'Yêu thích', 'nest' ); ?>
				</a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="flex items-center gap-2 text-sm text-foreground hover:text-primary">
						<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>
						<?php esc_html_e( 'Đăng xuất', 'nest' ); ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( wp_login_url() ); ?>" class="flex items-center gap-2 text-sm text-foreground hover:text-primary">
						<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>
						<?php esc_html_e( 'Đăng nhập', 'nest' ); ?>
					</a>
					<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="flex items-center gap-2 text-sm text-foreground hover:text-primary">
						<svg class="w-4 h-4 fill-current" viewBox="0 0 16 16"><path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4z"/><path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/></svg>
						<?php esc_html_e( 'Đăng ký', 'nest' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

</header><!-- #masthead -->
