<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>









<div class="order_tabel">
    <div class="table_head">
        <div class="table_detail main_detail">
            <h4 class="product-name"><?php _e( 'Product name', 'woocommerce' ); ?></h4>
            <h4 class="product-total"><?php _e( 'Price', 'woocommerce' ); ?></h4>
        </div>
    </div>
	
    <?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
    
    <div class="table_head">
        <div class="table_detail <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
<!--            <h4>men's tee<span>S / Black</span></h4>-->
            <h4 class="product-name">
                <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
		<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity ">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
                <?php echo WC()->cart->get_item_data( $cart_item ); ?>
            </h4>
<!--            <h4>$59.99</h4>-->
            <h4 class="product-total">
                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
            </h4>
        </div>
    </div>
    <?php
            }
    }

    do_action( 'woocommerce_review_order_after_cart_contents' );
?>
    <div class='table_detail_div'>
            <div class="table_head">
                <div class="table_detail total_detail">
                    <h4><?php _e( 'Subtotal', 'woocommerce' ); ?></h4>
                    <h4><?php wc_cart_totals_subtotal_html(); ?></h4>
                </div>
            </div>
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <div class="table_head">
        <div class="table_detail total_detail">
                    <h4><?php wc_cart_totals_coupon_label( $coupon ); ?></h4>
                    <h4><?php wc_cart_totals_coupon_html( $coupon ); ?></h4>
        </div> </div>
        <?php endforeach; ?>
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <div class="table_head">
                <div class="table_detail total_detail">
			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<h4><?php wc_cart_totals_shipping_html(); ?></h4>

			<h4><?php do_action( 'woocommerce_review_order_after_shipping' ); ?></h4>
                </div> </div>
		<?php endif; ?>
        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <div class="table_head">
			 <div class="table_detail total_detail">
				<h4><?php echo esc_html( $fee->name ); ?></h4>
				<h4><?php wc_cart_totals_fee_html( $fee ); ?></h4>
			</div></div>
		<?php endforeach; ?>
        <?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
         <div class="table_head">
                                        <div class="table_detail total_detail">
<!--					<tr class="tax-rate tax-rate-<?php //echo sanitize_title( $code ); ?>">-->
						<h4><?php echo esc_html( $tax->label ); ?></h4>
						<h4><?php echo wp_kses_post( $tax->formatted_amount ); ?></h4>
					</div></div>
				<?php endforeach; ?>
			<?php else : ?> 
        <div class="table_head">
				 <div class="table_detail total_detail">
					<h4><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></h4>
					<h4><?php wc_cart_totals_taxes_total_html(); ?></h4>
				</div></div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
           <div class="table_head">                       
        <div class="table_detail total_detail">
			<h4><?php _e( 'Total', 'woocommerce' ); ?></h4>
			<h4><?php wc_cart_totals_order_total_html(); ?></h4>
		</div></div>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
    </div>
</div></div></div>
