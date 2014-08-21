/**
For Front End Jquery
**/
$(document).ready(function() {

	/***************************************************/
	/*  Google Map Function For Home Page */
	$('.getdistancesubmit').click(function(){
		if($('.googlemapform .address_input').val()!='')
		{
			var destinationaddr = $('.googlemapform .address_input1').val();
			var sourceaddr = $('.googlemapform .address_input').val();
			var url = "https://maps.google.com/maps?saddr="+sourceaddr+"&daddr="+destinationaddr;
            window.open(url, '_blank');
		}
	
	});

	/***************************************************/
	/****  Ajax Fire to load the Posts in the front end ****110000*/
	
	

	var AjxUrl = $('#RockawayAjaxUrl').val();
	var AjxPgeTyp = $('#typeChck').val();
	setInterval(function() {
      postsLoad(AjxUrl, AjxPgeTyp);
	}, 8000);
	//setTimeout(,3000);
	

	
/* End Document Ready Function **/
});

/**/
function postsLoad(AjxUrl, AjxPgeTyp){
	// console.log('hello');
	if(AjxPgeTyp){
		// console.log('hi');
		//$('.ticktLstng').html('<div class="preload_home"><img src="'+$('#loaderImg').val()+'" alt="" /></div>');
		jQuery.ajax({
	        type: 'POST',
	        url: AjxUrl,
	        data: { action: 'InitializationPosts', dataShownTyp: AjxPgeTyp },
	        success: function(data, textStatus, XMLHttpRequest){
	            $('.ticktLstng').html(data);
				$(".cftclick").fancybox({
					'width'				: '75%',
					'height'			: '75%',
					'autoScale'			: false,
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
				});
				$('.cftclick').on('click',function(e){
				  	e.preventDefault();
				  	$('#bookNoWd').html('<div class="preload"><img src="'+$('#loaderImg').val()+'" alt="" /></div>');
				  	//$('#bookNoWd').html('');
				  	var PostId = $(this).attr('PostId');
				  	var PerformanceId = $(this).attr('PerformanceId');
				  	ticketFormInit(AjxUrl, PostId, PerformanceId);
				});
	        },
	        error: function(MLHttpRequest, textStatus, errorThrown){
	            //alert(errorThrown);
	        }
	    });
    }
}
/**/

