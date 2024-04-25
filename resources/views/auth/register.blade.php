@extends('layouts.auth')
@extends('layouts.auth')

@section('content')

    <div class="log-in-title">
        <h3>{{ config('app.name') }}</h3>
        <br>
        <h4>Create Your Account or <a href="{{ route('login') }}">Login </a></h4>
    </div>
    <div class="input-box">
        <form class="row g-4" method="POST" action="{{ route('register') }}">
            @csrf


            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

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

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                           class="form-control @error('password') is-invalid @enderror" name="password" required
                           autocomplete="current-password" onkeyup="checkPass()">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                    @enderror
                    <label for="password">Password</label>
                </div>
                <p  id="passwordMessage" class="text-danger" style="display: none;" >Password must have a number, Uppercase and a special  character</p>
            </div>

            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required autocomplete="new-password" onkeyup="checkPass(2)">
                    <label for="password">Confirm Password</label>

                </div>
                <p  id="passwordMessage2" class="text-danger" style="display: none;" >Password must have a number, Uppercase and a special  character</p>
            </div>

            <div class="col-12">
                <button class="btn btn-animation w-100 justify-content-center theme-bg-color" type="submit">Create
                </button>
            </div>
        </form>
    </div>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script>

        function checkPass(num=''){

            let password = $(`#passwordInput${num}`).val();

            const isValid = validatePassword(password);

            if (isValid) {
                $(`#passwordMessage${num}`).hide();

                $(`#btn-submit`).show();
            } else {
                $(`#btn-submit`).hide();
                $(`#passwordMessage${num}`).show();
            }
        }

        function validatePassword(password) {
            console.log(password)
            let isValid = true;
            if (password.length < 8 ||
                !/[a-z]/.test(password) ||
                !/[A-Z]/.test(password) ||
                !/\d/.test(password) ||
                !/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password)) {
                isValid = false;

            }


            return isValid;
        }

    </script>
@endsection
