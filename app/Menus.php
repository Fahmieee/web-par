<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';
}
