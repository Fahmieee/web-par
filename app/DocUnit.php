<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocUnit extends Model
{
    protected $table = 'document_units';
    protected $fillable = ['document_id','unit_id'];
    protected $primaryKey = 'id';
}
