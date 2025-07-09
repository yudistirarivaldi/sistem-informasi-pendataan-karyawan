<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Staff;
use App\Models\Master\Position;

class Penghargaan extends Model
{
    protected $table = 'tb_penghargaan';
    protected $fillable = ['staff_id', 'position_id', 'keterangan'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
