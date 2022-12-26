{{-- // refer app layout  --}}
@extends('app')

{{-- set title  --}}
@section('title', 'URL Shortner')

{{-- include header --}}
@push('style')
    <style>
        .h1 {
            color: red;
        }
    </style>
@endpush

@section('body-content')
    <div class="url-shortner-navigation-bar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                <a class="navbar-brand" href="{{ route('welcome') }}">Url Shortner</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signup') }}">Signup</a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
    </div>
@endsection

{{-- include custom scripts  --}}
@push('scripts')
    <script src=""></script>
@endpush
