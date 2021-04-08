<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- favicon icon -->
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
    
    <!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/admin/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css" /> -->
   
    <!-- Fonts -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title></title>



</head> 
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
			<!--begin::Logo-->
			<!-- <a href="index.html">
				<img alt="Logo" src="{{ asset('assets/img/logo.png')}}" class="logo-default max-h-30px" />
			</a> -->
            <div class="kt-aside__brand kt-grid__item" id="kt_aside_brand">
                <div class="kt-aside__brand-logo">
                    <a href="{{ route('admin./') }}">
                        <img alt="logo" src="{{ asset('assets/img/logo.png')}}">
                    </a>
                </div>
            </div>
           <!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Aside Mobile Toggle-->
				<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
					<span></span>
				</button>
				<!--end::Aside Mobile Toggle-->
				<!--begin::Header Menu Mobile Toggle-->
				<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<!--end::Header Menu Mobile Toggle-->
				<!--begin::Topbar Mobile Toggle-->
				<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
				<!--end::Topbar Mobile Toggle-->
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Aside-->
				<div class="aside aside-left d-flex flex-column" id="kt_aside">
					<!--begin::Brand-->
					<div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-4 py-lg-8">
						<!--begin::Logo-->
						<!-- <a href="index.html">
							<img alt="Logo" src="{{ asset('assets/img/logo.png')}}" class="max-h-30px" />
						</a> -->
                        <div class="kt-aside__brand kt-grid__item" id="kt_aside_brand">
                          <div class="kt-aside__brand-logo">
                            <a href="{{ route('admin./') }}">
                               <img alt="logo" src="{{ asset('assets/img/logo.png')}}">
                            </a>
                          </div>
                        </div>
						<!--end::Logo-->
					</div>
					<!--end::Brand-->
					<!--begin::Nav Wrapper-->
					<div class="aside-nav d-flex flex-column align-items-center flex-column-fluid pt-7">
						<!--begin::Nav-->
						<ul class="nav flex-column">
							<!--begin::Item-->
							<li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Dashboard">
								<a href="{{ route('admin./') }}" 
								class="nav-link btn btn-icon btn-clean btn-icon-white btn-lg {{ (Route::current()->getName() == 'admin.dashboard' || Route::current()->getName() == 'admin./') ? 'active' : '' }}">
									<i class="flaticon2-architecture-and-city icon-lg"></i>
								</a>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Users">
								<a href="{{ route('admin.users') }}" 
								class="nav-link btn btn-icon btn-clean btn-icon-white btn-lg {{ (Route::current()->getName() == 'admin.users') ? 'active' : '' }}" 
								>
									<i class="flaticon2-user-outline-symbol icon-lg"></i>
								</a>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Job Reports">
								<a href="{{ route('admin.job_reports') }}"
								class="nav-link btn btn-icon btn-clean btn-icon-white btn-lg {{ (Route::current()->getName() == 'admin.job_reports') ? 'active' : '' }}"
								>
									<i class="flaticon2-graph icon-lg"></i>
								</a>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Transactions">
								<a href="{{ route('admin.transactions') }}" 
								class="nav-link btn btn-icon btn-clean btn-icon-white btn-lg {{ (Route::current()->getName() == 'admin.transactions') ? 'active' : '' }}"
								>
									<i class="flaticon2-paper icon-lg"></i>
								</a>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Settings">
								<a href="{{ route('admin.settings') }}" 
								class="nnav-link btn btn-icon btn-clean btn-icon-white btn-lg {{ (Route::current()->getName() == 'admin.settings') ? 'active' : '' }}"
								>
									<i class="flaticon2-gear icon-lg"></i>
								</a>
							</li>
							<!--end::Item-->
						</ul>
						<!--end::Nav-->
					</div>
					<!--end::Nav Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header bg-white header-fixed">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Left-->
							<div class="d-flex align-items-stretch mr-2">
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="kt_header_menu header-menu header-menu-mobile header-menu-layout-default">
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											<li class="menu-item 
											{{ (Route::current()->getName() == 'admin./' || Route::current()->getName() == 'admin.dashboard') ? 'menu-item-active' : '' }}"
											 aria-haspopup="true">
												<a href="{{ route('admin./') }}" class="menu-link">
                                                <i class="kt-menu__link-icon flaticon2-architecture-and-city"></i>
													<span class="menu-text">Dashboard</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel {{ (Route::current()->getName() == 'admin.users' || Route::current()->getName() == 'admin.users') ? 'menu-item-active' : '' }}" 
												data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
                                                    <i class="kt-menu__link-icon flaticon2-user-outline-symbol"></i>
													<span class="menu-text">Users</span>
													<span class="menu-desc"></span>
													<i class="kt-menu__hor-arrow la la-angle-down ng-star-inserted"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                                  <span class="kt-menu__arrow"></span>	
                                                   <ul class="menu-subnav">
														<li class="menu-item menu-item-submenu"  data-placement="right" data-menu-toggle="hover" aria-haspopup="true">
															<a href="{{ route('admin.users', ['type' => 'freelancers']) }}" class="menu-link">
                                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"></i>
																<span class="kt-menu__link-text menu-text">Freelancers</span>
															</a>
														</li>
                                                        <li class="menu-item menu-item-submenu"  data-placement="right" data-menu-toggle="hover" aria-haspopup="true">
															<a href="{{ route('admin.users', ['type' => 'employers']) }}" class="menu-link">
                                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"></i>
																<span class="kt-menu__link-text menu-text">Employer</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel
											{{ (Route::current()->getName() == 'admin.job_reports') ? 'menu-item-active' : '' }}"
												 data-menu-toggle="click" aria-haspopup="true">
												<a href="{{ route('admin.job_reports') }}" class="menu-link">
                                                <i class="kt-menu__link-icon flaticon2-graph"></i>
													<span class="menu-text">Job Reports</span>
													<span class="menu-desc"></span>
												</a>
											</li>
                                            <li class="menu-item menu-item-submenu menu-item-rel
											{{ (Route::current()->getName() == 'admin.transactions') ? 'menu-item-active' : '' }}"
											 data-menu-toggle="click" aria-haspopup="true">
												<a href="{{ route('admin.transactions') }}" class="menu-link">
                                                <i class="kt-menu__link-icon flaticon2-paper"></i>
													<span class="menu-text">Transactions</span>
													<span class="menu-desc"></span>
												</a>
											</li>
											 <li class="menu-item menu-item-submenu menu-item-rel
											{{ (Route::current()->getName() == 'admin.settings') ? 'menu-item-active' : '' }}"
											 data-menu-toggle="click" aria-haspopup="true">
												<a href="{{ route('admin.settings') }}" class="menu-link">
                                                <i class="kt-menu__link-icon flaticon2-gear"></i>
													<span class="menu-text">Settings</span>
													<span class="menu-desc"></span>
												</a>
											</li>
										</ul>
										<!--end::Header Nav-->
									</div>
									<!--end::Header Menu-->
								</div>
								<!--end::Header Menu Wrapper-->
							</div>
							<!--end::Left-->
							<!--begin::Topbar-->
							<div class="topbar">
								<!--begin::User-->
								<div class="topbar-item">
									<div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
										<div class="d-flex flex-column text-right pr-3">
											<span class="text-muted font-weight-bold font-size-base d-none d-md-inline">
												{{ Auth::user()->name }} 
											</span> 
										</div>
										<span class="symbol symbol-35 symbol-light-primary">
										@if(Auth::user()->admin_image != '')
                                            @php 
                                              $image =  asset('assets/admin/users').'/'.Auth::user()->admin_image; 
                                            @endphp 
                                        @else
                                             @php 
                                               $image =  asset('assets/admin/users/default.jpg');
                                             @endphp 
                                        @endif
                                        <img src="{{ $image }}"/>
 										</span>
									</div>
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					  @yield('content')
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2">2020©</span>
								<a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Keenthemes</a>
							</div>
							<!--end::Copyright-->
							
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->

		<!-- begin::User Panel-->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">User Profile
				</h3>
				<a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				<!--begin::Header-->
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						<div class="symbol-label" style="background-image:url('{{$image}}')"></div>
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="javascript:void(0);" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"> {{ Auth::user()->name  }}</a>
						<div class="navi mt-2">
							<a href="javascript:;" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-text text-muted text-hover-primary">
										{{ Auth::user()->email }}
									</span>
								</span>
							</a>
							<a class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                                href="{{ route('admin.auth.logout') }}" 
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Sign Out 
                            </a>

                            <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>

						</div>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Separator-->
				<div class="separator separator-dashed mt-8 mb-5"></div>
				<!--end::Separator-->
				<!--begin::Nav-->
				<div class="navi navi-spacer-x-0 p-0">
					<!--begin::Item-->
					<a href="{{ route('admin.settings', ['type' => 'profile']) }}" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
												<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">My Profile</div>
								<div class="text-muted">Account settings and more
								</div>
							</div>
						</div>
					</a>
					<!--end:Item-->
				
				</div>
				<!--end::Nav-->
			</div>
			<!--end::Content-->
		</div>
		<!-- end::User Panel-->
	
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
	
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#8950FC", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
<!--         <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
 -->		<script src="{{ asset('assets/admin/js/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/admin/js/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ asset('assets/admin/js/widgets.js') }}"></script>
		<!--end::Page Scripts-->

        <script type="text/javascript">
        	toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": true,
			  "positionClass": "toast-bottom-left",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": "500",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			};

            $(document).ready(function(){
            <?php if(Session::has('success')){ ?>
                toastr.success("{{ Session::get('success') }}");
            <?php }else if(Session::has('error')){ ?>
                toastr.error("{{ Session::get('error') }}");
            <?php }else if(Session::has('message')){ ?>
                toastr.success("{{ Session::get('message') }}");
            <?php }else if(Session::has('status')){ ?>
                toastr.success("{{ Session::get('status') }}");
            <?php } ?>

                <?php if ($errors->any()){
                foreach ($errors->all() as $error){?>
                	toastr.error('{{ $error }}');
                <?php }} ?>


            $('.closeAlert').click(function(){
                $("#response").remove();
            });
            });

            function showScreenLoader(msg = null)
            {
                $('.loader-new').show();
                console.log('loader');
                if(msg != '' && msg != null)
                {
                    $('#loaderheading').html(msg);
                    $('#loaderheading').css('display','block');
                }
                $('body').addClass('pace-running');
                $('#wrapper').css('opacity','.2');
            }
            function hideLoader()
            {
                $('.loader-new').hide();
                $('#loaderheading').html('Loadeing ....');
                $('#loaderheading').css('display','none');
                $('body').removeClass('pace-running');
                $('#wrapper').css('opacity','1');
            }

              // get seller listing with ajax
    function getUsersTable($type='')
    { 
       
        $.ajax({
            url: '{{ url("admin/users")}}/' + $type,
            success:function(response)
            {
                $('#user_area').html(response); //using those id;s here
                KTApp.unblock('.blockSpinnerArea');  
            },error:function(errorResponse)
            {
               if(errorResponse.status == 401)
               {
                 location.reload();
               }
            } 
        })
    }
</script>


            @yield('footer')


    </body>
	<!--end::Body-->
</html>


		