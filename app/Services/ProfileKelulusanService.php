<?php

namespace App\Services;

use App\Imports\ProfileKelulusanImport;
use App\Models\ProfileKelulusan;

class ProfileKelulusanService
{

    protected $profileKelulusan;
    protected $iterationThreeGradeService;
    protected $iterationTwoGradeService;
    protected $iterationOneGradeService;
    protected $clusterService;
    protected $kmeansService;
    public function __construct(ProfileKelulusan $profileKelulusan,
                                IterationThreeGradeService $iterationThreeGradeService,
                                iterationTwoGradeService $iterationTwoGradeService,
                                IterationOneGradeService $iterationOneGradeService,
                                ClusterService $clusterService, KmeansService $kmeansService)
    {
        $this->profileKelulusan = $profileKelulusan;
        $this->iterationThreeGradeService = $iterationThreeGradeService;
        $this->iterationTwoGradeService = $iterationTwoGradeService;
        $this->iterationOneGradeService = $iterationOneGradeService;
        $this->clusterService = $clusterService;
        $this->kmeansService = $kmeansService;
    }

    public function getAllProfiles()
    {
        return $this->profileKelulusan->all();
    }



    public function createProfile()
    {
        if ($this->profileKelulusan->all()->count() == 0) {
            return redirect()->back()->with(['error' => 'Data is empty, please import data first']);
        }

        $data = $this->getAllProfiles();

        $profileKelulusan = $this->profileData();

        $dataFinal = [];
        foreach ($data as $item) {
            $semester5 = [$item->semester_5_1, $item->semester_5_2];
            $semester6 = [$item->semester_6_1, $item->semester_6_2];
            $semester7 = [$item->semester_7_1, $item->semester_7_2];

            foreach ($profileKelulusan as $key => $value) {
                if (in_array($semester5[0], $value['semester_5']) && in_array($semester5[1], $value['semester_5']) &&
                    in_array($semester6[0], $value['semester_6']) && in_array($semester6[1], $value['semester_6']) &&
                    in_array($semester7[0], $value['semester_7']) && in_array($semester7[1], $value['semester_7'])) {
//                    update into database
                    $this->profileKelulusan->where('id', $item->id)->update(
                        [
                            'profile_kelulusan' => $key,
                        ]
                    );

                }
            }
        }

        return $dataFinal;
    }

    public function profileData()
    {
        $profileKelulusan = [
            'Analisis Sistem' => [
                'semester_5' => [
                    'Sistem Informasi Perusahaan',
                    'Business Process Reengineering',
                ],
                'semester_6' => [
                    'Sistem Pendukung Keputusan',
                    'Sistem Informasi Pemerintahan',
                ],
                'semester_7' => [
                    'UI/UX Design',
                    'Manajemen Resiko TI/SI',
                ],
            ],
            'Analisis Bisnis' => [
                'semester_5' => [
                    'E-Commerce',
                    'Business Process Reengineering',
                ],
                'semester_6' => [
                    'Digital Marketing',
                    'Sistem Pendukung Keputusan',
                ],
                'semester_7' => [
                    'Supply Chain Management',
                    'Manajemen Resiko TI/SI',
                ],
            ],
            'Rekayasa Data' => [
                'semester_5' => [
                    'Data Mining',
                    'Sistem Informasi Perusahaan',
                ],
                'semester_6' => [
                    'Machine Learning',
                    'Sistem Pendukung Keputusan',
                ],
                'semester_7' => [
                    'Internet of Things',
                    'Manajemen Resiko TI/SI',
                ],
            ],
            'Manajer Proyek' => [
                'semester_5' => [
                    'Sistem Informasi Perusahaan',
                    'Business Process Reengineering',
                ],
                'semester_6' => [
                    'Digital Marketing',
                    'Sistem Informasi Perusahaan',
                ],
                'semester_7' => [
                    'Supply Chain Management',
                    'Internet of Things',
                ],
            ],
        ];

        return $profileKelulusan;
    }

    public function importExcel($file)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new ProfileKelulusanImport(), $file);

    }

    public function deleteAll()
    {
        $data = $this->profileKelulusan->all();
        $this->profileKelulusan->destroy($data);
    }

    public function checkProfileKelulusan($request)
    {
        $data =
            [
                'semester_5_1' => $request->semester_5[0],
                'semester_5_2' => $request->semester_5[1],
                'semester_6_1' => $request->semester_6[0],
                'semester_6_2' => $request->semester_6[1],
                'semester_7_1' => $request->semester_7[0],
                'semester_7_2' => $request->semester_7[1],

            ];

        $profileKelulusan = $this->profileData();

        $dataFinal = '';

            foreach ($profileKelulusan as $key => $value) {
                if (in_array($data['semester_5_1'], $value['semester_5']) && in_array($data['semester_5_2'], $value['semester_5']) &&
                    in_array($data['semester_6_1'], $value['semester_6']) && in_array($data['semester_6_2'], $value['semester_6']) &&
                    in_array($data['semester_7_1'], $value['semester_7']) && in_array($data['semester_7_2'], $value['semester_7'])) {

                    $dataFinal = $key;
                }
            }

        return $dataFinal;

    }

}
