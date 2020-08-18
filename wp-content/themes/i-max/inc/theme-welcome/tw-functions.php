<?php

/**
 * Checks if a WordPress plugin is installed.
 *
 * @param  string  $pluginTitle The plugin title (e.g. "My Plugin")
 *
 * @return string/boolean       The plugin file/folder relative to the plugins folder path (e.g. "my-plugin/my-plugin.php") or false
 */
function imax_is_plugin_installed($pluginTitle)
{
    // get all the plugins
    $installedPlugins = get_plugins();

    foreach ($installedPlugins as $installedPlugin => $data) {

        // check for the plugin title
        if ($data['Title'] == $pluginTitle) {

            // return the plugin folder/file
            return $data['Name'];
        }
    }

    return false;
}


/**
* Get activation or deactivation link of a plugin
*
* @author Nazmul Ahsan <mail@nazmulahsan.me>
* @param string $plugin plugin file name
* @param string $action action to perform. activate or deactivate
* @return string $url action url
*/

function imax_plugin_install($plugin_slug)
{
	$nonce_install  = wp_nonce_url(
		add_query_arg(
			array(
				'action' => 'install-plugin',
				//'paged'         => '1',
				'plugin' => $plugin_slug,
			),
			network_admin_url( 'update.php' )
		),
		'install-plugin_' . $plugin_slug
	);
	
	return $nonce_install;
}

function imax_plugin_activation( $plugin, $slug, $plugin_filename ) {
	if ( strpos( $plugin, '/' ) ) {
		$plugin = str_replace( '\/', '%2F', $plugin );
	}

	$tx_nonce = wp_create_nonce( 'activate-plugin_' . $slug .'/'. $plugin_filename );
	$url = admin_url( 'plugins.php?_wpnonce=' . $tx_nonce . '&action=activate&plugin='.$plugin);
	
	return $url;
}

/***************************
Customizer Activation Notice
****************************/

function imax_customizer_activate_notice () {
	
    global $current_user ;
    $user_id = $current_user->ID;	
	
	$pluginLocation = rawurlencode('templatesnext-toolkit/tx-toolkit.php');
	$pluginLink = imax_plugin_activation( $pluginLocation, 'templatesnext-toolkit', 'tx-toolkit.php' );
	$nonce_install = imax_plugin_install('templatesnext-toolkit');
	$pluginTitle = 'TemplatesNext ToolKit';
	$activation_button = '';
	
	$activation_button .= '<div class="nx-cstnt">';								
	$activation_button .= '<p>'.esc_attr__('Please install accompanying plugin &quot;TemplatesNext ToolKit&quot; to activate all the features of this theme.', 'i-max').'</p>';								
	if ( is_plugin_active( 'templatesnext-toolkit/tx-toolkit.php' ) ) {
		$activation_button .= '<a href="#" class="button disabled">' . __( 'Plugin installed and active', 'i-max' ) . '</a>';  
	} elseif( imax_is_plugin_installed($pluginTitle) == false ) {
		$activation_button .= '<a data-slug="templatesnext-toolkit" data-active-lebel="' . __( 'Installing...', 'i-max' ) . '" class="install-nx-now button" href="' . esc_url( $nonce_install ) . '" data-name="templatesnext-toolkit" aria-label="Install templatesnext-toolkit">' . __( 'Install and activate', 'i-max' ) . '</a>';
		$activation_button .= '<a class="button activate-nx-now button-primary" data-active-lebel="' . __( 'Activating...', 'i-max' ) . '" data-slug="templatesnext-toolkit" href="' . esc_url( $pluginLink ) . '" aria-label="Activate templatesnext-toolkit" style="display: none;">' . __( 'Activate', 'i-max' ) . '</a>';
		$activation_button .= '<a href="#" class="tx-active button disabled" style="display: none;">' . __( 'Plugin installed and active', 'i-max' ) . '</a>';
	} else {
		$activation_button .= '<a class="button activate-nx-now button-primary" data-active-lebel="' . __( 'Activating...', 'i-max' ) . '" data-slug="templatesnext-toolkit" href="' . esc_url( $pluginLink ) . '" aria-label="Activate templatesnext-toolkit">' . __( 'Activate', 'i-max' ) . '</a>';
		$activation_button .= '<a href="#" class="tx-active button disabled" style="display: none;">' . __( 'Plugin installed and active', 'i-max' ) . '</a>';  
	}
	$activation_button .= '<a class="tx-notice-close" href="?imax_customizer_notice_007=0"></a>';
	$activation_button .= '</div>';
	
	if ( get_user_meta($user_id, 'imax_customizer_notice_007') || is_plugin_active( 'templatesnext-toolkit/tx-toolkit.php' ) ) {
		$activation_button = '0';
	}
	
	return $activation_button;									
}

add_action('admin_init', 'imax_customizer_notice_ignore_007');
function imax_customizer_notice_ignore_007() {
    global $current_user;
	$user_id = $current_user->ID;
	if ( isset($_GET['imax_customizer_notice_007']) && '0' == $_GET['imax_customizer_notice_007'] ) {
    	add_user_meta($user_id, 'imax_customizer_notice_007', 'true', true);
    }
}