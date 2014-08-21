<?php
	global $wpdb, $myListTable;
	$myListTable = new CnCustomFormTable();
	$search_text = isset($_POST['s']) ? $_POST['s'] : '';

	if(isset($_GET['action'])=='view' && $_GET['action']!='delete'){

		$ticketreservations_arr = $wpdb->get_results("SELECT * FROM wp_ticketreservation WHERE id='".$_REQUEST['eventid']."'");
		foreach ( $ticketreservations_arr as $ticketreservation)
		{
			echo '<table>
			<tr>
				<th>Reservation No.</th>
				<th>Full details</th>
			</tr>
			<tr>
				<td>'.$ticketreservation->ticketregno.'</td>
				<td>';
			$reservationdetails = unserialize($ticketreservation->reservationinfo);

			//echo $reservationdetails['eventid'].'<br>';
			echo '<table>';
			echo '<tr><td>Event Title : </td><td>'.$reservationdetails['eventtitle'].'</td></tr>';
			echo '<tr><td>Event Date : </td><td>'.$reservationdetails['eventdate'].'</td></tr>';
			echo '<tr><td>Event Time : </td><td>'.$reservationdetails['eventtime'].'</td></tr>';
			echo '<tr><td>Name : </td><td>'.$reservationdetails['firstname'].' '.$reservationdetails['lastname'].'</td></tr>';
			echo '<tr><td>Email : </td><td>'.$reservationdetails['email'].'</td></tr>';
			echo '<tr><td>Phone : </td><td>'.$reservationdetails['phone'].'</td></tr>';
			echo '<tr><td>Total Ticket No : </td><td>'.$reservationdetails['total-ticket_no_text'].'</td></tr>';
			echo '<tr><td>Total Ticket Cost : </td><td>'.$reservationdetails['total-ticket_cost_text'].'</td></tr>';
			echo '<tr><td>No of Adult</td><td>'.$reservationdetails['ticket_division']['adult'].'</td></tr>';
			echo '<tr><td>Adult Unit Price : </td><td>'.$reservationdetails['ticket_division']['adult_price'].'</td></tr>';
			echo '<tr><td>No of Senior</td><td>'.$reservationdetails['ticket_division']['senior'].'</td></tr>';
			echo '<tr><td>Senior Unit Price : </td><td>'.$reservationdetails['ticket_division']['senior_price'].'</td></tr>';
			echo '<tr><td>No of Child : </td><td>'.$reservationdetails['ticket_division']['child'].'</td></tr>';
			echo '<tr><td>Child Unit Price : </td><td>'.$reservationdetails['ticket_division']['child_price'].'</td></tr>';
			echo '<tr><td>Reservation be applied against your season pass? </td><td>'.$reservationdetails['season-pass'].'</td></tr>';
			echo '<tr><td>Would you like information on purchasing a season pass? </td><td>'.$reservationdetails['purchase'].'</td></tr>';
			echo '<tr><td>Wheelchair Access & seating required? </td><td>'.$reservationdetails['seating'].'</td></tr>';
			echo '</table>';
			echo '</td>
					</tr>
				  </table>';
		}

	}
	if($_GET['action']=='viewlog' && $_GET['action']!='delete' ){
	
		
?>
	    <div class="wrap">
		  	<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div>
			<h2>View Reservation Lists</h2>
			<?php $myListTable->prepare_items($_REQUEST['eventid'],$search_text); ?>
		    <form method="post">
			    <input type="hidden" name="page" value="ttest_list_table">
				<?php
			    	// $myListTable->search_box( 'Search BY Reservation ID', '' );
			    	$myListTable->display(); 
				?>
			</form>
		</div>
<?php 
	}

	if($_GET['action']!='viewlog' && $_GET['action']!='view' && $_GET['action']!='delete'){
	
        
		// $myListTable = new CnCustomFormTable();
?>
	    <div class="wrap">
		  	<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div>
			<h2>View Reservation Lists</h2>
			<?php $myListTable->prepare_items('',$search_text); ?>
		    <form method="post">
			    <input type="hidden" name="page" value="ttest_list_table">
				<?php
			    	// $myListTable->search_box( 'Search BY Reservation ID', '' );
			    	$myListTable->display(); 
				?>
			</form>
		</div>
<?php 

	} if($_GET['action']=='delete'){
	
		// $myListTable = new CnCustomFormTable();

?>
	    <div class="wrap">
		  		<?php  
		  			$reservation_id = $_REQUEST['reserve_ID'];
		  			
		  		$sql_ticket_reservation_delete = "delete FROM wp_ticketreservation WHERE id='".$_REQUEST['eventid']."'";
		  			if(mysql_query($sql_ticket_reservation_delete))
		  			{ 
		  					echo '<div class="updated below-h2" id="message"><p>'.'Reservation Lists Deleted Successfully with ID Number is'.$reservation_id.'</p></div>';
		  					
		  			}else{
		  					echo '<div class="updated below-h2" id="message"><p>'.'Reservation Lists Not Deleted Successfully'.'</p></div>';
		  			}
		  		?>
		  		<div class="icon32 icon32-posts-page" id="icon-edit-pages"><br></div>
						<h2>View Reservation Lists</h2>
						<?php $myListTable->prepare_items('',$search_text); ?>
					    <form method="post">
						    <input type="hidden" name="page" value="ttest_list_table">
							<?php
						    	// $myListTable->search_box( 'Search BY Reservation ID', '' );
						    	$myListTable->display(); 
							?>
						</form>
		</div>
<?php 
	}
?>