<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $table = 'fees';
    protected $guarded = [];

    public function province(){
        return $this->belongsTo(Province::class, 'matp');
    }
    public function district(){
        return $this->belongsTo(District::class, 'maqh');
    }
    public function commune(){
        return $this->belongsTo(Commune::class, 'xaid');
    }
}
