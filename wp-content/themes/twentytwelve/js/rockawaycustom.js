/*function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }     
}*/
	jQuery(document).ready(function($){
		var custom_uploader;
		$('.bw').live('click',function(e){
		         e.preventDefault();
		         var currentId = $(this).prev().attr('class');
		         //If the uploader object has already been created, reopen the dialog
			     /*if (custom_uploader) 
			     {
			    	 custom_uploader.open();
			         return;
			     }*/
			     //Extend the wp.media object
			     custom_uploader = wp.media.frames.file_frame = wp.media({
			    	 	title: 'Choose Image',
			            button: {
			                text: 'Choose Image'
			            },
			            multiple: false
			        });
			     //When a file is selected, grab the URL and set it as the text field's value
			     custom_uploader.on('select', function() {
			    	 	attachment = custom_uploader.state().get('selection').first().toJSON();
			    	 	//alert(currentId);
			            $('.'+currentId).val(attachment.url);
			        });
			 
			     //Open the uploader dialog
			     custom_uploader.open();
			});
		$('.totaltr').val($('.event_performance table tr').length);
		
		$('.performanceclose').live('click',function(){
			$(this).parent('.event_performance table tr').remove(); 
			$('.totaltr').val($('.event_performance table tr').length);
			return false;
		});
		//$('.totalli').val($('.five_reason_meta ul li').length);
		$('.performanceadd').click(
				function(e){
					e.preventDefault();
					$('.event_performance table  tr:last').after('<tr><td><input type="text" id="" class="selector" required name="eventperformancedate[]" class="hasDatepicker"></td><td>Hr:<select name="eventperformancetimehr[]"><option>00</option><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option><option>06</option><option>07</option><option>08</option><option>09</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option></select>Min:<select name="eventperformancetimemin[]"><option>00</option><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option><option>06</option><option>07</option><option>08</option><option>09</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option><option>32</option><option>33</option><option>34</option><option>35</option><option>36</option><option>37</option><option>38</option><option>39</option><option>40</option><option>41</option><option>42</option><option>43</option><option>44</option><option>45</option><option>46</option><option>47</option><option>48</option><option>49</option><option>50</option><option>51</option><option>52</option><option>53</option><option>54</option><option>55</option><option>56</option><option>57</option><option>58</option><option>59</option></select></td><td><select name="seatavailability[]"><option value="Yes">Available</option><option value="No">Not Available</option></select></td><td class="price_structure"><div>Adult Price :- $<input type="text" name="adult_price[]" class="" value="" /><br/>Senior Price :- $<input type="text" name="senior_price[]" class="" value="" /><br/>Children Price :- $<input type="text" name="children_price[]" class="" value="" /></div></td><td class="performanceclose">close</td></tr>');
					//$('.five_reason_meta ul li:last .reas').append('Reason No:'+$('.five_reason_meta ul li').length);
					$('.totaltr').val($('.event_performance table tr').length);
				});
		
		$('*[id^="datepicker-"]').datepicker();
		
		$('.event_performance').on('focus', ".selector", function(){
	    	$(this).datepicker().datepicker('show');
			true;
		});
	
		$('.musical_info_radio').click(function(){
			$('.price_structure input[type=text]').val('');
			$('.show_price_structure').hide();
			$('#'+$(this).val()+'_price_Structure').show();
		});
	});

//change_ticket_price
	