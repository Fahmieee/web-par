<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScorePeriod extends Model
{
    protected $table = 'periode_nilai';
    protected $fillable = ['name','dari','sampai'];
    protected $primaryKey = 'id';

    use SoftDeletes;
    protected $dates =['deleted_at'];
}
