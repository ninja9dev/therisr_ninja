
@extends('user.layouts.main')

@section('content')

 

<div class="reports-info reprt-resp-sec freelancing-pro-info clentjoblisting">
   <div class="paddin-btms">
      <div class="container"> 
         <div>
            <div class="padding-ser">
                 @include('user.employer.jobs.topbar_jobs')
               <div class="row">
                  
                 @include('user.employer.jobs.sidebar_jobs')

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

@endsection


 

@section('footer') 
<script type="text/javascript">
  
  var jobareaajax_path = "{{ route('user.get_alljobs_proposals_area_ajax', ['page' => 'all' ])}}";
  var currentPage = 'all';
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