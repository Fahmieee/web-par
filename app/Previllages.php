<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Previllages extends Model
{
    protected $table = 'previllages';
    protected $fillable = ['role_id'];
    protected $primaryKey = 'id';
}
