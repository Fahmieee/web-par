<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = ['company_name','alamat'];
    protected $primaryKey = 'id';
}
