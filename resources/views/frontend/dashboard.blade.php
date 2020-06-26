@extends('welcome')

@section('home_content')
    <div class="mt-3">
            <div class="row">
                <div class="col-5 col-sm-3">
                    @include('frontend.layouts.sidebar')
                </div>
                <div class="col-7 col-sm-9">
                    @include('message')
                    @yield('dashboard_content')
                </div>
            </div>
        <!-- /.card -->
        </div>
@endsection
