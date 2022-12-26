{{-- // refer app layout  --}}
@extends('app')

{{-- set title  --}}
@section('title', 'Dashboard')

{{-- include header --}}
@push('style')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endpush

@section('body-content')
    <div class="dashboard-section">
        <div class="left-sidebar">
            <h4 class="brand-name mt-5 text-center">URL Shortner</h4>
        </div>
        <div class="right-sidebar">
            <div class="right-sidebar-nav">
                <ul>
                    <li><a class="active" href="{{ route('logout') }}">Logout</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#about">About</a></li>
                </ul>
            </div>
            <div class="total-pannel-stats">
                <h2 class="pl-2 mt-4 mb-3">Statistics</h2>
            </div>
        </div>
    </div>
@endsection

{{-- include custom scripts  --}}
@push('scripts')
    <script></script>
@endpush
