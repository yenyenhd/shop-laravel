<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'products';

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
     protected $product_hot = [
        1 => [
            'name' => 'Nổi bật',
            'class' => 'badge-success'
        ],
        0 => [
            'name' => 'Không',
            'class' => 'badge-secondary'
        ]
    ];
    public function getStatus()
    {
        return Arr::get($this->active, $this->status, '[N\A]');
    }
    public function getHot()
    {
        return arr::get($this->product_hot, $this->hot, '[N\A]');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }
}
