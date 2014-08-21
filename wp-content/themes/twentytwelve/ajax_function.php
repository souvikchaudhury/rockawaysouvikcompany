<?php
	function gettimeinfor($seconds,$hours,$getpostid,$seatavlstat,$evntId)
	{
		if($seconds >=0 )
		  {
		        if($hours<=24)
		            {
		               $ticket_info_type = '<span class="sold-out phoneorder">Phone Order/Walk-In Only *</span><br>';
		               $timeupclass = '';
		               $timeupmessage = '** We still have tickets available, but you can only reserve by phone or by coming directly to the theatre for this performance.**';
		            }
		        else
		            {
		                $ticket_info_type = ($seatavlstat=='Yes'?('<span class="available">SEATS AVAILABLE</span><a class="book-now cftclick" href="#bookNoWd" PostId="'.$getpostid.'" PerformanceId="'.$evntId.'">BOOK NOW</a>'):'<span class="sold-out">Sold out</span>').'<br>';
		                $timeupclass = '';
		            }
		      $statuscounter = 'hasconcert';
		    }
		else
		    {
		      $ticket_info_type = '<span class="sold-out">Sold Out</span><br>';
		      $timeupclass = 'timeup';
		    }
		return array($ticket_info_type,$timeupclass,$statuscounter,$timeupmessage);
	}

	function ticket_resrvation_schedule($typeofshow = '') {

		$args = array(
						'posts_per_page'   => $typeofshow == 'front' ? 2 : -1,
						'orderby'          => 'post_date',
						'order'            => 'desc',
						'post_type'        => 'events_booking',
						'post_status'      => 'publish'
					 ); 
		$posts_array = get_posts( $args );
	?> 

		<div id="ticket_inner<?php echo $typeofshow == 'front' ? ' play_event_cont' : ''; ?>">
        	<div class="ticket_area_inner<?php echo $typeofshow == 'front' ? ' play_event' : ''; ?>">
        		<?php 
				    if($typeofshow != 'front'){
				?> 
        		<h1>Ticket Reservation Area</h1>
            	<h2>Upcoming Events<span></span></h2>
            	<?php } ?>
        		<?php
            		foreach ($posts_array as $posts)
						{
							$mssgDecl = array();
              				$musicalinfo = get_post_meta( $posts->ID, '_musicalinfo', true );
              				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($posts->ID),'large');
              				$directed = get_post_meta( $posts->ID, '_directed', true );
              				$assdirected = get_post_meta( $posts->ID, '_assdirected', true );
              				$musicdirection = get_post_meta( $posts->ID, '_musicdirection', true );
                        	$musicarrangement = get_post_meta( $posts->ID, '_musicarrangement', true );
                        	$written = get_post_meta( $posts->ID, '_written', true );
                        	$venue = get_post_meta( $posts->ID, '_venue', true );
                        	$total_no_eventperformance = get_post_meta( $posts->ID, '_total_no_eventperformance', true );
                            $eventperformance_schedule = get_post_meta( $posts->ID, '_eventperformance_schedule', true );
				?>
							<!--event start-->
				            <div class="event-total-part">
				                <div class="event-inner">
				                	<?php 
				                	if($typeofshow != 'front'){
				                	?> 
					                	<div class="event-top-text">
					                    	<img src="<?php echo get_bloginfo("template_url")."/images/"; ?>ticket-img1.gif" alt="" />
					                        <span>Rockaway Theatre Company in partnership with Gateway National Recreation Area proudly presents:</span>
					                        <img src="<?php echo get_bloginfo("template_url")."/images/"; ?>ticket-img2.gif" alt="" />
					                    </div>                                
				                    <?php 
				                	} 
				                	?>
				                    <div class="event-detail">
				                        <h3><?php echo $posts->post_title;?></h3>
				                        <div class="event_img">
	                       					<div class="imgSec"> 
	                       						<img alt="" src="<?php echo $large_image_url[0]; ?>" >
	                       					</div>
	                        				<?php 
                        						$directed ? '<p>Directed By :<span>'.$directed.'</span></p>' : '';
                        						$assdirected ? '<p>Assistant Directed By : <span>'.$assdirected.'</span></p>' : '';
                           						$musicdirection ? '<p> Musical Direction By :  <span>'.$musicdirection.'</span></p>' : '';
												$musicarrangement ? '<p> Musical Arrangements By : <span>'.$musicarrangement.'</span></p>' : '';
												$written ? '<p> Written By :<span>'.$written.'</span></p>' : '';
                        						$venue ? '<h4>'.$venue.'</h4' : '';
                        					?>
                         					<div class="clear"></div>
                         				</div>
                         				<?php
                         					apply_filters('the_content',$posts->post_content);
                        				?>
                          			</div>
                          			<div class="ticket-status-top"></div>
                          			<div class="ticket-status-main">
				                        <h3>Ticket Information : </h3>
				                        <table>
				                            <tr>
				                           		<td>Adults</td>
				                              	<td>:</td>
				                              	<td>$<?php echo $adult_orginal_price = $musicalinfo=='Musical'? get_option( 'adults_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'adults_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'adults_YPW',true) : get_option( 'adults_OTHER',true)));?></td>
				                            </tr>
				                            <tr>
				                              	<td>Seniors</td>
				                              	<td>:</td>
				                              	<td>$<?php  echo $senior_orginal_price = $musicalinfo=='Musical'? get_option( 'seniors_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'seniors_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'seniors_YPW',true) : get_option( 'seniors_OTHER',true)));?></td>
				                            </tr>
				                            <tr>
				                              	<td>Childrens</td>
				                              	<td>:</td>
				                              	<td>$<?php echo $children_orginal_price = $musicalinfo=='Musical'? get_option( 'children_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'children_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'children_YPW',true) : get_option( 'children_OTHER',true)));?></td>
				                            </tr>
				                        </table>
				                        <h3>PERFORMANCE SCHEDULE :</h3>
				                        <?php
                                			$reason_contents = unserialize($eventperformance_schedule);
                                			/*echo '<pre>';
                                			print_r($reason_contents);
                                			echo '</pre>';*/

                                  			$count=1;
                                  			foreach ($reason_contents as $reason_content)
                                  			{
                                  				$special_counter1 = FALSE;
                                      			$reservation_ticket_no = get_option( 'reservation_no_generate');
                      
                                      			$originalDate = $reason_content['eventperformancedate'];
                                      			$newDate = date("M d,Y", strtotime($originalDate));
                                      
                                      			$originalTime = $reason_content['eventperformancetime'];
                                      			$time_in_12_hour_format  = date("g:i a", strtotime($originalTime));
                                      
                                      			$get_date_time_event = date("Y-m-d", strtotime($originalDate)).T.$originalTime;
                                      			$seconds = strtotime($get_date_time_event) - time();
                                      			$hours = $seconds / 60 /  60;

	                                      		if( trim($adult_orginal_price)==trim($reason_content['show_price_structure']['adult_price'])  && trim($senior_orginal_price) == trim($reason_content['show_price_structure']['senior_price']) && trim($children_orginal_price)==trim($reason_content['show_price_structure']['children_price']) ) {
                                          			$special_counter1 = TRUE;
                                      			}
                                      			$spcArr = array();
                                  
                                    			$spcArr['boldClass']  = $special_counter1  ? '' : 'spcBld';
                                    			$spcArr['labelClass'] = $special_counter1 ? '<label>Ticket Price:-</label>' : '<label class="spc">Special Ticket Price:-</label>';
                                    			$spcArr['boldmessage']= $special_counter1 ? '' : '**Performance dates listed in bold have discounted ticket prices.**';

                                    			$getinformation = gettimeinfor($seconds,$hours,$posts->ID,$reason_content['seatavailability'],$reason_content['eventperformanceid']);
                                    
                                    			if($spcArr['boldmessage'] != ''){
                                        			$mssgDecl['msg1'] = $spcArr['boldmessage'];
                                    			} 
                                    			if($getinformation[3] != ''){
                                        			$mssgDecl['msg2'] = $getinformation[3];
                                    			}
                                		?>
                                				<div class="ticket-line <?php echo $getinformation[1]; ?>">
                                    			<div class="date <?php echo $spcArr['boldClass']; ?>"><?php echo $newDate; ?></div>
                                    			<div class="time  <?php echo $spcArr['boldClass']; ?>"><?php echo $time_in_12_hour_format; ?></div>
                                     			<?php echo $getinformation[0]; ?>
                                     			</div>
			  							<?php 
			  								}
				                			if($typeofshow == 'front'){
				                				?>
				                				<a href="<?php echo site_url().'/ticket-reservation-section';?>" class="reserve_ticket">Reserve your ticket</a>
				                				<?php
				                			}
			  							?>            	
                    				</div>
                    				<div class="ticket-status-bottom"></div>
                    				<div class="nb-section">
				                        **This program is supported in part by public funds from the NYC Department of Cultural Affairs in partnership with the City Council**
				                        <br/>
				                        <?php 
				                            if($mssgDecl['msg1'])
				                              echo '</br>'.$mssgDecl['msg1'].'</br>'; 
				                            if($mssgDecl['msg2'])
				                              echo '</br>'.$mssgDecl['msg2'].'</br>'; 
				                        ?>
				                    </div>
				                    <?php 
			  							// }
				                			if($typeofshow != 'front'){
				                				?>
							                    <div class="corner1"></div>
								                <div class="corner2"></div>
								                <div class="corner3"></div>
								                <div class="corner4"></div>
								                <?php
								            }
								            ?>
				                </div>
				            </div>
						<?php
						}
						?>
			</div>
		</div>
		<?php
}


