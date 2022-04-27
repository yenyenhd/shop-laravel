<?php

namespace App\Imports;

use App\Models\Banner;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBanner implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Banner([
            'name' => $row[0],
            'image_name' => $row[1],
            'image_path' => $row[2],
        ]);
    }
}
