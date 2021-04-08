@extends('user.layouts.main')
@section('content')
 @php
 $r_image = false; $style = '';
    if(@$user->userProfile['background_image'] != ''){
        $b_image =  asset('assets/users_cover').'/'.@$user->userProfile['background_image']; 
        $r_image = true;
        $style="background-image: url(".$b_image.");";
    }
@endphp
<div class="landing-page text-center" style="{{ $style  }}">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <h3>{{ Auth::user()->name }} </h3>
            <h1 id="h1available">  {{ (!empty($user->userAvailable['available']) &&  
                                              $user->userAvailable['available'] == '2' ) 
                                              ? 'Not Availble' 
                                              : 'Available' }}
            </h1>
            <h2 id="h2foruntill">
              @if(!empty($user->userAvailable['available']) &&  $user->userAvailable['available'] == '2' ) 
                 {{ !empty($user->userAvailable['nonavail_untill']) ? dateFormat($user->userAvailable['nonavail_untill'])  : ''  }}
              @else
                Less than {{ !empty($user->userAvailable['avail_for']) ? $user->userAvailable['avail_for'] : '' }}hrs/week
              @endif
            </h2> 
         </div>
      </div>
      <div class="update-status">
         <button type="button" class="btn btn-primary updateStatusAvailButton"  data-toggle="modal" data-target="#updateStatusAvail">Update Status</button>
      </div>
   </div>
</div>
<div class="profile-info-btn">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <a href="{{ route('user.editprofile') }}" type="button" class="btn btn-primary">Edit Profile
            </a>
         </div>
      </div>
   </div>
