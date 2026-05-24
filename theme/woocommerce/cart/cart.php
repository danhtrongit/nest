<?php
/**
 * Cart Page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="flex flex-wrap -mx-2.5 lg:-mx-4">

	<!-- Left Column: Cart Items -->
	<div class="w-full xl:w-2/3 lg:w-7/12 px-2.5 lg:px-4 mb-5">

		<!-- Cart Items -->
		<div class="bg-white border border-gray-100 p-4 max-md:p-3 mb-5">
			<h1 class="text-lg font-bold text-foreground border-b border-gray-100 pb-3 mb-4"><?php esc_html_e( 'Giỏ hàng của bạn', 'nest' ); ?></h1>

			<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<!-- Desktop Header -->
				<div class="hidden xl:grid grid-cols-[1fr_120px_120px_120px] gap-2 text-sm font-semibold text-gray-500 border-b border-gray-100 pb-2 mb-3">
					<div><?php esc_html_e( 'Thông tin sản phẩm', 'nest' ); ?></div>
					<div class="text-center"><?php esc_html_e( 'Đơn giá', 'nest' ); ?></div>
					<div class="text-center"><?php esc_html_e( 'Số lượng', 'nest' ); ?></div>
					<div class="text-right"><?php esc_html_e( 'Thành tiền', 'nest' ); ?></div>
				</div>

				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail' ), $cart_item, $cart_item_key );
						?>

						<!-- Desktop Row -->
						<div class="woocommerce-cart-form__cart-item hidden xl:grid grid-cols-[1fr_120px_120px_120px] gap-2 items-center py-3 border-b border-gray-50 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<!-- Product Info -->
							<div class="flex items-center gap-3">
								<div class="flex w-[80px] h-[80px] shrink-0 border border-gray-100 overflow-hidden">
									<?php
									if ( $product_permalink ) {
										printf( '<a href="%s" class="cart-item-thumbnail-link block w-full h-full">%s</a>', esc_url( $product_permalink ), $thumbnail );
									} else {
										echo $thumbnail; // phpcs:ignore
									}
									?>
								</div>
								<div class="flex-1 min-w-0">
									<?php
									if ( $product_permalink ) {
										echo '<a href="' . esc_url( $product_permalink ) . '" class="text-sm font-medium text-foreground hover:text-primary line-clamp-2 transition-colors">' . esc_html( $_product->get_name() ) . '</a>';
									} else {
										echo '<span class="text-sm font-medium">' . wp_kses_post( $product_name ) . '</span>';
									}

									echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore

									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification text-xs text-orange-500 mt-1">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
									}
									?>
									<div class="mt-1">
										<?php
										echo apply_filters( // phpcs:ignore
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a role="button" href="%s" class="text-xs text-red-500 hover:text-red-700 transition-colors" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() ),
												esc_html__( 'Xóa', 'nest' )
											),
											$cart_item_key
										);
										?>
									</div>
								</div>
							</div>

							<!-- Price -->
							<div class="text-center text-sm font-semibold text-price">
								<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore ?>
							</div>

							<!-- Quantity -->
							<div class="flex justify-center">
								<?php
								if ( $_product->is_sold_individually() ) {
									$min_quantity = 1;
									$max_quantity = 1;
								} else {
									$min_quantity = 0;
									$max_quantity = $_product->get_max_purchase_quantity();
								}

								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $max_quantity,
										'min_value'    => $min_quantity,
										'product_name' => $product_name,
									),
									$_product,
									false
								);
								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore
								?>
							</div>

							<!-- Subtotal -->
							<div class="text-right text-sm font-bold text-price">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore ?>
							</div>
						</div>

						<!-- Mobile Row -->
						<div class="woocommerce-cart-form__cart-item xl:hidden flex gap-3 py-3 border-b border-gray-50 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<div class="flex w-[80px] h-[80px] shrink-0 border border-gray-100 overflow-hidden">
								<?php
								if ( $product_permalink ) {
									printf( '<a href="%s" class="cart-item-thumbnail-link block w-full h-full">%s</a>', esc_url( $product_permalink ), $thumbnail );
								} else {
									echo $thumbnail; // phpcs:ignore
								}
								?>
							</div>
							<div class="flex-1 min-w-0">
								<?php
								if ( $product_permalink ) {
									echo '<a href="' . esc_url( $product_permalink ) . '" class="text-sm font-medium text-foreground hover:text-primary line-clamp-2 transition-colors block mb-1">' . esc_html( $_product->get_name() ) . '</a>';
								} else {
									echo '<span class="text-sm font-medium block mb-1">' . wp_kses_post( $product_name ) . '</span>';
								}
								echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore
								?>
								<div class="text-sm font-bold text-price mb-2">
									<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore ?>
								</div>
								<div class="flex items-center justify-between">
									<div>
										<?php echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore ?>
									</div>
									<?php
									echo apply_filters( // phpcs:ignore
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a role="button" href="%s" class="text-xs text-red-500 hover:text-red-700" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() ),
											esc_html__( 'Xóa', 'nest' )
										),
										$cart_item_key
									);
									?>
								</div>
							</div>
						</div>

						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<div class="flex flex-wrap items-center justify-between gap-3 mt-4 pt-3 border-t border-gray-100">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="flex gap-2">
							<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
							<input type="text" name="coupon_code" class="border border-gray-200 px-3 py-2 text-sm w-[180px] focus:outline-none focus:border-primary" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Mã giảm giá', 'nest' ); ?>">
							<button type="submit" class="nest-btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
								<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
								<span class="nest-btn__text"><?php esc_html_e( 'Áp dụng', 'nest' ); ?></span>
								<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
							</button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="nest-btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						<span class="nest-btn__text"><?php esc_html_e( 'Cập nhật giỏ hàng', 'nest' ); ?></span>
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					</button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>
					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</div>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</form>

			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</div>

		<!-- Cross-sells / Suggested Products -->
		<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
		<?php woocommerce_cross_sell_display(); ?>

	</div>

	<!-- Right Column: Order Summary -->
	<div class="w-full xl:w-1/3 lg:w-5/12 px-2.5 lg:px-4">
		<div class="lg:sticky lg:top-4">
			<?php woocommerce_cart_totals(); ?>
		</div>
	</div>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
