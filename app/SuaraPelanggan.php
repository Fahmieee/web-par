<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuaraPelanggan extends Model
{
    protected $table = 'suara_user';
    protected $fillable = ['jenis_id','user_id','driver_id','ket','type'];
    protected $primaryKey = 'id';
}
