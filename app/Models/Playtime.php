<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playtime extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
    	return $this->hasMany(Product::class);
    }

    public function booking()
    {
    	return $this->hasMany(Booking::class, "playtime_id");
    }
}
