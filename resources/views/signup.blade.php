{{-- // refer app layout  --}}
@extends('app')

{{-- set title  --}}
@section('title', 'Signup | URS')

{{-- include header --}}
@push('style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Monoton&display=swap');

        .brand-name {
            font-family: 'Monoton', cursive;
        }

        .login-page {
            height: 100vh;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            border-radius: 0px !important;
            height: 3rem !important;
        }

        input:focus {
            border-color: var(--dws-primary-color) !important;
            outline: 0 !important;
            box-shadow: 0 0 0 0.15rem rgba(44, 46, 61, 0.25) !important;
        }

        button:focus {
            outline: none !important;
        }

        label {
            font-size: 14px !important;
            color: #57606f;
        }

        .create-account {
            font-size: 14px;
        }

        .password-container {
            position: relative;
        }

        .fa-eye {
            position: absolute;
            top: 60%;
            right: 4%;
            cursor: pointer;
            color: #747d8c;
        }
    </style>
@endpush

@section('body-content')
    @isset($message)
        <div class="container fixed-top pt-3" id="alert-container">
            <div class="alert {{ $status === 'false' ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show"
                role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endisset
    <div class="login-page d-flex justify-content-center align-items-center">
        <div class="login-container w-25">
            <div class="business-profile text-center mb-4">
                <div class="brand-logo"></div>
                <h2 class="brand-name">URL Shortner</h2>
            </div>
            <form method="post" action="{{ route('signup') }}">
                @csrf
                <div class="form-group">
                    <label for="userNameForSignup">Username</label>
                    <input type="text" class="form-control" name="user_name" id="userNameForSignup"
                        placeholder="Enter username" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="emailIdForSignup">Email</label>
                    <input type="email" class="form-control" name="user_email" id="emailIdForSignup"
                        placeholder="Enter email" autocomplete="off">
                </div>
                <div class="form-group password-container">
                    <label for="psw">Password</label>
                    <input type="password" class="form-control" name="password" id="psw" placeholder="Password"
                        autocomplete="off">
                    <i id="passwordShowHide" class="fa fa-eye" id="eye"></i>
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remeber me</label>
                </div>
                <p class="create-account"><a href="{{ route('login') }}">Already Have an Account</a></p>
                <button type="submit" class="btn u-s-btn-primary-color btn-block">Signup <i class="fa fa-sign-in"
                        aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
@endsection

{{-- include custom scripts  --}}
@push('scripts')
    <script>
        const passwordShowHide = document.getElementById('passwordShowHide');
        const psw = document.getElementById('psw');
        passwordShowHide.addEventListener('click', function() {
            if (psw.getAttribute("type") == 'password') {
                psw.setAttribute("type", "text")
                passwordShowHide.classList.toggle("fa-eye-slash");
            } else {
                psw.setAttribute("type", "password")
                passwordShowHide.classList.remove("fa-eye-slash");
            }
        });

    </script>
@endpush
