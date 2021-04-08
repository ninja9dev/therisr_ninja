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

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">

    <!-- Styles -->
      <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css')}}" type="text/css">
      <link rel="stylesheet" href="{{ asset('assets/css/choices.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css')}}"> 
      <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css">
     @php
       $pages = array("user.appliedjobs","user.myfreelancer","user.alloffers", "user.allcontracts", "user.activecontracts","user.archivedcontracts", "user.offerjobs" ,"user.likedjobs", "user.skippedjobs", "user.alljobs", "user.activejobs", "user.archivedjobs", "user.e_myjobs", "user.draftjobs", "user.myjobs", "user.activecontract","user.endedcontract","user.e_endedcontract", "user.archivedcontract", "user.jobreports", "user.job", "user.contract");
      @endphp
      @if (in_array(Route::current()->getName(), $pages))
        <link rel="stylesheet" href="{{ asset('assets/css/report-custom.css')}}" type="text/css">
      @endif
      <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}" type="text/css">
      <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}" type="text/css">

     
     @php 
       $pages = array("user.messages");
     @endphp
      @if (in_array(Route::current()->getName(), $pages))
      <link rel="stylesheet" href="{{ asset('assets/css/chat.css')}}" type="text/css">
      @endif

    <!-- Fonts -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <title>Login</title>


 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js')}}"></script>
     <script src="{{ asset('assets/js/popper.min.js')}}"></script>
     <script src="{{ asset('assets/js/choices.min.js')}}"></script>
     <script src="{{ asset('assets/js/jquery-1.12.4.js')}}"></script>
     <!-- this  min file needful to open filetrs dropdown -->
     <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
     <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>


     <script src="{{ asset('assets/js/jquery-ui.js')}}"></script>
 

     <!-- Select2 -->
    <link href="{{ asset('assets/css/select2.css')}}" rel="stylesheet" />
    <script src="{{ asset('assets/js/select2.js')}}"></script>

    <!-- validate -->    
    <script src="{{ asset ('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset ('assets/js/jquery.autofill.min.js') }}"></script>

    <!--toast-->
    <link rel="stylesheet" href="{{ asset ('assets/css/jquery.toast.css') }}"/>
    <script src="{{ asset ('assets/js/jquery.toast.js') }}"></script>

    <!-- confirmation tooltip-->
    <script src="{{ asset ('assets/js/bootstrap-tooltip.js') }}"></script>
    <script src="{{ asset ('assets/js/bootstrap-confirmation.js') }}"></script>


    <!--pace loader-->
     <link rel="stylesheet" href="{{ asset('assets/css/pace.css')}}">
     <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' 
     src="{{ asset('assets/js/pace.min.js')}}"></script>

     <!-- phone -->
    <link href="{{asset('assets/css/intelTelInput.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset ('assets/js/intelTelInput.min.js') }}"></script>


  <!-- Bootstarp Tag -->
    <link href="{{ asset('assets/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <script src="{{ asset('assets/js/bootstrap-tagsinput.js')}}"></script>


<style>
  .pagination{
    display: flex !important;
  }
</style>
<script type="text/javascript">
  var base_url = "{{ url('/') }}";
</script>
</head>



<body class="paddiset-landng">

    <div class="overlay loader-new" style="display: none;">
        <div class="cntr-ver">
           <span id='loaderheading'> loading ...... </span>
           <img class="size-load loaderimg" src="{{ asset('assets/img/spinner.gif') }}">
        </div>
    </div>


