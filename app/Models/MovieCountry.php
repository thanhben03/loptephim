<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCountry extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $timestamps = false;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
