@extends('user.layouts.app')

@section('content')
 
   <div class="forgot-content chge-pswd-pres">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 p-0">
                    <h1 class="text-center">Change your password</h1>
                   
                </div>
            </div>
            <div class="forgot-form-cont text-center change-form">
                <div class="row">
                    <div class="col-sm-12 p-0">
                        <div class="col-xl-4 offset-xl-4  offset-lg-2 col-sm-8 col-md-6 offset-md-3 offset-sm-2">
                            <div class="form-area">
                                <h2 class="text-left dan-morries-abc-dan">{{ $name ?? old('name') }} ({{ $email ?? old('email') }})</h2>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                     @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
 

                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                                    <div class="form-group">

                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                       
                                    </div>
                                    <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter Password">

                                    </div>
                                    <div class="signin-btn mb-3 mt-3">
                                        <button type="submit" class="btn btn-primary">Continue</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
