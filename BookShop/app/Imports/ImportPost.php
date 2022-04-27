<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPost implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'title' => $row[0],
            'slug' => $row[1],
            'image_path' => $row[2],
            'description' => $row[3],
            'content' => $row[4],
            'keyword' => $row[5],
        ]);
    }
}
