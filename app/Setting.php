<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['key', 'display_name', 'details', 'type', 'order','value','group'];
}
