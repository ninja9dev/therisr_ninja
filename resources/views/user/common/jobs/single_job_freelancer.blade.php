
@extends('user.layouts.main')

@section('content')

@include('user.freelancer.jobs.top_filter')

 

<div class="profile-info freelancing-pro-info">
   <div class="paddin-btms">
      <div class="container"> 
         <div>
            <div class="padding-ser">
               <div class="row">
                 @include('user.freelancer.sidebarprofile')

                 <div class="col-xl-9 col-lg-8 col-md-8 pl-5 jb-pd-l  pd-l0">
                    <div class="inner-report-cont" id="page-area-job">
                           <div id="jobdetails"> 
                           <!--  job detail area -->
                           </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('user.freelancer.job_ajax.job_popup_report')

@endsection


 

@section('footer') 
<script type="text/javascript">
  
  var jobareaajax_path = "{{ route('user.get_jobBasicF', ['id' => $job->id]) }}";
  var currentId = '{{$job->id}}';
</script>
<!-- This file is important to include some functions
 -->
 <script src="{{ asset ('assets/js/function/jobs_functions.js') }}"></script>
 <script>
  $( document ).ready(function() {
      $('.moreOptnDropdwn_custom ').on('click', function (event) {
        $(this).parent().toggleClass('show'); $(this).parent().find('.dropdown-menu').toggleClass('show');
    });
      $('body').on('click', function (e) {
          if (!$('.moreOptnDropdwn_custom').is(e.target) && $('.moreOptnDropdwn_custom').has(e.target).length === 0 && $('.show').has(e.target).length === 0) {
              $('.moreOptnDropdwn_custom ').parent().removeClass('show');
              $('.moreOptnDropdwn_custom ').parent().find('.dropdown-menu').removeClass('show');
          }
      });
});

$( document ).ready(function() {
  //get page data
 get_jobBasic_freelancer(jobareaajax_path);
});
</script>

@endsection