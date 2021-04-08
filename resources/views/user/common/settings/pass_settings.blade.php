
@extends('user.layouts.main')

@section('content')
     
<div class="container">

        <div class="row mt-50">

                 @include('user.common.settings.sidebar')

            <div class="col-lg-9 col-md-8 col-sm-8 set">
				<div class="head">
					<p class="setting">Settings<span class="slash">/</span>
						<span class="general">Password</span>
					</p>
				</div>
				
				<form name="password_change" class="editForm" method="POST" 
				    action="{{ route('user.pass_update', ['id' => Auth::user()->id])}}" >
				    	@csrf
					<div class="form seting-pswd frm-psd-mb">
						@if($user->provider != '' && $user->setpassword == 'no')
						<input type="hidden" name="cpass" value="{{ $user->password }}">
						@else
						<div class="form-group">
							<div class="row">
								<div class="col-xl-3">
									<label for="name" class="label1">Current Password</label>
								</div>
								<div class="col-xl-6">
							        <input type="password" class="form-control pull-left" name="cpass" placeholder="Current Password"
							         value="{{ old('cpass') }}">
								</div>
							</div>
						</div>
						@endif
						<div class="form-group">
							<div class="row">
								<div class="col-xl-3">
									<label for="exampleInputEmail1">New Password</label>
								</div>
								<div class="col-xl-6">
									<input type="password" class="form-control pull-left" placeholder="New Password" name="password"
									value="{{ old('password') }}" id="newpassword">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xl-3">
									<label for="username">Confirm Password</label>
								</div>
								<div class="col-xl-6">
									<input id="password-confirm" type="password" class="form-control pull-left"
								     name="password_confirmation" placeholder="Confirm Password" 
								     value="{{ old('password_confirmation') }}">
								</div>
							</div>
						</div>
						<div class="form-group mt-4 " style="">
							<div class="row">
								<div class="col-xl-3">
								</div>
								<div class="col-xl-6 col-lg-10">
									<div class="savewidth">
										<button  type="submit" class="btn rectangle pull-left">Save New Password</button>
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
	$(function() { 
  	$("form[name='password_change']").validate({
    // Specify validation rules
    rules: {
		cpass: "required",
		password: {
	        required: true,
	        maxlength: 12,
	        minlength: 8
	    },
	    password_confirmation : {
            required: true,
	        equalTo : "#newpassword"
	    }
    },
    // Specify validation error messages
    messages: {
		cpass: "Please enter your old password",
		password: {
	        required: "Please enter your new password",
	        maxlength: "Your password should not be more than 12 character",
	        minlength: "Your password should not be less than 8 character"
      },
	  password_confirmation:{
	  	required : "Please re-enter the above password",
	  	equalTo: "Confirm password should match with new password.",
	  } 
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endsection