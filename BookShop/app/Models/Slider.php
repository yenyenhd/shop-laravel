<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'sliders';


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
}