</div>
<div class="profile-info">
   <div class="paddin-btms">
      <div class="container">
         <div>
            <div class="padding-ser">
               <div class="row">
                  <div class="col-xl-3 col-lg-4 col-md-5 col-sm-8 col-10 offset-md-0  offset-sm-2 offset-1">
                     <div class="inner-profile text-center">
                            @php
                               if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
                               else $image =  asset('assets/users/default.jpg'); 
                            @endphp
                           <img id="profiePreview" class="img-preview" src="{{ $image }}">
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
                        <div class="inner-border">
                           <h3>{{ !empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '' }} / {{ !empty($user->userProfile['sec_title']) ? $user->userProfile['sec_title'] : '' }} </h3>

                           <p>{{ !empty($user->userProfile['overview']) ? $user->userProfile['overview'] : '' }}</p>
                           <ul>
                              <li>Hourly rate
                                 <span class="green-color">{{ !empty($user->userProfile['hourly_rate']) ? '$'.$user->userProfile['hourly_rate'] : '' }}</span>
                              </li>
                              <li>Years of experience
                                 <span class="green-color"> {{ (!empty($user->userProfile['start_year'])) ?  calculateYears(date('Y-m-d'),$user->userProfile['start_year'].'-01-01') : '' }} </span>
                              </li>
                              <li>Experience level
                                 <span class="green-color">
                                  {{ !empty($user->userProfile['exp_level']) ? expertLevel($user->userProfile['exp_level']) : '' }} 
                                </span>
                              </li>
                              <li>English level
                                 <span class="green-color">
                                    {{ !empty($user->userProfile['english_prof']) ? englishLevel($user->userProfile['english_prof']) : '' }}
                                 </span>
                              </li>
                           </ul>
                        </div>
                        <div class="inner-border">
                           <h4>Company worked with</h4>
                           
                            @if(!empty($user->userProfile['clients'] )) 
                                @php 
                                 $clients = array();
                                $clients = explode(',', $user->userProfile['clients'])
                                @endphp
                           

                              @forelse($clients as $key=>$client)
                                <a class="facebook-intagram " href="javascript:void(0);" > {{ $client }}</a>@if($key < count($clients)-1),@endif
                              @empty
                              @endforelse 
                            @else
                               No Clients added!
                            @endif
                           
                        </div>
                        <div class="inner-border">
                           <h4>Services offer</h4>
                            @if(!empty($user->userProfile['services'] )) 
                                @php 
                                 $services = array();
                                $services = explode(',', $user->userProfile['services'])
                                @endphp
                            

                              @forelse($services as $key=>$ser)
                                <a class="facebook-intagram " href="javascript:void(0);" > {{ getServiceName($ser) }}</a>@if($key < count($services)-1),@endif
                              @empty
                              @endforelse
                            @else
                               No service added!
                            @endif
                        </div>
                        <div class="inner-border">
                           <h4>Skills</h4>
                            @if(!empty($user->userProfile['skills'] )) 
                                @php 
                                $skills = array();
                                $skills = explode(',', $user->userProfile['skills'])
                                @endphp
                            

                              @forelse($skills as $key=>$skill)
                                <a class="facebook-intagram " href="javascript:void(0);" > {{ getSkillName($skill) }}</a>@if($key < count($skills)-1),@endif
                              @empty
                              @endforelse
                            @else
                               No skills added!
                            @endif
                        </div>
                        <div class="inner-border">
                           <h4>Employment & Education</h4>
                          @forelse ($user->userWorkExp as $workExp)
                             <div class="main-box">
                                <img src="../assets/img/work.png">
                                <div class="main-lft">
                                   <p class="designation green-color">[{{ $workExp->title }}] at [{{ $workExp->company_name }}]</p>
                                   <p class="location"> 
                                    {{ date("M",strtotime(date("Y")."-".$workExp->start_month."-01")).' '.$workExp->start_year }} - {{ ($workExp->currently_working == 'on') ? 'Current' :  date("M",strtotime(date("Y")."-".$workExp->end_month."-01")).' '.$workExp->end_year }}
                                   
                                    <br/>{{ $workExp->location }}
                                   </p>
                                </div>
                             </div>
                          @empty
                              No Employment added yet!
                          @endforelse

                          @forelse($user->userEducation as $educ)
                           <div class="main-box">
                              <img class="study" src="../assets/img/study.png">
                              <div class="main-lft">
                                 <p class="designation green-color">[{{ $educ->major }}] at [{{ $educ->school_name }}]</p>
                                 <p class="location">Attended
                                   {{ $educ->start_year.' - '.$educ->end_year }}</p>
                              </div>
                           </div>
                           @empty
                              <br/>No Education added yet!
                           @endforelse
                        </div>
                        <div class="inner-border">
                           <div class="social-icons">
                              @if(!empty($user->userSocialLinks['github']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['github'], 'github') }}">
                                  <img src="{{ asset('assets/img/icon-1.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['medium']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['medium'], 'medium') }}">
                                  <img src="{{ asset('assets/img/medium.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['codepen']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['codepen'], 'codepen') }}">
                                  <img src="{{ asset('assets/img/icon-3.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['behance']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['behance'], 'behance') }}">
                                  <img src="{{ asset('assets/img/behance.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['dribbble']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['dribbble'], 'dribbble') }}">
                                  <img src="{{ asset('assets/img/icon-5.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['youtube']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['youtube'], 'youtube') }}">
                                  <img src="{{ asset('assets/img/icon-6.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['linkedin']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['linkedin'], 'linkedin') }}">
                                  <img src="{{ asset('assets/img/icon7.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['instagram']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['instagram'], 'instagram') }}">
                                  <img src="{{ asset('assets/img/icon-8.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['twitter']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['twitter'], 'twitter') }}">
                                  <img src="{{ asset('assets/img/icon-9.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['pinterest']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['pinterest'], 'pinterest') }}">
                                  <img src="{{ asset('assets/img/pin.png')}}">
                                </a>
                              @endif
                              @if(!empty($user->userSocialLinks['facebook']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['facebook'], 'facebook') }}">
                                  <img src="{{ asset('assets/img/fb.png')}}">
                                </a>
                              @endif  
                               @if(!empty($user->userSocialLinks['website']))
                                <a class="icons" target="_blank" href="{{ createSocilLinks($user->userSocialLinks['website'], 'website') }}">
                                  <img src="{{ asset('assets/img/earth-globe.png')}}">
                                </a>
                              @endif                            
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="main-cov blue-hover" id="workExperienceBOX">
     <!-- work experience section --> 
   </div>


   <div class="portfoli-sects" id="portfolioBOX">
     <!-- portfolio section --> 
   </div>
</div>







