<?php

namespace App\Services;

use App\Imports\IterationOneGradeImport;
use App\Models\IterationOneGrade;
use Maatwebsite\Excel\Excel;

class IterationOneGradeService
{

    protected $IterationOneGrade;

    public  function __construct(IterationOneGrade $IterationOneGrade)
    {
        $this->IterationOneGrade = $IterationOneGrade;
    }

    public function getAllGrades()
    {
        return $this->IterationOneGrade->all();
    }

    public function deleteAll()
    {
        $data = $this->IterationOneGrade->all();
        $this->IterationOneGrade->destroy($data);
    }

    public function importExcel($file)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new IterationOneGradeImport, $file);
    }

}
