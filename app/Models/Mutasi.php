<?php

namespace App\Models;

use App\Models\Master\Staff;
use App\Models\Master\Position;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'tb_mutasi';
    protected $fillable = ['staff_id', 'position_id', 'dari', 'ke', 'keterangan'];
    protected $dates = ['deleted_at'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
