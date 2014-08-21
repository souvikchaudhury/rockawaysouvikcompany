 <?php 
   	global $wpdb;
   	add_option('auditions_title', "Auditions");
    $mainurl = get_option('siteurl')."/wp-admin/admin.php?page=auditions_admin_option";

   if($_GET['action'] == "delete") 
   {
		if(!empty($_GET['id'])) 
		  {
				$delete_qry      = mysql_query("delete from wp_auditions where auditions_id='".$_GET['id']."'");
                $_SESSION['msg'] = "<div id='message' class='updated below-h2'><p>Audition Deleted Successfully.</p></div>";
		  }
     }
	
?>
<div class="wrap">
	<h2>Auditions</h2>
	<?php
	echo $_SESSION['msg'];
$selqry = mysql_query("select * from wp_auditions order by auditions_id desc") or die ("Sql Error");
if(mysql_num_rows($selqry) > 0) {
echo "<table width ='100%'  class='wp-list-table widefat fixed posts'>";
echo "<thead><tr>";
echo "<th><b>Name</b></th>";
echo "<th><b>Time</b></th>";
echo "<th><b>Location</b></th>";
echo "<th><b>Date</b></th>";
echo "<th><b>Action</b></th>";
echo "</tr></thead>";


while($row=mysql_fetch_array($selqry)) {
echo "<tr>";
echo "<td>".$row['auditions_name']."</td>";
echo "<td>".$row['auditions_times']."</td>";
echo "<td>".$row['auditions_location']."</td>";
echo "<td>".$row['auditions_date']."</td>";
echo "<td><a href='?page=add_admin_menu_auditions&action=edit&id=".$row['auditions_id']."'>Edit</a>/
<a href='?page=auditions&action=delete&id=".$row['auditions_id']."'>Delete</a></td>";
echo "</tr>";
}

echo "</table>";
}

?>

</div>
	
