@extends('layout.main')
@php
    $heads = [
            'No',
            'Name',
            'Npm',
            'Semester 5',
            'Semester 6',
            'Semester 7',
            'Profile Kelulusan',
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
    @include('kmeans.profile_kelulusan.modal.check-profile')
    <div class="container">
        <h1 class="text-center">Profile Kelulusan</h1>
        <p class="text-center">This is the third iteration of the K-Means clustering algorithm.</p>
        <form action="{{route('kmeans.data.import')}}" method="POST" class="d-inline" id="import" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="iteration" value="profile_kelulusan">
            <x-adminlte-input-file type="file" accept=".xlsx,.xls" name="file" igroup-size="sm" placeholder="Choose a file..." required >
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
            <x-adminlte-button label="Import" theme="success" icon="fas fa-save" type="submit"/>
        </form>
        {{--        make button to mining, import data by excel and delete all data--}}
        <div class="text-center mb-5">
            <form action="{{{route('kmeans.profile_kelulusan.create')}}}" method="POST" class="d-inline" id="mining">
                @csrf
                <x-adminlte-button label="Mining" theme="primary" icon="fas fa-database" type="submit"/>
            </form>
            <form action="{{route('kmeans.data.delete')}}" method="POST" class="d-inline" id="delete-all">
                @csrf
                <input type="hidden" name="iteration" value="profile_kelulusan">
                <x-adminlte-button label="Delete Data" theme="danger" icon="fas fa-lg fa-trash" type="submit" class="show_confirm"/>
            </form>
            <!-- Button to trigger modal -->
            <x-adminlte-button label="Check Graduation Profile" data-toggle="modal" data-target="#profileModal" class="bg-purple" icon="fas fa-fw fa-graduation-cap"/>
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
                    @if($value->profile_kelulusan == null)
                        <td><i class="text-danger">-</i></td>
                    @else
                    <td><i><b>{{$value->profile_kelulusan}}</b></i></td>
                    @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('profileForm');
        const resultDiv = document.getElementById('profileResult');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            resultDiv.style.display = 'none';
            resultDiv.textContent = 'Checking...';

            const formData = new FormData(form);
            fetch('{{route('kmeans.profile_kelulusan.check')}}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    resultDiv.style.display = 'block';

                    if (data.profile && Array.isArray(data.profile) && data.profile.length > 0) {
                        let html = '<div class="card"><div class="card-body text-dark">';
                        html += '<h4 class="card-title text-dark">Profile Kelulusan Anda:</h4>';

                        data.profile.forEach(profile => {
                            if (profile.semester_5 && Array.isArray(profile.semester_5)) {
                                html += '<h5 class="text-dark">Semester 5:</h5><ul class="list-group mb-3">';
                                profile.semester_5.forEach(course => {
                                    html += `<li class="list-group-item text-dark">${course}</li>`;
                                });
                                html += '</ul>';
                            }

                            if (profile.semester_6 && Array.isArray(profile.semester_6)) {
                                html += '<h5 class="text-dark">Semester 6:</h5><ul class="list-group mb-3">';
                                profile.semester_6.forEach(course => {
                                    html += `<li class="list-group-item text-dark">${course}</li>`;
                                });
                                html += '</ul>';
                            }

                            if (profile.semester_7 && Array.isArray(profile.semester_7)) {
                                html += '<h5 class="text-dark">Semester 7:</h5><ul class="list-group mb-3">';
                                profile.semester_7.forEach(course => {
                                    html += `<li class="list-group-item text-dark">${course}</li>`;
                                });
                                html += '</ul>';
                            }
                        });

                        html += '</div></div>';
                        resultDiv.innerHTML = html;
                    } else {
                        resultDiv.innerHTML = '<div class="alert alert-warning"><b><i>No matching profile found.</i></b></div>';
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    resultDiv.style.display = 'block';
                    resultDiv.innerHTML = '<div class="alert alert-danger"><b><i>Error processing request.</i></b></div>';
                });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Limit selection to 2 and require exactly 2
        ['semester_5', 'semester_6', 'semester_7'].forEach(function(id) {
            const select = document.getElementById(id);
            select.addEventListener('change', function(e) {
                const selected = Array.from(select.selectedOptions);
                if (selected.length > 2) {
                    selected[selected.length - 1].selected = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Selection Limit Exceeded',
                        text: 'You must select exactly 2 subjects per semester.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        // Prevent form submit if not exactly 2 selected in each
        const form = document.getElementById('profileForm');
        form.addEventListener('submit', function(e) {
            let valid = true;
            ['semester_5', 'semester_6', 'semester_7'].forEach(function(id) {
                const select = document.getElementById(id);
                const selected = Array.from(select.selectedOptions);
                if (selected.length !== 2) {
                    valid = false;
                }
            });
            if (!valid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Selection Error',
                    text: 'You must select exactly 2 subjects for each semester.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>

<style>
</style>
