<?php
/*
Template Name: Auditions
*/
?>

<?php get_header(); ?>

<div id="content_inner">
			 <h1><?php  the_title(); ?></h1>
            <div class="content_area_inner">
			<?php  $today = date("Y-m-d"); 
	     $selqry = mysql_query("select * from wp_auditions where auditions_date >='$today' order by auditions_id desc ") or die ("Sql Error");
             if(mysql_num_rows($selqry) > 0)
              {
				   ?>
    <h2 class="audition_sch">Auditions Schedule</h2>  
    <ul class="audition_list">
            <?php
			    while($row=mysql_fetch_array($selqry)) 
			    {	
					$auditions_image = $row['auditions_image'];
					$auditionDate    = $row['auditions_date'];
				 ?>
					  <li><img src="<?php echo get_option('siteurl').'/wp-content/uploads/'.$auditions_image;?>" width="244" height="171" alt="" />
					  <div class="audition_txt"><h4><?php echo $row['auditions_name']; ?></h4>
					  <div class="times_txt">
					  <div class="time">Times - </div><?php echo nl2br($row['auditions_times']); ?>
					  </div>
					  <p> Location - <span><?php echo $row['auditions_location']; ?></span></p>
					  <p> Audition Requirements - 
					  <span class="nxt_text"><?php echo $row['auditions_requirements']; ?></span></p>
					  <p>what to bring - <span><?php echo $row['auditions_whattobring']; ?></span></p>
					  <p>Last Date - <span><?php echo date('F j, Y', strtotime($auditionDate)); ?></span></p>
					  </div>
					</li> 
              <?php }  ?>
   </ul>
   <?php } 
   else{
	   ?>
	   <p class="no_audition_txt">There are no auditions scheduled at this time, please check back soon, or join our mailing list to keep in the loop!  All audition notices are sent in our Email Newsletters. </p>
	   <?php
    }
   ?>
 <div class="audition_butt_outer"><a href="<?php echo get_site_url(); ?>/contacts" target="_blank" class="audition_butt"><span>Any Questions Regarding Auditions</span> <img src="<?php echo get_template_directory_uri(); ?>/images/wh_arrow.png" width="18" height="13" class="wh_arrow" /> </a></div>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>
