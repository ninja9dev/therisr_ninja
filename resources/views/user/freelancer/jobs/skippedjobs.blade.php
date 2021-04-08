
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
  
  var jobareaajax_path = "{{ route('user.get_job_ajax_frlncr', ['page' => 'skippedjobs' ])}}";
  var currentPage = 'alljobs';
</script>
<!-- This file is important to include some functions
 -->
 <script src="{{ asset ('assets/js/function/jobs_functions.js') }}"></script>
 <script>

$( document ).ready(function() {
  //get page data
  job_areaGet(jobareaajax_path, currentPage);
     // pagination
  $(document).on('click', '#listing-pagination .pagination a',function(event)
  {
      $('li').removeClass('active');
      $(this).parent('li').addClass('active');
      var myurl = $(this).attr('href');
      job_areaGet(myurl, currentPage);
      event.preventDefault();
  });
});



</script>


@endsection
