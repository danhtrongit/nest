<?php
/**
 * Template Part: Single Product - Social Share
 *
 * @package Nest
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_url   = get_permalink( $product->get_id() );
$product_title = get_the_title( $product->get_id() );
$encoded_url   = urlencode( $product_url );
$encoded_title = urlencode( $product_title );
?>
<div class="product-share-wishlist mt-5 pt-5 border-t border-gray-100">

	<!-- Social Share -->
	<div class="flex items-center gap-3 mb-3">
		<span class="flex items-center gap-1.5 text-sm text-gray-500">
			<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
				<path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"></path>
			</svg>
			<?php esc_html_e( 'Chia sẻ', 'nest' ); ?>
		</span>
		<div class="flex items-center gap-2">
			<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_attr( $encoded_url ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="<?php esc_attr_e( 'Chia sẻ lên Facebook', 'nest' ); ?>">
				<svg width="10" height="18" viewBox="0 0 155 155" fill="currentColor"><path d="M89.584,155.139V84.378h23.742l3.562-27.585H89.584V39.184c0-7.984,2.208-13.425,13.67-13.425l14.595-.006V1.08C115.325.752,106.661,0,96.577,0,75.52,0,61.104,12.853,61.104,36.452V56.793H37.29v27.585h23.814v70.761z"></path></svg>
			</a>
			<a href="https://twitter.com/share?url=<?php echo esc_attr( $encoded_url ); ?>&text=<?php echo esc_attr( $encoded_title ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-sky-500 text-white flex items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="<?php esc_attr_e( 'Chia sẻ lên Twitter', 'nest' ); ?>">
				<svg width="14" height="14" viewBox="0 0 512 512" fill="currentColor"><path d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992c0,8.32.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056c0,36.352,18.72,68.576,46.624,87.232c-16.864-.32-33.408-5.216-47.424-12.928c0,.32,0,.736,0,1.152c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-.384-19.872-1.792c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-.384-25.12-1.44C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-.16-9.12-.384-13.568C480.224,136.96,497.728,118.496,512,97.248z"></path></svg>
			</a>
			<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_attr( $encoded_url ); ?>&description=<?php echo esc_attr( $encoded_title ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="Pinterest">
				<svg width="12" height="14" viewBox="0 0 512 512" fill="currentColor"><path d="M262.948,0C122.628,0,48.004,89.92,48.004,187.968c0,45.472,25.408,102.176,66.08,120.16c6.176,2.784,9.536,1.6,10.912-4.128c1.216-4.352,6.56-25.312,9.152-35.2c.8-3.168.384-5.92-2.176-8.896c-13.504-15.616-24.224-44.064-24.224-70.752c0-68.384,54.368-134.784,146.88-134.784c80,0,135.968,51.968,135.968,126.304c0,84-44.448,142.112-102.208,142.112c-31.968,0-55.776-25.088-48.224-56.128c9.12-36.96,27.008-76.704,27.008-103.36c0-23.904-13.504-43.68-41.088-43.68c-32.544,0-58.944,32.224-58.944,75.488c0,27.488,9.728,46.048,9.728,46.048S144.676,371.2,138.692,395.488c-10.112,41.12,1.376,107.712,2.368,113.44c.608,3.168,4.16,4.16,6.144,1.568c3.168-4.16,42.08-59.68,52.992-99.808c3.968-14.624,20.256-73.92,20.256-73.92c10.72,19.36,41.664,35.584,74.624,35.584c98.048,0,168.896-86.176,168.896-193.12C463.62,76.704,375.876,0,262.948,0z"></path></svg>
			</a>
		</div>
	</div>

</div>
