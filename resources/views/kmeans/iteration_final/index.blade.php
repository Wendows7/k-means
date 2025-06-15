@extends('layout.main')
@php
    $heads = [
            'No',
            'Name',
            'Npm',
            'Profile Kelulusan',
            'Semester 5',
            'Semester 6',
            'Semester 7',
        ];

    $config = [
            'scrollX' => true,
            'fixedHeader' => true,
        ];

        $heads = array_map(function($head) {
            $head = str_replace('_', ' ', $head);
            return ucwords($head);
        }, $heads);

        $no = 1;

@endphp

@section('content_body')
    <div class="container">
        <h1 class="text-center">Profile Kelulusan</h1>
        <p class="text-center">This is the third iteration of the K-Means clustering algorithm.</p>
        {{--        make button to mining, import data by excel and delete all data--}}
        <div class="text-center mb-5">
            <form action="{{{route('kmeans.iteration_final.create')}}}" method="POST" class="d-inline" id="mining">
                @csrf
                <x-adminlte-button label="Mining" theme="primary" icon="fas fa-database" type="submit"/>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="card-title text-center">Profile Info</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>Semester</th>
                        @foreach($profileKelulusan as $key => $profile)
                            <th>{{ $key }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(['semester_5', 'semester_6', 'semester_7'] as $semester)
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $semester)) }}</td>
                            @foreach($profileKelulusan as $profile)
                                <td>
                                    @foreach($profile[$semester] as $subject)
                                        <div>{{ $subject }}</div>
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-adminlte-datatable id="table1" head-theme="dark" theme="light" :heads="$heads" :config="$config" beautify hoverable>
            @foreach($data as $value)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->npm}}</td>
                    <td>{{$value->profile_kelulusan}}</td>
                    <td>
                         {{ $value->semester_5_1 }}<br>
                         {{ $value->semester_5_2 }}

                    </td>
                    <td>
                        {{$value->semester_6_1}}<br>
                        {{$value->semester_6_2}}
                    </td>
                    <td>
                        {{$value->semester_7_1}}<br>
                        {{$value->semester_7_2}}
                    </td>
                </tr>
            @endforeach
    </x-adminlte-datatable>
    <br>
    <br>
    <br>
@stop

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.show_confirm').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Delete All Data !',
                    text: "Are you sure you want to delete?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.querySelector('input[type="file"][name="file"]');
        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                const fileName = e.target.files.length ? e.target.files[0].name : 'Choose a file...';
                // For AdminLTE input file, update the next sibling label
                const label = fileInput.closest('.custom-file').querySelector('.custom-file-label');
                if (label) {
                    label.textContent = fileName;
                }
            });
        }
    });
</script>

<style>
</style>