/*******************************************
	Ticket Form Generation Funtion
*******************************************/
function ticketFormInit(AjxUrl, PostId, PerformanceId){
	jQuery.ajax({
        type: 'POST',
        url: AjxUrl,
        data: { action: 'PostsEvents', PostId: PostId ,PerformanceId: PerformanceId},
        success: function(data, textStatus, XMLHttpRequest){
  			$('#bookNoWd').html(data);
  			rannocaptch = random_number();
			$('.captcha_code_i').text(rannocaptch);
			$('.captcha_orig').val(rannocaptch);
			AllfuncCall(AjxUrl);
        },
        error: function(MLHttpRequest, textStatus, errorThrown){
            //alert(errorThrown);
        }
    });
}
/*******************************************
*******************************************/
function AllfuncCall(AjxUrl){
	$('.captcha_refresh').click(function(e){
		e.preventDefault();
		var gettt = $(this).parent().parent().attr("class");
		rannocaptch = random_number();
		$('.'+gettt).find('.captcha_code_i').text(rannocaptch);
		$('.'+gettt).find('.captcha_orig').val(rannocaptch);
	});
	
	$('.generateranno').each(function(){
		$(this).click(function(){
			getId =$(this).attr('href');
		});
	});
	$('.generateranno').click(function(){
        $('.errormsgdisp').empty();
        $('.errormsgdisp').fadeOut();
		rannocaptch = random_number();
		$('.captcha_code_i').text(rannocaptch);
		$('.captcha_orig').val(rannocaptch);
	});	
	$('.text').attr('disabled','disabled');	
	$('.styled').change(function(){
		var $getClass = $(this).parent().parent().attr("class");
		
		getId = $(this).attr("id");
		getId = $('#'+getId).val()+'_txt';

		$('#'+getId).toggleClass('disT');
		//alert($getClass);
		
		if($('#'+getId).hasClass('disT')){
			$('#'+getId).removeAttr('disabled');
		}
		else{
			$('#'+getId).attr('disabled','disabled');
			$('#'+getId).val('');
		}
		totalvaluecalc($getClass);
	});
	$('.text').keyup(function () { 
		
	    this.value = this.value.replace(/[^0-9\.]/g,'');
		//getNo = parseInt(this.value);
		$getClass = $(this).parent().parent().attr("class");
		totalvaluecalc($getClass);
	});
	$('.submit').click(function(){
		//e.preventDefault();
		valid=true;
	    var err = [];
		counter=0;
		
		//First name Validation
		var firstname = $('#firstname').val();
		if(firstname=='Enter Your First Name' || firstname == '' || firstname == null)
		{
			err.push( "**Please Provide Your Firstname<br>" );
			counter = 1;
			valid=false;
		}

		//Last Name Validation
		var lastname = $('#lastname').val();
		if(lastname=='Enter Your Last Name' || lastname == '' || lastname == null)
		{
	        err.push( "**Please Provide Your Lastname<br>" );
			counter = 1;
			valid=false;
		}

		//Email Id Validation
		var email = $('#emailID').val();
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
	  	if( !mailformat.test( email ) ) {
		    err.push( "**Please Provide Your Correct Email ID <br>" );
	        counter = 1;
	        valid=false;
		} 

		//Mobile Number Verification
		var mobile_number = $('#phoneNo').val();
		if (mobile_number == '' || mobile_number == null || mobile_number =="Enter Your Phone No" || !$.isNumeric(mobile_number))
		{
	        err.push( "**Please Provide Your Correct Mobile No. <br>" );
			counter = 1;
			valid=false;
		}

		total_ticket_cost_text = $('#total-ticket_cost_text').val();
		total_ticket_no_text = $('#total-ticket_no_text').val();
		
		if(total_ticket_cost_text==null || total_ticket_cost_text=='' || total_ticket_no_text==null || total_ticket_no_text=='')
		{
	        err.push( "**Please Provide Total No. of Ticket Division <br>" );
			counter = 1;
			valid=false;
		}

		season_pass = $('input[name=season-pass]:checked').val();
		if(season_pass==null || season_pass=="")
		{
	        err.push( "**Please Provide Season Pass Information. <br>" );
			counter = 1;
			valid=false;
		}

		seating = $('input[name=seating]:checked').val();
		if(seating==null || seating=="")
		{
	        err.push( "**Please Provide Wheelchair Access & seating required Information. <br>" );
			counter = 1;
			valid=false;
		}

		var captcha_text = $('#captcha-textfield').val();
		if(captcha_text==null || captcha_text=='')
		{
	        err.push( "**Please Provide Captcha<br>" );
			counter = 1;
			valid=false;
		}

		if(counter==1)
		{
	        $('.errormsgdisp').empty();
			$('.errormsgdisp').append(err).slideDown("fast");
			valid=false;
		}
		else
		{
			captchaval = $('.captcha_orig').val();
			captchawritten = $('.captcha-textfield').val();
			
			if(captchaval.toLowerCase() == captchawritten.toLowerCase())
			{

				


				//console.log(arr);

				

				// Ajax Function Caling for form Submition
				// formSubmisnAjx(AjxUrl,arr,$('#nwpostid').val(),$('#evnprfnctid').val(),$('#reservation_no').val());

				jQuery.ajax({
			        type: 'POST',
			        url: AjxUrl,
			        data: { 
			        	action: 'SubmitEvents', 
			        	adult : ($('#adult_txt').val()!='' ? $('#adult_txt').val() : 0),
						adult_price : $('#adult_price').val(),
						senior : ($('#senior_txt').val()!='' ? $('#senior_txt').val() : 0),
						senior_price : $('#senior_price').val(),
						child : ($('#child_txt').val()!='' ? $('#child_txt').val() : 0),
						child_price : $('#children_price').val(),
						eventid			      	: $('#nwpostid').val(),
						eventtitle		      	: $('#nwposttitle').val(),
						eventdate		      	: $('#nwdate').val(),
						eventtime			  	: $('#nwtime').val(),
						firstname			  	: firstname,
						lastname			  	: lastname,
						email				  	: email,
						phone 			      	: mobile_number,
						total_ticket_no_text  	: total_ticket_no_text,
						total_ticket_cost_text	: total_ticket_cost_text,
						season_pass  		  	: season_pass,
						purchase 			  	: $('input[name=purchase]:checked').val(),
						seating  			  	: seating,
			        	nwpostid: $('#nwpostid').val(), 
			        	evnprfnctid: $('#evnprfnctid').val(), 
			        	reservation_no: $('#reservation_no').val()
			        },
			        success: function(data, textStatus, XMLHttpRequest){
			  			$('#bookNoWd').html(data);
			  			$('#closeRockaw').click(function(e){
			  				e.preventDefault();
			  				$.fancybox.close( true );
			  			});
			        },
			        error: function(MLHttpRequest, textStatus, errorThrown){
			            //alert(errorThrown);
			        }
			    });
				valid=false;
			}
			else
			{
				rannocaptch = random_number();
				$('.captcha_code_i').empty();
				$('.captcha_code_i').text(rannocaptch); //span
				$('.captcha_orig').val(rannocaptch);  //hidden field
				$('.captcha-textfield').val(''); //wriiten field clear
	                        
				$('.errormsgdisp').empty();
	            $('.errormsgdisp').fadeOut();
				$('.captchaerrormsg').slideDown("fast");
				valid=false;
			}
			//if($('.captcha_orig').val()==
		}
		return valid;
	});
}
function formSubmisnAjx(AjxUrl, submitedData, nwpostid, evnprfnctid, reservation_no){
	
}

