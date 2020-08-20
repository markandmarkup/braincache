<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body', 'visibility', 'last_edit_date'
    ];

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }
}
