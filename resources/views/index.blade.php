@extends('layout.main')

{{-- Customize layout sections --}}

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
        <h1 class="text-center">Welcome</h1>
        <div class="container">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title
                    text-center">Information</h3>
                </div>
                <div class="card-body">
                    <p class="text-center">This is a simple K-Means clustering application.</p>
                    <p class="text-center">You can use this application to visualize and understand K-Means clustering.</p>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush
