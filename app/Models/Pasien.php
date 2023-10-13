<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = ['kode_pasien', 'nama_pasien', 'alamat', 'no_hp'];
    protected $dates = ['deleted_at'];
}