function InitializationPostsFunc(){
//	ob_clean();
	ticket_resrvation_schedule($_POST['dataShownTyp']);
   	die();
}
add_action( 'wp_ajax_nopriv_InitializationPosts', 'InitializationPostsFunc' );
add_action( 'wp_ajax_InitializationPosts', 'InitializationPostsFunc' );

/**********************************************************************************************************/

function ticket_resrvation_form($id,$PerformanceId ){
	
	$posts = get_post( $id, 'ARRAY_' ); 

	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($posts->ID),'large');

	$musicalinfo = get_post_meta( $posts->ID, '_musicalinfo', true );

	$eventperformance_schedule = get_post_meta( $posts->ID, '_eventperformance_schedule', true );
	$reason_contents = unserialize($eventperformance_schedule);
	
	foreach ($reason_contents as $reason_content)
        {
  			$reservation_ticket_no = get_option( 'reservation_no_generate');

        	if($reason_content['eventperformanceid'] == $PerformanceId) 
        	{
        		$special_counter1 = FALSE;
        		
        		$originalDate = $reason_content['eventperformancedate'];
	  			$newDate = date("M d,Y", strtotime($originalDate));
	  
	  			$originalTime = $reason_content['eventperformancetime'];
	  			$time_in_12_hour_format  = date("g:i a", strtotime($originalTime));
	  
	  			$get_date_time_event = date("Y-m-d", strtotime($originalDate)).T.$originalTime;
	  			$seconds = strtotime($get_date_time_event) - time();
	  			$hours = $seconds / 60 /  60;

				$adult_orginal_price = $musicalinfo=='Musical'? get_option( 'adults_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'adults_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'adults_YPW',true) : get_option( 'adults_OTHER',true)));
				$senior_orginal_price = $musicalinfo=='Musical'? get_option( 'seniors_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'seniors_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'seniors_YPW',true) : get_option( 'seniors_OTHER',true)));
				$children_orginal_price = $musicalinfo=='Musical'? get_option( 'children_musical',true): ($musicalinfo=='Non-Musical'? get_option( 'children_nonmusical',true) : ($musicalinfo=='YPW'? get_option( 'children_YPW',true) : get_option( 'children_OTHER',true)));
				                    		

	      		if( trim($adult_orginal_price)==trim($reason_content['show_price_structure']['adult_price'])  && trim($senior_orginal_price) == trim($reason_content['show_price_structure']['senior_price']) && trim($children_orginal_price)==trim($reason_content['show_price_structure']['children_price']) ) {
	      			$special_counter1 = TRUE;
	  			}
	  			$spcArr = array();

				$spcArr['boldClass']  = $special_counter1  ? '' : 'spcBld';
				$spcArr['labelClass'] = $special_counter1 ? '<label>Ticket Price:-</label>' : '<label class="spc">Special Ticket Price:-</label>';
				$spcArr['boldmessage']= $special_counter1 ? '' : '**Performance dates listed in bold have discounted ticket prices.**';

				$getinformation = gettimeinfor($seconds,$hours,$posts->ID,$reason_content['seatavailability'],$reason_content['eventperformanceid']);

				if($spcArr['boldmessage'] != ''){
	    			$mssgDecl['msg1'] = $spcArr['boldmessage'];
				} 
				if($getinformation[3] != ''){
	    			$mssgDecl['msg2'] = $getinformation[3];
				}

