<?php
/**
 * My Account page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="flex flex-wrap -mx-2.5 lg:-mx-4">

	<!-- Navigation sidebar -->
	<div class="w-full md:w-1/4 px-2.5 lg:px-4 mb-5">
		<div class="bg-white border border-gray-100 p-4 max-md:p-3">
			<?php do_action( 'woocommerce_account_navigation' ); ?>
		</div>
	</div>

	<!-- Content area -->
	<div class="w-full md:w-3/4 px-2.5 lg:px-4 mb-5">
		<div class="bg-white border border-gray-100 p-6 max-md:p-4">
			<?php
				/**
				 * My Account content.
				 *
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_account_content' );
			?>
		</div>
	</div>

</div>
