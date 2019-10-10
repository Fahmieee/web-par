<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalCheckup extends Model
{
    protected $table = 'medical_checkup';
    protected $fillable = ['date','time','suhu','darah'];
    protected $primaryKey = 'id';
}