?>
	<!--for checkbox style
	<script type="text/javascript" src="<?php echo get_bloginfo("template_url")."/js/"; ?>custom-form-elements.js"></script>-->

			   	<h2>Online Booking Form</h2>
				<div class="popup-main">
					<div class="ticket-show-img">
						<img alt="" src="<?php echo $large_image_url[0]; ?>" style="width:159px; height: 159px;">
					</div>
					<form method="post" onSubmit='return chkForm(this)' action="">
						<input type="hidden" value="<?php echo $posts->ID; ?>" name="nwpostid" id="nwpostid"/>    
						<input type="hidden" value="<?php echo $reason_content['seatavailability']; ?>" name="seatavl" id="seatavl"/>    
						<input type="hidden" value="<?php echo $reason_content['eventperformanceid']; ?>" name="evnprfnctid" id="evnprfnctid"/>   
						<div class="show-confirmation">
							<p>
								<span class="span_left">
									Name of Show : 
								</span>      
								<span>
									<?php echo $posts->post_title;?>
									<input type="hidden" value="<?php echo $posts->post_title; ?>" name="nwposttitle" id="nwposttitle"/>   
								</span>
							</p>
							<p>
								<span class="span_left">
									Date :                
								</span>
								<span>
									<?php echo $newDate; ?>
									<input type="hidden" value="<?php echo $newDate; ?>" name="nwdate" id="nwdate"/>
								</span>
							</p>
							<p>
								<span class="span_left">
									Time :
								</span>                
								<span>
									<?php echo $time_in_12_hour_format; ?>
									<input type="hidden" value="<?php echo $time_in_12_hour_format; ?>" name="nwtime" id="nwtime"/>
								</span>
							</p>
							<p>
								<span class="span_left">
									Reservation Number : 
								</span>
								<span class="reservation">
									<?php echo $reservation_ticket_no; ?>
									<input type="hidden" name="reservation_no" id="reservation_no" class="reservation_no" value="<?php echo $reservation_ticket_no; ?>">
								</span>
							</p>
						</div>
						<div class="showing_price">
							<?php 
								//echo $special_counter == 1 ? '<label>Ticket Price:-</label>' : '<label class="spc">{ Special } Ticket Price:-</label>' 
								echo  $spcArr['labelClass'];  // CHeck Special Class or not
							?> 
							<p>
								Adult Price :-
								<span>
									<?php echo '$'.$showing_adult_price = $special_counter ==1?$adult_orginal_price:$reason_content['show_price_structure']['adult_price']?>
								</span>
							</p>
							<p>
								Senior Price :-
								<span>
									<?php echo '$'.$showing_senior_price = $special_counter ==1?$senior_orginal_price:$reason_content['show_price_structure']['senior_price']?>
								</span>
							</p>
							<p>
								Children Price :-
								<span>
									<?php echo '$'.$showing_senior_price = $special_counter ==1?$children_orginal_price:$reason_content['show_price_structure']['children_price']?>
								</span>
							</p>
						</div>
						<div class="ticket-booking-form chk<?php echo $posts->ID.$count?>">
							<div class="text-div">
								<label>First Name</label>
								<input type="text" name="firstname" id="firstname" value="Enter Your First Name" onfocus="if(this.value=='Enter Your First Name') this.value=''" onblur="if(this.value=='') this.value='Enter Your First Name'" />
							</div>
							<div class="text-div-right">
								<label>Last Name</label>
								<input type="text" name="lastname" id="lastname" value="Enter Your Last Name" onfocus="if(this.value=='Enter Your Last Name') this.value=''" onblur="if(this.value=='') this.value='Enter Your Last Name'" />
							</div>
							<div class="text-div">
								<label>Email Address</label>
								<input type="text" name="email" id="emailID" value="Enter Your Email Address" onfocus="if(this.value=='Enter Your Email Address') this.value=''" onblur="if(this.value=='') this.value='Enter Your Email Address'" />
							</div>
							<div class="text-div-right">
								<label>Phone No</label>
								<input type="text" name="phone" id="phoneNo" value="Enter Your Phone No" onfocus="if(this.value=='Enter Your Phone No') this.value=''" onblur="if(this.value=='') this.value='Enter Your Phone No'" />
							</div>
							<div class="text<?php echo $posts->ID.$count?>">
								<div class="age-status">
									<input type="checkbox" value="adult" class="styled adult_chk<?php echo $posts->ID.$count?>" name="adult_chk<?php echo $posts->ID.$count?>" id="adult_chk"/>
									<span class='age-status-result'>Adult</span>
									<input type="text" name="adult" class="ad text adult_txt" id="adult_txt" />                                                                     
									<input type="hidden" name="adult_price" value="<?php echo $reason_content['show_price_structure']['adult_price']; ?>" class="adult_price" id="adult_price" style="width: 50px;"/>
								</div>
								<div class="age-status">
									<input type="checkbox" value="senior" class="styled senior_chk<?php echo $posts->ID.$count?>" name="senior_chk<?php echo $posts->ID.$count?>" id="senior_chk"/>
									<span class='age-status-result'>Senior</span>
									<input type="text" name="senior" class="sn text senior_txt" id="senior_txt" />
									<input type="hidden" name="senior_price" value="<?php echo $reason_content['show_price_structure']['senior_price']; ?>" class="senior_price" id="senior_price" style="width: 50px;"/>
								</div>
								<div class="age-status">
									<input type="checkbox" value="child" class="styled child_chk<?php echo $posts->ID.$count?>" name="child_chk<?php echo $posts->ID.$count?>" id="child_chk"/>
									<span class='age-status-result'>Child</span>
									<input type="text" name="child" class="ch text child_txt" id="child_txt" />
									<input type="hidden" name="children_price" value="<?php echo $reason_content['show_price_structure']['children_price']; ?>" class="children_price" id="children_price" style="width: 50px;"/>
								</div>
								<div class="total-cost">
									Total Cost :  <span class="total-ticket_cost">$0</span>
									<input type="hidden" name="total-ticket_cost_text" id="total-ticket_cost_text" class="total-ticket_cost_text"/>
								</div>
								<div class="total-ticket">Total Number of Tickets : <span class="total-ticket_no">0</span>
									<input type="hidden" name="total-ticket_no_text" id="total-ticket_no_text" class="total-ticket_no_text"/>
								</div>
							</div>
							<div class="radio-div">
								<label>Will this reservation be applied against your season pass?</label>
								<div class="radio-list">
									<input type="radio" name="season-pass" value="yes" />Yes<br />
									<input type="radio" name="season-pass" value="no" />No<br />
									<input type="radio" name="season-pass" value="season-pass" /> I don't have a season pass
								</div>
							</div>
							<div class="radio-div-right">
								<label>Would you like information on purchasing a season<br /> pass?</label>
								<div class="radio-list">
									<input type="radio" name="purchase" value="yes" />Yes<br />
									<input type="radio" name="purchase" value="no" />No<br />
								</div>
							</div>
							<div class="radio-div">
								<label>Wheelchair Access &amp;<br /> seating required?</label>
								<div class="radio-list">
									<input type="radio" name="seating" value="yes" />Yes<br />
									<input type="radio" name="seating" value="no" />No<br />
								</div>
							</div>
							<div class="captcha<?php echo $posts->ID.$count?>">
								<div class="captcha-code">
									<span class="lbb captcha_code_i" oncontextmenu="return false" style='-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;'
									unselectable='on' onselectstart='return false;' onmousedown='return false;'></span>
									<input type="hidden" name="captcha_orig" id="captcha_orig" class="captcha_orig" />
									<a href="#" class="captcha_refresh"><img src="<?php echo get_bloginfo("template_url")."/images/"; ?>captcha-refresh.gif" alt="" /></a>
								</div>
							</div>
							<div class="captcha-text">
								<label>Please enter the above text</label>
								<input type="text" name="captcha-textfield" id="captcha-textfield" class="captcha-textfield"/>
							</div>
							<br style="clear:both;" />
							<div class="errormsgdisp">** Please fill up the all fields.</div>
							<div class="captchaerrormsg">** Please enter the correct captcha.</div>
							<input type="button" class="submit" name="submit" id="submit1" value="submit" />
						</div>
					</form>
				</div>
				<br style="clear:both" />
				<ul class="nb">
					<li>No payments required at this time. <span>All payments</span> are made at the Theater via Cash, Check or Money Order on the day of the performance.</li>
					<li><span>RTC does not accept credit/debit cards, please plan accordingly.</span></li>
					<li>All seats will be assigned on a "Best Available" basis by house management.</li>
					<li>You will receive an automated email from <a href="mailto:reservations@rockawaytheatrecompany.org">reservations@rockawaytheatrecompany.org</a> with your reservation number and reservation information. Please present this at the Theater on the day of the performance.</li>
				</ul>