<div id="wrapper">
    <header class="landing-page-header">
     <div class="container-fluid p-lr-35">
        <div class="row">
           <nav class="navbar navbar-expand-lg navbar-light">
              <a class="navbar-brand" href="{{ url('/') }}">
                 <div class="col-sm-12">
                    <div class="header-logo"><img class="logo" src="{{ asset('assets/img/logo.png')}}">
                    </div>
                 </div>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav mr-auto">
                    
                    @if($user->user_type == '2')
                    <li class="nav-item {{ (Route::current()->getName() == 'user.e_myjobs') ? 'active' : '' }}">
                       <a class="nav-link"
                        href="{{ route('user.e_myjobs') }}">My Jobs</a>
                    </li>
                    <li class="nav-item {{ (Route::current()->getName() == 'user.allcontracts') ? 'active' : '' }}">
                       <a class="nav-link"
                        href="{{ route('user.allcontracts') }}">Contracts</a>
                    </li>
                    @else
                    <li class="nav-item {{ (Route::current()->getName() == 'user.alljobs') ? 'active' : '' }}">
                       <a class="nav-link"
                        href="{{ route('user.alljobs') }}">All Jobs </a>
                    </li>
                     <li class="nav-item {{ (Route::current()->getName() == 'user.myjobs') ? 'active' : '' }}">
                       <a class="nav-link"
                        href="{{ route('user.myjobs') }}">My Jobs</a>
                    </li>
                    @endif
                    @if($user->user_type == '2')
                      <li class="nav-item {{ (Route::current()->getName() == 'user.myjobs') ? 'active' : '' }}">
                         <a class="nav-link"
                          href="{{ route('user.myjobs') }}">My Freelancers</a>
                      </li>
                    @endif
                    <li class="nav-item {{ (Route::current()->getName() == 'user.messages') ? 'active' : '' }}">
                       <a class="nav-link"
                        href="{{ route('user.messages') }}">Messages
                           <span class="notice message_counter">0</span>
                       </a>
                    </li>
                    <li class="nav-item mobLink {{ (Route::current()->getName() == 'user.gen_settings') ? 'active' : '' }}">
                       <a class="nav-link"
                        href="{{ route('user.gen_settings') }}">Profile & Settings
                       </a>
                    </li>
                    <li class="nav-item mobLink">
                       <a class="nav-link"
                        href="{{ !empty($settings->help_link) ? $settings->help_link : '' }}">Help
                       </a>
                    </li>
                    <li class="nav-item mobLink">
                       <a class="nav-link"
                        href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Log Out
                       </a>
                    </li>
                    <li class="nav-item dropdown drop-news">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @php
                            if(Auth::user()->image != '') $image =  asset('assets/users').'/'.Auth::user()->image; 
                            else $image =  asset('assets/users/default.jpg'); 
                         @endphp
                              <img src="{{ $image }}" class="topProfile-image round-pic user_image ng-star-inserted"> 

                       </a>
                       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('user.gen_settings') }}">Profile & Settings</a>
                          <a class="dropdown-item" href="https://www.therisr.com/#email-form">Help</a>
                           <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                       </div>
                    </li>
                 </ul>
               </div>
           </nav>
        </div>
        </div>
      </header>


 @yield('content')

  
    @php 
       $pages = array("user.messages");
     @endphp
      @if (!in_array(Route::current()->getName(), $pages))
        <footer class="footr-alls mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-footr-menu">
                            <li> <a href="{{ !empty($settings->help_link) ? $settings->help_link : '' }}" target="_blank"> Help </a> </li>
                            <li> <a href="{{ !empty($settings->term_link) ? $settings->term_link : '' }}" target="_blank"> Terms of Service </a> </li>
                            <li> <a href="{{ !empty($settings->privacy_link) ? $settings->privacy_link : '' }}" target="_blank"> Privacy Policy </a> </li>
                            <li> <a href="{{ !empty($settings->cookie_link) ? $settings->cookie_link : '' }}" target="_blank"> Cookie Policy </a> </li>
                        </ul>
                        <p class="copyryt"> &copy; {{ date('Y') }} <a href="{{ !empty($settings->frontsite_link) ? $settings->frontsite_link : '' }}" target="_blank">TheRisr.com </a></p>
                        
                        <ul class="list-footr-menu social-icn">
                            <li> 
                                <a href="{{ !empty($settings->insta_link) ? $settings->insta_link : 'https://www.instagram.com/the_risr_freelanceinstartup/'" target="_blank"> 
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        @endif

 </div>
  @yield('footer')


 <script>
