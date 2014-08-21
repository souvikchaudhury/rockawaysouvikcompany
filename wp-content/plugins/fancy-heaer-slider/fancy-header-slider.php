<?php
/*
Plugin Name: Fancy Header Slider
Plugin URI: http://wordpress.org/support/plugin/fancy-heaer-slider
Description: Image gallery with fancy transitions effects. This is a 'strip curtain' effect 
Version: 2.0
tag:2.0
Author: Rashmi Soni
Author URI: http://blog.rashmiksoni.com/
License: GPLv2
	Copyright 2013  Rashmi Soni

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
*/
global $wp_version;
if (version_compare ( $wp_version, "3.0", "<" )) { 
	wp_die("This plugin requires WordPress version 3.0.1 or higher.");
}
/**
* Enable the fancyheaderslider custom post type
* http://codex.wordpress.org/Function_Reference/register_post_type
* author @Rashmi Soni
*/
function headersliderposttype() {
    
    $labels = array(
        'name' => __( 'Header Slider', 'headersliderposttype' ),
        'singular_name' => __( 'fancyheader', 'headersliderposttype' ),
        'add_new' => __( 'Add New Slider', 'headersliderposttype' ),
        'add_new_item' => __( 'New Slider', 'headersliderposttype' ),
        'edit_item' => __( 'Edit Slider', 'headersliderposttype' ),
        'new_item' => __( 'New Slider', 'headersliderposttype' ),
        'view_item' => __( 'View Slider', 'headersliderposttype' ),
        'search_items' => __( 'Search Slider', 'headersliderposttype' ),
        'not_found' => __( 'No slider items found', 'headersliderposttype' ),
        'not_found_in_trash' => __( 'No slider items found in trash', 'headersliderposttype' )
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array( 'title','thumbnail'),
        'capability_type' => 'post',
        'rewrite' => array("slug" => "fancyheader"), // Permalinks format
        'has_archive' => true
    );
    register_post_type( 'fancyheader', $args);
}
add_action( 'init', 'headersliderposttype' );

