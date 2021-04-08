@extends('admin.layouts.main')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader grid-item" id="kt_subheader">
   <div class="container container-fluid">
      <div class="subheader-main">
         <!---->
         <h3 class="subheader-title">Payment Settings</h3>
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
                                <h3 class="card-label font-weight-bolder text-dark">Payment Settings</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Update the payment informaiton</span>
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
                                <input type="hidden" name="stripe_settings" value="stripe_settings">
                            <!--begin::Body-->
                            <div class="card-body">
                                <input type="hidden" name="id" value="{{ $settings->id }}">
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Test Mode
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <span class="switch switch-outline switch-icon switch-success">
                                            <label>
                                                <input type="checkbox" 
                                                checked="checked" 
                                                name="stripe_mode">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                        Stripe Test Secret Key <span>*</span>
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" 
                                        class="form-control form-control-lg form-control-solid @error('stripe_test_secret_key') is-invalid @enderror" 
                                        name="stripe_test_secret_key" 
                                        value="{{ $settings->stripe_test_secret_key }}">
                                        @error('stripe_test_secret_key')
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
                                       Stripe Test Publishable Key <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" 
                                        class="form-control form-control-lg form-control-solid @error('stripe_test_pub_key') is-invalid @enderror" 
                                        name="stripe_test_pub_key" 
                                        value="{{ $settings->stripe_test_pub_key }}"
                                        >
                                        @error('stripe_test_pub_key')
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
                                        Stripe Live Secret Key <span>*</span>
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" 
                                        class="form-control form-control-lg form-control-solid @error('stripe_live_secret_key') is-invalid @enderror" 
                                        name="stripe_live_secret_key" 
                                        value="{{ $settings->stripe_live_secret_key }}">
                                        @error('stripe_live_secret_key')
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
                                       Stripe Live Publishable Key <span>*</span>
                                    </label> 
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="text" 
                                        class="form-control form-control-lg form-control-solid @error('stripe_live_pub_key') is-invalid @enderror" 
                                        name="stripe_live_pub_key" 
                                        value="{{ $settings->stripe_live_pub_key }}"
                                        >
                                        @error('stripe_live_pub_key')
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
                    stripe_live_pub_key: {
                        validators: {
                            notEmpty: {
                                message: 'Live publishable key is required'
                            }
                        }
                    },
                    stripe_live_secret_key: {
                        validators: {
                            notEmpty: {
                                message: 'Live Secret Key is required'
                            },
                        }
                    },
                    stripe_test_pub_key: {
                        validators: {
                            notEmpty: {
                                message: 'Test publishable key is required'
                            }
                        }
                    },
                    stripe_test_secret_key: {
                        validators: {
                            notEmpty: {
                                message: 'Test Secret Key is required'
                            },
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