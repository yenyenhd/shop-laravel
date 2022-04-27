<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    protected $active = [
        0 => [
            'name' => 'Đang chờ duyệt',
            'class' => 'badge-danger'
        ],
        1 => [
            'name' => 'Đã duyệt',
            'class' => 'badge-success'
        ]
    ];

    public function getStatus()
    {
        return Arr::get($this->active, $this->status, '[N\A]');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

     public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    
}
