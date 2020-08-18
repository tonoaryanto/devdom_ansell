<?php

if( ! class_exists( 'WooCommerce' ) ) {
	return;
}

class Zen_Shop_Store_Recent_Products_Carousel extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'zen_shop_store_recent_products_carousel',
			'description' => __( 'Display recent products carousel.', 'zen-shop-store' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'zen_shop_store_recent_products_carousel', __( 'Recent Products Carousel', 'zen-shop-store' ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$dinprodis = ! empty( $instance['dinprodis'] ) ? $instance['dinprodis'] : '5';

		echo $args['before_widget'];

		if( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		?>
		<div class="di-recet-products-cur owl-carousel owl-theme">

			<?php
			$r = new WP_Query( array(
			'posts_per_page'		=> absint( $dinprodis ),
			'no_found_rows'			=> true,
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> true,
			'post_type'      		=> 'product',
			'order'					=> 'DESC',
			) );

			if( $r->have_posts() ) {
				while ( $r->have_posts() ) : $r->the_post();
					$proimglink = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'zen-shop-store-featured-product' );
					$proimglink = $proimglink[0];
					?>
					<div class="item">

						<?php
						if( $proimglink ) {
						?>
							<img class="img-fluid csidproimg" src="<?php echo esc_url( $proimglink ); ?>">
						<?php
						} else {
							?>
							<img class="img-fluid csidproimg" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/product-img.png' ); ?>">
							<?php
						}
						?>

						<p class="rpctitleouttr"><a class="rpctitle masterbtn" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			}
			?>

		</div>
		<?php
		
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$dinprodis = ! empty( $instance['dinprodis'] ) ? $instance['dinprodis'] : '5';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'zen-shop-store' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'dinprodis' ) ); ?>"><?php esc_html_e( 'Number of products to show:', 'zen-shop-store' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'dinprodis' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dinprodis' ) ); ?>" type="number" step="1" min="1" value="<?php echo absint( $dinprodis ); ?>" size="3"></p>

		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['dinprodis'] = absint( $new_instance['dinprodis'] );
		return $instance;
	}
}

function zen_shop_store_recent_products_carousel() {
	register_widget( 'Zen_Shop_Store_Recent_Products_Carousel' );
}
add_action( 'widgets_init', 'zen_shop_store_recent_products_carousel' );
