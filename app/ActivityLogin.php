<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLogin extends Model
{
    protected $table = 'activity_login';
    protected $fillable = ['user_id'];
    protected $primaryKey = 'id';
}
