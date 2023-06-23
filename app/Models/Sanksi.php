<?php

namespace App\Models;

use App\Models\Master\Position;
use App\Models\Master\Staff;
use Illuminate\Database\Eloquent\Model;

class Sanksi extends Model
{
    protected $table = 'tb_sanksi';
    protected $fillable = ['staff_id', 'position_id', 'keterangan', 'peringatan_id'];
    protected $dates = ['deleted_at'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function peringatan()
    {
        return $this->belongsTo(Peringatan::class);
    }

}