function random_number()
	{
		var text = "";
	    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	    for( var i=0; i < 5; i++ )
	        text += possible.charAt(Math.floor(Math.random() * possible.length));
	    return text;
	}
function totalvaluecalc($getClas)
	{
		rt = 0;
		ticketcost = 0;
		
		getLength = $('.'+$getClas).find('.disT').length;
		if(getLength!=0){
		$('.'+$getClas).find('.disT').each(function(){
			textval = isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
			ticketval = isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
			
			if($(this).hasClass('ad'))
			{
				adultprice = parseInt($('.'+$getClas).find('.adult_price').val());
				ticketval = ticketval * adultprice;	
			}
			if($(this).hasClass('sn'))
			{
				seniorprice = parseInt($('.'+$getClas).find('.senior_price').val());
				ticketval = ticketval * seniorprice;	
			}
			if($(this).hasClass('ch'))
			{
				childrenprice = parseInt($('.'+$getClas).find('.children_price').val());
				ticketval = ticketval * childrenprice;	
			}
			rt = rt + textval; 
			ticketcost = ticketcost + ticketval;
			
			$('.total-ticket_no').empty();
			$('.total-ticket_no').text(rt);
			$('.total-ticket_no_text').val(rt);
			$('.total-ticket_cost').empty();
			$('.total-ticket_cost').text('$'+ticketcost);
			$('.total-ticket_cost_text').val(ticketcost);	
		});
		}
		else{
			$('.total-ticket_no').empty();
			$('.total-ticket_no').text(0);
			$('.total-ticket_cost').empty();
			$('.total-ticket_cost').text('$0');
			$('.total-ticket_no_text').val(0);
			}
	}

