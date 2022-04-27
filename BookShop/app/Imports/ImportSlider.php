<?php

namespace App\Imports;

use App\Models\Slider;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSlider implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Slider([
            'name' => $row[0],
            'description' => $row[1],
            'image_name' => $row[2],
            'image_path' => $row[3],
        ]);
    }
}
