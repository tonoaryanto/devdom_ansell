<?php

if( ! class_exists( 'WooCommerce' ) ) {
	return;
}

class Zen_Shop_Store_Featured_Product extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'zen_shop_store_featured_product',
			'description' => __( 'Display single product in sidebar.', 'zen-shop-store' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'zen_shop_store_featured_product', __( 'Sidebar Featured Product', 'zen-shop-store' ), $widget_ops );
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
		$diproid = ! empty( $instance['diproduct'] ) ? $instance['diproduct'] : '';

		echo $args['before_widget'];

		if( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		
		?>
		<div class="di-featured-product">

			<?php
			$product = wc_get_product( $diproid );
			$protitle = $product->get_title();

			$prolink = get_the_permalink( $diproid );

			$proimglink = wp_get_attachment_image_src( get_post_thumbnail_id( $diproid ), 'zen-shop-store-featured-product' );
			$proimglink = $proimglink[0];
			?>

			<?php
			if( $proimglink ) {
				?>
				<img class="img-fluid sidproimg" src="<?php echo esc_url( $proimglink ); ?>">
				<?php
			} else {
				?>
				<img class="img-fluid sidproimg" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/product-img.png' ); ?>">
				<?php
			}
			?>
			
			<p class="sidprotitleotr"><a class="sidprotitle masterbtn" href="<?php echo esc_url( $prolink ); ?>"><?php echo esc_html( $protitle ); ?></a></p>

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
		$diproid = ! empty( $instance['diproduct'] ) ? $instance['diproduct'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'zen-shop-store' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'diproduct' ) ); ?>"><?php esc_html_e( 'Select a Product:', 'zen-shop-store' ); ?></label> 
		<select name="<?php echo esc_attr( $this->get_field_name( 'diproduct' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'diproduct' ) ); ?>" >
			<?php
			$diargs = array(
				'status' => 'publish',
				'limit' => -1,
			);
			$diproducts = wc_get_products( $diargs );
			foreach ($diproducts as $diproduct) {
				?>
				<option value="<?php echo absint( $diproduct->get_id() ); ?>" <?php selected( absint( $diproid ), absint( $diproduct->get_id() ) ); ?>><?php echo esc_html( $diproduct->get_title() ); ?></option>
				<?php
			}
			?>
		</select>
		</p>
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
		$instance['diproduct'] = absint( $new_instance['diproduct'] );
		return $instance;
	}
}

function zen_shop_store_register_featured_product() {
	register_widget( 'Zen_Shop_Store_Featured_Product' );
}
add_action( 'widgets_init', 'zen_shop_store_register_featured_product' );
