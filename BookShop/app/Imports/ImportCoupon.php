<?php

namespace App\Imports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCoupon implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Coupon([
            'name' => $row[0],
            'code' => $row[1],
            'number' => $row[2],
            'condition' => $row[3],
            'sale' => $row[4],
        ]);
    }
}