<?php
			}
		}
	}

function PostsEventsFunc(){
	ticket_resrvation_form($_POST['PostId'],$_POST['PerformanceId']);
   	die();
 }

add_action( 'wp_ajax_nopriv_PostsEvents', 'PostsEventsFunc' );
add_action( 'wp_ajax_PostsEvents', 'PostsEventsFunc' );

function SubmitEventsFunc(){
	
	$part_number['adult']			= $_POST['adult'];
	$part_number['adult_price']		= $_POST['adult_price'];
	$part_number['senior']			= $_POST['senior'];
	$part_number['senior_price']	= $_POST['senior_price'];
	$part_number['child']			= $_POST['child'];
	$part_number['child_price']		= $_POST['child_price'];
	
	$arr['eventid']			      = $_POST['eventid'];
	$arr['eventtitle']		      = $_POST['eventtitle'];
	$arr['eventdate']		      = $_POST['eventdate'];
	$arr['eventtime']			  = $_POST['eventtime'];
	$arr['firstname']			  = $_POST['firstname'];
	$arr['lastname']			  = $_POST['lastname'];
	$arr['email'] 				  = $_POST['email'];
	$arr['phone'] 			      = $_POST['phone'];
	$arr['total-ticket_no_text']  = $_POST['total_ticket_no_text'];
	$arr['total-ticket_cost_text']= $_POST['total_ticket_cost_text'];
	$arr['ticket_division']		  =	$part_number;
	$arr['season-pass']  		  = $_POST['season_pass'];
	$arr['purchase'] 			  = $_POST['purchase'];
	$arr['seating']  			  = $_POST['seating'];
	
	 
	$eventperformance_schedule = get_post_meta( $_POST['nwpostid'], '_eventperformance_schedule', true );
	$reason_contents = unserialize($eventperformance_schedule);

	foreach ($reason_contents as $reason_content) {
		if($reason_content['eventperformanceid'] == $_POST['evnprfnctid']){
			$curntevntdate = $reason_content['eventperformancedate'];
			$curntevnttime = $reason_content['eventperformancetime'];
			$seatavl = $reason_content['seatavailability'];
		}
	}

	$get_date_time_event = date("Y-m-d", strtotime($curntevntdate)).T.date("G:i:s", strtotime($curntevnttime));
	$seconds = strtotime($get_date_time_event) - time();
	$hours = $seconds / 60 /  60;

	if($seconds >= 0 && $hours > 24 && $seatavl == 'Yes') {

			$sql_query = "select * FROM wp_ticketreservation WHERE ticketregno='".$_POST['reservation_no']."'";
			$mysqlRes = mysql_query($sql_query);

			$valuearr = serialize($arr);
			$rev_date = date("Y-m-d H:i:s");	
			$data = array( 
							'ticketregno' => $_POST['reservation_no'], 
							'reservationinfo' => $valuearr,
							'reservationtime' => $rev_date 
						 );
			if(mysql_num_rows($mysqlRes) > 0) {
					echo $msg_cancel= 'This Reservation ID already Exists. Please Try after Some time or Refresh the Page.';
			}
			else{
					$sql_Insrt_query = "INSERT INTO wp_ticketreservation (ticketregno,reservationinfo,reservationtime) VALUES('".$_POST['reservation_no']."','".$valuearr."', '".$rev_date."' ) ";
					$mysqlRes1 = mysql_query($sql_Insrt_query);
					if($mysqlRes1){
						?>

						<!-- Success Message -->
						
                        <h2>Online Booking Form</h2>
						<p class="thnks_regis">Thanks for Registration. Your Reservation Id is
						<span><?php echo $_POST['reservation_no'];?></span></p>
						<p class="cnfrm_soon">You will be getting a confirmation email soon</p>                       
                        <div class="ticket-booking-form">
                        	<input type="button" class="submit sub_close" name="close" id="closeRockaw" value="Close">
                        </div>
						<!-- End Success Message -->
						<?php

						$reservation_ticket_no = $_POST['reservation_no'];
						$reservation_ticket_no = $reservation_ticket_no + 1;
						update_option( 'reservation_no_generate', $reservation_ticket_no );

						$to = get_option( 'ticketemailid',true);
						$subject = 'Ticket Reservation Information';
						$subject1 = $_POST['eventtitle'].':Ticket Reservation';
						
						$headers  = "MIME-Version: 1.0\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\n";
						$headers .= "X-Priority: 3\n";
						$headers .= "X-MSMail-Priority: Normal\n";
						$headers .= "X-Mailer: php\n";
						$headers .= 'From: Rockaway Theatre Company <'.$_POST['email'].'>' . "\r\n";

						$headers1  = "MIME-Version: 1.0\n";
						$headers1 .= "Content-type: text/html; charset=iso-8859-1\n";
						$headers1 .= "X-Priority: 3\n";
						$headers1 .= "X-MSMail-Priority: Normal\n";
						$headers1 .= "X-Mailer: php\n";
						$headers1 .= 'From: Rockaway Theatre Company <'.$to.'>'. "\r\n";
			
						$message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr> <td width="20%">Show Name</td>   <td width="5%">:</td>  <td>'.$_POST['eventtitle'].'</td>  </tr>
						  			<tr> <td width="20%">Date</td> 	      <td width="5%">:</td>  <td>'.$_POST['eventdate'].'</td>	  	 </tr>
						  			<tr> <td width="20%">Time</td> 	      <td width="5%">:</td>  <td>'.$_POST['eventtime'].'</td>		 </tr>
						  			<tr> <td width="20%">Registration No</td>   <td width="5%">:</td>   <td>'.$_POST['reservation_no'].'</td>  </tr>
						  			<tr> <td width="20%">Name</td>    <td width="5%">:</td>   <td>'.$_POST['firstname'].' '.$_POST['lastname'].'</td>  </tr>
						  			<tr> <td width="20%">Email</td>   <td width="5%">:</td>   <td>'.$_POST['email'].'</td>   </tr>
						  			<tr> <td width="20%">Phone</td>   <td width="5%">:</td>   <td>'.$_POST['phone'].'</td>   </tr>
						  			<tr> <td width="20%">No. of Tickets</td>   <td width="5%">:</td>  <td>Adult- '.$part_number['adult'].', child- '.$part_number['child'].', senior- '.$part_number['senior'].'</td>   </tr>
						  			<tr> <td width="20%">Total Costs</td>    <td width="5%">:</td>   <td>$'.$_POST['total_ticket_cost_text'].'</td>	  </tr>
									</table>';

						$message1 = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
									 <tr> <td><img src="'.get_template_directory_uri().'/images/logo.png" alt="" width="147" height="128" /></td> </tr>
									 <tr> <td> 
									 	  <table width="100%" border="0" cellspacing="0" cellpadding="0">			  
									 	  	<tr>  <td width="20%">Show Name</td>  <td width="5%">:</td>   <td>'.$_POST['eventtitle'].'</td>  </tr>
							  			  	<tr>  <td width="20%">Date</td>   <td width="5%">:</td>   <td>'.$_POST['eventdate'].'</td>  </tr>
							  				<tr>  <td width="20%">Time</td>   <td width="5%">:</td>   <td>'.$_POST['eventtime'].'</td>  </tr>
							  				<tr>  <td width="20%">Registration No</td>    <td width="5%">:</td>  <td>'.$_POST['reservation_no'].'</td>  </tr>
							  				<tr>  <td width="20%">Name</td> <td width="5%">:</td> <td>'.$_POST['firstname'].' '.$_POST['lastname'].'</td> </tr>
							  				<tr>  <td width="20%">Email</td> <td width="5%">:</td>   <td>'.$_POST['email'].'</td>  </tr>
							  				<tr>  <td width="20%">Phone</td>   <td width="5%">:</td>   <td>'.$_POST['phone'].'</td>  </tr>
							  				<tr>  <td width="20%">No. of Tickets</td>  <td width="5%">:</td>  <td>Adult- '.$part_number['adult'].', child- '.$part_number['child'].', senior- '.$part_number['senior'].'</td>  </tr>
							  				<tr>  <td width="20%">Total Costs</td>  <td width="5%">:</td>  <td>$'.$_POST['total_ticket_cost_text'].'</td>  </tr>
										</table>							
										</td>
									 </tr>
									 </table>';
						
						mail( $to, $subject, $message,$headers );
						mail( $_POST['email'], $subject1, $message1,$headers1 );
					}
				}
					
	}else{
		if($seatavl != 'Yes'){
			?>
				<h2>Online Booking Form</h2>
				<p class="thnks_regis">Sorry! We can not confirm your reservation due to unavailability of tickets.</p>                        
	            <div class="ticket-booking-form">
	            	<input type="button" class="submit sub_close" name="close" id="closeRockaw" value="Close">
	            </div>
			<?php
		}
		else{
			?>
			<!-- Not Reserved Your ticket -->
				<h2>Online Booking Form</h2>
				<p class="thnks_regis">
					Sorry! We can not confirm your reservation online. Please go for "Phone order/walk in only" to check availability.
					Inconvenience caused is highy regreted.
				</p>
	            <div class="ticket-booking-form">
	            	<input type="button" class="submit sub_close" name="close" id="closeRockaw" value="Close">
	            </div>
			<!-- End Here Not Reserved Your ticket -->
			<?php
		}
	}
   	die();
 }

add_action( 'wp_ajax_nopriv_SubmitEvents', 'SubmitEventsFunc' );
add_action( 'wp_ajax_SubmitEvents', 'SubmitEventsFunc' );
?>