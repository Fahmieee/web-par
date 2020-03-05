<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
   protected $table = 'drivers';
    protected $fillable = ['driver_id','unit_id'];
    protected $primaryKey = 'id';
}
