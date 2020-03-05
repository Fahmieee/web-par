<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingDrivers extends Model
{
    protected $table = 'training_driver';
    protected $fillable = ['training_id','user_id'];
    protected $primaryKey = 'id';
}
