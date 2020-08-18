<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package  i-max
 * @since i-max 1.0
 */
?>
<?php


$bg_style = '';
$top_phone = '';
$top_email = '';
$topbar_bg_class = '';
$nav_dropdown_class = '';

$topbar_bg = get_theme_mod('topbar_bg', 1);
$top_phone = esc_attr(get_theme_mod('top_phone', '1-000-123-4567'));
$top_email = esc_attr(get_theme_mod('top_email', 'email@i-create.com'));
$imax_logo = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
$imax_logo_trans = get_theme_mod( 'logo_trans', '' );

$nav_dropdown = get_theme_mod('nav_dropdown', 1);

if ( $topbar_bg == 1 ) {
	$topbar_bg_class = "colored-bg";
}
if ( $nav_dropdown == 1 ) {
	$nav_dropdown_class = "colored-drop";
}

global $post; 

$no_page_header = 0;
if ( function_exists( 'rwmb_meta' ) ) { 
	$no_page_header = rwmb_meta('imax_no_page_header');
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php    
    if ( ! function_exists( '_wp_render_title_tag' ) ) :
        function imax_render_title() {
    ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
        }
        add_action( 'wp_head', 'imax_render_title' );
    endif;    
    ?> 
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style=" <?php echo $bg_style; ?> ">

	<?php if ( get_theme_mod('pre_loader', 1) == 1 ) : ?>
	<div class="nx-ispload">
        <div class="nx-ispload-wrap">
            <div class="nx-folding-cube">
                <div class="nx-cube1 nx-cube"></div>
                <div class="nx-cube2 nx-cube"></div>
                <div class="nx-cube4 nx-cube"></div>
                <div class="nx-cube3 nx-cube"></div>
            </div>
        </div>    
    </div>
    <?php endif; ?> 
	<div id="page" class="hfeed site">
    	
        <?php if ( $top_email || $top_phone || imax_social_icons() ) : ?>
    	<div id="utilitybar" class="utilitybar <?php echo $topbar_bg_class; ?>">
        	<div class="ubarinnerwrap">
                <div class="socialicons">
                    <?php echo imax_social_icons(); ?>
                </div>
                <?php if ( !empty($top_phone) ) : ?>
                <div class="topphone tx-topphone">
                    <i class="topbarico genericon genericon-phone"></i>
                    <?php _e('Call us : ','i-max'); ?> <?php echo esc_attr($top_phone); ?>
                </div>
                <?php endif; ?>
                
                <?php if ( !empty($top_email) ) : ?>
                <div class="topphone tx-topmail">
                    <i class="topbarico genericon genericon-mail"></i>
                    <?php _e('Mail us : ','i-max'); ?> <?php echo sanitize_email($top_email); ?>
                </div>
                <?php endif; ?>                
            </div> 
        </div>
        <?php endif; ?>
        
        <?php if ( $no_page_header == 0 ) : ?>
        <div class="headerwrap">
            <header id="masthead" class="site-header" role="banner">
         		<div class="headerinnerwrap">
					<?php if ( $imax_logo && $imax_logo_trans ) : ?>
                        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <span><img src="<?php echo esc_url($imax_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" class="imax-logo normal-logo" /></span>
                            <span><img src="<?php echo $imax_logo_trans; ?>" alt="<?php bloginfo( 'name' ); ?>" class="imax-logo trans-logo" /></span>                            
                        </a>
					<?php elseif ( $imax_logo ) : ?>
                        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <span><img src="<?php echo esc_url($imax_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" class="imax-logo" /></span>
                        </a>
					<?php elseif ( $imax_logo_trans ) : ?>
                        <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <span><img src="<?php echo $imax_logo_trans; ?>" alt="<?php bloginfo( 'name' ); ?>" class="imax-logo" /></span>  
                        </a>
                    <?php else : ?>
                        <span id="site-titlendesc">
                            <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>   
                            </a>
                        </span>
                    <?php endif; ?>	
        
                    <div id="navbar" class="navbar <?php echo $nav_dropdown_class; ?>">
                        <nav id="site-navigation" class="navigation main-navigation" role="navigation">
                            <h3 class="menu-toggle"><?php _e( 'Menu', 'i-max' ); ?></h3>
                            <a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'i-max' ); ?>"><?php _e( 'Skip to content', 'i-max' ); ?></a>
                            <?php 
								if ( has_nav_menu(  'primary' ) ) {
										wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container_class' => 'nav-container', 'container' => 'div' ) );
									}
									else
									{
										wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-container' ) ); 
									}
								?>
							
                        </nav><!-- #site-navigation -->
                        
                        <?php
                        global $woocommerce;
						$show_cart = get_theme_mod('show_cart', 0);
                        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $show_cart == 1 ) {
                        ?>
                        <div class="header-iconwrap">
                            <div class="header-icons woocart">
                                <a href="<?php echo wc_get_cart_url(); ?>" >
                                    <span class="show-sidr"><?php _e('Cart','i-max'); ?></span>
                                    <span class="genericon genericon-cart"></span>
                                    <span class="cart-counts"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
                                </a>
                                <?php echo imax_top_cart(); ?>
                            </div>
                        </div>  
                        <?php	
                        }
                        ?>                                              
                        
                       	<?php if ( get_theme_mod('show_search', 1) == 1 ) : ?>
                        <div class="topsearch">
                            <?php get_search_form(); ?>
                        </div>
                        <?php endif; ?>	
                    </div><!-- #navbar -->
                    <div class="clear"></div>
                </div>
            </header><!-- #masthead -->
        </div>
        <?php endif; ?>
        
        <!-- #Banner -->
        <?php
		
		$hide_title = $show_slider = $other_slider = $custom_title = $hide_breadcrumb = $smart_slider_3 = "";
		
		if ( function_exists( 'rwmb_meta' ) ) {
			$hide_title = rwmb_meta('imax_hidetitle');
			$show_slider = rwmb_meta('imax_show_slider');
			$other_slider = rwmb_meta('imax_other_slider');
			$custom_title = rwmb_meta('imax_customtitle');
			$hide_breadcrumb = rwmb_meta('imax_hide_breadcrumb');
			$smart_slider_3 = rwmb_meta('imax_smart_slider');			
		}
		
		$hide_front_slider = get_theme_mod('slider_stat', 0);
		$other_front_slider = get_theme_mod('blogslide_scode', '');
		$itrans_slogan = esc_attr(get_theme_mod('banner_text', ''));
		
		if( $smart_slider_3 ) {
			$other_slider = '[smartslider3 slider='.$smart_slider_3.']';
		}		
		
		$other_slider = esc_html($other_slider);
		$other_front_slider = esc_html($other_front_slider);
		
		if ( is_home() ) {
			
			if ( !empty($other_front_slider) ) : ?>
            	<?php echo do_shortcode( htmlspecialchars_decode($other_front_slider) ) ?>
        	<?php elseif ( $hide_front_slider == 0 ) : ?>
            	<?php imax_ibanner_slider(); ?>
        	<?php else : ?>
            <div class="iheader" style="">
                <div class="titlebar">
                    <h1 class="entry-title">
                        <?php
                            if ($itrans_slogan) {
                                echo esc_attr($itrans_slogan);
                            }
                        ?>	                 
                    </h1>
                </div>
            </div>                                    
        	<?php endif;
		} else 
		{

			if($other_slider) :
			?>
			
			<div class="other-slider" style="">
				<?php echo do_shortcode( htmlspecialchars_decode($other_slider) ) ?>
			</div>
	
			<?php	
			//elseif ( is_home() && !is_paged() || $show_slider ) : 
			elseif ( $show_slider ) : 		
			?>
				<?php imax_ibanner_slider(); ?>
			<?php 
			elseif( !$hide_title ) : 
			?>
			
			<div class="iheader nx-titlebar" style="">
				<div class="titlebar">
					
					<?php
						if( is_archive() )
						{
							echo '<h1 class="entry-title">';
								if ( is_day() ) :
									printf( __( 'Daily Archives: %s', 'i-max' ), get_the_date() );
								elseif ( is_month() ) :
									printf( __( 'Monthly Archives: %s', 'i-max' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'i-max' ) ) );
								elseif ( is_year() ) :
									printf( __( 'Yearly Archives: %s', 'i-max' ), get_the_date( _x( 'Y', 'yearly archives date format', 'i-max' ) ) );
								elseif ( is_category() ) :	
									printf( __( 'Category Archives: %s', 'i-max' ), single_cat_title( '', false ) );		
								else :
									_e( 'Archives', 'i-max' );
								endif;                						
							echo '</h1>';
						} elseif ( is_search() ) {
							echo '<h1 class="entry-title">';
								printf( __( 'Search Results for: %s', 'i-max' ), get_search_query() );					
							echo '</h1>';
						} else 	{
							if ( !empty($custom_title) ) {
								echo '<h1 class="entry-title">'.esc_attr($custom_title).'</h1>';
							} else {
								echo '<h1 class="entry-title">';
								the_title();
								echo '</h1>';
							}						
						}
						
						if(function_exists('bctx_display') && !$hide_breadcrumb ) {
							echo '<div class="nx-breadcrumb">';
								bctx_display(); 
							echo '</div>';
						} elseif(function_exists('bcn_display') && !$hide_breadcrumb ) {
							echo '<div class="nx-breadcrumb">';
								bcn_display();
							echo '</div>';
						}
					?>               
					
				</div>
			</div>
			
			<?php endif;
		
		}		
		
		?>
		<div id="main" class="site-main">

