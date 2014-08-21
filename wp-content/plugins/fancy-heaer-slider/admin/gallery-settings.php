<?php 
/**
 * Section to display gallery settings.
 * @author Rashmi Soni
 */
?>
<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) 
	die('You are not allowed to call this page directly.'); 

$title = __('Fancy Header Slider Setting'); 

?>
<div class="wrap">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2><?php echo esc_html( $title ); ?></h2>
	<?php 
	//Section to save gallery settings
	if(isset($_POST['update_Settings'])) {
		
		$options['fhs_max_width'] = $_POST['fhs_max_width'];
		$options['fhs_max_height'] = $_POST['fhs_max_height'];
		$options['fhs_effect'] = $_POST['fhs_effect'];
		$options['fhs_strips'] = $_POST['fhs_strips'];
		$options['fhs_delay']= $_POST['fhs_delay'];
		$options['fhs_stripdelay']= $_POST['fhs_stripdelay'];
		$options['fhs_titledelay']= $_POST['fhs_titledelay'];
		$options['fhs_speed'] = $_POST['fhs_speed'];
		$options['fhs_postion'] = $_POST['fhs_postion'];
		$options['fhs_direction'] = $_POST['fhs_direction'];
		$options['fhs_navigation'] = $_POST['fhs_navigation'];
		$options['fhs_link'] = $_POST['fhs_link'];
		$options['fhs_button_navigation'] = $_POST['fhs_button_navigation'];
		
		update_option('fhs_settings', $options);
		FancyHeaderSlider::show_image_message(__('Gallery settings successfully updated.'));
	}
	$options = get_option('fhs_settings');
	?>

	<form method="post" action="<?php echo admin_url('admin.php?page=fhs-gallery-settings'); ?>">
			
			<div style="float:left;width:35%;">
				<h4><?php _e("Width:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:6px;">	
				<input type="text" name="fhs_max_width" maxlength="4" value="<?php echo $options['fhs_max_width']; ?>" size="20">
			</div>
			
			<div class="clear" ></div>
			<div style="float:left;width:35%;">	
				<h4><?php _e("Height:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;width:35%;">
				<input type="text" maxlength="4" name="fhs_max_height" value="<?php echo $options['fhs_max_height']; ?>" size="20">
			</div>
			<div class="clear"></div>
			
			<div style="float:left;width:35%;">	
				<h4><?php _e("Effect:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:6px;">
			<?php
	$effectarrays = array('curtain' , 'wave' , 'zipper')
	?>
    <select  name="fhs_effect" id="fhs_effect"><option value="">--Select---</option>
   <?php
   foreach($effectarrays as $effectarray)
   {
	   if($options['fhs_effect'] == $effectarray)
	   {
		?>
       <option value="<?php echo $effectarray ?>" selected="selected"><?php echo ucfirst($effectarray) ?></option>
       <?php   
	   }
	   else
	   {
		 ?>
       <option value="<?php echo $effectarray ?>"><?php echo ucfirst($effectarray) ?></option>
       <?php  
	   }
	   
   }
   ?>
    </select>
			</div>
			<div class="clear"></div>
			
			<div style="float:left;width:35%;">	
				<h4><?php _e("Strips:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:6px;">
				<input type="text"  name="fhs_strips" value="<?php echo $options['fhs_strips']; ?>" size="20">
			</div>
			<div class="clear"></div>	

			<div style="float:left;width:35%;">	
				<h4><?php _e("Delay:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:6px;">
			<input type="text" name="fhs_delay" value="<?php echo $options['fhs_delay']; ?>" size="20">
			</div>
			<div class="clear"></div>
			
			<div style="float:left;width:35%;">	
				<h4><?php _e("StripDelay:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:16px;">
			<input type="text" name="fhs_stripdelay" value="<?php echo $options['fhs_stripdelay']; ?>" size="20">
			</div>
			<div class="clear"></div>
			
			<div style="float:left;width:35%;">	
				<h4><?php _e("TitleOpacity:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:16px;">
				<input type="text" name="fhs_titledelay" value="<?php echo $options['fhs_titledelay']; ?>" size="20">
			</div>
			<div class="clear"></div>
			
			<div style="float:left;width:35%;">	
				<h4><?php _e("TitleSpeed:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:16px;">
				<input type="text" name="fhs_speed" value="<?php echo $options['fhs_speed']; ?>" size="20">
			</div>
			<div class="clear"></div>
			
			<div style="float:left;width:35%;">	
				<h4><?php _e("Position:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:6px;">
			<?php
	$postiondatas = array('top', 'bottom', 'alternate', 'curtain');
	?>
    <select  name="fhs_postion" id="fhs_postion"><option value="">--Select---</option>
   <?php
   foreach($postiondatas as $postiondata)
   {
	   if($options['fhs_postion'] == $postiondata)
	   {
		?>
       <option value="<?php echo $postiondata ?>" selected="selected"><?php echo ucfirst($postiondata) ?></option>
       <?php   
	   }
	   else
	   {
		 ?>
       <option value="<?php echo $postiondata ?>"><?php echo ucfirst($postiondata) ?></option>
       <?php  
	   }
	   
   }
   ?>
    </select>
    
			</div>
			<div class="clear"></div>	
			<div style="float:left;width:35%;">	
				<h4><?php _e("Direction:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:16px;">
				 <?php
	$directiondatas = array('left', 'right', 'alternate', 'random', 'fountain', 'fountainAlternate');
	?>
    <select  name="fhs_direction" id="fhs_direction"><option value="">--Select---</option>
   <?php
   foreach($directiondatas as $directiondata)
   {
	   if($options['fhs_direction'] == $directiondata)
	   {
		?>
       <option value="<?php echo $directiondata ?>" selected="selected"><?php echo ucfirst($directiondata) ?></option>
       <?php   
	   }
	   else
	   {
		 ?>
       <option value="<?php echo $directiondata ?>"><?php echo ucfirst($directiondata) ?></option>
       <?php  
	   }
	   
   }
   ?>
    </select>
			</div>
			<div class="clear"></div>
            
            <div style="float:left;width:35%;">	
				<h4><?php _e("Navigation:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:16px;">
				<?php
	$navigationdatas = array('true', 'false');
	?>
    <select  name="fhs_navigation" id="fhs_navigation">
   <?php
   foreach($navigationdatas as $navigationdata)
   {
	   if($options['fhs_navigation'] == $navigationdata)
	   {
		?>
       <option value="<?php echo $navigationdata ?>" selected="selected"><?php echo ucfirst($navigationdata) ?></option>
       <?php   
	   }
	   else
	   {
		 ?>
       <option value="<?php echo $navigationdata ?>"><?php echo ucfirst($navigationdata) ?></option>
       <?php  
	   }
	   
   }
   ?>
    </select>
			</div>
			<div class="clear"></div>
            <div style="float:left;width:35%;">	
				<h4><?php _e("Button Navigation:", 'menu-test' ); ?></h4>
			</div>
            <div style="float:left;padding-top:16px;">
				<?php
	$buttonnavigationdatas = array('true', 'false');
	?>
    <select  name="fhs_button_navigation" id="fhs_button_navigation">
   <?php
   foreach($buttonnavigationdatas as $button_navigation_datas)
   {
	   if($options['fhs_button_navigation'] == $button_navigation_datas)
	   {
		?>
       <option value="<?php echo $button_navigation_datas ?>" selected="selected"><?php echo ucfirst($button_navigation_datas) ?></option>
       <?php   
	   }
	   else
	   {
		 ?>
       <option value="<?php echo $button_navigation_datas ?>"><?php echo ucfirst($button_navigation_datas) ?></option>
       <?php  
	   }
	   
   }
   ?>
    </select>
			</div>
            <div class="clear"></div>
            <div style="float:left;width:35%;">	
				<h4><?php _e("Links:", 'menu-test' ); ?></h4>
			</div>
			<div style="float:left;padding-top:16px;">
				<?php
	$fhs_linkdatas = array('true', 'false');
	?>
    <select  name="fhs_link" id="fhs_link">
   <?php
   foreach($fhs_linkdatas as $fhs_linkdata)
   {
	   if($options['fhs_link'] == $fhs_linkdata)
	   {
		?>
       <option value="<?php echo $fhs_linkdata ?>" selected="selected"><?php echo ucfirst($fhs_linkdata) ?></option>
       <?php   
	   }
	   else
	   {
		 ?>
       <option value="<?php echo $fhs_linkdata ?>"><?php echo ucfirst($fhs_linkdata) ?></option>
       <?php  
	   }
	   
   }
   ?>
    </select>
			</div>
			<div class="clear"></div>
			<div class="submit">
				<input class="button-primary" type="submit" name="update_Settings" value="Save Gallery Settings"  />
			</div>
	</form>		
</div>