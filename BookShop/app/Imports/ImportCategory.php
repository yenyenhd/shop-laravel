<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCategory implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'name' => $row[0],
            'slug' => $row[1],
            'parent_id' => $row[2],
            'description' => $row[3],
            'title_seo' => $row[4],
            'keyword' => $row[5],
        ]);
    }
}
