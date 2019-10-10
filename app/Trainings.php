<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    protected $table = 'trainings';
    protected $fillable = ['training_name','nick_name'];
    protected $primaryKey = 'id';
}
