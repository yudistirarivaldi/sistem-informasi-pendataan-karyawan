<?php

namespace App\Models;

use App\Models\Master\Departement;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Staff;

class Overtime extends Model
{
    protected $table = 'tb_overtime';
    protected $fillable = ['staff_id', 'departement_id', 'jumlah_overtime', 'tgl_overtime'];

    public function getTglovertimeAttribute($name)
    {
        return date('d-m-Y', strtotime($name));
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}
