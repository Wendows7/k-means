<?php

namespace App\Services;


use App\Imports\IterationThreeGradeImport;
use App\Models\IterationThreeGrade;

class IterationThreeGradeService
{

    protected $iterationThreeGrade;

    public function __construct(IterationThreeGrade $iterationThreeGrade)
    {
        $this->iterationThreeGrade = $iterationThreeGrade;
    }

    public function getAllGrades()
    {
        return $this->iterationThreeGrade->all();
    }

    public function deleteAll()
    {
        $data = $this->iterationThreeGrade->all();
        $this->iterationThreeGrade->destroy($data);
    }

    public function importExcel($file)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new IterationThreeGradeImport, $file);
    }

}
