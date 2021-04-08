
@extends('user.layouts.main')

@section('content')
     
<div class="container"> 
        <div class="row mt-50">
                 @include('user.common.settings.sidebar')
          
			<div class="col-lg-9 col-md-8 col-sm-8 set">
				<div class="head">
					<p class="setting">Settings<span class="slash">/</span>
						<span class="general">General</span>
					</p>
				</div>

				<form class="genSettingsForm frm-bord"  method="POST"  name="genSettingsForm"
				    action="{{ route('user.gen_update', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
				    	@csrf
				    	<input type="hidden" name="userType" value="{{ @$user->user_type  }}"/>
					<div class="form">
						<div class="genrl-profile-img">
                           <div class="image-box">
	                            @php
	                               if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
	                               else $image =  asset('assets/users/default.jpg'); 
	                            @endphp

	                              <img id="profiePreview" class="img-preview" src="{{ $image }}">
	                               <div class="overlay-edit" 
	                                    onclick="document.getElementById('profileImage').click()">
	                                   <label>
	                                    <i class="fa fa-pencil"></i></label>
	                                   <input type="file" name="profileImage" id="profileImage" accept="image/*">
	                              </div>
                            </div>
						</div>					
						<div class=" form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="name" class="label1">Name</label>
								</div>
								<div class="col-xl-6">
									<input type="text" class="form-control t1" name="name"
									 value="{{ Auth::user()->name }}">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="email">Email</label>
								</div>
								<div class="col-xl-6">
									<input type="email" class="form-control" 
									value="{{ Auth::user()->email }}" name="email">
								</div>
							</div>
						</div>
						<div class="area-1">
							<div class="form-group">
								<div class="row">
									<div class="col-xl-12">
										<label for="username">Where does your company located? </label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xl-3">
										<label for="username">City</label>
									</div>
									<div class="col-xl-6">
										<input type="text" class="form-control"  name="city" placeholder=""  
                                          value="{{ !empty($user->userEmpProfile['city'] ) ? $user->userEmpProfile['city']  : ''}}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xl-3">
										<label for="username">Country</label>
									</div>
									<div class="col-xl-6">
									    <div class="dropdown drop-show-all emply-drop-bg">
										  <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											  {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
										  </button>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row spt">
									<div class="col-xl-3"></div>
									<div class="col-xl-6 spt">
										<p class="note text-right">Need to change the country? <a href="javascript:void(0)">Contact us</a></p>
									</div>
								</div>
							</div>
						</div>
						<div class="area-1">
							<div class="form-group">
								<div class="row">
									<div class="col-xl-12">
										<label for="username">Company detail </label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xl-3">
										<label for="username">Company Name</label>
									</div>
									<div class="col-xl-6">
										<input type="text" class="form-control" name="company_name" value="{{ !empty($user->userEmpProfile['company_name'] ) ? $user->userEmpProfile['company_name']  : ''}}" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xl-3">
										<label for="username">Website (optional)</label>
									</div>
									<div class="col-xl-6">
										<input type="text" class="form-control" name="website" value="{{ !empty($user->userEmpProfile['website'] ) ? $user->userEmpProfile['website']  : ''}}"
										 onkeyup="isUrlValid(this, 'website');" >
                                       <span class="error help-block" style="display: none;">Please enter a valid website URL.</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-xl-3">
										<label for="username">Phone (optional)</label>
									</div>
									<div class="col-xl-6">
										<input type="hidden" name="phone_Code" id="phone_Code" 
										value="{{ !empty($user->userEmpProfile['phone_Code'] ) ? $user->userEmpProfile['phone_Code']  : ''}}" />

										 <input id="phonenumber"
                                            class="form-control @error('phone') is-invalid @enderror" 
                                            type="tel" name="phone" autocomplete="off" 
                                            value="{{ !empty($user->userEmpProfile['phone'] ) ? $user->userEmpProfile['phone']  : ''}}"
                                            ata-parsley-minlength="10" data-parsley-maxlength="15"
                                            data-parsley-minlength-message="Your phone number must have atleast 10 characters">
                                        <span id="valid-msg" class="hide"></span>
                                        <span id="error-msg" class="hide text-danger"></span>
                                        <div class="fv-plugins-message-container"></div>
									</div>
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="row">
									<div class="col-xl-3">
										<label for="username">Timezone</label>
									</div> 
									<div class="col-xl-6"> 
										<select class="form-control select2" name="timezone"
		                                    id="timezone" style="width: 100%">
		                                    @foreach( $timezones as $row )
		                                    <option value="{{$row->id}}"
		                                        {{ ( !empty($user->userEmpProfile['timezone'] ) && $user->userEmpProfile['timezone'] == $row->id ) 
		                                           ? 'selected' : '' }}>
		                                        {{ $row->diff_from_gtm .' ('.$row->timezone_name .')'}}
		                                    </option>
		                                    @endforeach
		                                </select>
									</div>
								</div>
							</div>	
						<div class="form-group btn-sec-employ mt-4 mb-3 dis">
							<div class="row">
								<div class="col-xl-12">
									<button type="submit" class="btn btnrectangle submitButton">Save changes</button>
									<!-- <button type="button" class="btn btncancel gray-color">Cancel</button> -->
								</div>
							</div>
						</div>							
						</div>

					</div>
				</form>
			</div>

		</div>
	</div>  
	  

@endsection
@section('footer') 
<script>
	
	function readURL(input) {
	   // Allowing file type 
	   var filePath = input.value; 

	   var allowedExtensions =  
	           /(\.jpg|\.jpeg|\.png)$/i; 
	     console.log('f '+ filePath);
	   if (!allowedExtensions.exec(filePath)) { 
	         $.toast({
	             heading: 'Error',
	             text:'Invalid file type.',
	             showHideTransition: 'slide',
	             icon: 'error'
	         });
	       fileInput.value = ''; 
	       return false; 
	   }else  
	   {
	     if (input.files && input.files[0]) {
	      var reader = new FileReader();
	       reader.onload = function(e) {
	         $('#profiePreview').attr('src', e.target.result);
	         $('.topProfile-image').attr('src', e.target.result);
	       } 
	       
	       reader.readAsDataURL(input.files[0]); // convert to base64 string
	     }
	   }
	}

	$("#profileImage").change(function() {
	  readURL(this);
	});


   // professionalForm
   $("form[name='genSettingsForm'").validate({
      rules: {  
      name: "required",
      email: "required",
      city: "required",
      company_name: "required"
    },  
    submitHandler: function(form) {
        showScreenLoader();
        var formData = new FormData($("form[name='genSettingsForm'")[0]);
	       $.ajax({
	            url: form.action,
	            type: form.method,
	            data: formData,
	            dataType: 'JSON',
	            cache:false,
	            contentType: false, 
	            processData: false,
	            success: function(response) {
	               $.toast({
	                   heading: 'Success',
	                   text: response.message,
	                   showHideTransition: 'slide',
	                   icon: 'success'
	               })
	               hideLoader();
	            }            
	        });
	       return false; // <- last item inside submitHandler function
     }
   });


       $('#timezone').select2({
           placeholder: "Select Timezone",
           //maximumSelectionLength: 1
       });


	function isUrlValid(thisv, urltype) {

	  var input = $(thisv).val();
	  var valid = true;
	   if(urltype == 'website')
	   {
	     var valid = /^(http:\/\/www\.|https:\/\/www\.|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(input);
	   }else{

	   }

	   if(valid  || input == ''){
	       $(thisv).parent().find('span.error').hide();
	       $('.submitButton').removeAttr('disabled');
	       console.log("valid url");
	   } else {
	      $(thisv).parent().find('span.error').show();
	      $('.submitButton').attr('disabled', 'disabled'); 
	       console.log("invalid url");
	   }
	}

</script>

<script>
    var input = document.querySelector('#phonenumber'),
    errorMsg = document.querySelector("#error-msg"),
  validMsg = document.querySelector("#valid-msg");

  // here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
 
    var iti  = window.intlTelInput(input, {
    utilsScript:'assets/js/utils.js?1590403638580',
    nationalMode:true, 
    initialCountry: "{{ !empty($user->userEmpProfile['phone_Code'] ) ? $user->userEmpProfile['phone_Code']  : 'auto'}}",
    geoIpLookup: function(success) {
      // Get your api-key at https://ipdata.co/
      fetch("https://api.ipdata.co/?api-key=test")
        .then(function(response) {
          if (!response.ok) return success("+44");
          return response.json();
        })
        .then(function(ipdata) {
        	console.log('c '+ipdata.country_code);
          success(ipdata.country_code);
        });
    },
   separateDialCode:true
    
  });

  var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
  var codeInit =  $('.iti__selected-dial-code').html();
  var attrCon_code = $('.iti__selected-flag').attr('aria-activedescendant');
  attrCon_code = attrCon_code.replace("iti-0__item-", ""); 
  //input.setCountry = attrCon_code;
  $('#phone_Code').val(attrCon_code);
};

// on blur: validate
input.addEventListener('blur', function() {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
        //input.value = iti.getNumber();
      validMsg.classList.remove("hide");
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

// set number to field
input.value = "{{ !empty($user->userEmpProfile['phone'] ) ? $user->userEmpProfile['phone']  : ''}}";
</script>


@endsection