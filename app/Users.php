<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = ['username','email'];
    protected $primaryKey = 'id';

    protected $hidden = ['password',  'remember_token'];

    use SoftDeletes;
    protected $dates =['deleted_at'];
}
