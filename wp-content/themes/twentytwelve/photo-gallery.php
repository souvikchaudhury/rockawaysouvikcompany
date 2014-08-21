<?php
/*
Template Name: Photo-Gallery
*/
?>

<?php get_header(); ?>

<?php 
 $album_id = $_GET['glname'];
 $glyear   = $_GET['glyear'];
?>

<div id="content_inner">
			 <h1><?php  the_title(); ?></h1>
            <div class="content_area_inner">

 <div class="short_by">
 <form action="" method="get" id="show_nm" name="show_nm">
 <select name="glname" onchange="filterEvent();">
	       <option value="">Fliter by Event</option>
	 	<?php $selqry = mysql_query("select name,id from wp_ngg_album") or die ("Sql Error");
             if(mysql_num_rows($selqry) > 0)
              {
				   while($row=mysql_fetch_array($selqry)) 
			    {	
				 ?>
				    <option value ="<?php echo $row['id']; ?>" <?php if($_GET['glname']== $row['id']){echo $selectd = 'selected'; }?> ><?php echo $row['name']; ?></option>
          <?php } 
            }
       ?>
 </select>
 
 
 <select name="glyear" onchange="filterEventYear();" class="year">
	 <option value="">Fliter by Year</option>
	 <?php $yearqurey = mysql_query("select DISTINCT added_date,id from wp_ngg_album") or die ("Sql Error");
             if(mysql_num_rows($yearqurey) > 0)
              {
				   while($rowYearqurey=mysql_fetch_array($yearqurey)) 
			    {	$eventYear    = $rowYearqurey['added_date'];
				       $ts        = strtotime("$eventYear");
				       $date[] = date('Y',$ts);
				   }
				   $date = array_unique($date);
				   sort($date);
				 foreach($date as $year)
				 {
				 ?>
				    <option value = "<?php echo $year; ?>" <?php if($_GET['glyear'] == $year){echo $selectd = 'selected'; }?> >
				    <?php 
                       echo $year;
				        ?>
				     </option>
          <?php } 
            }
       ?>
	 
 </select>
 
 </form>
 
 </div>
 <script type="text/javascript">
function filterEvent()
{
   document.show_nm.submit();
}
function filterEventYear()
{
   document.show_nm.submit();
}
</script>
 <?php 
 $sql      = "select name,id,added_date from wp_ngg_album where 1=1 ";
 if($album_id!=''){
   $sql .= " AND id = $album_id";
  }
   if($glyear!=''){
   $sql .= " AND added_date LIKE '%$glyear%'";
  }

 $selqryAlbum = mysql_query($sql) or die ("Sql Error");

             if(mysql_num_rows($selqryAlbum ) > 0)
              {
				while($albumRow = mysql_fetch_array($selqryAlbum)) 
			    {	
				 $albumId   = $albumRow['id'];
			     $showalbum = '[nggalbum id='.$albumId.' template=extend]';
			     $showalbum = apply_filters('the_content', $showalbum );
			     echo $showalbum;
			     
               } 
            }
            else
            {
				echo "<p class='no_audition_txt'>There is no Image in this selected album</p>";
			}
 ?>
 

 
 
 

 <!--<ul class="gallary_list">
 <li><img src="images/gallary_img1.jpg" width="282" height="187" alt="" />
 <div class="gallary_txt"><h2>Lorem ipsum</h2>
 <p class="date_txt">Feb 26 , 2013</p>
 <p class="date_txt">Production: <span>Lorem Ipsum</span></p>
 <p>Lorem Ipsum has been the industry's standard dummy text ever since the 150pe and scrambled it to make a type specimen book. at it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web site</p>
<a href="#" class="watch_video"> watch video</a>
 
 </div>
 </li>
 <li><img src="images/gallary_img2.jpg" width="282" height="187" alt="" />
 <div class="gallary_txt"><h2>Lorem ipsum</h2>
 <p class="date_txt">Feb 26 , 2013</p>
 <p class="date_txt">Production: <span>Lorem Ipsum</span></p>
 <p>Lorem Ipsum has been the industry's standard dummy text ever since the 150pe and scrambled it to make a type specimen book. at it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web site</p>
<a href="#" class="watch_video"> watch video</a>
 
 </div>
 </li>
 <li><img src="images/gallary_img3.jpg" width="282" height="187" alt="" />
 <div class="gallary_txt"><h2>Lorem ipsum</h2>
 <p class="date_txt">Feb 26 , 2013</p>
 <p class="date_txt">Production: <span>Lorem Ipsum</span></p>
 <p>Lorem Ipsum has been the industry's standard dummy text ever since the 150pe and scrambled it to make a type specimen book. at it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web site</p>
<a href="#" class="watch_video"> watch video</a>
 
 </div>
 </li>
 <li><img src="images/gallary_img4.jpg" width="282" height="187" alt="" />
 <div class="gallary_txt"><h2>Lorem ipsum</h2>
 <p class="date_txt">Feb 26 , 2013</p>
 <p class="date_txt">Production: <span>Lorem Ipsum</span></p>
 <p>Lorem Ipsum has been the industry's standard dummy text ever since the 150pe and scrambled it to make a type specimen book. at it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web site</p>
<a href="#" class="watch_video"> watch video</a>
 
 </div>
 </li>
 </ul>
 <ul class="pagination pg_bottom"><li><a href="#" class="grey_current previous">Previous</a></li>
 <li><a href="#" class="grey_current">1</a></li>
  <li><a href="#">2</a></li>
 <li><a href="#">3</a></li>
 <li><a href="#">4</a></li>
 <li><a href="#" class="next">Next</a></li> 

 </ul>-->

		   </div><!-- #content -->
</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>
