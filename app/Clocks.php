<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clocks extends Model
{
    protected $table = 'clocks';
    protected $fillable = ['user_id'];
    protected $primaryKey = 'id';
}
