@extends('admin.layouts.main')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader grid-item" id="kt_subheader">
   <div class="container container-fluid">
      <div class="subheader-main">
         <!---->
         <h3 class="subheader-title">Change Password</h3>
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
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
                            </div>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form name="password_change" class="form" method="POST" 
                         action="{{ route('admin.pass_update')}}" >
                          @csrf
                            <div class="card-body">
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">
                                    Current Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="password" class="form-control form-control-lg form-control-solid mb-2" name="cpass" 
                                        placeholder="Current Password"
                                        value="{{ old('cpass') }}">
                                    </div>
                                </div>
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">
                                    New Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="password" 
                                        class="form-control form-control-lg form-control-solid" 
                                        placeholder="New Password" 
                                        name="password"
                                        value="{{ old('password') }}" 
                                        id="newpassword">
                                    </div>
                                </div>
                                 <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">
                                    Verify Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input id="password-confirm" 
                                        type="password" 
                                        class="form-control form-control-lg form-control-solid"
                                        name="password_confirmation" placeholder="Confirm Password" 
                                        value="{{ old('password_confirmation') }}">
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
<script type="text/javascript">

</script>
@endsection