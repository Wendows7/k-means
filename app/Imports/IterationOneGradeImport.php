<?php

namespace App\Imports;

use App\Models\IterationOneGrade;
use Maatwebsite\Excel\Concerns\ToModel;

class IterationOneGradeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new IterationOneGrade([
            'name' => $row[0],
            'npm' => $row[1],
            'agama' => $row[2],
            'pancasila' => $row[3],
            'pengantar_teknologi_informasi' => $row[4],
            'organisasi_dan_manajemen' => $row[5],
            'pangkalan_data' => $row[6],
            'prak_pangkalan_data' => $row[7],
            'bahasa_pemrograman' => $row[8],
            'prak_bahasa_pemrograman' => $row[9],
            'english_for_entrepreneurship' => $row[10],
            'bahasa_indonesia' => $row[11],
            'matematika_diskrit' => $row[12],
            'analisis_proses_bisnis' => $row[13],
            'sistem_operasi' => $row[14],
            'prak_sistem_operasi' => $row[15],
            'struktur_data' => $row[16],
            'prak_struktur_data' => $row[17], // typo as in your array
            'tata_kelola_teknologi_informasi' => $row[18],
            'solusi_entrepreneurship' => $row[19],
            'analisis_dan_perancangan_sistem_informasi' => $row[20],
            'komunikasi_antar_personal' => $row[21],
            'pemrograman_berorientasi_objek' => $row[22],
            'prak_pemrograman_berorientasi_objek' => $row[23],
            'perancangan_dan_pengelolaan_jaringan_komputer' => $row[24],
            'prak_perancangan_dan_pengelolaan_jaringan_komputer' => $row[25],
            'pemrograman_berbasis_web' => $row[26],
            'prak_pemrograman_berbasis_web' => $row[27],
            'kecerdasan_buatan' => $row[28],
            'sekuriti_sistem_informasi' => $row[29],
            'probabilistik_dan_statistik' => $row[30],
            'prak_probabilistik_dan_statistik' => $row[31],
            'sistem_informasi_manajemen' => $row[32],
            'kewarganegaraan' => $row[33],
        ]);
    }
}
