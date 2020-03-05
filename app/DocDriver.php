<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocDriver extends Model
{
    protected $table = 'document_drivers';
    protected $fillable = ['document_id','user_id'];
    protected $primaryKey = 'id';
}
