<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IterationTwoGrade>
 */
class IterationTwoGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gradeScale = [0, 1, 2, 2.5, 3, 3.5, 4];
        return [
            'name' => $this->faker->name(),
            'npm' => $this->faker->randomNumber(),
            'agama' => $this->faker->randomElement($gradeScale),
            'pancasila' => $this->faker->randomElement($gradeScale),
            'pengantar_teknologi_informasi' => $this->faker->randomElement($gradeScale),
            'organisasi_dan_manajemen' => $this->faker->randomElement($gradeScale),
            'pangkalan_data' => $this->faker->randomElement($gradeScale),
            'prak_pangkalan_data' => $this->faker->randomElement($gradeScale),
            'bahasa_pemrograman' => $this->faker->randomElement($gradeScale),
            'prak_bahasa_pemrograman' => $this->faker->randomElement($gradeScale),
            'english_for_entrepreneurship' => $this->faker->randomElement($gradeScale),
            'bahasa_indonesia' => $this->faker->randomElement($gradeScale),
            'matematika_diskrit' => $this->faker->randomElement($gradeScale),
            'analisis_proses_bisnis' => $this->faker->randomElement($gradeScale),
            'sistem_operasi' => $this->faker->randomElement($gradeScale),
            'prak_sistem_operasi' => $this->faker->randomElement($gradeScale),
            'struktur_data' => $this->faker->randomElement($gradeScale),
            'prak_struktur_data' => $this->faker->randomElement($gradeScale), // typo as in your array
            'tata_kelola_teknologi_informasi' => $this->faker->randomElement($gradeScale),
            'solusi_entrepreneurship' => $this->faker->randomElement($gradeScale),
            'analisis_dan_perancangan_sistem_informasi' => $this->faker->randomElement($gradeScale),
            'komunikasi_antar_personal' => $this->faker->randomElement($gradeScale),
            'pemrograman_berorientasi_objek' => $this->faker->randomElement($gradeScale),
            'prak_pemrograman_berorientasi_objek' => $this->faker->randomElement($gradeScale),
            'perancangan_dan_pengelolaan_jaringan_komputer' => $this->faker->randomElement($gradeScale),
            'prak_perancangan_dan_pengelolaan_jaringan_komputer' => $this->faker->randomElement($gradeScale),
            'pemrograman_berbasis_web' => $this->faker->randomElement($gradeScale),
            'prak_pemrograman_berbasis_web' => $this->faker->randomElement($gradeScale),
            'kecerdasan_buatan' => $this->faker->randomElement($gradeScale),
            'sekuriti_sistem_informasi' => $this->faker->randomElement($gradeScale),
            'probabilistik_dan_statistik' => $this->faker->randomElement($gradeScale),
            'prak_probabilistik_dan_statistik' => $this->faker->randomElement($gradeScale),
            'sistem_informasi_manajemen' => $this->faker->randomElement($gradeScale),
            'kewarganegaraan' => $this->faker->randomElement($gradeScale),
            'rekayasa_perangkat_lunak' => $this->faker->randomElement($gradeScale),
            'teknologi_open_source' => $this->faker->randomElement($gradeScale),
            'prak_teknologi_open_source' => $this->faker->randomElement($gradeScale),
            'manajemen_proyek_si' => $this->faker->randomElement($gradeScale),
            'fundamental_data_sains' => $this->faker->randomElement($gradeScale),
            'e_bisnis' => $this->faker->randomElement($gradeScale),
            'data_mining' => $this->faker->randomElement($gradeScale),
            'sistem_informasi_perusahaan' => $this->faker->randomElement($gradeScale),
            'e_commerce' => $this->faker->randomElement($gradeScale),
            'business_proses_reenginering' => $this->faker->randomElement($gradeScale),

        ];
    }
}
