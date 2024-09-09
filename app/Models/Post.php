<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['links'];



    public function users()
    {
        return $this->belongsToMany(User::class, 'user_posts', 'post_id', 'user_id');
    }

    public function like()
    {
        return $this->hasMany(PostLike::class, 'post_id', 'id');
    }

    public function user_post()
    {
        return $this->hasMany(UserPost::class);

    }

    public function oneUser()
    {
        return $this->hasOne(User::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    protected function getLinksAttribute()
    {
        return json_decode($this->link) ?? [];
    }
}
