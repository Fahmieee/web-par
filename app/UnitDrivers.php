<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitDrivers extends Model
{
    protected $table = 'unit_drivers';
    protected $fillable = ['unit_id','user_id'];
    protected $primaryKey = 'id';
}
