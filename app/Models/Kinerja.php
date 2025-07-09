<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Staff;

class Kinerja extends Model
{
    protected $table = 'tb_kinerja';
    protected $fillable = ['staff_id', 'keterangan', 'status', 'month'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
