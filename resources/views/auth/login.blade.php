@extends('layouts.auth')

@section('content')
    <!-- log in section start -->

                        <div class="log-in-title">
                            <h3>Welcome To {{ config('app.name') }}</h3>
                            <br>
                            <h4>Log In Your Account  or <a href="{{ route('register') }}">Create account </a></h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">

                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                        <input id="password-field" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="password">Password</label>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <button class="btn btn-animation w-100 justify-content-center theme-bg-color" type="submit">Log
                                        In</button>
                                </div>
                            </form>
                        </div>

    <!-- log in section end -->

    @endsection
