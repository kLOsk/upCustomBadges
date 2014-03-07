<?php
/**
 * Plugin Name: UserPro Custom Badges
 * Plugin URI: http://www.daniel-klose.com
 * Description: This plugin adds additional badges to the UserPro Plugin. The UserPro Plugin is required in order to use this Plugin. Make sure to install and enable UserPro, before installing UserPro Custom Badges. Buy UserPro here: <a href="http://goo.gl/S1sOgz">http://goo.gl/S1sOgz</a>
 * Version: 0.3.1
 * Author: Daniel Klose
 * Author URI: http://www.daniel-klose.com
 * License: GPL2
 *  Copyright 2014  Daniel Klose

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    
    Badges by http://symb.ly/
 */
 
 /** Admin Menu */
add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_options_page( 'User Pro Custom Badges Options', 'UP Custom Badges', 'manage_options', 'upCustomBadges', 'upCustomBadgesOptions' );
}

	// Add settings link on plugin page
function your_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=upCustomBadges.php">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'your_plugin_settings_link' );

function upCustomBadgesOptions() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	if( is_plugin_active( 'userpro/index.php' ) ) {
		?>
		<div class="wrap">
			<script>  
				//Execute PHP Copy Script
				function do_copy(){
					var xhReq = new XMLHttpRequest();
					var request = "../wp-content/plugins/upCustomBadges/copy.php" // prepare a request to script
					xhReq.open("GET", request, false);  // send a request
					xhReq.send(null);
					document.getElementsByID("results").innerHTML=xhReq.responseText  /// display results
					}
				
				//Execute PHP Delete Script
				function do_delete(){
					var xhReq = new XMLHttpRequest();
					var request = "../wp-content/plugins/upCustomBadges/delete.php" // prepare a request to script
					xhReq.open("GET", request, false);  // send a request
					xhReq.send(null);
					document.getElementsByID("results").innerHTML=xhReq.responseText  /// display results
					}
			</script>
	
			<input type="button" value="Copy Badges" name="copy_badges"  onclick="do_copy()">
			<input type="button" value="Delete Badges" name="delete_badges"  onclick="do_delete()">
			<div id="results">Click copy or delete to add or remove badges from UserPro.</br>
							  Badges by http://symb.ly/
			</div>

		</div>
		<?php
	}
	else {
		echo '<div class="wrap">';
		echo '<p>Plugin not active. Make to have UserPro activated on your WordPress installation. <a href="http://goo.gl/S1sOgz">Buy UserPro on CodeCanyon</a></p>';
		echo '</div>';
	}
}
?>