@extends('adminlte::page')
{{--include sweet alert--}}


@section('title', 'K-Means')
<link rel="shortcut icon" href="{{ asset('images/logo.png') }}"/>

{{-- Extend the layout with a custom logo --}}
{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @include('sweetalert::alert')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="footer-fixed text-center" style="font-size: 14px; color: #6c757d;">
        <strong>Copyright &copy; {{ date('Y') }} <a href="" target="_blank">K-Means</a>.</strong> All rights reserved.
    </div>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
    <script>

        $(document).ready(function() {
            // Add your common script logic here...
        });

    </script>
@endpush

{{-- Add common CSS customizations --}}

@push('css')

    <style>

    </style>
@endpush
