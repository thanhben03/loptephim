<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function movie_genres()
    {
        return $this->hasMany(MovieGenre::class);

    }

    public function movie_countries()
    {
        return $this->hasMany(MovieCountry::class);

    }

}
