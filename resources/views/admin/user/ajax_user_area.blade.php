<!--begin::Search Form-->
                                <div class="mb-7">
                                    <div class="row align-items-center">
                                        <div class="col-lg-9 col-xl-8">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <div class="input-icon">
                                                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_u_search_query" />
                                                        <span>
                                                            <i class="flaticon2-search-1 text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                        <select class="form-control" id="kt_datatable_u_search_status">
                                                            <option value="">All</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">In-active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @if($type == '' || $type == 'all')
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <div class="d-flex align-items-center">
                                                        <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                                        <select class="form-control" id="kt_datatable_u_search_type">
                                                            <option value="">All</option>
                                                            <option value="1">Freelancer</option>
                                                            <option value="2">Employer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            <!--end::Search Form-->
                            <!--end: Search Form-->
                            <!--begin: Datatable-->
                            <div class="datatable datatable-bordered datatable-head-custom" 
                            id="kt_datatable_u"></div>
                            <!--end: Datatable-->
                   
<script type="text/javascript">
    $columns_array = [
        {
            field: 'name',
            title: 'User',
            width:"auto",
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
                var user_img = '';
                
                if(row.image != '' && row.image != null) 
                    user_img =  '<?=asset('assets/users');?>'+'/'+ row.image; 
                else user_img =  '<?=asset('assets/users/default.jpg');?>'; 

                return '<div class="d-flex align-items-center">\
                      <div class="symbol symbol-40 symbol-sm flex-shrink-0">\
                        <div class="symbol-label">\
                           <img class="table-round-img align-self-end" src="'+user_img+'" alt="photo">\
                        </div>\
                      </div>\
                      <div class="ml-4">\
                         <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'+row.name+'</div>\
                         <a href="#" class="text-muted font-weight-bold text-hover-primary">'+row.email+'</a>\
                      </div>\
                   </div>';
            }
        }, {
            field: 'user_type',
            title: 'Type',
            width:"auto",
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {
                        'title': 'Freelancer',
                        'state': 'primary'
                    },
                    2: {
                        'title': 'Employer',
                        'state': 'success'
                    }
                };
                return '<span class="font-weight-bold text-' + status[row.user_type].state + '">' +
                    status[row.user_type].title + '</span>';
            },
        }, {
            field: 'country',
            title: 'Country',
            width:"auto",
            autoHide: false,
            template: function(row) {
                return row?.country_name?.country_name;
            }
        },{
            field: 'hourly_rate',
            title: 'Hourly Rate',
            width:"auto",
            autoHide: false,
            template: function(row) {
                console.log(row);
                if(typeof(row.user_profile) != "undefined" && row.user_profile != null){
                    return '<span class="label font-weight-bold label-lg label-light-primary label-inline">' + 
                    '{{ !empty($settings->currency) ? $settings->currency : '$'}}'  + row?.user_profile?.hourly_rate +'/hr' + '</span>';
                }else{
                    return '';
                }
            },
        },{
            field: 'therisr_score',
            title: 'TheRisr Score',
            width:"auto",
            autoHide: false,
            template: function(row) {
              function addClass($score, $thisscore){
                 return ($score > $thisscore) 
                     ? ( ($score > $thisscore && $score < $thisscore+1) ? 'fa-star-half-o' : 'fa-star') 
                     : 'fa-star-o';
              }

                console.log(row);
                if(typeof(row.therisr_score) != "undefined" && row.therisr_score != null){
                    return '\
                    <span class="feedback-star"><p>'+row.therisr_score+' </p>\
                      <i class="fa '+addClass(row.therisr_score, 0)+'"></i>\
                      <i class="fa '+addClass(row.therisr_score, 1)+'"></i>\
                      <i class="fa '+addClass(row.therisr_score, 2)+'"></i>\
                      <i class="fa '+addClass(row.therisr_score, 3)+'"></i>\
                      <i class="fa '+addClass(row.therisr_score, 4)+'"></i>\
                      </span>\
                    </span>';
                }else{
                    return 'No rating yet!';
                }
            },
        }, {
            field: 'created_at',
            title: 'Join Date',
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
        }, {
            field: 'status',
            title: 'Status',
            width:"auto",
            autoHide: false,
            // callback function support for column rendering
            template: function(row) {
                var status = {
                        1: {
                            'title': 'Active',
                            'class': ' label-light-success'
                        },
                        2: {
                            'title': 'Inactive',
                            'class': ' label-light-danger'
                        }
                    };
                    return '<span class="label font-weight-bold label-lg ' + status[row.status].class + ' label-inline">' + status[row.status].title + '</span>';
                },
        },  {
            field: 'actions',
            title: 'Actions',
            sortable: false,
            width:"auto",
            overflow: 'visible',
            autoHide: false,
            template: function() {
                return '\
                    <div class="dropdown dropdown-inline">\
                        <a href="javascript:;" class="btn btn-icon btn-success">\
                            <i class="flaticon-eye"></i>\
                        </a>\
                ';
            },
        }
    ];
    
    $freelancer_array = [
       $columns_array[$columns_array.findIndex(i => i.field === "name")],
       $columns_array[$columns_array.findIndex(i => i.field === "therisr_score")],
       $columns_array[$columns_array.findIndex(i => i.field === "country")],
       $columns_array[$columns_array.findIndex(i => i.field === "hourly_rate")],
       $columns_array[$columns_array.findIndex(i => i.field === "created_at")],
       $columns_array[$columns_array.findIndex(i => i.field === "status")],
       // $columns_array[$columns_array.findIndex(i => i.field === "actions")]
    ];
    $employer_array = [
       $columns_array[$columns_array.findIndex(i => i.field === "name")],
       $columns_array[$columns_array.findIndex(i => i.field === "therisr_score")],
       $columns_array[$columns_array.findIndex(i => i.field === "country")],
       $columns_array[$columns_array.findIndex(i => i.field === "created_at")],
       $columns_array[$columns_array.findIndex(i => i.field === "status")],
       // $columns_array[$columns_array.findIndex(i => i.field === "actions")]
    ];
    $allusers_array = [
       $columns_array[$columns_array.findIndex(i => i.field === "name")],
       $columns_array[$columns_array.findIndex(i => i.field === "user_type")],
       $columns_array[$columns_array.findIndex(i => i.field === "therisr_score")],
       $columns_array[$columns_array.findIndex(i => i.field === "country")],
       $columns_array[$columns_array.findIndex(i => i.field === "created_at")],
       $columns_array[$columns_array.findIndex(i => i.field === "status")],
       // $columns_array[$columns_array.findIndex(i => i.field === "actions")]
    ];

    $this_columns_array = $allusers_array;

    <?php if(!empty($type) && $type == 1) { ?>
         $this_columns_array = $freelancer_array;
    <?php } elseif(!empty($type) && $type == 2) { ?>
         $this_columns_array = $employer_array;
    <?php }?>

    console.log($this_columns_array, '<?=$type;?>');

    var datatable = $('#kt_datatable_u').KTDatatable({
        data: { 
            type: 'remote',  
            source: {
                read: {                        
                    url: '{{Route("admin.get_users")}}',
                    params: {
                        'user_type' : "<?php echo !empty($type)?$type:'all' ;?>"
                    },
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
            scroll: true,
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
        columns: $this_columns_array,
        stateSaveParams: function ( settings, data ) {
            for ( var i=0, ien=data.columns.length ; i<ien ; i++ ) {
                delete data.columns[i].visible;
            }
        }

    });

    $('#kt_datatable_u_search_status').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'status');
    });

    $('#kt_datatable_u_search_type').on('change', function() {
        datatable.search($(this).val().toLowerCase(), 'user_type');
    });

    $('#kt_datatable_u_search_status, #kt_datatable_u_search_type').selectpicker();


</script>