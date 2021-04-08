@extends('user.layouts.app')

@section('content')
<section class="login-form">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row height-cl">
                        <div class="col-lg-8 offset-lg-2 d-flex justify-content-center align-items-center">
                            <div class="left-content text-center loginpd-respons"> 
                                <img class="logo mb-3" src="{{ asset('assets/img/logo.png')}}">
                                <h1 class="mb-3">Welcome Back.</h1>

                                <!--begin::Title-->
                                 <form method="POST" action="{{ route('user.loginUser') }}">
                                  @csrf
                                    <div class="form-group">
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                          name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-0">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
 
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div 
                                    class="form-group publicar-form phdblack d-flex justify-content-between align-items-center">
                                        <div class="form-group form-check mb-3 remember-check">
                                            <label 
                                            class="form-check-label text-black d-flex align-items-center">
                                                 <input 
                                                 class="form-check-input" 
                                                 type="checkbox" 
                                                 name="remember" 
                                                 id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                  {{ __('Remember me') }}
                                            </label>
                                        </div>
                                        <div class="text-right forot-pwd mb-3">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="signin-btn mb-3">
                                        <button type="submit" class="btn btn-primary">Sign In</button>
                                    </div>
                                    <div class="main-ls text-center">
                                        <p>Don't have an account? <a href="{{ route('register') }}">Sign up here</a></p>
                                    </div>
                                    <div class="signin-btn mb-3 mt-4 orsec">
                                        <div class="left-bord"></div><span>or</span><div class="right-bord"></div>
                                    </div>
                                    <div class="signin-btn mb-3 mt-4 linked-in">
                                        <a href="{{ route('user.linkedin', ['provider' => 'linkedin']) }}" type="button" 
                                            class="btn btn-primary"> 
                                            <img src="{{ asset('assets/img/linkedin.png')}}"> Continue with LinkedIn
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="image-right displaynone-img">
                        <img src="{{ asset('assets/img/img-right.jpg')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
