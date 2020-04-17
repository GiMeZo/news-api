<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'featured_image', 'votes_up',
        'votes_down', 'user_id', 'category_id'
    ];

    public function author() {
        return $this->belongTo(User::class);
    }

    public function comments() {
        return $this->hasMany(comment::class);
    }

    public function category() {
        return $this->belongTo(category::class);
    }
    
}
