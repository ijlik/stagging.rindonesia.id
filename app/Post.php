<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['author_id', 
    'category_id', 
    'title',
    'seo_title',
    'excerpt',
    'body',
    'image',
    'slug',
    'meta_description',
    'meta_keywords',
    'status',
    'featured',
    'views',
    'editor_pick',
    'embed_video',
    'hastag'
    ];

    public function scopeIsReady($query, $category)
    {
        return $query->where('status','=','PUBLISHED')->where('category_id','=',$category)->orderBy('created_at','desc')->get()->count();
    }
}