<!-- update status model -->
<div class="modal hiring-popup update-proj" id="updateStatusAvail">
    <div class="modal-dialog modal-dialog-centered modal-md ">
        <div class="modal-content">
          <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title fairy-tale-in-the-wo text-center">Update Status</h4>
                <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('assets/img/cross.png')}}"></button>
            </div>
           <form class="updateStatus" method="POST" name="updateStatus">
             @csrf
          <!-- Modal body -->
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="left-hiring-txt">
                     
                          @if(!empty($user->userAvailable['available']) &&  $user->userAvailable['available'] == '2' ) 
                            @php $forStyle = 'display:none'; $untillStyle = 'display:block'; @endphp
                          @else
                              @php $forStyle = 'display:block'; $untillStyle = 'display:none'; @endphp
                          @endif

                          
                                <input type="hidden" name="available"
                                        id="available" value="{{ !empty($user->userAvailable['available']) ? $user->userAvailable['available'] : '1' }}" />

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle select-p" type="button" id="availableButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ (!empty($user->userAvailable['available']) &&  
                                              $user->userAvailable['available'] == '2' ) 
                                              ? 'Not Availble' 
                                              : 'Available' }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="availableButton" x-placement="bottom-start" 
                                    style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item tt avail" data-id="1" href="javascript:void(0);">Available</a>
                                        <a class="dropdown-item nt notavail" data-id="2" href="javascript:void(0);">Not Available</a>
                                    </div>
                                </div>
                              <p class="text-center till" style="{{$forStyle}}">For</p>
                              <p class="text-center untill" style="{{$untillStyle}}">Until</p>
                              <div class="till" style="{{$forStyle}}">
                                  <select class="form-control" name="avail_for" id="avail_for">
                                    <option></option>
                                    <option value="30" {{ (!empty($user->userAvailable['avail_for']) &&   $user->userAvailable['avail_for'] == '30' ) ? 'selected="selected"' : '' }}>
                                    Less than 30 hrs/week</option>
                                    <option value="40" {{ (!empty($user->userAvailable['avail_for']) &&   $user->userAvailable['avail_for'] == '40' ) ? 'selected="selected"' : '' }}>
                                    Less than 40 hrs/week</option>
                                    <option value="50" {{ (!empty($user->userAvailable['avail_for']) &&   $user->userAvailable['avail_for'] == '50' ) ? 'selected="selected"' : '' }}>
                                    Less than 50 hrs/week</option>
                                    <option value="60" {{ (!empty($user->userAvailable['avail_for']) &&   $user->userAvailable['avail_for'] == '60' ) ? 'selected="selected"' : '' }}>
                                    Less than 60 hrs/week</option>
                                  </select>
                              </div>
                              <div class="untill" style="{{$untillStyle}}">
                                  <div class="dropdown drop-mes-icon"  
                                   onclick="$('#untilDate').datepicker('show');">
                                    <input type="text" value="{{ !empty($user->userAvailable['nonavail_untill']) ? $user->userAvailable['nonavail_untill']  : ''  }}" class="form-control"
                                    name="nonavail_untill"  id="untilDate" 
                                     autocomplete="off" /> 
                                  </div>
                              </div>
                       
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
            </div>
           </form>
        </div>
    </div>
</div>

<!-- update status model end -->



@endsection
@section('footer') 

<script type="text/javascript">

  $(document).ready(function(){

    $( "#untilDate" ).datepicker({ 
      minDate: 0, 
      dateFormat: 'yy-mm-dd',
      setDate : "{{ !empty($user->userAvailable['nonavail_untill']) ? $user->userAvailable['nonavail_untill']  : ''  }}"
    });


     //get portfolio section
     get_portfolioBOX(); 
     //get work experience section
     get_workExperienceBOX("{{ route('user.f_workhistory_ajax', ['id' => Auth::user()->id])}}"); 

        $(".notavail").click(function(){
            $('#available').val($(this).attr('data-id'));
            $('#availableButton').html($(".notavail").html());
            $(".till").hide();
            $(".untill").show();
        });
        $(".avail").click(function(){
            $('#available').val($(this).attr('data-id'));
            $('#availableButton').html($(".avail").html());
            $(".untill").hide();
            $(".till").show();
        });

   });

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
 
function get_workExperienceBOX($url){
   showScreenLoader();
    $.ajax({
         url: $url,
         success:function(response)
         {
            hideLoader();
            $('#workExperienceBOX').html(response);  
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



$(function() { 
   $("form[name='updateStatus']").validate({
    // Specify validation rules
    rules: { 
      avail_for: {
         validOrNah: true
      },
      nonavail_untill : {
         validOrNah_non: true
      }
    },  
    submitHandler: function(form) {
      showScreenLoader();
        var formData = new FormData($('form[name="updateStatus"]')[0]);
       $.ajax({
            url: "{{ route('user.updateAvailable') }}",
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
               $('.updateStatusAvailButton').click();
               if($("#available").val() === "1")
               {
                   $('#h1available').html('Available');
                   $('#h2foruntill').html('Less than '+$("#avail_for").val()+' hrs/week');
              }else{
                $('#h1available').html('Not Available');
                var month = new Array();
                month[0] = "Jan";
                month[1] = "Feb";
                month[2] = "March";
                month[3] = "April";
                month[4] = "May";
                month[5] = "Jun";
                month[6] = "July";
                month[7] = "Aug";
                month[8] = "Sept";
                month[9] = "Oct";
                month[10] = "Nov";
                month[11] = "Dec";

                var d = new Date($("#untilDate").val());
                var date = (d.getDate() < 10) ? '0'+d.getDate() : d.getDate();
                var n = month[d.getMonth()]+ ' ' + date + ', ' + d.getFullYear();
                 $('#h2foruntill').html(n);
              }
               hideLoader();
            }            
        });
       return false; // <- last item inside submitHandler function
     }
  });
});

$.validator.addMethod("validOrNah", function(value, element) {
  if ($("#available").val() === "1" && $("#avail_for")[0].selectedIndex === 0) {
    return false;
  } 
    return true;
}, "Please select something!");


$.validator.addMethod("validOrNah_non", function(value, element) {
  if ($("#available").val() === "2" && $("#untilDate").val() == '') {
    return false;
  } 
    return true;
}, "Please select date!");
</script>
@endsection