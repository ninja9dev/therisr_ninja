<!--begin::Search Form-->
    <div class="mb-7">
        <div class="row align-items-center">
            <div class="col-lg-9 col-xl-8">
                <div class="row align-items-center">
                    <div class="col-md-4 my-2 my-md-0">
                        <div class="input-icon">
                            <input type="text" 
                            class="form-control" 
                            placeholder="Search..." 
                            id="kt_datatable_u_search_query" />
                            <span>
                                <i class="flaticon2-search-1 text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
<!--end::Search Form-->
<!--end: Search Form-->
<!--begin: Datatable-->
<div class="datatable datatable-bordered datatable-head-custom" 
id="kt_datatable_job_reports"></div>
<!--end: Datatable-->
                   
<script type="text/javascript">
        var datatable = $('#kt_datatable_job_reports').KTDatatable({
            data: {
                type: 'remote',  
                source: {
                    read: {                        
                        url: '{{Route("admin.get_reports")}}',
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        map: function(raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 100,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false,
                footer: false,
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#kt_datatable_u_search_query'),
                key: 'generalSearch',
            },

            // columns definition
            columns: [{
                field: 'reported_by',
                title: 'Reported By',
                width:"auto",
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
                    var user_img = '';
                    
                    if(row.user_basic_detail.image != '' && row.user_basic_detail.image != null) 
                        user_img =  '<?=asset('assets/users');?>'+'/'+ row.user_basic_detail.image; 
                    else user_img =  '<?=asset('assets/users/default.jpg');?>'; 

                    return '<div class="d-flex align-items-center">\
                          <div class="symbol symbol-40 symbol-sm flex-shrink-0">\
                            <div class="symbol-label">\
                               <img class="table-round-img align-self-end" src="'+user_img+'" alt="photo">\
                            </div>\
                          </div>\
                          <div class="ml-4">\
                             <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'+row.user_basic_detail.name+'</div>\
                             <a href="#" class="text-muted font-weight-bold text-hover-primary">'+row.user_basic_detail.email+'</a>\
                          </div>\
                       </div>';
                }
            }, {
                field: 'job_title',
                title: 'Job Title',
                width:"auto",
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
                    console.log(row);
                    return row?.job_detail?.job_title;
                }
            }, {
                field: 'reason',
                title: 'Reason',
                width:"auto",
                // callback function support for column rendering
                template: function(row) {
                    console.log(row);
                    return row?.reason;
                }
            }, {
                field: 'created_at',
                title: 'Reported Date',
                sortable: 'desc',
                type: 'datetime',
                format: 'MM/DD/YYYY',
                width:"auto",
                autoHide: false,
                template: function(row) {
                    const options = { year: 'numeric', month: 'short', day: 'numeric' };

                    var output = '';
                    output += '<div class="mb-0">' + new Date(row.created_at).toLocaleDateString("en-US", options) + '</div>';
                    return output;
                },
            },
            ],

        });

        $('#kt_datatable_u_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'status');
        });

        $('#kt_datatable_u_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'user_type');
        });

        $('#kt_datatable_u_search_status, #kt_datatable_u_search_type').selectpicker();


</script>