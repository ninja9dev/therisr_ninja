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
id="kt_datatable_transactions"></div>
<!--end: Datatable-->
                   
<script type="text/javascript">
        var datatable = $('#kt_datatable_transactions').KTDatatable({
            data: {
                type: 'remote',  
                source: {
                    read: {                        
                        url: '{{Route("admin.get_tran")}}',
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
                field: 'client',
                title: 'Client',
                width:"auto",
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
                    var user_img = '';
                    
                    if(row.users.image != '' && row.users.image != null) 
                        user_img =  '<?=asset('assets/users');?>'+'/'+ row.users.image; 
                    else user_img =  '<?=asset('assets/users/default.jpg');?>'; 

                    return '<div class="d-flex align-items-center">\
                          <div class="symbol symbol-40 symbol-sm flex-shrink-0">\
                            <div class="symbol-label">\
                               <img class="table-round-img align-self-end" src="'+user_img+'" alt="photo">\
                            </div>\
                          </div>\
                          <div class="ml-4">\
                             <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'+row.users.name+'</div>\
                             <a href="#" class="text-muted font-weight-bold text-hover-primary">'+row.users.email+'</a>\
                          </div>\
                       </div>';
                }
            }, {
                field: 'contract',
                title: 'Contract Title',
                width:"auto",
                // callback function support for column rendering
                template: function(row) {
                    console.log(row);
                    return row?.contract?.job_title;
                }
            },{
                field: 'contract_type',
                title: 'Contract Type',
                width:"auto",
                // callback function support for column rendering
                template: function(row) {
                     var contract_t = {
                            1: {
                                'title': 'Hourly',
                                'class': ' label-light-success'
                            },
                            2: {
                                'title': 'Fixed',
                                'class': ' label-light-info'
                            }
                    };
                        if(row.contract.contract_type != null && row.contract.contract_type != 'undefined')
                        return '<span class="label font-weight-bold label-lg ' + contract_t[row.contract.contract_type].class + ' label-inline">' + contract_t[row.contract.contract_type].title + '</span>';
                        else 
                            return '';
                }
            }, {
                field: 'freelancer',
                title: 'Freelancer',
                width:"auto",
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
                    var user_img = '';
                    
                    if(row.contract.user_to_basic_detail.image != '' && row.contract.user_to_basic_detail.image != null) 
                        user_img =  '<?=asset('assets/users');?>'+'/'+ row.contract.user_to_basic_detail.image; 
                    else user_img =  '<?=asset('assets/users/default.jpg');?>'; 

                    return '<div class="d-flex align-items-center">\
                          <div class="symbol symbol-40 symbol-sm flex-shrink-0">\
                            <div class="symbol-label">\
                               <img class="table-round-img align-self-end" src="'+user_img+'" alt="photo">\
                            </div>\
                          </div>\
                          <div class="ml-4">\
                             <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'+row.contract.user_to_basic_detail.name+'</div>\
                             <a href="#" class="text-muted font-weight-bold text-hover-primary">'+row.contract.user_to_basic_detail.email+'</a>\
                          </div>\
                       </div>';
                }
            }, {
                field: 'amount',
                title: 'Amount',
                width:"auto",
                autoHide: false,
                template: function(row) {

                    var output = '';
                    output += '<div class="mb-0">' + '{{ !empty($settings->currency) ? $settings->currency : '$'}}'  + row.amount.toFixed(2) + '</div>';
                    return output;
                },
            },{
                field: 'created_at',
                title: 'Date',
                sortable: 'desc',
                type: 'datetime',
                format: 'MM/DD/YYYY',
                width:"auto",
                autoHide: false,
                template: function(row) {
                    const options = { year: 'numeric', month: 'short', day: 'numeric' };

                    var output = '';
                    output += '<span class="label font-weight-bold label-lg label-light-default label-inline">' + new Date(row.created_at).toLocaleDateString("en-US", options) + '</span>';
                    return output;
                },
            },{
                field: 'status',
                title: 'Status',
                width:"auto",
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                            'succeeded': {
                                'title': 'Paid',
                                'class': ' label-light-success'
                            },
                            'failed': {
                                'title': 'Failed',
                                'class': ' label-light-danger'
                            }
                        };
                        if(row.status != null && row.status != 'undefined')
                        return '<span class="label font-weight-bold label-lg ' + status[row.status].class + ' label-inline">' + status[row.status].title + '</span>';
                        else 
                            return '';
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