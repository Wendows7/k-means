<?php

namespace App\Imports;

use App\Models\ProfileKelulusan;
use Maatwebsite\Excel\Concerns\ToModel;

class ProfileKelulusanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ProfileKelulusan([
            'name' => $row[0],
            'npm' => $row[1],
            'semester_5_1' => $row[2],
            'semester_5_2' => $row[3],
            'semester_6_1' => $row[4],
            'semester_6_2' => $row[5],
            'semester_7_1' => $row[6],
            'semester_7_2' => $row[7],
        ]);
    }
}
