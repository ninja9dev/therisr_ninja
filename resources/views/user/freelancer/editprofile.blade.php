
@extends('user.layouts.main')

@section('content')

<style type="text/css">
 
</style>
 @php
 $r_image = false; $style = '';
    if(@$user->userProfile['background_image'] != ''){
        $b_image =  asset('assets/users_cover').'/'.@$user->userProfile['background_image']; 
        $r_image = true;
        $style="background-image: url(".$b_image.");";
    }

@endphp
<div class="raev-baner-bg landing-page text-center" id="coverPreview" style="{{ $style  }}">
   <div class="container">
      @if(empty(@$user->userProfile) || (@$user->userProfile->services == null  && @$user->userProfile->skills == null ) ) 
         <p class="pos-erroe">
            <span class="error-msgs"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> You need to complete the profile. 
               <i class="fa fa-close closeAlert" aria-hidden="true"></i> </span>
         </p>
      @endif

      <div class="row">
         <div class="col-sm-12">
            <label for="img-str" class="btm-drgs">
               <!-- <input type="file" id="img-str" style="width:0px; height:0px; opacity:0; visibility:hidden;" /> -->
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle select-p" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="{{ asset('assets/users_cover/uploadimage.png') }}">
                     <h4>Add Background Image</h4>
                     <p>Recommended image size 2560x1440</p>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form name="cover_profile" enctype="multipart/form-data">
                        @csrf
                     <input type="file" name="coverImage" id="coverImage" accept="image/*"
                      style="display: none;">
                      <input type="hidden" name="coverImageHidden" id="coverImageHidden" value="add">
                    </form>

                     <a class="dropdown-item editmesge" href="javascript:void(0);" 
                       onclick="document.getElementById('coverImage').click()">Upload Image</a>

                     @if($r_image)
                     <a class="dropdown-item messgedelete" href="javascript:void(0);" 
                       onclick="removeCoverImage();">Remove Image</a>
                     @endif
                  </div>
               </div>
            </label>
         </div>
      </div>
   </div>
</div>
<div class="profile-info-btn">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <a href="{{ route('/') }}" type="submit" class="btn btn-primary">Exit Editing
            </a>
         </div>
      </div>
   </div>
