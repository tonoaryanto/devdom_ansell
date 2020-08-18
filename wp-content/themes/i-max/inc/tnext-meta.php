<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'imax_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function imax_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'imax_';
	
	$imax_template_url = get_template_directory_uri();

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'heading',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Page Heading Options', 'i-max' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post', 'page' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// Hide Title
			array(
				'name' => __( 'Hide Title Bar', 'i-max' ),
				'id'   => "{$prefix}hidetitle",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'class' => 'hide-ttl',
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),
			array(
				'name' => __( 'Show Default i-max Slider', 'i-max' ),
				'id'   => "{$prefix}show_slider",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'class' => 'show-slider',
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),			
			
			// hide breadcrum
			array(
				'name' => __( 'Hide breadcrumb', 'i-max' ),
				'id'   => "{$prefix}hide_breadcrumb",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),
			
			// Custom Title
			array(
				// Field name - Will be used as label
				'name'  => __( 'Other Slider Plugin Shortcode', 'i-max' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}other_slider",
				// Field description (optional)
				'desc'  => __( 'Enter a 3rd party slider shortcode, ex. meta slider, smart slider 2, wow slider, etc.', 'i-max' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => __( '', 'i-max' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				//'clone' => true,
				'class' => 'cust-ttl',
			),			
			
			array(
				'name'            => __( 'Smart Slider 3', 'i-max' ),
				'id'              => "{$prefix}smart_slider",
				'type'            => 'select',
				// Array of 'value' => 'Label' pairs
				'options'         => imax_smartslider_list(),
				// Allow to select multiple value?
				'multiple'        => false,
				// Placeholder text
				'placeholder'     => __( 'Select a smart slider', 'i-max' ),
				// Display "Select All / None" button?
				'select_all_none' => false,
				'desc' 			  => __('This option will override all the above slider options', 'i-max'),
				'after'			  => imax_smartslider_after(),
			),				

		)
	);
	
	
	
	
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'portfoliometa',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Portfolio Options', 'i-max' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'portfolio' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// Side bar

			// ITEM DETAILS OPTIONS SECTION
			array(
				'type' => 'heading',
				'name' => __( 'Portfolio Additinal Details', 'i-max' ),
				'id'   => 'fake_id_pf1', // Not used but needed for plugin
			),
			// Slide duration
			array(
				'name'  => __( 'Subtitle', 'i-max' ),
				'id'    => "{$prefix}portfolio_subtitle",
				'desc'  => __( 'Enter a subtitle for use within the portfolio item index (optional).', 'i-max' ),				
				'type'  => 'text',
			),
			
			array(
				'name'  => __( 'Portfolio Link(External)', 'i-max' ),
				'id'    => "{$prefix}portfolio_url",
				'desc'  => __( 'Enter an external link for the item (optional) (NOTE: INCLUDE HTTP://).', 'i-max' ),
				'type'  => 'text',
			),
														

		)
	);		
	
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'miscellaneous',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Other Page Options', 'i-max' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post', 'page', 'portfolio', 'team', 'product' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'low',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			/*
			// Show Alternate main navigation
			array(
				'name' => __( 'Show Alternate Main Navigation', 'i-max' ),
				'id'   => "{$prefix}alt_navigation",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Turn on the alternate main navigation', 'i-max'),
			),
			*/
			
			// Remove top and bottom page padding/margin
			array(
				'name' => __( 'Remove Top and Bottom Padding/Margin', 'i-max' ),
				'id'   => "{$prefix}page_nopad",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Remove the spaces/padding from top and bottom of the page/post', 'i-max'),
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),							
			
			// Hide page header
			array(
				'name' => __( 'Show Transparent Header', 'i-max' ),
				'id'   => "{$prefix}trans_header",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Show transparent header on pages/posts. This will hide the page/post titlebar as well', 'i-max'),
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),				
			
			// Hide page header
			array(
				'name' => __( 'Hide Page Header', 'i-max' ),
				'id'   => "{$prefix}no_page_header",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('In case you are building the page without the top navigation and logo', 'i-max'),
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),										

			// Hide page header
			array(
				'name' => __( 'Hide Topbar', 'i-max' ),
				'id'   => "{$prefix}no_ubar",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Hide top bar with email, phone and social links', 'i-max'),
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),
			// Hide page header
			array(
				'name' => __( 'Hide Footer Widget Area', 'i-max' ),
				'id'   => "{$prefix}no_footer",
				'type' => 'switch',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Hide bottom footer widget area', 'i-max'),
				'on_label'  => esc_attr__('Yes', 'i-max'),
				'off_label' => esc_attr__('No', 'i-max'),					
			),									

			// Custom page primary color			
			array(
				'name'  => __( 'Custom Primary Color', 'i-max' ),
				'id'    => "{$prefix}page_color",
				'type'  => 'color',
				'std'   => '',
				'desc' => __('Choose a custom primary color for this page', 'i-max'),
			),
			
			// Custom page primary color			
			array(
				'name'  => __( 'Topbar Background Color', 'i-max' ),
				'id'    => "{$prefix}topbar_bg_color",
				'type'  => 'color',
				'std'   => '',
				'desc' => __('Top bar with phone, email and social link background color', 'i-max'),
			),
			
			/* Requires Meta Box Update 
			array(
				'name'  => __( 'Custom Page Logo Normal', 'i-max' ),
				'id'    => "{$prefix}page_logo_normal",
				'type'  => 'single_image',
			),
			// additional page class			
			array(
				'name'  => __( 'Custom Page Logo Reverse', 'i-max' ),
				'id'    => "{$prefix}page_logo_trans",
				'type'  => 'single_image',
			),
			*/				
							
			// additional page class			
			array(
				'name'  => __( 'Additional Page Class', 'i-max' ),
				'id'    => "{$prefix}page_class",
				'type'  => 'text',
				'std'   => __( '', 'i-max' ),
				'desc' => __('Enter an additional page class, will be added to body. "hide-page-header" for no header, "boxed" for boxed page for wide layout.', 'i-max'),
			),
						
		)
	);		
	
	return $meta_boxes;
}

	function imax_get_category_list_key_array($category_name) {
			
		$get_category = get_categories( array( 'taxonomy' => $category_name	));
		$category_list = array( 'all' => 'Select Category');
		
		foreach( $get_category as $category ){
			if (isset($category->slug)) {
			$category_list[$category->slug] = $category->cat_name;
			}
		}
			
		return $category_list;
	}	

	function imax_smartslider_list () {
		
		global $wpdb;
		$smartslider = array();
		//$smartslider[0] = 'Select a slider';
		
		if(class_exists('SmartSlider3')) {
			$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'nextend2_smartslider3_sliders');
			if($get_sliders) {
				foreach($get_sliders as $slider) {
					$smartslider[$slider->id] = $slider->title;
				}
			}
		}
		return $smartslider;
	
	}
	
	function imax_smartslider_after () {
		
		$smartslider_html = '';
		
		$smartslider_html .= '<div class="nx-ss-pro">';
		$smartslider_html .= esc_attr__('&quot;Smart Slider 3&quot; can be downloaded from ', 'i-max');
		$smartslider_html .= '<a href="'.esc_url('//wordpress.org/plugins/smart-slider-3/').'" target="_blank">';
		$smartslider_html .= esc_attr__('WordPress repository', 'i-max');
		$smartslider_html .= '</a>. ';
		$smartslider_html .= esc_attr__('Professionally designed ', 'i-max');
		$smartslider_html .= '<a href="'.esc_url('//smartslider3.com/sample-sliders/?source=templatesnext').'" target="_blank">';
		$smartslider_html .= esc_attr__('slider library', 'i-max');
		$smartslider_html .= '</a> ';
		$smartslider_html .= esc_attr__('available with Smart Slider 3.', 'i-max');
		$smartslider_html .= '</div>';
		
		return $smartslider_html;
	
	}	