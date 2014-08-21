  <?php 
   	global $wpdb;
    $mainurl = get_option('siteurl')."/wp-admin/admin.php?page=add_admin_menu_auditions";
    $auditionUrl = get_option('siteurl')."/wp-admin/admin.php?page=auditions";
    $audition_dir = wp_upload_dir();
    $audition_dir['basedir'];
    $submittext = "";
	if($_POST['submit'] =="Submit")
    {
		
		     $auditions_image     = $_FILES['auditions_image']['name']; 
             $source              = $_FILES['auditions_image']['tmp_name'];
             $destination         = $audition_dir['basedir'].'/'.$auditions_image;//$audition_dir.$auditions_image;

					$sql = "insert into ".WP_auditions_TABLE.""
					. " set `auditions_name` = '" . mysql_real_escape_string(trim($_POST['auditions_name']))
					. "', `auditions_image` = '" . $auditions_image
					. "', `auditions_times` = '" . mysql_real_escape_string(trim($_POST['auditions_times']))
					. "', `auditions_location` = '" . mysql_real_escape_string(trim($_POST['auditions_location']))
					. "', `auditions_requirements` = '" . mysql_real_escape_string(trim($_POST['auditions_requirements']))
					. "', `auditions_whattobring` = '" . mysql_real_escape_string(trim($_POST['auditions_whattobring']))
					. "', `auditions_date` = '" . mysql_real_escape_string(trim($_POST['auditions_date']))
					. "'";
			             $wpdb->get_results($sql);
			             
			                    if(move_uploaded_file($source,$destination))
			                    {
									 $submittext = "<div id='message' class='updated below-h2'><p>Auditions Inserted sucessfully</p></div>";
									}
									else
									{
										echo 'not uplaoded';
										}	
	 }		
		if($_POST['submit'] =="Update")
          {
			  if($_FILES['auditions_image']['name']=="")
			  {
				  //echo 'exist'; die();
				  $auditions_image = $_POST['image'];
		      }
		      else
		      {
				 // echo 'new'; die();
				  $auditions_image     = $_FILES['auditions_image']['name']; 
			      $source              = $_FILES['auditions_image']['tmp_name'];
				  $destination         = $audition_dir['basedir'].'/'.$auditions_image;
			  }
				    $sqlUpdate = "update ".WP_auditions_TABLE.""
					. " set `auditions_name` = '" . mysql_real_escape_string(trim($_POST['auditions_name']))
					. "', `auditions_image` = '" . $auditions_image
					. "', `auditions_times` = '" . mysql_real_escape_string(trim($_POST['auditions_times']))
					. "', `auditions_location` = '" . mysql_real_escape_string(trim($_POST['auditions_location']))
					. "', `auditions_requirements` = '" . mysql_real_escape_string(trim($_POST['auditions_requirements']))
					. "', `auditions_whattobring` = '" . mysql_real_escape_string(trim($_POST['auditions_whattobring']))
					. "', `auditions_date` = '" . mysql_real_escape_string(trim($_POST['auditions_date']))
					. "' where `auditions_id` = '" . $_POST['edit_id'] 
					. "'";
					
				$wpdb->get_results($sqlUpdate);
				 if(move_uploaded_file($source,$destination))
			                    {
									 $submittext = "<div id='message' class='updated below-h2'><p>Auditions Edited sucessfully</p></div>";
									}
									else
									{
										echo "<div id='message' class='updated below-h2'><p>Auditions Edited sucessfully</p>";
									}		      
          }
      $button   = "Submit";
      $pageName = "Add Auditions";
	if($_GET['action'] == "edit") 
	{
	if(!empty($_GET['id'])) 
	  {
			$pageName = "Edit Auditions";
			$button = "Update";
			$sel_edit_qry = mysql_query("select * from wp_auditions where auditions_id = ".$_GET['id']."");
			if(mysql_num_rows($sel_edit_qry) > 0) 
			{
			$row_auditions   = mysql_fetch_array($sel_edit_qry);
			$auditions_name  = $row_auditions['auditions_name'];
			$auditions_image  = $row_auditions['auditions_image'];
			$auditions_times = $row_auditions['auditions_times'];
			$auditions_locations  = $row_auditions['auditions_location'];
			$auditions_requirements  = $row_auditions['auditions_requirements'];
			$auditions_whattobring  = $row_auditions['auditions_whattobring'];
			$auditions_date  = $row_auditions['auditions_date'];
			} 
	  }
	}
?>
<div class="wrap">
	 <h2><?php echo $pageName;?></h2>
  <script language="JavaScript" src="<?php echo auditions_plugin_url('inc/setting.js'); ?>"></script>
  <form name="form_auditions" method="post" action="<?php echo @$mainurl; ?>"   enctype="multipart/form-data"  >

    <?php echo $submittext; ?>
   <table width="100%" cellspacing="0" cellpadding="0">
	   <tr><td>Name: </td><td><input type="text" name="auditions_name" value="<?php echo $auditions_name;?>" class="regular-text"></td></tr>
	   <tr><td>Image: </td><td><input type="file" name="auditions_image" size="30">
	   <?php if($_REQUEST['action']=="edit") { echo '<strong>'.$auditions_image.'</strong>' ;} ?>
	   </td></tr>
	   <tr><td>Times: </td><td><textarea name="auditions_times"   cols="55"><?php echo $auditions_times;?></textarea></td></tr>
	   <tr><td>Location: </td><td><input type="text" name="auditions_location" value="<?php echo $auditions_locations;?>" class="regular-text"></td></tr>
	   <tr><td>Requirements: </td><td><textarea name="auditions_requirements"  cols="55"><?php echo $auditions_requirements;?></textarea></td></tr>
	   <tr><td>What to bring: </td><td><textarea name="auditions_whattobring"  cols="55"><?php echo $auditions_whattobring;?></textarea></td></tr>
	   <tr><td>Date(yyyy-mm-dd): </td><td><input type="text" name="auditions_date" value="<?php echo $auditions_date;?>" class="regular-text">[2013-04-12]</td></tr>
	   <tr><td><input type="hidden" name="edit_id" value="<?php echo $_GET['id'] ?>"><input type="hidden" name="image" value="<?php echo $auditions_image; ?>"></td>
	   <td><input type="submit" name="submit" lang="publish" value="<?php echo $button; ?>" class="button-primary" ></td></tr>
	   <tr>
		   <td colspan="2">
		   <?php if($_REQUEST['action']=="edit") {?>
            <img src="<?php echo get_option('siteurl').'/wp-content/uploads/'.$auditions_image;?>" width="100" height="100" border="10">
            <?php } ?>
         </td>
	   </tr>
   </table>
  </form>
 

</div>
	
