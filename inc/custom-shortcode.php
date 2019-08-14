<?php
add_shortcode( 'share_url', 'kn_share_url' );
function kn_share_url( $atts ) {
	$atts = shortcode_atts(
		array(
			'type' => 'facebook',
		), 
	$atts, 'share_url' );
	$type = $atts['type'];
	ob_start();
		if( $type == 'facebook' ) {
			echo 'https://www.facebook.com/sharer/sharer.php?u='.get_permalink().'';
		}
		elseif ( $type == 'twitter' ) {
			echo 'https://twitter.com/home?status='.get_permalink().'';
		}
		elseif ( $type == 'linkin' ) {
			echo 'https://www.linkedin.com/shareArticle?mini=true&title=&summary=&source=&url='.get_permalink().'';
		}
		else {
			echo '#test';
		}
	return ob_get_clean();
}

add_shortcode( 'kn_search', 'kn_search' );
function kn_search( $form ) {
 	ob_start();
	    echo '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	    <div class="input-select">';
	    wp_dropdown_categories( 'hide_empty=0' );
	    echo '</div>';
	    echo '<div class="input-text">';
	    echo '<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="search" />
	    <button><i class="fa fa-search" aria-hidden="true"></i></button>
	    </div>
	    </form>';
    return ob_get_clean();
}

add_shortcode( 'custom_field', 'custom_field_func' );
function custom_field_func( $atts ) {
	$atts = shortcode_atts(
		array(
			'name' => 'second_day_price',
		), 
	$atts, 'custom_field' );
	$name = $atts['name'];
	ob_start();
		if( $name == 'regular' ) {
			echo get_post_meta( get_the_ID(),'_regular_price', true );
		}
		else {
			echo get_field( $name, get_the_ID() );
		}
	return ob_get_clean();
}


add_shortcode( 'woo_cart', 'woo_cart_counter' );

function woo_cart_counter() {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> (<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>)</a>
	<?php
	return ob_get_clean();
}


?>