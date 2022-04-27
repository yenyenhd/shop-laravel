<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
    protected $primaryKey = 'xaid';
    protected $table = 'communes';
    protected $guarded = [];
}
