<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }
    public function address()
    {
        return $this->hasMany(Address::class, 'customer_id', 'id');
    }
}
