<?php
/*
Plugin Name: Auditions
* Description: Auditions
*/

global $wpdb, $wp_version,$wp_query;
define("WP_auditions_TABLE", $wpdb->prefix . "auditions");
define( 'Auditions_plugin_Basename', plugin_basename( __FILE__ ) );
function auditions_plugin_url( $path = '' ) {
	return plugins_url( $path, Auditions_plugin_Basename );
}
/** In main plugin file **/


function auditions_install() 
{
	global $wpdb, $wp_version;	
	add_option('auditions_title', "Auditions");		
	if($wpdb->get_var("show tables like '". WP_auditions_TABLE . "'") != WP_auditions_TABLE)  
	{ 
		$wpdb->query("CREATE TABLE IF NOT EXISTS `". WP_auditions_TABLE . "` (
			  `auditions_id` int(11) NOT NULL auto_increment,
			  `auditions_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
			  `auditions_times` text COLLATE latin1_swedish_ci NOT NULL ,
			  `auditions_location` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin ,
			  `auditions_requirements` text COLLATE latin1_swedish_ci ,
			  `auditions_whattobring` text COLLATE latin1_swedish_ci ,
			  `auditions_date` date NOT NULL default '0000-00-00',
			  PRIMARY KEY  (`auditions_id`) )
			");			
	}	
}

function auditions_admin_option() 
{
	//echo "<div class='wrap'>";
	//echo "This plugin is created to store description of post formats with respect to their associted categories.";
	//echo "</div>";
	global $wpdb;
	include_once("viewauditions.php");
	
	
}
function add_admin_menu_auditions() {
	global $wpdb;
	include_once("addauditions.php");
}
function add_admin_menu_option_auditions() 
{
	add_menu_page( __( 'Auditions', 'auditions' ), __( 'Auditions', 'auditions' ), 'administrator', 'auditions', 'auditions_admin_option' );
    add_submenu_page('auditions', 'Add auditions', 'Add auditions', 'administrator', 'add_admin_menu_auditions', 'add_admin_menu_auditions');
	
}
add_action('admin_menu', 'add_admin_menu_option_auditions');
register_activation_hook(__FILE__, 'auditions_install');
//register_deactivation_hook(__FILE__, 'auditions_install');

?>
