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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css">

    <!-- Fonts -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Login</title>


 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js')}}"></script>
     <script src="{{ asset('assets/js/popper.min.js')}}"></script>
     <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
     <script src="{{ asset('assets/js/choices.min.js')}}"></script>
     <script src="{{ asset('assets/js/jquery-1.12.4.js')}}"></script>
     <!-- this  min file needful to open filetrs dropdown -->
     <script src="{{ asset('assets/js/jquery.min.js')}}"></script>


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

        <!--pace loader-->
     <link rel="stylesheet" href="{{ asset('assets/css/pace.css')}}">
     <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' 
     src="{{ asset('assets/js/pace.min.js')}}"></script>

</head>
<body>

    <div class="overlay loader-new" style="display: none;">
        <div class="cntr-ver">
           <span id='loaderheading'> loading ...... </span>
           <img class="size-load loaderimg" src="{{ asset('assets/img/spinner.gif') }}">
        </div>
    </div>


<div id="wrapper">

             @if(Route::current()->getName() != 'login')
                <header>
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-12 p-0">
                              <div class="header-logo"> <a href="{{ url('/') }}"> <img class="logo" src="{{ asset('assets/img/logo.png')}}"></a></div>
                           </div>
                        </div>
                     </div>
                </header>
            @endif


        
            
       @yield('content')

</div>


<script type="text/javascript">
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


</script>
    

</body>
</html>
