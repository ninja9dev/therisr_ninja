@extends('admin.layouts.main')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader grid-item" id="kt_subheader">
   <div class="container container-fluid">
      <div class="subheader-main">
         <!---->
         <h3 class="subheader-title">Job Reports</h3>
      </div>
      <div class="subheader-toolbar">
         <div class="subheader-wrapper"></div>
      </div>
   </div>
</div>
    <!--end::Subheader-->
 
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
                        <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Advance Table Widget 10-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Job Reports</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body blockSpinnerArea" id="ajax_area">
                            <!-- ajax area --> 
                        </div>

                        <!--end::Body-->
                    </div>
                    <!--end::Advance Table Widget 10-->
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->

@endsection
@section('footer')
<script type="text/javascript">

    $( document ).ready(function() { 
       KTApp.block('.blockSpinnerArea');  
        $.ajax({
            url: '{{ url("admin/job_reports")}}',
            success:function(response)
            {
                $('#ajax_area').html(response); //using those id;s here
                KTApp.unblock('.blockSpinnerArea');  
            },error:function(errorResponse)
            {
               if(errorResponse.status == 401)
               {
                 location.reload();
               }
            } 
        })
    });
    
  
</script>
@endsection