@extends('layout.main')
@php
    $heads = [
        'No',
        'Name',
        'Npm',
        'agama',
        'pancasila',
        'pengantar_teknologi_informasi',
        'organisasi_dan_manajemen',
        'pangkalan_data',
        'prak_pangkalan_data',
        'bahasa_pemrograman',
        'prak_bahasa_pemrograman',
        'english_for_entrepreneurship',
        'bahasa_indonesia',
        'matematika_diskrit',
        'analisis_proses_bisnis',
        'sistem_operasi',
        'prak_sistem_operasi',
        'struktur_data',
        'prak_struktur_data', // typo as in your array
        'tata_kelola_teknologi_informasi',
        'solusi_entrepreneurship',
        'analisis_dan_perancangan_sistem_informasi',
        'komunikasi_antar_personal',
        'pemrograman_berorientasi_objek',
        'prak_pemrograman_berorientasi_objek',
        'perancangan_dan_pengelolaan_jaringan_komputer',
        'prak_perancangan_dan_pengelolaan_jaringan_komputer',
        'pemrograman_berbasis_web',
        'prak_pemrograman_berbasis_web',
        'kecerdasan_buatan',
        'sekuriti_sistem_informasi',
        'probabilistik_dan_statistik',
        'prak_probabilistik_dan_statistik',
        'sistem_informasi_manajemen',
        'kewarganegaraan',
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
    if (session('result')) {
//            insert new data into $heads
        $heads[] = 'Distance C1';
        $heads[] = 'Distance C2';
        $heads[] = 'Distance C3';
        $heads[] = 'Distance C4';
        $heads[] = 'Cluster 1';
        $heads[] = 'Cluster 2';
    }

@endphp

@section('content_body')
    <div class="container">
        <h1 class="text-center">K-Means Clustering - Iteration 1</h1>
        <p class="text-center">This is the first iteration of the K-Means clustering algorithm.</p>
        <form action="{{route('kmeans.data.import')}}" method="POST" class="d-inline" id="import" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="iteration" value="1">
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
            <form action="{{{route('kmeans.mining')}}}" method="POST" class="d-inline" id="mining">
                @csrf
                <input type="hidden" name="iteration" value="1">
                <x-adminlte-button label="Mining" theme="primary" icon="fas fa-database" type="submit"/>
            </form>
            <form action="{{route('kmeans.data.delete')}}" method="POST" class="d-inline" id="delete-all">
                @csrf
                <input type="hidden" name="iteration" value="1">
                <x-adminlte-button label="Delete Data" theme="danger" icon="fas fa-lg fa-trash" type="submit" class="show_confirm"/>
            </form>
        </div>
    </div>

    @if(session('result'))
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="card-title
                    text-center">Cluster Info</h3>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <th>Cluster</th>
                    </tr>
                    @foreach($cluster as $c)
                    <tr>
                        <td>{{$c->cluster_code}}</td>
                        <td>{{ $c->cluster_name }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endif

    <x-adminlte-datatable id="table1" head-theme="dark" theme="light" :heads="$heads" :config="$config" beautify>
        @if(session('result'))
                @foreach($data as $value)
            <tr>
                    <td>{{$no++}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->npm}}</td>
                    <td>{{$value->agama}}</td>
                    <td>{{$value->pancasila}}</td>
                    <td>{{$value->pengantar_teknologi_informasi}}</td>
                    <td>{{$value->organisasi_dan_manajemen}}</td>
                    <td>{{$value->pangkalan_data}}</td>
                    <td>{{$value->prak_pangkalan_data}}</td>
                    <td>{{$value->bahasa_pemrograman}}</td>
                    <td>{{$value->prak_bahasa_pemrograman}}</td>
                    <td>{{$value->english_for_entrepreneurship}}</td>
                    <td>{{$value->bahasa_indonesia}}</td>
                    <td>{{$value->matematika_diskrit}}</td>
                    <td>{{$value->analisis_proses_bisnis}}</td>
                    <td>{{$value->sistem_operasi}}</td>
                    <td>{{$value->prak_sistem_operasi}}</td>
                    <td>{{$value->struktur_data}}</td>
                    <td>{{$value->prak_struktur_data}}</td>
                    <td>{{$value->tata_kelola_teknologi_informasi}}</td>
                    <td>{{$value->solusi_entrepreneurship}}</td>
                    <td>{{$value->analisis_dan_perancangan_sistem_informasi}}</td>
                    <td>{{$value->komunikasi_antar_personal}}</td>
                    <td>{{$value->pemrograman_berorientasi_objek}}</td>
                    <td>{{$value->prak_pemrograman_berorientasi_objek}}</td>
                    <td>{{$value->perancangan_dan_pengelolaan_jaringan_komputer}}</td>
                    <td>{{$value->prak_perancangan_dan_pengelolaan_jaringan_komputer}}</td>
                    <td>{{$value->pemrograman_berbasis_web}}</td>
                    <td>{{$value->prak_pemrograman_berbasis_web}}</td>
                    <td>{{$value->kecerdasan_buatan}}</td>
                    <td>{{$value->sekuriti_sistem_informasi}}</td>
                    <td>{{$value->probabilistik_dan_statistik}}</td>
                    <td>{{$value->prak_probabilistik_dan_statistik}}</td>
                    <td>{{$value->sistem_informasi_manajemen}}</td>
                    <td>{{$value->kewarganegaraan}}</td>
                    <td>{{$value->C1}}</td>
                    <td>{{$value->C2}}</td>
                    <td>{{$value->C3}}</td>
                    <td>{{$value->C4}}</td>
                    <td>{{$value->cluster_1}}</td>
                    <td>{{$value->cluster_2}}</td>
            </tr>
                @endforeach
        @else
            @foreach($data as $value)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->npm}}</td>
                    <td>{{$value->agama}}</td>
                    <td>{{$value->pancasila}}</td>
                    <td>{{$value->pengantar_teknologi_informasi}}</td>
                    <td>{{$value->organisasi_dan_manajemen}}</td>
                    <td>{{$value->pangkalan_data}}</td>
                    <td>{{$value->prak_pangkalan_data}}</td>
                    <td>{{$value->bahasa_pemrograman}}</td>
                    <td>{{$value->prak_bahasa_pemrograman}}</td>
                    <td>{{$value->english_for_entrepreneurship}}</td>
                    <td>{{$value->bahasa_indonesia}}</td>
                    <td>{{$value->matematika_diskrit}}</td>
                    <td>{{$value->analisis_proses_bisnis}}</td>
                    <td>{{$value->sistem_operasi}}</td>
                    <td>{{$value->prak_sistem_operasi}}</td>
                    <td>{{$value->struktur_data}}</td>
                    <td>{{$value->prak_struktur_data}}</td>
                    <td>{{$value->tata_kelola_teknologi_informasi}}</td>
                    <td>{{$value->solusi_entrepreneurship}}</td>
                    <td>{{$value->analisis_dan_perancangan_sistem_informasi}}</td>
                    <td>{{$value->komunikasi_antar_personal}}</td>
                    <td>{{$value->pemrograman_berorientasi_objek}}</td>
                    <td>{{$value->prak_pemrograman_berorientasi_objek}}</td>
                    <td>{{$value->perancangan_dan_pengelolaan_jaringan_komputer}}</td>
                    <td>{{$value->prak_perancangan_dan_pengelolaan_jaringan_komputer}}</td>
                    <td>{{$value->pemrograman_berbasis_web}}</td>
                    <td>{{$value->prak_pemrograman_berbasis_web}}</td>
                    <td>{{$value->kecerdasan_buatan}}</td>
                    <td>{{$value->sekuriti_sistem_informasi}}</td>
                    <td>{{$value->probabilistik_dan_statistik}}</td>
                    <td>{{$value->prak_probabilistik_dan_statistik}}</td>
                    <td>{{$value->sistem_informasi_manajemen}}</td>
                    <td>{{$value->kewarganegaraan}}</td>
                </tr>
            @endforeach
        @endif
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
