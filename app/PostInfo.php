<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostInfo extends Model
{
    protected $table = 'posts_info';
    protected $fillable = [

        'title',
        'author',
        'category_id'

    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
