@extends('admin.layouts.main')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader grid-item" id="kt_subheader">
   <div class="container container-fluid">
      <div class="subheader-main">
         <!---->
         <h3 class="subheader-title">Site Settings</h3>
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
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                 @include('admin.settings.sidebar')
                <!--end::Aside-->
                <!--begin::Content--> 
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Site Settings</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Update the site informaiton</span>
                            </div>
                           
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                       <form class="form"
                       id="kt_form_1"
                       name="admin_profile" 
                       method="POST" 
                       action="{{ route('admin.update_settings') }}" 
                       enctype="multipart/form-data">
                                @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <input type="hidden" name="id" value="{{ $settings->id }}">
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        App Name <span>*</span>
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" 
                                        class="form-control form-control-lg form-control-solid @error('app_name') is-invalid @enderror"
                                        placeholder="App name" 
                                        name="app_name" 
                                        value="{{ $settings->app_name }}"
                                        autocomplete="app_name" />
                                        @error('app_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Contact Email <span>*</span>
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" 
                                        class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" 
                                        placeholder="Email"
                                        name="email" 
                                        value="{{ $settings->email }}" 
                                        autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Service Fee (%) <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="number" 
                                        class="form-control form-control-lg form-control-solid @error('service_fee') is-invalid @enderror" 
                                        placeholder="Service Fee"
                                        name="service_fee" 
                                        value="{{ $settings->service_fee }}"
                                        onkeypress="return isNumber(this);" 
                                        oninput="return validatePercentage(event,this);" 
                                        >
                                        <div class="fv-plugins-message-container"><div data-field="email" data-validator="notEmpty" class="fv-help-block"></div></div>
                                        @error('service_fee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Front Site Link <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="test" 
                                        class="form-control form-control-lg form-control-solid @error('frontsite_link') is-invalid @enderror" 
                                        name="frontsite_link" 
                                        value="{{ $settings->frontsite_link }}"
                                        >
                                        @error('frontsite_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Cookie Page Link <span></span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="test" 
                                        class="form-control form-control-lg form-control-solid @error('cookie_link') is-invalid @enderror" 
                                        name="cookie_link" 
                                        value="{{ $settings->cookie_link }}"
                                        >
                                        @error('cookie_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Privacy Policy Link <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="test" 
                                        class="form-control form-control-lg form-control-solid @error('privacy_link') is-invalid @enderror" 
                                        name="privacy_link" 
                                        value="{{ $settings->privacy_link }}"
                                        >
                                        @error('privacy_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Terms Link <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="test" 
                                        class="form-control form-control-lg form-control-solid @error('term_link') is-invalid @enderror" 
                                        name="term_link" 
                                        value="{{ $settings->term_link }}"
                                        >
                                        @error('term_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Help Link <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="test" 
                                        class="form-control form-control-lg form-control-solid @error('help_link') is-invalid @enderror" 
                                        name="help_link" 
                                        value="{{ $settings->help_link }}"
                                        >
                                        @error('help_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Instagram Link <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="test" 
                                        class="form-control form-control-lg form-control-solid @error('insta_link') is-invalid @enderror" 
                                        name="insta_link" 
                                        value="{{ $settings->insta_link }}"
                                        >
                                        @error('insta_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Group-->
                                
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <button type="submit" name="submitButton" 
                                        class="btn btn-success mr-2 btnSubmit">Save Changes</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                                <!--end::Group-->
                            </div>
                            <!--end::Body-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->

@endsection
@section('footer')
<script> 
    const form = document.getElementById('kt_form_1');
    FormValidation.formValidation(
            form,
            {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email is required'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },
                    app_name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter app name'
                            },
                            stringLength: {
                                min:2,
                                max:50,
                                message: 'Please enter a valid app name'
                            }
                        }
                    } ,
                    frontsite_link: {
                        validators: {
                            notEmpty: {
                                message: 'Website URL is required'
                            },
                            uri: {
                                message: 'The website address is not valid'
                            }
                        }
                    },
                    cookie_link: {
                        validators: {
                            uri: {
                                message: 'The website address is not valid'
                            }
                        }
                    },
                    privacy_link: {
                        validators: {
                            notEmpty: {
                                message: 'Website URL is required'
                            },
                            uri: {
                                message: 'The website address is not valid'
                            }
                        }
                    },
                    term_link: {
                        validators: {
                            notEmpty: {
                                message: 'Website URL is required'
                            },
                            uri: {
                                message: 'The website address is not valid'
                            }
                        }
                    },
                    help_link: {
                        validators: {
                            notEmpty: {
                                message: 'Website URL is required'
                            },
                            uri: {
                                message: 'The website address is not valid'
                            }
                        }
                    },
                    insta_link: {
                        validators: {
                            notEmpty: {
                                message: 'Website URL is required'
                            },
                            uri: {
                                message: 'The website address is not valid'
                            }
                        }
                    },

                    // service_fee: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Please enter service fee'
                    //         },
                    //         stringLength: {
                    //             min:0,
                    //             max:100,
                    //             message: 'Please enter a valid service fee'
                    //         }
                    //     }
                    // }                  
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                }
            }
        ).on('core.form.valid', function() {
          form.submit();
        });


   function validatePercentage(evt,thisv)
    {
       evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
       
        if($(thisv).val() > 100 || $(thisv).val() < 0){
                $(thisv).addClass('is-invalid');
                $(thisv).parent().find('.fv-plugins-message-container div').html('Please enter the correct value!');
                $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
                return false;
        }
        else{
             var len = $(thisv).val().length;
             var index = $(thisv).val().indexOf('.');
             if (index > 0) {
                 var CharAfterdot = (len) - index;
                 if (CharAfterdot > 3) {
                  $(thisv).addClass('is-invalid');
                     $(thisv).parent().find('.fv-plugins-message-container div').html('Please enter the correct value!');
                     $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
                     return false;
                 } 
             }
             $(thisv).removeClass('is-invalid');
             $(thisv).parent().find('.fv-plugins-message-container div').html('');
            $(thisv).closest('form').find('.btnSubmit').removeAttr('disabled');
           return true;
        }
    }


  function isNumber(evt) 
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
          return false;
        }
        return true;
    }


</script>
@endsection