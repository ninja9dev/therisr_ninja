@extends('admin.layouts.app')

@section('content')
<section class="login-form">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="row height-cl">
                        <div class="col-lg-8 offset-lg-2 d-flex justify-content-center align-items-center">
                            <div class="left-content text-center loginpd-respons"> 
                                <img class="logo mb-3" src="{{ asset('assets/img/logo.png')}}">
                                <h1 class="mb-3">Admin Login</h1>

                                <!--begin::Title-->
                                 <form method="POST" action="{{ route('admin.auth.loginAdmin') }}">
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
                                    <div class="form-group mb-3">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="signin-btn mb-3">
                                        <button type="submit" class="btn btn-primary">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="image-right displaynone-img">
                        <img src="{{ asset('assets/img/admin/login-bg.jpg')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
