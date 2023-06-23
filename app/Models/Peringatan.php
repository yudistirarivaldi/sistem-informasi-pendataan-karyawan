<?php

namespace App\Models;

use App\Models\Sanksi;
use Illuminate\Database\Eloquent\Model;

class Peringatan extends Model
{
    protected $table = 'tb_peringatan';
    protected $fillable = ['name'];

    public function sanksi() {
        return $this->hasOne(Sanksi::class);
    }
}


