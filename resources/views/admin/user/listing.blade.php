@extends('admin.layouts.main')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader grid-item" id="kt_subheader">
   <div class="container container-fluid">
      <div class="subheader-main">
         <!---->
         <h3 class="subheader-title">
         	@if($type == 1)
        	  Freelancers
        	@elseif($type == 2)
        	  Employers
        	@else
              Users
            @endif
         </h3>
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
                                <span class="card-label font-weight-bolder text-dark">
                                	@if($type == 1)
                                	  Freelancers
                                	@elseif($type == 2)
                                	  Employers
                                	@else
                                      Users
                                    @endif
                                </span>
                            </h3>
                           <!--  <div class="card-toolbar">
                               <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Choose Types
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:;">
                                                    <i class="nav-link-icon flaticon2-user"></i>
                                                    <span class="nav-link-text">Freelancer</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="javascript:;">
                                                    <i class="nav-link-icon flaticon2-user"></i>
                                                    <span class="nav-link-text">Employer</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body blockSpinnerArea" id="user_area">
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
       getUsersTable('<?php echo $type; ?>'); //calling this function on window get loaded
    });
    
  
</script>
@endsection