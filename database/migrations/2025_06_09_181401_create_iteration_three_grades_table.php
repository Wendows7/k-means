<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('iteration_three_grades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('npm');

            $courses = [
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
                'prak_struktur_data',
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
                'rekayasa_perangkat_lunak',
                'teknologi_open_source',
                'prak_teknologi_open_source',
                'manajemen_proyek_si',
                'fundamental_data_sains',
                'e_bisnis',
                'data_mining',
                'sistem_informasi_perusahaan',
                'e_commerce',
                'business_proses_reenginering',
                'metode_penelitian',
                'arsitektur_si_ti',
                'proyek_aplikasi_si',
                'prak_proyek_aplikasi_si',
                'kuliah_kerja_nyata',
                'enterprise_resource_planning',
                'machine_learning',
                'sistem_pendukung_keputusan',
                'digital_marketing',
                'sistem_informasi_pemerintahan',
            ];

            foreach ($courses as $course) {
                $table->float($course);
            }

            $table->string('C1')->nullable();
            $table->string('C2')->nullable();
            $table->string('C3')->nullable();
            $table->string('C4')->nullable();

            $table->string('cluster_1')->nullable();
            $table->string('cluster_2')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iteration_three_grades');
    }
};
