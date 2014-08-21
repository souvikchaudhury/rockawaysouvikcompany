<?php
/*
Template Name: Ticket Reservation
*/
?>
<?php  ob_flush(); ?>
<?php get_header(); ?>
<input type="hidden" value="<?php echo get_bloginfo('template_directory').'/images/ajax_loader_red_48.gif'; ?>" id="loaderImg" />
<div class="ticktLstng">
	<div class="preload_home"><img src='<?php echo get_bloginfo('template_directory').'/images/ajax_loader_red_48.gif'; ?>' alt="" /></div>
</div>
<div style="display: none;">
	<div id="bookNoWd" class="popup" style="width:900px;height:500px;">
	</div>
</div>
<?php get_footer(); ?>
