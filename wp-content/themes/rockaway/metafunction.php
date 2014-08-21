<?php
/******************************************************************************************************************
 * Rockaway Custom Meta Box 
 * Author Name: Souvik Chaudhury
 * Company Profile: http://capitalnumbers.com
 ******************************************************************************************************************/
		function event_info_function( $post )
		{
			wp_enqueue_script('media-upload');
			?>
			<script type="text/javascript" src="<?php echo get_bloginfo("template_url")."/js/"; ?>rockawaycustom.js"></script>
			 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
				<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
			<style>
				#post-body #normal-sortables{ min-height:0px; }	
				.event_performance td ,.event_titling td{ border: 1px solid #D3D3D3;  padding: 5px;}
				.event_performance > table, .event_titling > table{ border: 1px solid #D3D3D3;}
				.performanceclose, .performanceadd, .eventtitlingadd, .eventtitlingclose{ cursor:pointer;}
			</style>
			<?php
				// Use nonce for verification
			    wp_nonce_field( plugin_basename( __FILE__ ), 'event_info' );
				/************************************
				    **** get Value from post meta ****
				************************************/
				$directed = get_post_meta( $post->ID, '_directed', true );
				$assdirected = get_post_meta( $post->ID, '_assdirected', true );
				$musicdirection = get_post_meta( $post->ID, '_musicdirection', true );
				$musicarrangement = get_post_meta( $post->ID, '_musicarrangement', true );
				$written = get_post_meta( $post->ID, '_written', true );
				$venue = get_post_meta( $post->ID, '_venue', true );
				$musicalinfo = get_post_meta( $post->ID, '_musicalinfo', true );
				$total_no_eventperformance = get_post_meta( $post->ID, '_total_no_eventperformance', true );
				$eventperformance_schedule = get_post_meta( $post->ID, '_eventperformance_schedule', true );

				

		?>

	



			
			<table>
			<tr>
			<td><h4>Directed By:</h4></td>
		  	<td><input type="text" name="directed" value="<?php echo esc_attr($directed); ?>"/></td>
			</tr>
			<tr>
			<td><h4>Assistant Directed By:</h4></td>
		  	<td><input type="text" name="assdirected" value="<?php echo esc_attr($assdirected); ?>"/></td>
			</tr>
			<tr>
			<td><h4>Musical Direction By: </h4></td>
		  	<td><input type="text" name="musicdirection" value="<?php echo esc_attr($musicdirection); ?>"/></td>
		  	</tr>
		  	<tr>
			<td><h4>Musical Arrangements By: </h4></td>
			<td><input type="text" name="musicarrangement" value="<?php echo esc_attr($musicarrangement); ?>"/></td>
			</tr>
			<tr>
			<td><h4>Written By: </h4></td>
			<td><input type="text" name="written" value="<?php echo esc_attr($written); ?>"/></td>
			</tr>
			<tr>
			<td><h4>Venue: </h4></td>
		  	<td><input type="text" name="venue" value="<?php echo esc_attr($venue); ?>"/></td>
		  	</tr>
		  	<tr>
		  	<td><h4>Choose Musical or Non-Musical: </h4></td>
		  	<td>
		  		<input type="radio" class="musical_info_radio" name="musicalinfo" required value="Musical" <?php echo ($musicalinfo=='Musical'?'checked=true':''); ?>/>Musical
		  		
		  		<input type="radio" class="musical_info_radio" name="musicalinfo" required value="Non-Musical" <?php echo ($musicalinfo=='Non-Musical'?'checked=true':''); ?> />Non Musical
		  
		  		<input type="radio" class="musical_info_radio" name="musicalinfo" required value="YPW" <?php echo ($musicalinfo=='YPW'?'checked=true':''); ?> />Young Peoples Workshop</td>

			<td><input type="radio" class="musical_info_radio" name="musicalinfo" required value="OTHER" <?php echo ($musicalinfo=='OTHER'?'checked=true':''); ?> />Special/Other Performance</td>
		  	</tr>
		  	</table>
		<div id="Musical_price_Structure" style="display:<?php echo ($musicalinfo=='Musical'?'block':'none'); ?>;" class="show_price_structure">
				<table>
						<tr>
						<td>Adult Musical Price:</td>
						<td>$<?php echo get_option( 'adults_musical',true);?></td>
						</tr>
						<tr>
						<td>Seniors Musical Price:</td>
						<td>$<?php echo get_option( 'seniors_musical',true);?></td>
						</tr>
						<tr>
						<td>Children Musical Price:</td>
						<td>$<?php echo get_option( 'children_musical',true);?></td>
						</tr>
				</table>

		</div>
	
		<div id="Non-Musical_price_Structure"  style="display:<?php echo ($musicalinfo=='Non-Musical'?'block':'none'); ?>;" class="show_price_structure">
					<table>
						<tr>
							<td>Adult Non-Musical Price:</td>
							<td>$<?php echo get_option( 'adults_nonmusical',true);?></td>
						</tr>
						<tr>
							<td>Seniors Non-Musical Price:</td>
							<td>$<?php echo get_option( 'seniors_nonmusical',true);?></td>
						</tr>
						<tr>
							<td>Children Non-Musical Price:</td>
							<td>$<?php echo get_option( 'children_nonmusical',true);?></td>
						</tr>
					</table>

		</div>
	
		<div id="YPW_price_Structure"  style="display:<?php echo ($musicalinfo=='YPW'?'block':'none'); ?>;" class="show_price_structure">
						<table>
						<tr>
							<td>Adult YPW Price:</td>
							<td>$<?php echo get_option( 'adults_YPW',true);?></td>
						</tr>
						<tr>
							<td>Seniors YPW Price:</td>
							<td>$<?php echo get_option( 'seniors_YPW',true);?></td>
						</tr>
						<tr>
							<td>Children YPW Price:</td>
							<td>$<?php echo get_option( 'children_YPW',true);?></td>
						</tr>
					</table>


		</div>

		<div id="OTHER_price_Structure"  style="display:<?php echo ($musicalinfo=='OTHER'?'block':'none'); ?>;" class="show_price_structure">
						<table>
						<tr>
							<td>Adult Other Price:</td>
							<td>$<?php echo get_option( 'adults_OTHER',true);?></td>
						</tr>
						<tr>
							<td>Seniors Other Price:</td>
							<td>$<?php echo get_option( 'seniors_OTHER',true);?></td>
						</tr>
						<tr>
							<td>Children Other Price:</td>
							<td>$<?php echo get_option( 'children_OTHER',true);?></td>
						</tr>
					</table>


		</div>
		  	<h2>Performance Schedule</h2>
		  	<input type="hidden" name="totaltr" id="totaltr" class="totaltr">
		  	<p>	
		  		<div class="event_performance">
		  			<table class="tabd">
		  				<tr>
		  					<td><b>Date</b></td>
		  					<td><b>Time</b></td>
		  					<td><b>Seat Availability</b></td>
		  					<td><b>Ticket Price Structure</b>(If You don't enter the ticket price then default price will be enter.)</td>
		  					<td>Close</td>
		  				</tr>
		  				<?php 
							if ($total_no_eventperformance <= 0)
							{			
						?>
		  				<tr>
		  					<td><input type="text" name="eventperformancedate[]" required id="" class="selector" ></td>
		  					<td>
		  					Hr:
		  						<select name="eventperformancetimehr[]">
		  							<?php 
		  							for($hr=0;$hr<24;$hr++)
		  							{
		  								if($hr<10)
		  									echo "<option>".'0'.$hr."</option>";
		  								else
		  									echo "<option>".$hr."</option>";
		  							}
		  							?>
		  						</select>
		  					Min:
		  						<select name="eventperformancetimemin[]">
		  							<?php 
		  							for($mn=0;$mn<60;$mn++)
		  							{
		  								if($mn<10)
		  									echo "<option>".'0'.$mn."</option>";
		  								else
		  									echo "<option>".$mn."</option>";
		  							}
		  							?>
		  						</select>
		  					</td>
		  					<td>
		  					    <select name="seatavailability[]">
		  							<option name="Yes">Available</option>
		  							<option name="No">Not Available</option>
		  						</select>
		  					</td>

		  					<td class="price_structure"> 
			  							<div>
			  								Adult Price :- $
			  								<input type="text" name="adult_price[]" class="" value="" width="90px"/>
											<br/>
			  								Senior Price :- $
			  								<input type="text" name="senior_price[]" class="" value="" width="90px"/>
											<br/>
			  								Children Price :- $
			  								<input type="text" name="children_price[]" class="" value="" width="90px"/>
			  							</div>
			  				</td>
		  					<td class="performanceclose">close</td>
		  				</tr>
		  			<?php 
					} 
		  			else
		  			{
		  				$reason_contents = unserialize($eventperformance_schedule);
		  				$count=1;
		  				foreach ($reason_contents as $reason_content)
		  				{
		  					$eventperformancetime = $reason_content['eventperformancetime'];
		  					$eventperformancetimearr = explode(':', $eventperformancetime);
		  			?>
		  					<tr>
			  					<td>
			  						<input type="text" name="eventperformancedate[]" required id="" class="selector" value="<?php echo $reason_content['eventperformancedate']; ?>">
			  					</td>
			  					<td>
			  					Hr:
			  						<select name="eventperformancetimehr[]">
			  							<?php 
			  							for($hr=0;$hr<24;$hr++)
			  							{
			  								if($hr<10)
			  								{
			  									?>
			  									<option value="<?php echo '0'.$hr; ?>" <?php echo ($eventperformancetimearr[0]=='0'.$hr?'selected=true':''); ?>><?php echo '0'.$hr; ?></option>
			  									<?php
			  								}
			  								else
			  								{
			  									?>
			  									<option value="<?php echo $hr; ?>" <?php echo ($eventperformancetimearr[0]==$hr?'selected=true':''); ?> ><?php echo $hr; ?></option>";
			  									<?php 
			  								}
			  							}
			  							?>
			  						</select>
			  					Min:
			  						<select name="eventperformancetimemin[]">
			  							<?php 
			  							for($mn=0;$mn<60;$mn++)
			  							{
			  								if($mn<10)
			  								{
			  									?>
			  									<option value="<?php echo '0'.$mn; ?>" <?php echo ($eventperformancetimearr[1]=='0'.$mn?'selected=true':''); ?>><?php echo '0'.$mn; ?></option>
			  									<?php
			  								}
			  								else
			  								{
			  									?>
			  									<option value="<?php echo $mn; ?>" <?php echo ($eventperformancetimearr[1]==$mn?'selected=true':''); ?> ><?php echo $mn; ?></option>";
			  									<?php 
			  								}
			  							}
			  							?>
			  						</select>
			  					</td>
			  					<td>
			  					    <select name="seatavailability[]">
			  							<option value="Yes" <?php echo ($reason_content['seatavailability']=='Yes'?'selected=true':''); ?>>Available</option>
			  							<option value="No" <?php echo ($reason_content['seatavailability']=='No'?'selected=true':''); ?>>Not Available</option>
			  						</select>
			  					</td>
								<td class="price_structure"> 
		  							<div>
		  								Adult Price :- $
		  								<input type="text" name="adult_price[]" class="" value="<?php echo $reason_content['show_price_structure']['adult_price']; ?>" width="90px"/>
										<br/>
		  								Senior Price :- $
		  								<input type="text" name="senior_price[]" class="" value="<?php echo $reason_content['show_price_structure']['senior_price']; ?>" width="90px"/>
										<br/>
		  								Children Price :- $
		  								<input type="text" name="children_price[]" class="" value="<?php echo $reason_content['show_price_structure']['children_price']; ?>" width="90px"/>
		  							</div>
			  					</td>


			  					<td class="performanceclose">close</td>
		  				  </tr>
		  			<?php
							$count++;
						}
					}
					?>
		  			</table>
		  			<div class="performanceadd">Add</div>
		  		</div>
		  	</p>
			<?php
		}
		/* When the post is saved, saves our custom data */
		function eventinfo_save_postdata( $post_id ) 
		{
		
			  // First we need to check if the current user is authorised to do this action. 
			  if ( 'page' == $_REQUEST['post_type'] ) {
			    if ( ! current_user_can( 'edit_page', $post_id ) )
			        return;
			  } else {
			    if ( ! current_user_can( 'edit_post', $post_id ) )
			        return;
			  }
			
			  // Secondly we need to check if the user intended to change this value.
			  if ( ! isset( $_POST['event_info'] ) || ! wp_verify_nonce( $_POST['event_info'], plugin_basename( __FILE__ ) ) )
			      return;
			
			  // Thirdly we can save the value to the database
			
			  //if saving in a custom table, get post_ID
			  $post_ID = $_POST['post_ID'];
			  //sanitize user input
			  $directed = sanitize_text_field( $_POST['directed']);
			  $assdirected = sanitize_text_field( $_POST['assdirected']);
			  $musicdirection = sanitize_text_field($_POST['musicdirection']);
			  $musicarrangement = sanitize_text_field($_POST['musicarrangement']);
			  $written = sanitize_text_field($_POST['written']);
			  $venue = sanitize_text_field($_POST['venue']);
			  $musicalinfo = sanitize_text_field($_POST['musicalinfo']);
			  
			  $eventperformancedate = $_POST['eventperformancedate'];
			  $eventperformancetimehr = $_POST['eventperformancetimehr'];
			  $eventperformancetimemin = $_POST['eventperformancetimemin'];
			  $seatavailability = $_POST['seatavailability'];

			  $adult_price = $_POST['adult_price'];
			  $senior_price = $_POST['senior_price'];
			  $children_price = $_POST['children_price'];
			  
			  $total = $_POST['totaltr'];

			  $adult_price_orginal = $musicalinfo=='Musical'? get_option( 'adults_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'adults_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'adults_YPW',true) : get_option( 'adults_OTHER',true)));

			  $senior_price_orginal = $musicalinfo=='Musical'? get_option( 'seniors_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'seniors_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'seniors_YPW',true) : get_option( 'seniors_OTHER',true)));

			  $children_price_orginal = $musicalinfo=='Musical'? get_option( 'children_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'children_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'children_YPW',true) : get_option( 'children_OTHER',true)));

			  
			  for ($i=0; $i < $total-1; $i++)
			  {
			  		$arr[$i]['eventperformanceid'] = $i+1;
				  	$arr[$i]['eventperformancedate'] = $eventperformancedate[$i];
				  	$arr[$i]['eventperformancetime'] = $eventperformancetimehr[$i].':'.$eventperformancetimemin[$i].':00';
				  	$arr[$i]['seatavailability'] = $seatavailability[$i];
				  	
				  	$adult_price[$i]==''?$arr[$i]['show_price_structure']['adult_price'] = trim($adult_price_orginal) : $arr[$i]['show_price_structure']['adult_price'] = trim($adult_price[$i]);

				  	$senior_price[$i]==''?$arr[$i]['show_price_structure']['senior_price']=  trim($senior_price_orginal):$arr[$i]['show_price_structure']['senior_price']= trim($senior_price[$i]);
				  	
				  	$children_price[$i]==''?$arr[$i]['show_price_structure']['children_price'] = trim($children_price_orginal):$arr[$i]['show_price_structure']['children_price'] = trim($children_price[$i]);
				  	
				  	
			  }
			  
			  /*echo '<pre>';	
			  print_r($arr);
			  echo '</pre>';
			  die;*/

			  $total_serialize_value = serialize($arr);
			  // Do something with $mydata 
			  // either using 
			  add_post_meta($post_ID, '_directed', $directed, true) or
			    update_post_meta($post_ID, '_directed', $directed);
				
			 add_post_meta($post_ID, '_assdirected', $assdirected, true) or
			    update_post_meta($post_ID, '_assdirected', $assdirected);
				
			  add_post_meta($post_ID, '_musicdirection', $musicdirection, true) or
			    update_post_meta($post_ID, '_musicdirection', $musicdirection);
			    
			  add_post_meta($post_ID, '_musicarrangement', $musicarrangement, true) or
			    update_post_meta($post_ID, '_musicarrangement', $musicarrangement);
			    
			  add_post_meta($post_ID, '_written', $written, true) or
			    update_post_meta($post_ID, '_written', $written);
			    
			  add_post_meta($post_ID, '_venue', $venue, true) or
			    update_post_meta($post_ID, '_venue', $venue);
			    
			  add_post_meta($post_ID, '_musicalinfo', $musicalinfo, true) or
			    update_post_meta($post_ID, '_musicalinfo', $musicalinfo);
			    
			  add_post_meta($post_ID, '_eventperformance_schedule', $total_serialize_value, true) or
			    update_post_meta($post_ID, '_eventperformance_schedule', $total_serialize_value);
			   
			  add_post_meta($post_ID, '_total_no_eventperformance', $total-1, true) or
			    update_post_meta($post_ID, '_total_no_eventperformance', $total-1);
			 // or a custom table (see Further Reading section below)
		}
?>
