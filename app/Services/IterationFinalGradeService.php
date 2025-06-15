<?php

namespace App\Services;

use App\Models\IterationFinalGrade;
use App\Models\ProfileKelulusan;

class IterationFinalGradeService
{

    protected $iterationFinalGrade;
    protected $iterationThreeGradeService;
    protected $iterationTwoGradeService;
    protected $iterationOneGradeService;
    protected $clusterService;
    protected $kmeansService;
    protected $profileKelulusanService;
    public function __construct(IterationFinalGrade $iterationFinalGrade,
                                IterationThreeGradeService $iterationThreeGradeService,
                                iterationTwoGradeService $iterationTwoGradeService,
                                IterationOneGradeService $iterationOneGradeService,
                                ClusterService $clusterService, KmeansService $kmeansService,
                                ProfileKelulusanService $profileKelulusanService)
    {
        $this->iterationFinalGrade = $iterationFinalGrade;
        $this->iterationThreeGradeService = $iterationThreeGradeService;
        $this->iterationTwoGradeService = $iterationTwoGradeService;
        $this->iterationOneGradeService = $iterationOneGradeService;
        $this->clusterService = $clusterService;
        $this->kmeansService = $kmeansService;
        $this->profileKelulusanService = $profileKelulusanService;
    }

    public function getAllProfiles()
    {
        return $this->iterationFinalGrade->all();
    }



    public function createProfile()
    {

        if ($this->iterationOneGradeService->getAllGrades()->first() == null)
        {
            return redirect()->back()->with(['error' => 'Please run iteration 1 first']);
        }
        if ($this->iterationTwoGradeService->getAllGrades()->first() == null)
        {
            return redirect()->back()->with(['error' => 'Please run iteration 2 first']);
        }
        if ($this->iterationThreeGradeService->getAllGrades()->first() == null)
        {
            return redirect()->back()->with(['error' => 'Please run iteration 3 first']);
        }

        $this->iterationFinalGrade->truncate();


        $iteration1 = $this->iterationOneGradeService->getAllGrades()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'npm' => $item->npm,
                'mata_kuliah_pilihan_1_semester5' => $this->clusterService->getClusterNameByIterationAndCode(1, $item->cluster_1),
                'mata_kuliah_pilihan_2_semester5' => $this->clusterService->getClusterNameByIterationAndCode(1, $item->cluster_2),
            ];
        });
        $iteration2 = $this->iterationTwoGradeService->getAllGrades()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'npm' => $item->npm,
                'mata_kuliah_pilihan_1_semester6' => $this->clusterService->getClusterNameByIterationAndCode(2, $item->cluster_1),
                'mata_kuliah_pilihan_2_semester6' => $this->clusterService->getClusterNameByIterationAndCode(2, $item->cluster_2),
            ];
        });
        $iteration3 = $this->iterationThreeGradeService->getAllGrades()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'npm' => $item->npm,
                'mata_kuliah_pilihan_1_semester7' => $this->clusterService->getClusterNameByIterationAndCode(3, $item->cluster_1),
                'mata_kuliah_pilihan_2_semester7' => $this->clusterService->getClusterNameByIterationAndCode(3, $item->cluster_2),
            ];
        });
        $data = $iteration3->map(function ($item) use($iteration1, $iteration2) {
            return [
                'name' => $item['name'],
                'npm' => $item['npm'],
                'semester_5' => [
                    $iteration1->where('name', $item['name'])->where('npm', $item['npm'])->first()['mata_kuliah_pilihan_1_semester5'] ?? '',
                    $iteration1->where('name', $item['name'])->where('npm', $item['npm'])->first()['mata_kuliah_pilihan_2_semester5'] ?? '',
                ],
                'semester_6' => [
                    $iteration2->where('name', $item['name'])->where('npm', $item['npm'])->first()['mata_kuliah_pilihan_1_semester6'] ?? '',
                    $iteration2->where('name', $item['name'])->where('npm', $item['npm'])->first()['mata_kuliah_pilihan_2_semester6'] ?? '',
                ],
                'semester_7' => [
                    $item['mata_kuliah_pilihan_1_semester7'],
                    $item['mata_kuliah_pilihan_2_semester7'],
                ],
            ];
        });


        $profileKelulusan = $this->profileKelulusanService->profileData();

        $dataFinal = [];
        foreach ($data as $item) {
            $semester5 = $item['semester_5'];
            $semester6 = $item['semester_6'];
            $semester7 = $item['semester_7'];

            foreach ($profileKelulusan as $key => $value) {
                if (in_array($semester5[0], $value['semester_5']) && in_array($semester5[1], $value['semester_5']) &&
                    in_array($semester6[0], $value['semester_6']) && in_array($semester6[1], $value['semester_6']) &&
                    in_array($semester7[0], $value['semester_7']) && in_array($semester7[1], $value['semester_7'])) {
                    $dataFinal[] = [
                        'name' => $item['name'],
                        'npm' => $item['npm'],
                        'profile_kelulusan' => $key,
                        'semester_5' => $semester5,
                        'semester_6' => $semester6,
                        'semester_7' => $semester7,
                    ];
//                    insert into database
                    $this->iterationFinalGrade->create([
                        'name' => $item['name'],
                        'npm' => $item['npm'],
                        'semester_5_1' => $semester5[0],
                        'semester_5_2' => $semester5[1],
                        'semester_6_1' => $semester6[0],
                        'semester_6_2' => $semester6[1],
                        'semester_7_1' => $semester7[0],
                        'semester_7_2' => $semester7[1],
                        'profile_kelulusan' => $key,
                    ]);
                }
            }
        }

        return $dataFinal;
    }


}
