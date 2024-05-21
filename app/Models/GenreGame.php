<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreGame extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'games_genres';
}
