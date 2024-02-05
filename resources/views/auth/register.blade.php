@extends('layouts.auth')
@extends('layouts.auth')

@section('content')

  <!-- log in section start -->
    <section class="log-in-section background-image-2 section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{asset('assets/images/inner-page/log-in.png')}}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Welcome To {{ config('app.name') }}</h3>
                            <br>
                            <h4>Create Your Account or <a href="{{ route('login') }}">Login </a></h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" method="POST" action="{{ route('register') }}">
                                    @csrf



                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">

                                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                        <label for="email">Your Full Name</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">

                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="password">Password</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">

<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <label for="password">Confirm Password</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-animation w-100 justify-content-center theme-bg-color" type="submit">Create</button>
                                </div>
                            </form>
                        </div>

                        {{-- <div class="other-log-in">
                            <h6>or</h6>
                        </div>

                        <div class="log-in-button">
                            <ul>
                                <li>
                                    <a href="/login-g" class="btn google-button w-100">
                                        <img src="{{asset('assets/images/inner-page/google.png')}}" class="blur-up lazyload"
                                            alt=""> Log In with Google
                                    </a>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="other-log-in">
                            <h6></h6>
                        </div>

                        {{-- <div class="sign-up-box">
                            <h4>Don't have an account?</h4>
                            <a href="{{ route('register') }}">Sign Up</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- log in section end -->

@endsection
