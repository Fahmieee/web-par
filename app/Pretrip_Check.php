<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pretrip_Check extends Model
{
    protected $table = 'pretrip_check';
    protected $fillable = ['user_id','status'];
    protected $primaryKey = 'id';
}
