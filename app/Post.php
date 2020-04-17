<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * $fillable
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'featured_image', 'votes_up','votes_down', 'user_id', 'category_id'];

    /**
     * author
     *
     * @return void
     */
    public function author() {
        return $this->belongTo(User::class);
    }

    /**
     * comments
     *
     * @return void
     */
    public function comments() {
        return $this->hasMany(comment::class);
    }

    /**
     * category
     *
     * @return void
     */
    public function category() {
        return $this->belongTo(category::class);
    }
    
}
