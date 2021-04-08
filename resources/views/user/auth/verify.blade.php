@extends('user.layouts.app')

@section('content')


   <div class="forgot-content verify-email">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 p-0">
               <img class="verfy-img" src="{{ asset('assets/img/verify.png')}}">
                <h1 class="text-center">Verify your email<br> to procceed</h1>
            </div>
         </div>
         <div class="forgot-form-cont text-center">
            <div class="row">
               <div class="col-sm-12 p-0">
                   <h3>
                        @if (session('resent'))
                               We just sent an email to the address: <a href="javascript:void(0);">{{ $email }} </a><br>
                        @endif
                   
                           Before proceeding, please check your mailbox and click on the link provided to <br>verify you address.
                   </h3>
                    
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="signin-btn mb-3">
                           <button type="submit" class="btn primary">{{ __('Resend Verification Email') }}</button>.
                        </div>
                    </form>
            
                   <a class="need-help" href="mailto:{{ isset($settings->email) ? $settings->email : config('app.email') }}">I need help verifying my email</a>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
