<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'categories';

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    protected $active = [
        1 => [
            'name' => 'Public',
            'class' => 'badge-danger'
        ],
        0 => [
            'name' => 'Private',
            'class' => 'badge-secondary'
        ]
    ];
    public function getStatus()
    {
        return Arr::get($this->active, $this->status, '[N\A]');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
    public function categoryChildren()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
