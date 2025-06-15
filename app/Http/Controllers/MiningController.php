<?php

namespace App\Http\Controllers;

use App\Services\IterationOneGradeService;
use App\Services\Kmeans2Service;
use App\Services\KmeansService;
use Illuminate\Http\Request;

class MiningController extends Controller
{

    protected $iterationOneGradeService;
    protected $kmeansService;

    protected $kmeans2Service;

    public function __construct(IterationOneGradeService $iterationOneGradeService, KmeansService $kmeansService, Kmeans2Service $kmeans2Service)
    {
        $this->iterationOneGradeService = $iterationOneGradeService;
        $this->kmeansService = $kmeansService;
        $this->kmeans2Service = $kmeans2Service;
    }

    public function mining(Request $request)
    {
        $iteration = $request->iteration;
        $result = $this->kmeansService->clusterGrades(4, 100, $iteration);

        if ($result) {
            return redirect()->route("kmeans.iteration_" . $iteration)->with(['success' => 'Mining successfully', 'result' => $result]);
        }else
        {
            return redirect()->back()->with(['error' => 'Mining failed']);
        }
    }

}