</div>
<div class="profile-info">
   <div class="paddin-btms">
      <div class="container">
         <div class="padding-ser">
            <div class="row">
               <div class="col-xl-3 col-lg-4 col-md-5 col-sm-8 col-10 offset-md-0  offset-sm-2 offset-1">
                  <div class="inner-profile text-center">
                     <form name="user_profile" enctype="multipart/form-data">
                        @csrf
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
                     </form>

                     <h3>{{ Auth::user()->name }}</h3>
                     <h4>{{ !empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '' }}</h4>
                     <h5> <span class="icon-location"><img src="{{ asset('assets/img/location.png')}}"></span>
                        {{ !empty($user->userProfile['city']) ? $user->userProfile['city'] : '' }}{{ (!empty($user->userProfile['city']) && !empty($user->countryName['country_name'])) ? ', ' : ''}}
                        {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
                     </h5>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-8 col-md-7">
               
                  <div class="inner-txt-cont profilrmrt">
                     <div class="accordion tabs-fll-w" id="accordionExample">
                     <form class="personalForm" method="POST" name="personalForm">
                        @csrf
                        <div class="card">
                           <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                 <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                 Personal Info
                                 </button>
                              </h2>
                           </div>
                           <div id="collapseOne" class=" collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                 <div class="padding-srt">
                                    <div class="row">
                                       <div class="col-md-12 mb-3">
                                          <label class="tbl-st"> Your title(s) </label>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-xl-5">
                                          <label class="tbl-st"> Primary title </label>
                                       </div>
                                       <div class="col-xl-7 inp">
                                          <input type="text" id="primaryTitle" class="form-control wd-309"  placeholder=""
                                          name="prim_title" value="{{ !empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '' }}">
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-xl-5">
                                          <label class="tbl-st"> Secondary title </label>
                                       </div>
                                       <div class="col-xl-7 inp">
                                          <input type="text" class="form-control wd-309" id="secondaryTitle" placeholder=""
                                           name="sec_title"  value="{{ !empty($user->userProfile['sec_title']) ? $user->userProfile['sec_title'] : '' }}">
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <label class="tbl-st"> Write a professional overview </label>
                                       </div>
                                       <div class="col-md-12">
                                          <textarea class="form-control autoHightTextarea" rows="5" id="overview" name="overview" maxlength="544" onkeyup="return isLimitValidate(this);" >{{ !empty($user->userProfile['overview']) ? $user->userProfile['overview'] : '' }}</textarea>
                                          <span class="chara-data" id="overview_limit"> 544 characters left</span>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <label class="tbl-st">Your experience level? </label>
                                       </div>
                                       <div class="col-md-12">
                                         <input type="hidden" name="exp_level" value="{{ !empty($user->userProfile['exp_level']) ? $user->userProfile['exp_level'] : '' }}" 
                                         id="exp_level">
                                          <a class="left-side misc-field exp_level_w 
                                          {{ (!empty($user->userProfile['exp_level']) && $user->userProfile['exp_level'] == 1) ? 'activeexp' : '' }} "
                                           href="javascript:void(0)"  onclick="exp_level(this,'1');">
                                          Entry Level</a>
                                          <a class="left-side misc-field exp_level_w
                                          {{ (!empty($user->userProfile['exp_level']) && $user->userProfile['exp_level'] == 2) ? 'activeexp' : '' }} "
                                           href="javascript:void(0)"  onclick="exp_level(this,'2');">
                                          Advanced</a>
                                          <a class="left-side misc-field exp_level_w 
                                          {{ (!empty($user->userProfile['exp_level']) && $user->userProfile['exp_level'] == 3) ? 'activeexp' : '' }} " 
                                          href="javascript:void(0)"  onclick="exp_level(this,'3');">
                                          Expert</a>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <label class="tbl-st">When did you start your career? </label>
                                       </div>
                                       <div class="col-lg-3 col-md-5">
                                          <select class="form-control" name="start_year">
                                             <option value="">Year</option>
                                                @for($i= date('Y'); $i >= (date('Y')-50); $i--)
                                                <option class="dropdown-item" 
                                                  {{ (!empty($user->userProfile['start_year']) && $user->userProfile['start_year'] == $i) ? 'selected="selected"' : '' }} >
                                                   {{ $i }}
                                                </option>
                                                @endfor
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12 p-0">
                                          <div class="hr-bot-line"></div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <label class="tbl-st new-mt mt-15">Your Hourly Rate </label>
                                       </div>
                                    </div>
                                    <div class="row mb-2">
                                       <div class="col-lg-5">
                                          <label class="tbl-st"> Hourly Rate </label>
                                       </div>
                                       <div class="col-lg-7">
                                          <div class="dropdown drop-show-all diff-drop">
                                             <div class="input-group mb-0">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text dollar">
                                                   <img src="{{ asset('assets/img/dollar.png')}}">
                                                   </span>
                                                </div>
                                                <input type="rate" name="hourly_rate" class="form-control rate text-align-end" placeholder="00.00"
                                                   onkeypress="return isAmountValidate(event,this);"  
                                                   onfocusout="return calculateFee('hourly_rate','{{ $settings->service_fee }}');" 
                                                   min="0.02" max="99.99"    data-maxamount="99.99"
                                                   onchange="validateFloatKeyPress(this);"
                                                   value="{{ !empty($user->userProfile['hourly_rate']) ? $user->userProfile['hourly_rate'] : '' }}"
                                                   id="hourly_rate"
                                                    >
                                                  <span class="help-block invalid-feedback"></span>
                                             </div>
                                          </div>
                                          <span class="main-sp">/hr</span>	
                                       </div>
                                    </div>
                                    <div class="row mb-2"> 
                                       <div class="col-lg-5">
                                          <label class="tbl-st">  {{ $settings->service_fee }}% {{ $settings->app_name }} Service Fee</label>
                                       </div>
                                       <div class="col-lg-7">
                                          <div class="dropdown drop-show-all diff-drop no-border">
                                             <button class="btn dropdown-toggle btn-sel" type="button" >
                                                <p id="calculatedFee">	00.00</p>
                                             </button>
                                          </div>
                                          <span class="main-sp">/hr</span>	
                                       </div>
                                    </div>
                                    <div class="row mb-2">
                                       <div class="col-lg-5">
                                          <label class="tbl-st">You’ll Receive</label>
                                       </div>
                                       <div class="col-lg-7">
                                          <div class="dropdown drop-show-all diff-drop">
                                             <button class="btn dropdown-toggle btn-sel disabled" type="button" id="dropdownMenuButton">
                                                <p id="receiveAmt">  00.00</p>
                                             </button>
                                          </div>
                                          <span class="main-sp">/hr</span> 
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12 p-0">
                                          <div class="hr-bot-line"></div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <label class="tbl-st mt-15">Your English proficiency? </label>
                                       </div>
                                       <div class="col-md-12">
                                          <select class="form-control" name="english_prof">
                                             <option value="">Select your proficiency</option>
                                             <option value="native"
                                               {{ (!empty($user->userProfile['english_prof']) && $user->userProfile['english_prof'] == 'native') ? 'selected="selected"' : '' }}>
                                                Native or Billingual</option>
                                             <option value="fluent"  
                                               {{ (!empty($user->userProfile['english_prof']) && $user->userProfile['english_prof'] == 'fluent') ? 'selected="selected"' : '' }}>
                                                Fluent</option>
                                             <option value="conversational"
                                              {{ (!empty($user->userProfile['english_prof']) && $user->userProfile['english_prof'] == 'conversational') ? 'selected="selected"' : '' }}>
                                              Conversational</option>
                                          </select>
                                          <!--<div class="dropdown drop-show-all mb-3 wd-309 land-cust-drop">
                                             <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Select your proficiency
                                             </button>
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Native or Billingual</a>
                                                <a class="dropdown-item" href="#">Fluent</a>
                                                <a class="dropdown-item" href="#">Conversational</a>
                                             </div>
                                          </div>-->
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12 p-0">
                                          <div class="hr-bot-line"></div>
                                       </div>
                                    </div>
                                    <div class="row mt-3">
                                       <div class="col-md-12">
                                          <label class="tbl-st new-mt">Where do you live?  </label>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <label class="tbl-st"> City </label>
                                       </div>
                                       <div class="col-lg-6 inp">
                                          <input type="text" class="form-control" name="city" placeholder=""  
                                          value="{{ !empty($user->userProfile['city'] ) ? $user->userProfile['city']  : ''}}">
                                       </div>
                                    </div>
                                    <div class="row bg-col-chng">
                                       <div class="col-lg-6">
                                          <label class="tbl-st"> Country </label>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="dropdown drop-show-all">
                                             <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <p class="text-center mb-1">Need to change the country?
                                  <a class="color-green" href="{{ !empty($settings->help_link) ? $settings->help_link : '' }}"
                                    target="_blank"> Contact us</a>
                                 </p>
                                 <div class="col-sm-12 p-0 save-btn-lg">
                                    <button type="submit" class="btn btn-primary btnSubmit">Save changes</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                     <form class="professionalForm" method="POST" name="professionalForm">
                      @csrf
                        <div class="card">
                           <div class="card-header" id="headingTwo" onclick="closePrevious('headingOne');">
                              <h2 class="mb-0">
                                 <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                 Professional Experience
                                 </button>
                              </h2>
                           </div>
                           <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body"> 
                                 <div class="padding-srt">
                                    <div class="row mb-3">
                                       <div class="col-md-12">
                                          <label class="tbl-st">What service(s) do you offer? </label>
                                       </div>
                                       <div class="col-md-12 inp">
                                          <?php $user_services =  !empty($user->userProfile['services'] ) ? explode(',',$user->userProfile['services']) : array(); ?>
                                          <select class="form-control select2" name="services"  id="services"
                                           multiple style="width: 100%">
                                             <option value=""></option>
                                             @foreach($services as $service)
                                              <option value="{{ $service->id }}" 
                                                {{ in_array( $service->id, $user_services) ? 'selected="selected"'  : ''}} >{{ $service->name }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <div class="col-md-12">
                                          <label class="tbl-st">Work skills do you have? </label>
                                       </div>
                                       <div class="col-md-12 inp">
                                          <?php $user_skills =  !empty($user->userProfile['skills'] ) ? explode(',',$user->userProfile['skills']) : array(); ?>
                                          <select class="form-control select2" name="skills"  id="skills"
                                           multiple style="width: 100%">
                                             <option value=""></option>
                                             @foreach($skills as $skill)
                                              <option value="{{ $skill->id }}" 
                                                {{ in_array( $skill->id, $user_skills) ? 'selected="selected"'  : ''}} >{{ $skill->name }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="row mb-3">
                                       <div class="col-md-12">
                                          <label class="tbl-st">Clients you have worked with</label>
                                       </div>
                                       <div class="col-md-12 inp">
                                          <input class="form-control" id="clients" type="text" placeholder="Enter clients" 
                                          name="clients" value="{{ !empty($user->userProfile['clients'] ) ? $user->userProfile['clients'] : ''  }}" />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 p-0 save-btn-lg">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                        <div class="card work-experince">
                           <div class="card-header" id="headingThree" onclick="get_workExpBOX();get_eduBOX();closePrevious('headingTwo');">
                              <h2 class="mb-0">
                                 <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                 Employment & Education
                                 </button>
                              </h2>
                           </div>
                           <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                 <div class="padding-srt">
                                       
                                    <div id="workExpBOX">
                                      <!-- work experience box -->  
                                    </div>
                                    
                                    <div id="eduBOX">
                                        <!-- education  box -->  
                                    </div>
                                 </div>
                              </div>
                           </div> 
                        </div>
                        <div class="card">
                           <div class="card-header" id="headingThree1" onclick="get_socialBOX();closePrevious('headingThree');">
                              <h2 class="mb-0">
                                 <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
                                 Social Links (optional)
                                 </button>
                              </h2>
                           </div>
                           <div id="collapseThree2" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample">
                              <div class="card-body social-iv">
                                    <div id="socialBOX">
                                      <!-- work experience box -->  
                                    </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="portfoli-sects" id="portfolioBOX">
     <!-- portfolio section --> 
   </div>

</div>







@endsection


 

@section('footer') 

<!-- This file is important to include some functions
 -->
 <script src="{{ asset ('assets/js/function/functions.js') }}"></script>

<script> 
    $(document).ready(function(){

      // click on hourly rate
      calculateFee('hourly_rate', '{{ $settings->service_fee }}'); 

     //get portfolio section
     get_portfolioBOX();  


          var availableTags = [
          "H.R. manager", "PHP developer", "Android developer", "Project Manager", "General Manager", "Business Development Manager", "Internet Marketing Head", "Content Writter", "System Administrator", "CEO/MD", "University Professor"
        ];
        $( "#primaryTitle" ).autocomplete({
          source: availableTags
        });

    });
 

  
       var clients = new Choices(
          document.getElementById('clients'),
          {
            delimiter: ',',
            editItems: true,
            removeItemButton: true,
          }
        );

 
      
   
   $(function() { 


   $("form[name='personalForm']").validate({ 
    onfocusout: true,
    // Specify validation rules
    rules: { 
      prim_title: "required",
      sec_title : "required",
      exp_level : "required",
      start_year : "required",
      overview : "required",
      hourly_rate : "required",
      english_prof : "required",
      city : "required"
    },  
    // Specify validation error messages
    messages: {
      prim_title: "Please enter your primary title.",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      showScreenLoader();
       $.ajax({
            url: "{{ route('user.editprofile') }}",
            type: form.method,
            data: $(form).serialize(),
            dataType: 'json',
            success: function(response) {
               $.toast({
                   heading: 'Success',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: 'success'
               })
               $('#headingTwo').find('button').click();
               hideLoader();
            }            
        });
       return false; // <- last item inside submitHandler function
    }
  });


   // professionalForm
   $("form[name='professionalForm'").validate({
      rules: {  
      services: "required",
      skills: "required"
    },  
    // Specify validation error messages
    messages: {
      services: "Please select services you offer.",
      skills: "Please enter skills you have.",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
     showScreenLoader();
       $.ajax({
            url: "{{ route('user.editprofile') }}",
            type: form.method,
            data: { 
               services : $('#services').val().join(','),
               skills : $('#skills').val().join(','),
               clients: $('#clients').val(),
               '_token' : '{{csrf_token()}}' 
            },
            dataType: 'json',
            success: function(response) {
               $.toast({
                   heading: 'Success',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: 'success'
               })
               $('#headingThree').find('button').click();
                hideLoader();
            }            
        });
       return false; // <- last item inside submitHandler function
    }
   });

});

// close previous section
function closePrevious($id) {
  // setTimeout(function() {
  //   $('#'+ $id).find('button').click();
  // }, 1000);
}


function get_workExpBOX(){
     showScreenLoader();
   $.ajax({
            url: "{{ route('user.workExp_ajax')}}",
            success:function(response)
            {
                hideLoader();
                // close first section
               $('#workExpBOX').html(response);  
            },error:function(errorResponse)
            {
               if(errorResponse.status == 401)
               {
                 location.reload();
               }
                hideLoader();
            }
        }); 
}
function get_eduBOX(){
     showScreenLoader();
   $.ajax({
            url: "{{ route('user.edu_ajax')}}",
            success:function(response)
            {
                hideLoader();
               $('#eduBOX').html(response);  
            },error:function(errorResponse)
            {
               if(errorResponse.status == 401)
               {
                 location.reload();
               }
                hideLoader();
            }
        }); 
}

function get_socialBOX(){
     showScreenLoader();
    $.ajax({
         url: "{{ route('user.social_ajax')}}",
         success:function(response)
         {
            hideLoader();
            $('#socialBOX').html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
}

function get_portfolioBOX(){
     showScreenLoader();
    $.ajax({
         url: "{{ route('user.portfolio_ajax')}}",
         data: { 'route' : "{{Route::current()->getName()}}"},
         success:function(response)
         {
            hideLoader();
            $('#portfolioBOX').html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
}


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
       //submit image
        showScreenLoader();
        var formData = new FormData($('form[name="user_profile"]')[0]);
       $.ajax({
            url: "{{ route('user.user_profile') }}",
            type: "POST",
            data:formData,
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
       // end submit image

     }
   }
}

function readCoverURL(input) {
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
            var width = 0;
            var height = 0;

            var image = new Image(); 
            image.src = e.target.result;
            image.onload = function() {
              width = this.width;
              height = this.height;
                // access image size here 
                console.log(this.width,this.height);          
                console.log(width,height);

                if(width < 900 || height < 300){
                       $.toast({
                       heading: 'Error',
                       text:'Dimensions should be at least 900x300',
                       showHideTransition: 'slide',
                       icon: 'error'
                     });
                }else{
                      $style="background-image: url("+e.target.result+");";
                     $('#coverPreview').attr('style', $style);
                     
                     if($('.messgedelete').length == 0){
                        $('.editmesge').after('<a class="dropdown-item messgedelete" href="javascript:void(0);" onclick="removeCoverImage();">Remove Image</a>');
                     }

                      $('#coverImageHidden').val('add');

                      //submit image
                      showScreenLoader();
                      var formData = new FormData($('form[name="cover_profile"]')[0]);
                      $.ajax({
                          url: "{{ route('user.editprofile') }}",
                          type: "POST",
                          data:formData,
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
                     // end submit image
                }
            }
        
       } 
       
       reader.readAsDataURL(input.files[0]); // convert to base64 string
     }
   }
}

$("#profileImage").change(function() {
  readURL(this);
});

$("#coverImage").change(function() {
  readCoverURL(this);
});

function removeCoverImage(){

   $style="background-image: none !important;";
   $('#coverPreview').attr('style', $style);
   $('#coverImage').val('');  $('#coverImageHidden').val('delete');
       //submit image
        showScreenLoader();
        var formData = new FormData($('form[name="cover_profile"]')[0]);
       $.ajax({
            url: "{{ route('user.editprofile') }}",
            type: "POST",
            data:formData,
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
       // end submit image
}
 
</script>


@endsection