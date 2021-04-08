@extends('user.layouts.app')

@section('content')

      <div class="forgot-content chge-pswd-pres">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 p-0">
               <h1 class="text-center">Forgot your password?</h1>
            </div>
         </div>
         <div class="forgot-form-cont text-center">
            <div class="row">
                <div class="col-sm-12 p-0">
                    <div class="col-xl-4 offset-xl-4  offset-lg-2 col-sm-8 col-md-6 offset-md-3 offset-sm-2">
                        <div class="form-area">
                          

                            <form method="POST" action="{{ route('password.email') }}">
                             @csrf
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                     name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                                     placeholder="Email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="signin-btn mb-3">
                                    <button type="submit" class="btn btn-primary">
                                       Send password reset info
                                    </button>
                                </div>
                            </form>
                        </div>  
                    </div>  
                  <h6 class="text-center it-may-take-several">It may take several minutes to receive a password reset<br> email. Make sure to check your junk mail.</h6>
              
                  <h3>Already have an account? <a href="{{ route('login') }}">Sign in here</a></h3>
               </div>
            </div>
         </div>
      </div>

@endsection
