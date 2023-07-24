var base_url = $('#base').data('base')


// product enquiry

	$('form#product_enquiry_form').submit(function(e){
		e.preventDefault();
		var form = $(this);
		$.ajax({
			url:base_url+'send_product_enquiry',
			type:"POST",
			data:form.serialize(),
			beforeSend:function(){
				$('.pro_enquiry').html('Processing...');
			},
			success:function(data){
			    
				var obj = JSON.parse(data);
				if (obj.status==1) {
					$('.pro_enquiry').html('Submited');
					toastr.success(obj.msg);
					$('form#product_enquiry_form')[0].reset();
					$('.popup-close').click().fadeOut(1000);
				}else{
					$('.pro_enquiry').html('Submit');
				
					var set_v ='';
					if (obj.name) {
						set_v = obj.name;
					}
					if (obj.p_id) {
						set_v = obj.p_id;
					}
					if (obj.email) {
						set_v = obj.email;
					}

					if (obj.phone) {
						set_v = obj.phone;
					}

					if (obj.msg) {
						set_v = obj.msg;
					}

					toastr.error(set_v);
				}
			}
		});
	});

////////////////////

// Reviews
$('form#review_form').submit(function(e){
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url:base_url+'send_review',
        type:"POST",
        data:form.serialize(),
        beforeSend:function(){
            $('#reviewbtn').html('submitting..');
        },
        success:function(data){
            if (data) {
                $('form#review_form')[0].reset();
                 $('#reviewbtn').html('Add A Review');
                toastr.success('Review Submitted success');
                $('.close').click();
            }else{
                toastr.error('Something Getting Wrong Please Retry');
            }
        }
    });
})




///////////////////

// subscribe

$('form#subscribe').submit(function(e){
    var form = $(this);
    e.preventDefault();
    $.ajax({
      url:base_url+'subscribe',
      type:"POST",
      data:form.serialize(),
      success:function(data){
        var obj = JSON.parse(data);
        if (obj.status==1) {
          $('form#subscribe')[0].reset();
          toastr.success('Thanks for subscribing');
        }else{
          toastr.error(obj.msg);
        }
      }
    });
  });
  
 
//////////////

// Search
function search(){
var keyword = $('#search_top').val();
  if (keyword.length >2) {
    $.ajax({
      url:base_url+'search_result', 
      type:"POST",
      data:{keyword:keyword},
      success:function(data){
         
        if(data){
            $('#search_result').html(data);
        }else{
          $('#search_result').html('');  
        }
        
      }
    });
  }else{
    $('.search_result').html('');    
  }
  
}

/////////////////

  $('form#contact_form').submit(function(e){
    var form = $(this);
    e.preventDefault();
    $.ajax({
      url: base_url+'send_enquiry',
      type:"POST",
      data:form.serialize(),
      success:function(data){
        var obj = JSON.parse(data);
        if (obj.status==1) {
          toastr.success(obj.msg);
          $('form#contact_form')[0].reset();
        }else{
          var set_v = '';
          if (obj.email) {
            set_v = obj.email;
          }
          if (obj.phone) {
            set_v = obj.phone;
          }
           if (obj.msg) {
            set_v = obj.msg;
          }
         if (obj.honeyport) {
            set_v = obj.honeyport;
          }
          toastr.error(set_v);
        }
      }
    });
  });



///////////

// CAreer

$('form.career_form').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
         $.ajax({
            type:'POST',
            url: base_url+'save_job',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
              $('.care_btn').html('Processing...');
            },
            success:function(data){
                var obj =JSON.parse(data);
                if(obj.status==1){
                    $('.care_btn').html('Applied');
                    $('form.career_form')[0].reset();
                    toastr.success(obj.msg);
                    $('.popup-close').click();
                    location.reload();
                    
                }else{
                     $('.care_btn').html('Submit');
                    var set =''
                    if(obj.name){
                        set = obj.name;
                    }
                     if(obj.email){
                        set = obj.email;
                    }
                     if(obj.phone){
                        set = obj.phone;
                    }
                     if(obj.msg){
                        set = obj.msg;
                    }
                    
                     toastr.error(set);
                }
               
            }
     });
  });


///////////

// User Registration 

$('form#user_signup').submit(function(e){
    e.preventDefault();
var missing =0;

$(this).find('.required').each(function(){
  if ($(this).val().length <1 || $(this).val()=='') {
    $(this).addClass('nofillout');
    missing++;
  
  }
});

$('.nofillout').each(function(){
  if ($(this).val().length >1) {
    $(this).removeClass('nofillout');
  }
});

if (missing >=1) {
   toastr.error('Please Fill All Requird Field');
  return false;
}

var password = $('input[name="password"]').val();
var cpassword = $('input[name="cpassword"]').val();

if(password != cpassword){
toastr.error('Password and confirm password do not match');
  return false;
}


    var form = $(this);
    $.ajax({
      url: base_url+'save_user_registration',   
      type:"POST",
      data:form.serialize(),
      beforeSend:function(){
        $('#btn_reg').html('Processing...');
      },
      success:function(data){alert(data);
        var obj = JSON.parse(data);
        if(obj.status==1){
            toastr.success(obj.msg);
            window.location.href= 'user';
        }else{
            var set_v = '';
            if(obj.email){
                set_v = obj.email;
            }
             if(obj.msg){
                set_v = obj.msg;
            }
            
            toastr.error(set_v);
        }
      },
      complete:function(){
       $('#btn_reg').html('Sign up');
      }
    });
  });






//lgoin

$('form#user_login').submit(function(e){
    e.preventDefault();
    var form = $(this);
    $.ajax({
	  url: base_url+'user_login',	
      type:"POST",
      data:form.serialize(),
      beforeSend:function(){
        $('#btn_login').html('Processing...');
      },
      success:function(data){
        var obj = JSON.parse(data);
        if(obj.status==1){
            toastr.success(obj.msg);
            window.location.href= 'user';
        }else{
            var set_v = '';
            if(obj.email){
                set_v = obj.email;
            }
             if(obj.msg){
                set_v = obj.msg;
            }
            
            toastr.error(set_v);
        }
      },
      complete:function(){
       $('#btn_login').html('Login');
      }
    });
  });

//end login










// general validation

$(".isnumber").on("keypress keyup blur",function (event) {    
$(this).val($(this).val().replace(/[^\d].+/, ""));
if ((event.which < 48 || event.which > 57)) {
    event.preventDefault();
    return false;
}
});  


$('.txtOnly').keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z ]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      }
      else
      {
      e.preventDefault();
      return false;
      }
    });
    
$('.address').keypress(function (e) {
      var regex = new RegExp("^[a-zA-Z0-9-/, ]+$");
      var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
      if (regex.test(str)) {
        return true;
      }
      else
      {
      e.preventDefault();
      return false;
      }
    });    
    
    
 $('.copypeste').on("cut copy paste",function(e) {
      e.preventDefault();
   });
   
//  end validation
