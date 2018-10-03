<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kanal extends Model
{
    protected $table = 'kanals';
    protected $fillable = ['display_name', 'slug', 'position'];
}
