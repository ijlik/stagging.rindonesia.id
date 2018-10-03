<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'body',
        'name',
        'email',
        'phone',
        'subject',
        'category',
        'status',
        'notes'
    ];
}