// below jquery required for filters top bar
      $(document).ready(function(){
      <?php if(Session::has('success')){ ?>
             $.toast({
                 heading: 'Success',
                 text: "{{ Session::get('success') }}",
                 showHideTransition: 'slide',
                 icon: 'success'
            });
       <?php }else if(Session::has('error')){ ?>
           $.toast({
                   heading: 'Error',
                   text: "{{ Session::get('error') }}",
                   showHideTransition: 'slide',
                   icon: 'error'
              });
       <?php }else if(Session::has('message')){ ?>
           $.toast({
                   heading: 'Success',
                   text: "{{ Session::get('message') }}",
                   showHideTransition: 'slide',
                   icon: 'success'
              });
        <?php }else if(Session::has('status')){ ?>
           $.toast({
                   heading: 'Success',
                   text: "{{ Session::get('status') }}",
                   showHideTransition: 'slide',
                   icon: 'success'
              });
       <?php } ?>

        <?php if ($errors->any()){
           foreach ($errors->all() as $error){?>
              $.toast({
                       heading: 'Error',
                       text: "{{ $error }}",
                       showHideTransition: 'slide',
                       icon: 'error'
                  });
        <?php }} ?>

      $('.closeAlert').click(function(){
         $("#response").remove();$('.pos-erroe').remove();
      });

      // auto hide error messages when user start typing
      $('form').on('keyup change paste', 'input, select, textarea', function(){
        $(this).closest('form').validate().resetForm();
          console.log('Form changed!', this);
      });

      // collapse position scroll issue
      $('.collapse').on('shown.bs.collapse', function(e) {
        var $card = $(this).closest('.card');
        $('html,body').animate({
          scrollTop: $card.offset().top
        }, 1000);
      });

      // restrict all form submit on enter
      function stopRKey(evt) {
          var evt = (evt) ? evt : ((event) ? event : null);
          var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
          if ((evt.keyCode == 13) && ((node.type=="text") || (node.type=="radio") || (node.type=="checkbox")) )  {return false;}
      }

        document.onkeypress = stopRKey;

    });


        // multi select
       $('#services_filter').select2({
           placeholder: "Select services",
           tags: false,
           multiple: true,
           tokenSeparators:[","]
       });

        // multi select
       $('#skills_filter').select2({
           placeholder: "Select skills",
           tags: false,
           multiple: true,
           tokenSeparators:[","]
       }); 

    </script>
    
    <script>
    $( function() {
    var availableTags = [
      "User Experience",
      "User Experience Design",
      "Universal Design",
      "User Interface",
      "User Interaction"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
    } );



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


    </script>


<!-- this code is for local timezone -->
@if($current_time_zone=Session::get('current_time_zone'))@endif
<input type="hidden" id="hd_current_time_zone" value="{{{$current_time_zone}}}"/>

<script type="text/javascript">
  $(document).ready(function(){
      if($('#hd_current_time_zone').val() ==""){ // Check for hidden field is empty. if is it empty only execute the post function
          var current_date = new Date();
          curent_zone = -current_date.getTimezoneOffset() * 60;
          var token = "{{csrf_token()}}";
          $.ajax({
            method: "POST",
            url: "{{URL::to('ajax/set_current_time_zone/')}}",
            data: {  '_token':token, curent_zone: curent_zone } 
          }).done(function( data ){
        });   
      }       
});



  // code for global message count
  var ajaxMessageCounter = null;
  setInterval(function()
  {  
    if(ajaxMessageCounter == null){
      ajaxMessageCounter = $.ajax({
          url: "{{ url('getGlobalMessageUnreadCount') }}",
          type: 'GET',
          success: function(response)
          {
              ajaxMessageCounter = null;
              $('.message_counter').html(response);
          }            
      });
    }
  }, 1000);



//popover confirmation close issue


</script>

      
   </body>
</html>
