@extends('admin.layouts.main')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader grid-item" id="kt_subheader">
   <div class="container container-fluid">
      <div class="subheader-main">
         <!---->
         <h3 class="subheader-title">Profile Settings</h3>
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
                                <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                            </div>
                           
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                       <form class="form"
                       id="kt_form_1"
                       name="admin_profile" 
                       method="POST"
                       action="{{ route('admin.updateprofile') }}" 
                       enctype="multipart/form-data">
                                @csrf
                                
                            <!--begin::Body-->
                            <div class="card-body">
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">Avatar</label>
                                    <div class="col-lg-9 col-xl-6">
                                        @if($admin->admin_image != '')
                                            @php 
                                              $image =  asset('assets/admin/users').'/'.$admin->admin_image; 
                                            @endphp 
                                        @else
                                             @php 
                                               $image =  asset('assets/admin/users/default.jpg');
                                             @endphp 
                                        @endif
                                            <div class="image-input image-input-outline image-input-empty"
                                                id="kt_profile_avatar" 
                                                style="background-image:url({{ $image }})">
                                                <div class="image-input-wrapper"></div>

                                           
                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change profile picture">
                                                    <i class="fa fa-pencil icon-sm text-muted"></i>
                                                    <input type="file" name="admin_image" accept=".png, .jpg, .jpeg" />
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">Allowed file types: png, jpg,
                                                jpeg.</span>
                                    </div>
                                </div>
                                 <!--begin::Group-->
                                <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Name</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                value="{{$admin->name}}" name="name" />
                                        </div>
                                </div>
                                 <!--begin::Group-->
                                <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Email Address</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="la la-at"></i>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-control-lg form-control-solid"
                                                    value="{{$admin->email}}" placeholder="Email" name="email" />
                                            </div>
                                        </div>
                                </div>
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">
                                    </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <button type="submit" name="submitButton" 
                                        class="btn btn-success mr-2">Save Changes</button>
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
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter name'
                            },
                            stringLength: {
                                min:2,
                                max:50,
                                message: 'Please enter a valid name'
                            }
                        }
                    }                   
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

    var avatar5 = new KTImageInput('kt_profile_avatar');
        avatar5.on('change', function(imageInput) {    
    });
</script>
@endsection