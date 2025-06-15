<?php

namespace App\Services;

use App\Imports\IterationTwoGradeImport;
use App\Models\IterationTwoGrade;

class iterationTwoGradeService
{

    protected $iterationTwoGrade;

    public function __construct(IterationTwoGrade $iterationTwoGrade)
    {
        $this->iterationTwoGrade = $iterationTwoGrade;
    }

    public function getAllGrades()
    {
        return $this->iterationTwoGrade->all();
    }

    public function deleteAll()
    {
        $data = $this->iterationTwoGrade->all();
        $this->iterationTwoGrade->destroy($data);
    }

    public function importExcel($file)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new IterationTwoGradeImport, $file);
    }
}
