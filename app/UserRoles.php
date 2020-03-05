<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'users_roles';
    protected $fillable = ['user_id'];
    protected $primaryKey = 'id';
}
