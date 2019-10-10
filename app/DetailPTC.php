<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPTC extends Model
{
    protected $table = 'check_detail';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';
}