if ( !class_exists('FancyHeaderSlider') ) {
	
	class FancyHeaderSlider
	{
		var $plugin_url;
		// Initialize the plugin
		function FancyHeaderSlider()
		{
			$this->plugin_url = trailingslashit( WP_PLUGIN_URL . '/' .	dirname( plugin_basename(__FILE__)));
			//adds admin menu options to manage
			add_action('admin_menu', array(&$this, 'admin_menu'));
			//adds admin menu options at topbar to manage
			if ( is_admin() ) 
				add_action( 'admin_bar_menu', array(&$this, 'admin_bar_menu_fhs'), 100 );
			 include('admin/metabox-link.php');	
			 if (!is_admin() )
			 {
					add_action('wp_print_scripts', array(&$this, 'gallery_script')); 
			 }
		}
		/**
		 * Function to add main menu and submenus to admin panel
		 * @return adds menu
		 * @author Rashmi Soni
		 */
		function admin_menu() {
			
			$parent_slug = "edit.php?post_type=fancyheader";
			
			$page = add_submenu_page( $parent_slug, __('Slider Settings'),'Slider Settings', 'manage_options', 'fhs-gallery-settings', array($this, 'gallery_settings'));
			
			$page = add_submenu_page( $parent_slug, __('Fancy Header Slider Overview'), __('Document'), 'manage_options', 'fhs-gallery-overview', array($this, 'gallery_overview'));
			
		}
		/**
		 * Function to add admin_bar_menu at top.
		 * @author Rashmi Soni
		 */
		function admin_bar_menu_fhs() {
	    	global $wp_admin_bar;
	    	$wp_admin_bar->add_menu( array( 'id' => 'fhs-menu', 'title' => __( 'FHS' ), 'href' => admin_url('admin.php?page=fhs-gallery-overview') ) );
			
			
			$wp_admin_bar->add_menu( array( 'parent' => 'fhs-menu', 'id' => 'fhs-menu-gallery-settings', 'title' => __('Slider Settings', ''), 'href' => admin_url('admin.php?page=fhs-gallery-settings') ) );
			
	    }
		/**
		 * Function to install Fancy Header Gallery
		 * @author Rashmi Soni
		 */
		function fhs_install(){
			global $wpdb;
			$this->_fhs_activate();
		}	
		/**
		 * Function to create database and needed setting for plugin.
		 * @author Rashmi Soni
		 */
		function _fhs_activate() {
		
		global $wpdb;
			//Section to save gallery settings.
			$options = array();
			$options['fhs_max_width'] = 500;
			$options['fhs_max_height'] = 332;
			$options['fhs_effect'] = '';
			$options['fhs_strips'] = 20;
			$options['fhs_delay'] = 5000;
			$options['fhs_stripdelay'] = 50;
			$options['fhs_titledelay'] = 0.7;
			$options['fhs_speed'] = 1000;
			$options['fhs_postion']= 'alternate';
			$options['fhs_direction'] = 'fountainAlternate';
			$options['fhs_navigation'] = 'true';
			$options['fhs_link'] = 'false';
			$options['fhs_button_navigation'] = 'false';
			
			update_option('fhs_settings', $options);
			
			$installed_ver = get_option( "fhs_version" );
		}
		/**
		 * Function to include gallery settings page
		 * @return includes file content
		 * @author Rashmi Soni
		 */
		function gallery_settings() {
			include('admin/gallery-settings.php');
		}
		/**
		 * Function to include gallery CSS page
		 * @return includes file content
		 * @author Rashmi Soni
		 */
		 function gallery_css() {
			include('admin/gallery-css.php');
		}
		
		/**
		* Show a system messages
		* author Rashmi Soni
		*/
		function show_image_message($message) {
		echo '<div class="wrap"><h2></h2><div class="updated fade" id="message"><p>' . $message . '</p></div></div>' . "\n";
		}
		/**
		 * Function to include gallery overview page
		 * @return includes file content
		 * @author Rashmi Soni
		 */
		function gallery_overview() {
			include('admin/gallery-overview.php');
		}
		/**
		 * Function to include scripts
		 * @author Rashmi Soni
		 */
		function gallery_script() {
			echo "<!-- Fancy Header Gallery Script Start Here -->";
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery.jqFancyTransitions', $this->plugin_url . 'js/jqFancyTransitions.1.8.min.js', 'jquery');
			?>
           <!-- <link href="<?php echo $this->plugin_url . 'css/fancyslider.css' ?>" type="text/css" media="all" />-->
           
            <?php
			
			echo "<!-- Fancy Header Gallery Script ends here -->";
		}
		/**
		 * Function to Front End Function
		 * @author Rashmi Soni
		 */
		function fhs_displayed()
		{
			global $wpdb;
			$wp_query = new WP_Query(array('post_type' =>'fancyheader','post_status'=>'publish','order' => 'DESC'));
			$countfancyslider = $wp_query->found_posts;
			$options = get_option('fhs_settings');
			if($options['fhs_max_width'] != ''){$sliderwidth = $options['fhs_max_width'];}else{$sliderwidth = 500;}
			if($options['fhs_max_height'] != ''){$sliderheight = $options['fhs_max_height'];}else{$sliderheight = 332;}
			if($options['fhs_effect'] != ''){$slidereffect = $options['fhs_effect'];}else{$slidereffect = '';}
			if($options['fhs_strips'] != ''){$sliderstrips = $options['fhs_strips'];}else{$sliderstrips = 20;}
			if($options['fhs_delay'] != ''){$sliderdelay = $options['fhs_delay'];}else{$sliderdelay = 5000;}
			if($options['fhs_stripdelay'] != ''){$sliderstripdelay = $options['fhs_stripdelay'];}else{$sliderstripdelay = 50;}
			
			if($options['fhs_titledelay'] != ''){$slidertitledelays = $options['fhs_titledelay'];}else{$slidertitledelays = 0.7;}
			if($options['fhs_speed'] != ''){$sliderspeed = $options['fhs_speed'];}else{$sliderspeed = 1000;}
			if($options['fhs_postion'] != ''){$sliderpostion = $options['fhs_postion'];}else{$sliderpostion = 'bottom';}
			if($options['fhs_direction'] != ''){$sliderdirection = $options['fhs_direction'];}else{$sliderdirection = 'random';}
			if($options['fhs_navigation'] != ''){$slidernavigation = $options['fhs_navigation'];}else{$slidernavigation = 'false';}
			if($options['fhs_link'] != ''){$sliderlink = $options['fhs_link'];}else{$sliderlink = 'false';}
						
			
			?>
            <script type="text/javascript">
            jQuery(document).ready( function(){
				jQuery('#slideshowHolder').jqFancyTransitions({ 
				effect: '<?php echo $slidereffect ?>', // wave, zipper, curtain
				width: <?php echo $sliderwidth ?>, // width of panel
				height: <?php echo $sliderheight ?>, // height of panel
				strips: <?php echo $sliderstrips ?>, // number of strips
				delay: <?php echo $sliderdelay ?>, // delay between images in ms
				stripDelay: <?php echo $sliderstripdelay ?>, // delay beetwen strips in ms
				titleOpacity: <?php echo $slidertitledelays ?>, // opacity of title
				titleSpeed: <?php echo $sliderspeed ?>, // speed of title appereance in ms
				position: '<?php echo $sliderpostion ?>', // top, bottom, alternate, curtain
				direction: '<?php echo $sliderdirection ?>', // left, right, alternate, random, fountain, fountainAlternate
				navigation: <?php echo $slidernavigation ?>, // prev and next navigation buttons
				links: <?php echo $sliderlink ?> // show images as links
				});
			<?php	if($options['fhs_button_navigation'] == 'false'){?>jQuery('#ft-buttons-slideshowHolder').css('display' , 'none');<?php	}else{?>jQuery('#ft-buttons-slideshowHolder').css('display' , 'block');	<?php }?>		
				
				
				
            });
            </script>

            <?php
		
			if($countfancyslider > 0)
			{
					
					?>
                    <div id='slideshowHolder'>
                    <?php
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					if (has_post_thumbnail( $post->ID ) ): 
					$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
					endif; 
					
					?>
                    <img src='<?php echo $feature_image[0] ?>' alt='&nbsp;<?php echo strtoupper(the_title()) ?>' width="<?php echo $sliderwidth ?>" height="<?php echo $sliderheight ?>" />
                    <?php
					if($sliderlink == 'true')
					{
						
						$slider_links = get_post_meta(get_the_ID(),'_fancyheader_slider_link',true);
						?>
                        <a href ='<?php echo $slider_links ?>' target="_blank"/></a>
                        <?php
					}
					
					endwhile; 
					?>
                    </div>
                <?php
			}
			else
			{
				// Demo Images
				
				?>
                   <div id='slideshowHolder'>
                    <img src='<?php echo plugins_url() ?>/fancy-heaer-slider/images/11.jpg' alt='&nbsp;IMAGE 1' />
                    <a href ='http://rashmiksoni.com'/></a>
                    <img src='<?php echo plugins_url() ?>/fancy-heaer-slider/images/12.jpg' alt='&nbsp;IMAGE 2' />
                    <a href ='http://blog.rashmiksoni.com'></a>
                    <img src='<?php echo plugins_url() ?>/fancy-heaer-slider/images/13.jpg' alt='&nbsp;IMAGE 3' />
                    <a href ='http://workshop.rs/projects/moobargraph'></a>
                    </div>
                <?php
			}
				?>
			
            <?php
			
		}
		
		function fhs_overview()
		{
			?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="53%" style="border-right: 1px dotted #999999;padding-right: 20px;"><?php _e('This is header gallery plugin if you want so fancy look in you header part you can use this one.you can made custom effect with set of options that you can use to set speed, number of strips,direction, type of effect, etc. Bellow is list of all parameters and their values that you can use.<br><br>');
			_e('width: 500, // width of panel<br><br>');
			_e('height: 332, // height of panel<br><br>');
			_e('strips: 20, // number of strips<br><br>');
			_e('delay: 5000, // delay between images in ms<br><br>');
			_e('stripDelay: 50, // delay beetwen strips in ms<br><br>');
			_e('titleOpacity: 0.7, // opacity of title<br><br>');
			_e('titleSpeed: 1000, // speed of title appereance in ms<br><br>');
			_e('position: "alternate", // top, bottom, alternate, curtain<br><br>');
			_e('direction: "fountainAlternate", // left, right, alternate, random, fountain, fountainAlternate<br><br>');
			_e('navigation: false, // prev and next navigation buttons<br><br>');
			_e('links: false // show images as links<br><br>'); ?></td>
            <td width="15"></td>
    <td style="vertical-align:top">
    <?php
	_e('<b>Installation Guide</b><br>');
	?>
    <div style="border-bottom: 1px dotted #CCCCCC;padding: 5px;"></div><br />
    <ol>
    <?php
	_e('<li>Upload the fancy-header-slider folder to the /wp-content/plugins/ directory.<br><br></li>');
	_e("<li>Go to the <b>'Plugins'</b> page of your WordPress administration area and activate the plugin.<br><br></li>");
	
	_e("<li>Create your fancy header slider by clicking on <b>'Header Slider'</b> in your administration menu and selecting <b>'Add New Slider'</b>. The slider uses ONLY the featured image attached to any given post.<br><br></li>");
	
	_e("<li>Use the function <b>'<br>
	if(function_exists('fhs_display_front'))<br>
	{<br>
		echo fhs_display_front();<br>
	}<br>'
	</b> in the header area of a header.php page where you want the fancy header image slider to appear.<br><br></li>");
	
	_e("<li>Watch the video.(here i saw how that fancy header slider is working)<br><br></li>");
	
	_e("<li>For more details please visit <a href=''>here</a></li>");
	
	?>
    </ol>
    
    </td>
  </tr>
</table>

            <?php
			
		}			

	}
	
}
	function fhs_display_front()
	{
		FancyHeaderSlider::fhs_displayed();
	}
	add_shortcode('fhs_slider_display', array('FancyHeaderSlider', 'fhs_displayed'));

// create new instance of the class
$FancyHeaderSlider = new FancyHeaderSlider();

if (isset($FancyHeaderSlider)){
	
	register_activation_hook( basename(dirname(__FILE__)).'/'.basename(__FILE__), array(&$FancyHeaderSlider,'fhs_install') );
	register_deactivation_hook(basename(dirname(__FILE__)).'/'.basename(__FILE__),  array(&$FancyHeaderSlider,'fhs_deactivate_empty'));
			
}
?>
