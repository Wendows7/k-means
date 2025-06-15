<?php

namespace Database\Seeders;

use App\Models\Cluster;
use Database\Factories\ClusterFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClustersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'iteration' => 1,
                'cluster_name' => 'Data Mining',
                'cluster_code' => 'C1',
            ],
            [
                'iteration' => 1,
                'cluster_name' => 'Sistem Informasi Perusahaan',
                'cluster_code' => 'C2',
            ],
            [
                'iteration' => 1,
                'cluster_name' => 'E-Commerce',
                'cluster_code' => 'C3',
            ],
            [
                'iteration' => 1,
                'cluster_name' => 'Business Process Reengineering',
                'cluster_code' => 'C4',
            ],
            [
                'iteration' => 2,
                'cluster_name' => 'Machine Learning',
                'cluster_code' => 'C1',
            ],
            [
                'iteration' => 2,
                'cluster_name' => 'Sistem Pendukung Keputusan',
                'cluster_code' => 'C2',
            ],
            [
                'iteration' => 2,
                'cluster_name' => 'Digital Marketing',
                'cluster_code' => 'C3',
            ],
            [
                'iteration' => 2,
                'cluster_name' => 'Sistem Informasi Pemerintahan',
                'cluster_code' => 'C4',
            ],
            [
                'iteration' => 3,
                'cluster_name' => 'Internet of Things',
                'cluster_code' => 'C1',
            ],
            [
                'iteration' => 3,
                'cluster_name' => 'UI/UX Design',
                'cluster_code' => 'C2',
            ],
            [
                'iteration' => 3,
                'cluster_name' => 'Manajemen Resiko TI/SI',
                'cluster_code' => 'C3',
            ],
            [
                'iteration' => 3,
                'cluster_name' => 'Supply Chain Management',
                'cluster_code' => 'C4',
            ],
        ];

//        $data = [
//            [
//                'iteration' => 1,
//                'cluster_1' => 'Data Mining',
//                'cluster_2' => 'Sistem Informasi Perusahaan',
//                'cluster_3' => 'E-Commerce',
//                'cluster_4' => 'Business prosses reenginering',
//            ],
//            [
//                'iteration' => 2,
//                'cluster_1' => 'Manchine Learning',
//                'cluster_2' => 'Sistem Pendukung Keputusan',
//                'cluster_3' => 'Digital Marketing',
//                'cluster_4' => 'Sistem Informasi Pemerintahan',
//            ],
//            [
//                'iteration' => 3,
//                'cluster_1' => 'Internet of Things',
//                'cluster_2' => 'UI/UX Design',
//                'cluster_3' => 'Manajemen Resiko TI/SI',
//                'cluster_4' => 'Supply Chain Management',
//            ]
//                ];

        foreach ($data as $row) {
            Cluster::create($row);
        }
    }
}
