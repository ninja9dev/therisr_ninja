@extends('user.layouts.app')

@section('content')

    <div class="forgot-content freelancer-signup signpdt">
        <form method="POST" action="{{ route('register') }}" name="registration">
        @csrf
         @if(empty($data['provider']))
          <div class="container step1">
             <div class="row">
                <div class="col-sm-12 p-0">
                   <h1 class="text-center">Get started with The Risr</h1>
                   <h2 class="this-is-a-paradise-f">This is a paradise for talented people to <br>work together. </h2>
                </div>
             </div>
             <div class="forgot-form-cont text-center siginpd-respons">
                <div class="row">
                   <div class="col-sm-12 p-0">                
                        <div class="form-group">
                            <div class="dinline">
                                <input id="name" type="text" class="form-control wd-309 mx-auto @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="dinline">
                                <input id="email" type="email" class="form-control wd-309 mx-auto @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Work Email Address">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="dinline">
                                <input id="password" type="password" class="form-control wd-309 mx-auto @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="dinline">
                                <input type="password" class="form-control wd-309 mx-auto" name="password_confirmation" 
                                id="exampleInputEmail12" aria-describedby="emailHelp" placeholder="Re-enter Password" required>
                            </div>
                        </div>
                        <div class="signin-btn mb-3">
                            <a href="javascript:void(0);" type="button" class="btn btn-primary buttonClick" onclick="showStep('step2')">Continue</a>
                        </div>
                    
                      <p>No credit card required. Secure site</p>
                      <h3>Already have an account? <a href="{{ route('login') }}">Sign in here</a></h3>
                   </div>
                </div>
             </div>
          </div>
         @endif
          <div class="container almost-done step2" style="  @if(empty($data['provider'])) display: none; @endif">  
             <div class="row">
                <div class="col-sm-12 p-0">
                   <h1 class="text-center dan-almost-done"> @if(!empty($data['name'])) {{$data['name']}} @else 'Hi' @endif, almost done! </h1>
                </div>
             </div>
             <div class="forgot-form-cont text-center">
                <div class="row">
                    <div class="col-sm-12 p-0">
                        <div class="col-md-4 offset-md-4 col-sm-4 offset-sm-4">
                          @if(!empty($data['provider']) && (empty($data['email']) || ($data['email'] == $data['provider_id'].'noemail@gmail.com')) )
                            <div class="form-group">
                                <div class="dinline">
                                    <input id="email" type="email" class="form-control wd-309 mx-auto" 
                                    name="email" value="{{ old('email') }}" required autocomplete="email" 
                                    placeholder="Work Email Address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                          @elseif(!empty($data['email']) && ($data['email'] != $data['provider_id'].'noemail@gmail.com')) 
                          <input type="hidden" name="emaillinkedin" value="autoverify">
                          <input type="hidden" name="email" value="{{!empty($data['email']) ? $data['email'] : '' }}">
                          @endif
                      @if(!empty($data['provider']))
                      <input type="hidden" name="name" value="{{!empty($data['name']) ? $data['name'] : '' }}">
                      <input type="hidden" name="provider" value="{{!empty($data['provider']) ? $data['provider'] : '' }}">
                      <input type="hidden" name="provider_id" value="{{!empty($data['provider_id']) ? $data['provider_id'] : '' }}">
                      <input type="hidden" name="password" value="dummy@123"/>
                      <input type="hidden" name="password_confirmation" value="dummy@123"/>
                     @endif

                            <div class="form-group">
                               <select class="form-control select2" name="country"
                                    id="country" style="width: 100%">
                                    @foreach( $countries as $row )
                                    <option value="{{$row->id}}"
                                        {{ ( old('country') == $row->id )? 'selected' : '' }}>
                                        {{$row->country_name}}
                                    </option>
                                    @endforeach
                                     @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </select>
                            </div> 
                        </div>  
                        <input type="hidden" name="user_type" value="1" id="user_type">
                        <a class="left-side misc-field user_type_box activeexp" href="javascript:void(0);" onclick="userType(this,'1');">I am a Freelancer</a>
                        <a class="right-side misc-field mr-0 user_type_box" href="javascript:void(0);" onclick="userType(this,'2');">I am a Employer</a>
                        <div class="main-tab">
                            <span>
                                <label class="cont">
                                    <input type="checkbox" name="checkbox" required="required" id="checkbox">
                                    <span class="checkmark"></span>
                                </label>    
                            </span>
                            <p class="text-left">
                                By creating an account, you agree to <br><a href="https://www.therisr.com/tos">TheRisr Terms of Service</a> & <a href="https://www.therisr.com/privacy-policy">Privacy Policy. </a>
                            </p>
                            <span class="checkbox-error error" style="display: none;">Required!</span>
                        </div>
                     <div class="signin-btn mb-3">
                            <button type="submit" class="btn btn-primary" onclick="return showStep('step1');">Create Account</button>
                     </div>
                   </div>
                </div>
             </div>  
          </div>
        </form>
    </div>
    <script>
        function showStep($class='step2'){
            if($class == 'step2')
            {
              $('.dan-almost-done').html($("input[name='name']").val() + ', almost done!');
               $('.'+$class).show();
               $('.step1').hide();
            }else{
               $('.'+$class).show();
               $('.step2').hide(); 
            }
        }
        function userType(thisv, $val=1){
          $('.user_type_box').removeClass('activeexp');
          $(thisv).addClass('activeexp');
          $('#user_type').val($val);
        }
     
        // multi select
       $('#country').select2({
           placeholder: "Select country",
           //maximumSelectionLength: 1
       });





$(function() { 
   $("form[name='registration']").validate({
    // Specify validation rules
    rules: { 
      name: "required",
      email : {
        required : true  
      }, 
      password: {
          required: true,
          maxlength: 12,
          minlength: 8
      },
      password_confirmation : {
          required: true,
          equalTo : "#password"
      },
      checkbox: {
        required : true
      }
    },  
    // Specify validation error messages
    messages: {
      name: "Please enter your full name.",
      email: {
        required : "Please enter your work email."
      },
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
         if ($("#checkbox").prop("checked") == true) {
             $('.checkbox-error').hide();
             showScreenLoader('Please wait a moment!');
            form.submit();
        }else{
          $('.checkbox-error').show();
          showStep('step2');
        }
     }
  });

});

</script>

@endsection
