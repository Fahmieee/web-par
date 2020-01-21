<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PTCNotok extends Model
{
    protected $table = 'pretrip_check_notoke';
    protected $fillable = ['user_id','pretripcheck_id'];
    protected $primaryKey = 'id';
}
