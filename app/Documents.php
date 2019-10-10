<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';
    protected $fillable = ['doc_name','type'];
    protected $primaryKey = 'id';
}
