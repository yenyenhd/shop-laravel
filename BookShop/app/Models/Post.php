<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'posts';
    protected $guarded = [];


    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    protected $active = [
        1 => [
            'name' => 'Hiển thị',
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

}
