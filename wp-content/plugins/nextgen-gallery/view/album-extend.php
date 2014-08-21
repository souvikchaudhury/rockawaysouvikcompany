<?php 
/**
Template Page for the album overview (extended)

Follow variables are useable :

	$album     	 : Contain information about the album
	$galleries   : Contain all galleries inside this album
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($galleries)) : ?>

<?php //print_r($album); ?>
	<!-- List of galleries -->
	<?php foreach ($galleries as $gallery) : ?>
	
	<?php //echo '<pre>';
	//print_r($galleries);
	
?>
	<!--<div class="ngg-album">
		<div class="ngg-albumtitle"><a href="<?php echo $gallery->pagelink ?>"><?php echo $gallery->title ?></a></div>
			<div class="ngg-albumcontent">
				<div class="ngg-thumbnail">
					<a href="<?php echo $gallery->pagelink ?>"><img class="Thumb" alt="<?php echo $gallery->title ?>" width="282" height="187" src="<?php echo $gallery->previewurl ?>"/></a>
				</div>
				<div class="ngg-description">
				<p><?php echo $gallery->galdesc ?></p>
				<?php if ($gallery->counter > 0) : ?>
				<p><strong><?php echo $gallery->counter ?></strong> <?php _e('Photos', 'nggallery') ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>-->

	
 <ul class="gallary_list">
	 <li><a href="<?php echo $gallery->pagelink ?>"><img class="Thumb" alt="<?php echo $gallery->title ?>" src="<?php echo $gallery->previewurl ?>" /></a>
	 <div class="gallary_txt"><h2><?php echo $gallery->title ?></h2>
	 <p class="date_txt"><?php echo date('F j, Y', strtotime($album->added_date)); ?></p>
	 <!--<p class="date_txt">Production: <span>Lorem Ipsum</span></p>-->
	 <p><?php echo $gallery->galdesc ?></p>
	 <a href="<?php echo $gallery->pagelink ?>" class="watch_video"> View Photos</a>
	 </div>
	 </li>
  </ul> 
 	<?php endforeach; ?>
 	
	<!-- Pagination -->
 	<?php echo $pagination ?>

<?php endif; ?>
