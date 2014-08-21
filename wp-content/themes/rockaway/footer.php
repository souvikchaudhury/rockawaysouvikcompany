<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<!-- #main .wrapper -->
</div>
<div id="footer">
<div class="footer">
<ul class="footer_prt">
<li class="ab_rtc">
<h3>About rtc</h3>
<?php $id=162; $post = get_page($id); ?>
<p><?php echo substr($post->post_content,0,130); ?>.. <a href="<?php echo get_permalink($id); ?>">Read More</a></p>
<a href="#" class="ft_home">Rockaway Theatre Company<br />P.O. Box 950398<br />Far Rockawy, NY 11695-0398</a>
<a href="<?php echo get_site_url(); ?>/contacts" class="mail">e-mail us</a>
<a href="#" class="phone">(718) 374-6400</a>

</li>
<li class="lt_post"><h3>Latest Posts</h3>
<?php
   $args = array( 'numberposts' => '1' ,'category' => '1','orderby' => 'post_date','order' => 'DESC',);
	$recent_posts = wp_get_recent_posts( $args );
   foreach( $recent_posts as $recent ){
	    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($recent["ID"]) );
	   ?>	   
  <img src="<?php echo $feat_image; ?>" alt="" width="240" height="98" />
  <p class="lt_post_hed"><?php echo $recent["post_title"]; ?></p>
  <p><?php echo substr($recent["post_content"],0,100); ?></p>
  <a href="#" class="clock"><?php echo date('F j, Y', strtotime($recent["post_date"])); ?></a>
  <a href="<?php echo get_permalink($recent["ID"]); ?>">Continue Reading...</a>
 <?php
 	}
?>
   </li>
<li class="ph_stream"><h3>Photo stream</h3>
<div class="photo_st_img">
	<?php $selqry = mysql_query("select galleryid,filename,alttext from wp_ngg_pictures where galleryid='6' order by pid desc limit 0,8 ") or die ("Sql Error");
             if(mysql_num_rows($selqry) > 0)
              {
				   while($row=mysql_fetch_array($selqry)) 
			    {	
				  $stream_image = $row['filename']; ?>
				  <a class="shutterset_set_<?php echo $row['galleryid']; ?>" href="<?php echo get_option('siteurl'); ?>/wp-content/gallery/photo-stream/<?php echo $stream_image; ?>">
				  <img class="Thumb"  title="<?php echo $row['alttext']; ?>" alt="<?php echo $row['alttext']; ?>" src="<?php echo get_option('siteurl'); ?>/wp-content/gallery/photo-stream/thumbs/thumbs_<?php echo $stream_image; ?>" width="59" height="51" alt=""  /></a>
          <?php } 
            }
   ?>
</div>
 
  
  <div class="newsletter">
<p>Sign Up For News Letter</p>
<form onsubmit="return newsletter_check(this)" action="<?php echo get_site_url(); ?>/wp-content/plugins/newsletter/do/subscribe.php" method="post">
<input type="hidden" value="page" name="nr">
<input type="email" name="ne" value="" class="newsletter-email"/>
<input type="submit" value="Subscribe" name="" class="newsletter-submit"/>
</form>
</div>

<div class="ft_social_icons">
<p>Follow Us</p>
<a class="youtube" href="http://www.youtube.com/user/RockawayTheatreCo"> </a>
<a class="f" href="http://www.facebook.com/RockawayTheatreCompany"> </a>
<a class="tw" href="https://twitter.com/RockawayTheatre"> </a>
<!--<a class="p" href="#"> </a>
<a class="in" href="#"> </a>-->
<a class="v" href="https://plus.google.com/u/0/b/105943860845146293093/105943860845146293093/posts/p/pub"> </a>

</div>
</li>

</ul>
<div class="copyright"><p>&copy; 2013 All Right Researved.</p> <div class="copyright_txt">Website Designed & Maintained by
<span class="comp_nm">Patrick Meyers</span></div></div>
</div>

</div>

<script type="text/javascript">
//<![CDATA[
if (typeof newsletter_check !== "function") {
window.newsletter_check = function (f) {
    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
    if (!re.test(f.elements["ne"].value)) {
        alert("The email is not correct");
        return false;
    }
    if (f.elements["ny"] && !f.elements["ny"].checked) {
        alert("You must accept the privacy statement");
        return false;
    }
    return true;
}
}
//]]&gt;
</script>
<script type='text/javascript'>
  jQuery("input:radio[name='sessionpass']").click(function(){
	 // if(jQuery("input:radio[name='sessionpass']").is(":checked"))
	  var radio_value = jQuery(this).val();
		
		// If checked
		if (radio_value=="I don't have a season pass")
		{
			//show the hidden div
			jQuery(".show").show("fast");
		}
		
	  });
</script>
<!-- #page -->

<?php  wp_footer(); ?>
</body>
</html>