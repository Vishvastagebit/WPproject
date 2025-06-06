<div class="thankyou-container" style="max-width: 1320px; margin: 0 auto; padding: 0 15px;">
    <div class="woocommerce-order">
        <?php
        if ( $order ) :

            do_action( 'woocommerce_before_thankyou', $order->get_id() );
            ?>

            <?php if ( $order->has_status( 'failed' ) ) : ?>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                    <?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?>
                </p>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay">
                        <?php esc_html_e( 'Pay', 'woocommerce' ); ?>
                    </a>
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay">
                            <?php esc_html_e( 'My account', 'woocommerce' ); ?>
                        </a>
                    <?php endif; ?>
                </p>

            <?php else : ?>

                <?php wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>

                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                    <li class="woocommerce-order-overview__order order" style="padding: 0 20px; border-right: 1px dashed #ccc;">
                        <?php esc_html_e( 'Order number:', 'woocommerce' ); ?><br>
                        <strong><?php echo $order->get_order_number(); ?></strong>
                    </li>

                    <li class="woocommerce-order-overview__date date" style="padding: 0 20px; border-right: 1px dashed #ccc;">
                        <?php esc_html_e( 'Date:', 'woocommerce' ); ?><br>
                        <strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
                    </li>

                    <li class="woocommerce-order-overview__total total" style="padding: 0 20px; border-right: 1px dashed #ccc;">
                        <?php esc_html_e( 'Total:', 'woocommerce' ); ?><br>
                        <strong><?php echo $order->get_formatted_order_total(); ?></strong>
                    </li>

                    <?php if ( $order->get_payment_method_title() ) : ?>
                        <li class="woocommerce-order-overview__payment-method method" style="padding: 0 20px;">
                            <?php esc_html_e( 'Payment method:', 'woocommerce' ); ?><br>
                            <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                        </li>
                    <?php endif; ?>

                </ul>

            <?php endif; ?>

            <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

        <?php else : ?>

            <?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

        <?php endif; ?>
    </div>
</div>
