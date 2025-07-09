<?php

namespace App\Models;

use App\Models\Master\Staff;
use App\Models\Master\Position;
use Illuminate\Database\Eloquent\Model;

class RiwayatKarir extends Model
{
    protected $table = 'tb_riwayat_karir';
    protected $fillable = ['staff_id', 'position_id', 'position_new_id', 'keterangan'];
    protected $dates = ['deleted_at'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function positionNew()
    {
        return $this->belongsTo(Position::class, 'position_new_id');
    }
}
