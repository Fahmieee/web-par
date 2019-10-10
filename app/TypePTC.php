<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePTC extends Model
{
    protected $table = 'check_types';
    protected $fillable = ['name','icon'];
    protected $primaryKey = 'id';
}
