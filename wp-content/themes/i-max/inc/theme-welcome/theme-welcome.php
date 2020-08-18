<?php

include get_template_directory() . '/inc/theme-welcome/tw-functions.php';	
	
if (isset($_GET['activated']) && is_admin()) {
	set_transient( '_welcome_screen_activation_redirect', true, 30 );
}

add_action( 'admin_init', 'welcome_screen_do_activation_redirect' );
function welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( '_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( '_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to bbPress about page
  wp_safe_redirect( add_query_arg( array( 'page' => 'welcome-screen-about' ), admin_url( 'themes.php' ) ) );

}

add_action('admin_menu', 'welcome_screen_pages');

function welcome_screen_pages() {
	add_theme_page(
		'Welcome To Welcome i-max',
		'About i-max',
		'read',
		'welcome-screen-about',
		'welcome_screen_content',
		'dashicons-awards', 
		6 		
	);
}

function welcome_screen_content() {
	
	include get_template_directory() . '/inc/theme-welcome/tw-content.php';
	
	$logo_url = get_template_directory_uri() . '/inc/theme-welcome/i-max-welcome.jpg';
	$page_settings_image_url = get_template_directory_uri() . '/inc/theme-welcome/images/page-settings.gif';	
	$img_url = get_template_directory_uri() . '/inc/theme-welcome/images/';
	$active_tab = 'imax_about';
	
	/* Urls */
	$reviewURL = esc_url('//wordpress.org/support/theme/i-max/reviews/?filter=5');
	$goPremiumURL = esc_url('//templatesnext.org/ispirit/landing/?ref=imaxw');
	$videoguide = esc_url('//www.templatesnext.org/i-max-documentations/');
	$supportforum = esc_url('//templatesnext.org/ispirit/landing/forums/'); 
	$toolkit = esc_url('//www.templatesnext.org/icreate/templatesnext-toolkit/');
	$fb_page = esc_url('//www.facebook.com/templatesnext/');
	$pb_tutorial = esc_url('https://siteorigin.com/page-builder/documentation/');
	$livedemo = esc_url('//templatesnext.org/i-max/?ref=imaxw');	


	$ocdi_buttont = "";
	if ( class_exists('OCDI_Plugin') ) {
		$ocdi_buttont = "button-enabled";
	} else
	{
		$ocdi_buttont = "button-disabled";
	} 	
	$details_theme = wp_get_theme();
	$name_version = $details_theme->get( 'Name' ) . " - " . $details_theme->get( 'Version' );
  	?>
  	<div class="wrapp">
        <div class="nx-info-wrap-2 welcome-panel">
        	
        	<div class="nx-info-wrap">
            	
                <div class="nx-welcome tw-title"><?php _e( 'Welcome To ', 'i-max' ); echo $name_version; ?></div>
                <div class="tx-wspace-24"></div>
                <div class="tx-wspace-24"></div>                
                <div class="welcome-logo"><img src="<?php echo $logo_url; ?>" alt="" class="welcome-logo-img" width="" /></div>
                <div class="nx-info-desc">
                    <p>
						<?php _e( 'Blog, WooCommerce, business or personal website, I-MAX is crafted to suit all. It is favorite among developers as well as among first time WordPress users. I-MAX is RTL ready.', 'i-max' ); ?>
					</p>
                    <p>
						<?php _e( 'Make sure to install accompanying plugin &quot;TemplatesNext ToolKit&quot; to activate all the features and options of this theme.', 'i-max' ); ?>
					</p>                    
                    <a class="button button-primary button-hero" target="_blank" href="<?php echo $livedemo; ?>">
                    <?php _e( 'Live Demos', 'i-max' ); ?>
                    </a>  
                    <a class="button button-primary button-hero" target="_blank" href="<?php echo $goPremiumURL; ?>">
                    	<?php _e( 'Go Premium', 'i-max' ); ?>
                    </a>  
                </div>
                <div class="tx-wspace-12"></div>
                <div class="tx-wspace-24"></div>
                <?php
					if( isset( $_GET[ 'tab' ] ) ) {
						$active_tab = $_GET[ 'tab' ];
					}
				?>
                <h2 class="nav-tab-wrapper">
                    <a href="?page=welcome-screen-about&tab=imax_about" class="nav-tab <?php echo $active_tab == 'imax_about' ? 'nav-tab-active' : ''; ?>">
                   		<?php _e( 'Setting Up I-MAX', 'i-max' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=imax_vid" class="nav-tab <?php echo $active_tab == 'imax_vid' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'Video Guide', 'i-max' ); ?>
                    </a>                       
                    <a href="?page=welcome-screen-about&tab=imax_pro" class="nav-tab <?php echo $active_tab == 'imax_pro' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'Go Premium', 'i-max' ); ?>
                    </a>                    
                    <a href="?page=welcome-screen-about&tab=imax_ocdi" class="nav-tab <?php echo $active_tab == 'imax_ocdi' ? 'nav-tab-active' : ''; ?>">
                   		<?php _e( 'One Click Demo Import', 'i-max' ); ?>
                    </a>                           
                    <a href="?page=welcome-screen-about&tab=imax_plugins" class="nav-tab <?php echo $active_tab == 'imax_plugins' ? 'nav-tab-active' : ''; ?> nx-kick">
                    	<?php _e( 'Useful Plugins', 'i-max' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=imax_faq" class="nav-tab <?php echo $active_tab == 'imax_faq' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'FAQs/Support', 'i-max' ); ?>
                    </a>
                </h2>
                
                <?php
					if( $active_tab == 'imax_about' )
					{
				?> 
                	<div class="nx-tab-content">
                		<p>&nbsp;</p>
                        <ul class="nx-welcome">
							<?php
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Upload Logos', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Start with uploading your logos', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=title_tagline" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Theme Color', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Change theme color', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=colors" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Topbar Customization', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Add your phone, email and social links or empty the fields to remove them', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=nxtopbar" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Header Customization', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Customize header, change font menu size, width, etc.', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=nxheader" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Turn ON/OFF Preloader', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Turn on or off page preloader, by default it is on', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=layout" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';
									
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Footer Customization', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Customize footer background, text color, etc', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=nxfooter" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';									

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Edit Theme Slider', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Adjust slider settings, edit slides, etc.', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[panel]=slider" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'WooCommerce Customization', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Adjust WooCommerce Settings', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=woocomm" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Fonts', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Choose your fonts', 'i-max' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=fonts" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';
									
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Choose Your Plugins', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'I-ONE supports most of the popular plugins. We have listed some of the popular plugins with high ratings. ', 'i-max' ) );
									printf( esc_html__( 'It is not neccssery to install and activate all the plugins recommendded. ', 'i-max' ) );
									printf( esc_html__( 'You need the correct set of plugins suiteable for your job.', 'i-max' ) );																		
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%sthemes.php?page=welcome-screen-about&tab=imax_plugins" target="_blank">Install Plugins</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';
									
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Activate Maintenance/Coming Soon  Mode', 'i-max' ));
									echo '</h3>';
									printf( esc_html__( 'Maintenance mode for visitors. If you are logged in admin, use different browser to preview the maintenance mode.', 'i-max' ) );
									printf( esc_html__( 'Logged in admins will view a normal site so that they can work on it.', 'i-max' ) );										
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=mmode" target="_blank">Customizer Option</a>', 'i-max' ), admin_url() );
									echo '</div>';								
									echo '</li>';								
                            ?>                    
                        </ul>
                        <?php
							echo 'Ideal page settings for page builder layouts : ';
							echo '<img style="border: 4px solid #bbbbbb; margin-top: 12px;" src="'.$page_settings_image_url.'" alt="" />';
                        ?>
        			</div>
				<?php
					} elseif ( $active_tab == 'imax_vid' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <ul class="vd-thumb">
                        	<li><a href="#media-popup" data-media="//www.youtube.com/embed/J7mJSnuko_w?autoplay=1"><img src="<?php echo esc_url(get_template_directory_uri() . '/inc/theme-welcome/images/so-pb.png'); ?>" alt="" /></a></li>
                            <li><a href="#media-popup" data-media="//www.youtube.com/embed/sCStWRm6iUU?autoplay=1"><img src="<?php echo esc_url(get_template_directory_uri() . '/inc/theme-welcome/images/elementor.png'); ?>" alt="" /></a></li>
                            <li><a href="#media-popup" data-media="//www.youtube.com/embed/KFuO0Jg6Ps4?autoplay=1"><img src="<?php echo esc_url(get_template_directory_uri() . '/inc/theme-welcome/images/brizy-n-ss3.png'); ?>" alt="" /></a></li>
                        </ul>    
                            
                        <div class="popup" id="media-popup">
                        	<div class="nx-videowrapper">
                            	<iframe width="560" height="315" src="" frameborder="0" autoplay="1" allowfullscreen></iframe>
                                <div class="clvideo"><a href="#"><?php esc_attr_e('Close Video', 'i-max'); ?></a></div>
                            </div>
                        </div>                       
						<div class="tx-wspace-12"></div>
        			</div>      
                        
				<?php	
					} elseif ( $active_tab == 'imax_ocdi' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <p style="font-weight: 600; color: #272727;">
                            <?php _e( 'Following plugins were used while creating the &quot;One Click Demo&quot;s. <br>Once you are done with installing and activating the plugins go to', 'i-max' ); ?>
                            <a class="" href="<?php echo admin_url(); ?>themes.php?page=pt-one-click-demo-import">
                            <?php _e( 'I-MAX Demo Setup', 'i-max' ); ?>
                            </a>                             
                        </p>                       
                        <ol>
							<?php
			
								foreach ($tx_plugins as $plugin) {
									
									$pluginLocation = rawurlencode($plugin['slug'].'/'.$plugin['pluginfile']);
									$pluginLink = imax_plugin_activation( $pluginLocation, $plugin['slug'], $plugin['pluginfile'] );
									$nonce_install = imax_plugin_install($plugin['slug']);
															
									if (!empty($plugin['ocdi']))
									{
										echo '<li><b>'.$plugin['title'].'</b><br />';
										echo $plugin['desc'].'<br />';
										$pluginTitle = $plugin['title'];
										if ( is_plugin_active( $plugin['slug'].'/'.$plugin['pluginfile'] ) ) {
											echo '<a href="#" class="button disabled">' . __( 'Plugin installed and active', 'i-max' ) . '</a>';  
										} elseif( imax_is_plugin_installed($pluginTitle) == false )
										{
											echo '<a data-slug="' . $plugin['slug'] . '" data-active-lebel="' . __( 'Installing...', 'i-max' ) . '" class="install-now button" href="' . esc_url( $nonce_install ) . '" data-name="' . $plugin['slug'] . '" aria-label="Install ' . $plugin['slug'] . '">' . __( 'Install and activate', 'i-max' ) . '</a>';
										} else
										{
											echo '<a class="button activate-now button-primary" data-active-lebel="' . __( 'Activating...', 'i-max' ) . '" data-slug="' . $plugin['slug'] . '" href="' . esc_url( $pluginLink ) . '" aria-label="Activate ' . $plugin['slug'] . '">Activate</a>';
										}
										echo '</li>';
									}
									
								}
                            ?>                    
                        </ol>
        			</div>       
                                            
				<?php		
					} elseif ( $active_tab == 'imax_plugins' )
					{
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <p style="font-weight: 500; color: #272727;">
                            <?php _e( 'I-MAX is created using core WordPress theme as framework, most of the WordPress plugin should run flowlessly with I-MAX, We have listed few useful plugins bellow, so that you can install them with a click.', 'i-max' ); ?>
                        </p>                        
                        <ol>
							<?php
			
								foreach ($tx_plugins as $plugin) {
									
									$pluginLocation = rawurlencode($plugin['slug'].'/'.$plugin['pluginfile']);
									$pluginLink = imax_plugin_activation( $pluginLocation, $plugin['slug'], $plugin['pluginfile'] );
									$nonce_install = imax_plugin_install($plugin['slug']);
															
									
									echo '<li><b>'.$plugin['name'].'</b><br />';
									echo $plugin['desc'].'<br />';
									echo _e( 'Plugin URL : ', 'i-max' ).'<a href="'.$plugin['pluginurl'].'" target="_blank">'.$plugin['pluginurl'].'</a><br />';
									if(!empty($plugin['tutorial']))
									{
										echo _e( 'Tutorial : ', 'i-max' ).'<a href="'.$plugin['tutorial'].'" target="_blank">'.$plugin['tutorial'].'</a><br />';   
									}
									
									$pluginTitle = $plugin['title'];
									if ( is_plugin_active( $plugin['slug'].'/'.$plugin['pluginfile'] ) ) {
										echo '<a href="#" class="button disabled">' . __( 'Plugin installed and active', 'i-max' ) . '</a>';  
									} elseif( imax_is_plugin_installed($pluginTitle) == false )
									{
										echo '<a data-slug="' . $plugin['slug'] . '" data-active-lebel="' . __( 'Installing...', 'i-max' ) . '" class="install-now button" href="' . esc_url( $nonce_install ) . '" data-name="' . $plugin['slug'] . '" aria-label="Install ' . $plugin['slug'] . '">' . __( 'Install and activate', 'i-max' ) . '</a>';
									} else
									{
										echo '<a class="button activate-now button-primary" data-active-lebel="' . __( 'Activating...', 'i-max' ) . '" data-slug="' . $plugin['slug'] . '" href="' . esc_url( $pluginLink ) . '" aria-label="Activate ' . $plugin['slug'] . '">Activate</a>';
									}
									
									echo '</li>';
									
								}
                            ?>                    
                        </ol>
        			</div>       
                        
				<?php	
					} elseif ( $active_tab == 'imax_faq' )
					{
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <?php
							foreach ($tx_faqs as $faq) {
								echo '<b>'._e( 'Q. ', 'i-max' ).$faq['question'].'</b><br />';
								echo _e( 'A. ', 'i-max' ).$faq['answeer'].'<br /><br />';									   
							}
                        ?>                    
                        
        			</div>      
                        
				<?php	
					} elseif ( $active_tab == 'imax_pro' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <p class="go-pro-desc">	
							<?php esc_attr_e( 'We have only one premium theme I-SPIRIT, and it combines all the features of other free themes plus several additional premium features.', 'i-max'); ?>
                        	<?php esc_attr_e( 'With only one premium theme I-SPIRIT we have ensured that you receive maximum quality, support and regular updates.', 'i-max'); ?> 
                        </p>
                        <p>&nbsp;</p>
                        <div class="nx-price-table">
                        	<div class="nx-pt-row th-title">
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"><span class="th-name"><?php esc_attr_e( 'I-MAX', 'i-max'); ?></span></div>
                            	<div class="nx-pt-cell"><span class="th-name"><?php esc_attr_e( 'I-SPIRIT', 'i-max'); ?></span></div>
                                <div class="nx-pt-cell"><span class="th-name"><?php esc_attr_e( 'I-SPIRIT', 'i-max'); ?></span><span class="th-variation"><?php esc_attr_e( 'Developers Version', 'i-max'); ?></span></div>
                            </div>
                        	<div class="nx-pt-row th-price">
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"><span class="th-price"><?php esc_attr_e( 'FREE', 'i-max'); ?></span></div>
                            	<div class="nx-pt-cell"><span class="th-price"><?php esc_attr_e( '$48 USD', 'i-max'); ?></span><span class="th-usage"><?php esc_attr_e( 'Single Website', 'i-max'); ?></span></div>
                                <div class="nx-pt-cell"><span class="th-price"><?php esc_attr_e( '$320 USD', 'i-max'); ?></span><span class="th-usage"><?php esc_attr_e( 'Unlimited Websites', 'i-max'); ?></span></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Page Preloader', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Maintenance Mode', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Updates', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Lifetime', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Lifetime', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'Lifetime', 'i-max'); ?></div>
                            </div>                            
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Google Fonts', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Top 20', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'All', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'All', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Shortcodes', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '18+', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '65+', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( '65+', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Header Style', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '2', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '6', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( '6', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'WooCommerce Ready', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>  
                            
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'RTL Ready', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Translation Ready', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Slider Revolution', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-iteme">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'WPBakery Page Builder', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>                            
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'White Label', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Premium Support', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Custom Header', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-max'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-max'); ?></div>
                            </div>   
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"><a href="<?php echo $goPremiumURL; ?>" target="_blank" class="button button-primary button-hero th-price-button"><?php esc_attr_e( 'More Details', 'i-max'); ?></a></div>
                                <div class="nx-pt-cell"><a href="<?php echo $goPremiumURL; ?>" target="_blank" class="button button-primary button-hero th-price-button"><?php esc_attr_e( 'More Details', 'i-max'); ?></a></div>
                            </div>                                                                                                                                                                                                    
                        </div>
        			</div>      
                        
				<?php
					}
				?>
  
                <div class="tx-wspace-24"></div>
                <div class="tx-wspace-24"></div>    
                <div class="nx-admin-row">
                	<div class="one-four-col">
                    	<a href="<?php echo $videoguide; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-video-alt2"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Documentation', 'i-max' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $supportforum; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-format-chat"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Support Forum', 'i-max' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $toolkit; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-migrate"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'TemplatesNext Toolkit', 'i-max' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $fb_page; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-facebook-alt"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Community', 'i-max' ); ?></h3>
                        </a>
                    </div>                                                            
                </div>                
 	
            </div>

                <div id="dashboard_right_now" class="postbox" style="display: block; float: right; width: 33%; max-width: 320px; margin: 16px;">
                    <h2 class="hndle nxw-title" style="padding: 12px 24px;"><span><?php echo $review_pop['title']; ?></span></h2>
                    <div class="inside">
                        <div class="main" style="padding: 24px;">
							<?php echo $review_pop['desc']; ?>
                    		<a class="button button-primary button-hero" target="_blank" href="<?php echo $reviewURL; ?>">
                            	<?php echo $review_pop['link']; ?>
                            </a> 
                            <?php echo $review_pop['conclusion']; ?>
                        </div>
                    </div>
                </div>   

            <div class="tx-wspace"></div>
        
            
            
        </div>
        
  	</div>
  
  	<?php
}

add_action( 'admin_head', 'welcome_screen_remove_menus' );
function welcome_screen_remove_menus() {
    remove_submenu_page( 'index.php', 'welcome-screen-about' );
}


// Add Stylesheet
add_action( 'admin_enqueue_scripts', 'imax_welcome_scripts' );
function imax_welcome_scripts() {
	wp_enqueue_style( 'nx-welcome-style', get_template_directory_uri() . '/inc/theme-welcome/css/nx-welcome.css', array(), '1.01' );
	wp_enqueue_script( 'nx-welcome-script', get_template_directory_uri() . '/inc/theme-welcome/js/nx-welcome.js' );
	
	$activation_button = imax_customizer_activate_notice();
	wp_localize_script('nx-welcome-script', 'recomended_notice', $activation_button);	
}
