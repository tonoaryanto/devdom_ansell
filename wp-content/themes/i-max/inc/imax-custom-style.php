<?php
	
	/*
	*
	*	nx Theme Functions
	*	------------------------------------------------
	*	nx Framework v 1.0
	*
	*	imax_custom_styles()
	*	nx_custom_script()
	*	nx_go_to_top()		
	*
	*/

 	/* CUSTOM CSS OUTPUT
 	================================================== */
 	if (!function_exists('imax_custom_styles')) { 
		function imax_custom_styles() {
			
			global  $imax_data;
			$custom_css = "";
			$body_font_size = "13";
			$body_line_height = "24";
			$menu_font_size = "13";
			$primary_color = "#dd3333";
			
			$tx_body_font = array();
			$tx_title_font = array();
			$tx_body_style = '';
			$tx_title_style = '';
			$tx_body_font['font-family'] = '"Open Sans", Helvetica, sans-serif';
			$tx_body_font['font-size'] = '14px';
			$tx_body_font['line-height']= 1.8;
			$tx_body_font['color'] = '#575757';
			$tx_body_font['variant'] = 400;
			
			$tx_title_font['font-family'] = 'Roboto, Georgia, serif';
			$tx_title_font['variant'] = 500;			

			$primary_color = esc_attr(get_theme_mod('primary_color', '#dd3333'));
			
			global $post;	
			$custom_page_color = '';
			$topbar_bg_color = '';	
			
			if ( function_exists( 'rwmb_meta' ) ) {
				$custom_page_color = rwmb_meta('imax_page_color', '');
				$topbar_bg_color = rwmb_meta('imax_topbar_bg_color', '');
			}			

			if( !empty($custom_page_color) ) {
				$primary_color = $custom_page_color;
			}				
			
			$tx_body_font = get_theme_mod( 'body_font', $tx_body_font );
			$tx_title_font = get_theme_mod( 'title_font', $tx_title_font );	
			
			if ( isset( $tx_body_font['font-family'] ) ) {
				$tx_body_style .= 'font-family: '.$tx_body_font['font-family'].'; ';
			}
			if ( isset( $tx_body_font['font-size'] ) ) {
				$tx_body_style .= 'font-size: '.$tx_body_font['font-size'].'px; ';
			}
			if ( isset( $tx_body_font['line-height'] ) ) {
				$tx_body_style .= 'line-height: '.$tx_body_font['line-height'].'; ';
			}
			if ( isset( $tx_body_font['color'] ) ) {
				$tx_body_style .= 'color: '.$tx_body_font['color'].';';
			}
			/*
			if ( isset( $tx_body_font['variant'] ) ) {
				$tx_body_style .= 'font-weight: '.$tx_body_font['variant'].';';
			}
			*/
			
			if ( isset( $tx_title_font['font-family'] ) ) {
				$tx_title_style .= 'font-family: '.$tx_title_font['font-family'].'; ';
			}
			if ( isset( $tx_title_font['variant'] ) ) {
				$tx_title_style .= 'font-weight: '.$tx_title_font['variant'].';';
			}								

			echo '<style type="text/css">'. "\n";
			
			echo 'body {'.$tx_body_style.'}';
			echo 'h1,h2,h3,h4,h5,h6,.comment-reply-title,.widget .widget-title, .entry-header h1.entry-title {'.$tx_title_style.'}';				
			
			echo '.themecolor {color: '.$primary_color.';}';
			echo '.themebgcolor {background-color: '.$primary_color.';}';
			echo '.themebordercolor {border-color: '.$primary_color.';}';
			
			echo '.tx-slider .owl-pagination .owl-page > span { border-color: '.$primary_color.';  }';
			echo '.tx-slider .owl-pagination .owl-page.active > span { background-color: '.$primary_color.'; }';
			echo '.tx-slider .owl-controls .owl-buttons .owl-next, .tx-slider .owl-controls .owl-buttons .owl-prev { background-color: '.$primary_color.'; }';		
			
			//echo '.nav-container > ul li a {font-size: '. $menu_font_size .'px;}';
			
			echo 'a,a:visited,.blog-columns .comments-link a:hover, .utilitybar.colored-bg .socialicons ul.social li a:hover .socico  {color: '.$primary_color.';}';

			echo 'input:focus,textarea:focus,.site-footer .widget-area .widget .wpcf7 .wpcf7-submit {border: 1px solid '.$primary_color.';}';
			
			echo 'button,input[type="submit"],input[type="button"],input[type="reset"],.tx-service.curved .tx-service-icon span,.tx-service.square .tx-service-icon span {background-color: '.$primary_color.';}';

			echo '.nav-container .sub-menu,.nav-container .children {border-top: 2px solid '.$primary_color.';}';

			echo '.ibanner,.da-dots span.da-dots-current,.tx-cta a.cta-button, .utilitybar.colored-bg {background-color: '.$primary_color.';}';

			echo '#ft-post .entry-thumbnail:hover > .comments-link,.tx-folio-img .folio-links .folio-linkico,.tx-folio-img .folio-links .folio-zoomico {background-color: '.$primary_color.';}';

			echo '.entry-header h1.entry-title a:hover,.entry-header > .entry-meta a:hover {color: '.$primary_color.';}';

			echo '.featured-area div.entry-summary > p > a.moretag:hover {background-color: '.$primary_color.';}';

			echo '.site-content div.entry-thumbnail .stickyonimg,.site-content div.entry-thumbnail .dateonimg,.site-content div.entry-nothumb .stickyonimg,.site-content div.entry-nothumb .dateonimg {background-color: '.$primary_color.';}';

			echo '.entry-meta a,.entry-content a,.comment-content a,.entry-content a:visited {color: '.$primary_color.';}';

			echo '.format-status .entry-content .page-links a,.format-gallery .entry-content .page-links a,.format-chat .entry-content .page-links a,.format-quote .entry-content .page-links a,.page-links a {background: '.$primary_color.';border: 1px solid '.$primary_color.';color: #ffffff;}';

			echo '.format-gallery .entry-content .page-links a:hover,.format-audio .entry-content .page-links a:hover,.format-status .entry-content .page-links a:hover,.format-video .entry-content .page-links a:hover,.format-chat .entry-content .page-links a:hover,.format-quote .entry-content .page-links a:hover,.page-links a:hover {color: '.$primary_color.';}';

			echo '.iheader.front, .vslider_button {background-color: '.$primary_color.';}';

			echo '.navigation a,.tx-post-row .tx-folio-title a:hover,.tx-blog .tx-blog-item h3.tx-post-title a:hover {color: '.$primary_color.';}';

			echo '.paging-navigation div.navigation > ul > li a:hover,.paging-navigation div.navigation > ul > li.active > a {color: '.$primary_color.';	border-color: '.$primary_color.';}';

			echo '.comment-author .fn,.comment-author .url,.comment-reply-link,.comment-reply-login,.comment-body .reply a,.widget a:hover {color: '.$primary_color.';}';

			echo '.widget_calendar a:hover {background-color: '.$primary_color.';	color: #ffffff;	}';

			echo '.widget_calendar td#next a:hover,.widget_calendar td#prev a:hover {background-color: '.$primary_color.';color: #ffffff;}';

			echo '.site-footer div.widget-area .widget a:hover {color: '.$primary_color.';}';

			echo '.site-main div.widget-area .widget_calendar a:hover,.site-footer div.widget-area .widget_calendar a:hover {background-color: '.$primary_color.';color: #ffffff;}';
						
			echo '.widget a:visited { color: #373737;}';

			echo '.widget a:hover,.entry-header h1.entry-title a:hover,.error404 .page-title:before,.tx-service-icon span i,.tx-post-comm:after {color: '.$primary_color.';}';

			echo '.da-dots > span > span,.site-footer .widget-area .widget .wpcf7 .wpcf7-submit, .nx-preloader .nx-ispload {background-color: '.$primary_color.';}';

			echo '.iheader,.format-status,.tx-service:hover .tx-service-icon span,.ibanner .da-slider .owl-item .da-link:hover {background-color: '.$primary_color.';}';
			
			echo '.tx-cta {border-left: 6px solid '.$primary_color.';}';
			
			echo '.paging-navigation #posts-nav > span:hover, .paging-navigation #posts-nav > a:hover, .paging-navigation #posts-nav > span.current, .paging-navigation #posts-nav > a.current, .paging-navigation div.navigation > ul > li a:hover, .paging-navigation div.navigation > ul > li > span.current, .paging-navigation div.navigation > ul > li.active > a {border: 1px solid '.$primary_color.';color: '.$primary_color.';}';
			
			echo '.entry-title a { color: #141412;}';
			
			echo '.tx-service-icon span { border: 2px solid '.$primary_color.';}';
			
			echo '.utilitybar.colored-bg { border-bottom-color: '.$primary_color.';}';			
			
			echo '.nav-container .current_page_item > a,.nav-container .current_page_ancestor > a,.nav-container .current-menu-item > a,.nav-container .current-menu-ancestor > a,.nav-container li a:hover,.nav-container li:hover > a,.nav-container li a:hover,ul.nav-container ul a:hover,.nav-container ul ul a:hover {background-color: '.$primary_color.'; }';
			
			echo '.tx-service.curved .tx-service-icon span,.tx-service.square .tx-service-icon span {border: 6px solid #e7e7e7; width: 100px; height: 100px;}';
			
			echo '.tx-service.curved .tx-service-icon span i,.tx-service.square .tx-service-icon span i {color: #FFFFFF;}';
			
			echo '.tx-service.curved:hover .tx-service-icon span,.tx-service.square:hover .tx-service-icon span {background-color: #e7e7e7;}';
			
			echo '.tx-service.curved:hover .tx-service-icon span i,.tx-service.square:hover .tx-service-icon span i,.folio-style-gallery.tx-post-row .tx-portfolio-item .tx-folio-title a:hover {color: '.$primary_color.';}';
			
			echo '.site .tx-slider .tx-slide-button a,.ibanner .da-slider .owl-item.active .da-link  { background-color: '.$primary_color.'; color: #FFF; }';
			echo '.site .tx-slider .tx-slide-button a:hover  { background-color: #373737; color: #FFF; }';	
			
			echo '.ibanner .da-slider .owl-controls .owl-page span { border-color:'.$primary_color.'; }';
			
			echo '.ibanner .da-slider .owl-controls .owl-page.active span, .ibanner .da-slider .owl-controls.clickable .owl-page:hover span {  background-color: '.$primary_color.'; }';					
			
			echo '.vslider_button, .vslider_button:visited, .ibanner.nxs-max18 .owl-item .nx-slider .da-img:before { background-color:'.$primary_color.';}';
			
			echo '.ibanner .sldprev, .ibanner .da-slider .owl-prev, .ibanner .sldnext, .ibanner .da-slider .owl-next { 	background-color: '.$primary_color.'; }';	
			
			echo '.colored-drop .nav-container ul ul a, .colored-drop ul.nav-container ul a, .colored-drop ul.nav-container ul, .colored-drop .nav-container ul ul {background-color: '.$primary_color.';}';				
			
			echo '.header-iconwrap .header-icons.woocart > a .cart-counts, .woocommerce ul.products li.product .button {background-color:'.$primary_color.';}';
			
			echo '.header-icons.woocart .cartdrop.widget_shopping_cart.nx-animate { border-top-color:'.$primary_color.';}';
			
			echo '.woocommerce ul.products li.product .onsale, .woocommerce span.onsale { background-color: '.$primary_color.'; color: #FFF; }';
			
			echo '.nx-nav-boxedicons .site-header .header-icons > a > span.genericon:before, ul.nav-menu > li.tx-heighlight:before, .woocommerce .nxowoo-box:hover a.button.add_to_cart_button {background-color: '.$primary_color.'}';			
			
			if( !empty($topbar_bg_color) ) {
				echo '.site .utilitybar { background-color: '.$topbar_bg_color.'; color: #FFFFFF; border-bottom: 1px solid '.$topbar_bg_color.';}';
				echo '.site .utilitybar .ubarinnerwrap .topphone { color: #FFFFFF;}';	
				echo '.site .utilitybar .ubarinnerwrap .topbarico	{ color: #FFFFFF;}';
				echo '.site .utilitybar .ubarinnerwrap .socialicons ul.social li a i.genericon { background-color: rgba(255, 255, 255, 0.2); color: #FFF; }';	
				echo '.site .utilitybar .ubarinnerwrap .socialicons ul.social li a:hover i.genericon { background-color: rgba(255, 255, 255, 0.0); color: #FFF; }';								
			}				
			
			if ($custom_css) {
				echo "\n".'/* =============== user styling =============== */'."\n";
				echo $custom_css;
			}
			
			// CLOSE STYLE TAG
			echo "</style>". "\n";
		}
	
		add_action('wp_head', 'imax_custom_styles');
	}
	
	/* CUSTOM JS OUTPUT
	================================================== 
	function nx_custom_script() {
		
		global  $imax_data;
		
		$custom_js = $imax_data['custom_js'];
		
		if ($custom_js) {			
			echo "\n<script>\n".$custom_js."\n</script>\n";			
		}
	}
	
	add_action('wp_footer', 'nx_custom_script');
		
*/
?>