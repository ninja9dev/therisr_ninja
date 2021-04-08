@extends('admin.layouts.main')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader grid-item" id="kt_subheader">
   <div class="container container-fluid">
      <div class="subheader-main">
         <!---->
         <h3 class="subheader-title">Dashboard</h3>
      </div>
      <div class="subheader-toolbar">
         <div class="subheader-wrapper"></div>
      </div>
   </div>
</div>
    <!--end::Subheader-->
    <!--begin::Modal-->
    <div class="modal fade" id="subheader7Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="kt_subheader_leaflet" style="height:450px; width: 100%;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                    <button id="submit" type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Apply</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Advance Table Widget 10-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">
                                Finance Summary
                                </span>
                            </h3>
                            <div class="card-toolbar">
                                <input type="hidden" 
                                    class="form-control input-form-control" 
                                    readonly="readonly" 
                                    placeholder="Select Date Range"
                                    name="daterange" id="daterange">
                                        
                                <!--begin::Daterange-->
                                <div class="input-group" 
                                id="kt_dashboard_daterangepicker">
                                    <a href="javascript:void(0);" 
                                    class="btn btn-light-primary btn-sm font-weight-bold mr-2">
                                        <span class="opacity-60 font-weight-bold mr-2"
                                            id="kt_dashboard_daterangepicker_title">Today
                                        </span>
                                        <span class="font-weight-bold" 
                                        id="kt_dashboard_daterangepicker_date">
                                        </span>
                                    </a>
                                </div>
                                <!--end::Daterange-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0 blockSpinnerArea_stats">
                            <div class="widget12">
                                <div class="widget12-content">
                                    <div class="widget12-item mt-5">
                                        <div class="widget12-info">
                                            <span class="widget12-desc">Total Transactions</span>
                                            <span class="widget12-value" 
                                            id="transaction_ajax">$0</span>
                                        </div>
                                        <div class="widget12-info">
                                            <span class="widget12-desc">Commission Charged</span>
                                            <span class="widget12-value"
                                            id="commission_ajax">$0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Advance Table Widget 10-->
                </div>
            </div>
         
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Advance Table Widget 10-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Users</span>
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
        getUsersTable('all'); //calling this function on window get loaded
    });

    function get_financeSummary() {
        KTApp.block('.blockSpinnerArea_stats');
        $.ajax({
            url: '{{Route("admin.get_stats")}}',
            type: 'POST',
            data : {
                'date_filter' : $('#daterange').val(),
                '_token': "{{ csrf_token() }}"
            },
            dataType: 'json',
            success:function(response)
            {
                $('#transaction_ajax').html(response.total_transactions);
                $('#commission_ajax').html(response.total_commission);
                KTApp.unblock('.blockSpinnerArea_stats');  
            },error:function(errorResponse)
            {
               if(errorResponse.status == 401)
               {
                 location.reload();
               }
            } 
        })
    }
    
    $(function() {
        // predefined ranges
        var start = moment().subtract(29, 'days');
        var end = moment();
        function cb(start, end,label = '') {
            $('#daterange').val( start.format('DD-MM-YYYY') + ' / ' + end.format('DD-MM-YYYY'));
            if(label != 'Custom Range')
            {
                $('#kt_dashboard_daterangepicker a').html(label);
            }else{
                $('#kt_dashboard_daterangepicker a').html(start.format('D MMM YYYY') + ' - ' + end.format('D MMM YYYY'));
            }
            if(typeof getDashboard === "function"){
                get_financeSummary();   
            }
            get_financeSummary();
        }
        $('#kt_dashboard_daterangepicker').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "opens": "left"
        }, cb);

        cb(start, end,'Last 30 Days');
        });
    </script>

@endsection