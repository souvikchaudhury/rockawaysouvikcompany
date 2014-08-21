<?php
/* Non-Musicals - Adults: $15.00, Seniors: $12.00, Children: $12.00.
Musicals - Adults: $20.00, Seniors: $15.00, Children: $15.00 */
if(isset($_POST['submit']))
{
	$adults_nonmusical = $_POST['adults_nonmusical'];
	if($adults_nonmusical!='')
		update_option( 'adults_nonmusical', $adults_nonmusical);
	
	$seniors_nonmusical = $_POST['seniors_nonmusical'];
	if($seniors_nonmusical!='')
		update_option( 'seniors_nonmusical', $seniors_nonmusical );
	
	$children_nonmusical = $_POST['children_nonmusical'];
	if($children_nonmusical!='')
		update_option( 'children_nonmusical', $children_nonmusical );
	
	$adults_musical = $_POST['adults_musical'];
	if($adults_musical!='')
		update_option( 'adults_musical', $adults_musical );
	
	$seniors_musical = $_POST['seniors_musical'];
	if($seniors_musical!='')
		update_option( 'seniors_musical', $seniors_musical );
	
	$children_musical = $_POST['children_musical'];
	if($children_musical!='')
		update_option( 'children_musical', $children_musical );
		
	$adults_YPW = $_POST['adults_YPW'];
	if($adults_YPW!='')
		update_option( 'adults_YPW', $adults_YPW );
	
	$seniors_YPW = $_POST['seniors_YPW'];
	if($seniors_YPW!='')
		update_option( 'seniors_YPW', $seniors_YPW );
	
	$children_YPW = $_POST['children_YPW'];
	if($children_YPW!='')
		update_option( 'children_YPW', $children_YPW );
	//
	$adults_OTHER = $_POST['adults_OTHER'];
	if($adults_OTHER!='')
		update_option( 'adults_OTHER', $adults_OTHER );
	
	$seniors_OTHER = $_POST['seniors_OTHER'];
	if($seniors_OTHER!='')
		update_option( 'seniors_OTHER', $seniors_OTHER );
	
	$children_OTHER = $_POST['children_OTHER'];
	if($children_OTHER!='')
		update_option( 'children_OTHER', $children_OTHER );
	//
	$ticketemailid = $_POST['emailid'];
	if($ticketemailid!='')
		update_option( 'ticketemailid', $ticketemailid );
	
	$officeAddrs = $_POST['officeAddrs'];
	if($officeAddrs!='')
		update_option( 'officeAddrs', $officeAddrs );
}
?>
<form name="myform" action="" method="post">
<h2>Non-Musicals</h2>
<table>
	<tr>
		<td>Adult Non-Musical Price:</td>
		<td>$<input type="text" name="adults_nonmusical" id="adults_nonmusical" value="<?php echo get_option( 'adults_nonmusical',true);?>" style="width:50px;"/></td>
	</tr>
	<tr>
		<td>Seniors Non-Musical Price:</td>
		<td>$<input type="text" name="seniors_nonmusical" id="seniors_nonmusical" value="<?php echo get_option( 'seniors_nonmusical',true);?>"style="width:50px;"/></td>
	</tr>
	<tr>
		<td>Children Non-Musical Price:</td>
		<td>$<input type="text" name="children_nonmusical" id="children_nonmusical" value="<?php echo get_option( 'children_nonmusical',true);?>"style="width:50px;"/></td>
	</tr>
</table>
<h2>Musicals</h2>
<table>
<tr>
<td>Adult Musical Price:</td>
<td>$<input type="text" name="adults_musical" id="adults_musical" value="<?php echo get_option('adults_musical',true);?>"style="width:50px;"/></td>
</tr>
<tr>
<td>Seniors Musical Price:</td>
<td>$<input type="text" name="seniors_musical" id="seniors_musical" value="<?php echo get_option('seniors_musical',true);?>"style="width:50px;"/></td>
</tr>
<tr>
<td>Children Musical Price:</td>
<td>$<input type="text" name="children_musical" id="children_musical" value="<?php echo get_option('children_musical',true);?>"style="width:50px;"/></td>
</tr>
</table>
<h2>Young Peoples Workshop</h2>
<table>
	<tr>
		<td>Adult YPW Price:</td>
		<td>$<input type="text" name="adults_YPW" id="adults_YPW" value="<?php echo get_option( 'adults_YPW',true);?>" style="width:50px;"/></td>
	</tr>
	<tr>
		<td>Seniors YPW Price:</td>
		<td>$<input type="text" name="seniors_YPW" id="seniors_YPW" value="<?php echo get_option( 'seniors_YPW',true);?>"style="width:50px;"/></td>
	</tr>
	<tr>
		<td>Children YPW Price:</td>
		<td>$<input type="text" name="children_YPW" id="children_YPW" value="<?php echo get_option( 'children_YPW',true);?>"style="width:50px;"/></td>
	</tr>
</table>
<h2>Special/Other Performance</h2>
<table>
	<tr>
		<td>Adult Other Price:</td>
		<td>$<input type="text" name="adults_OTHER" id="adults_OTHER" value="<?php echo get_option( 'adults_OTHER',true);?>" style="width:50px;"/></td>
	</tr>
	<tr>
		<td>Seniors Other Price:</td>
		<td>$<input type="text" name="seniors_OTHER" id="seniors_OTHER" value="<?php echo get_option( 'seniors_OTHER',true);?>"style="width:50px;"/></td>
	</tr>
	<tr>
		<td>Children Other Price:</td>
		<td>$<input type="text" name="children_OTHER" id="children_OTHER" value="<?php echo get_option( 'children_OTHER',true);?>"style="width:50px;"/></td>
	</tr>
</table>
<h2>Email id: </h2>
<input type="text" name="emailid" value="<?php echo get_option('ticketemailid',true);?>"style="width:250px;"/>
<br>
<h2>Address: </h2>
<textarea name="officeAddrs" style=" height: 128px; width: 322px;"><?php echo get_option('officeAddrs',true);?></textarea>
<br>
<input type="submit" name="submit" value="Submit" />
</form>

