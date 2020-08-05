<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\User;

class Post extends Model
{
    public function author() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }
}
