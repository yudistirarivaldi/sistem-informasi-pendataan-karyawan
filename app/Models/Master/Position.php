<?php

namespace App\Models\Master;

use App\Models\Sanksi;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'tb_position';
    protected $fillable = ['name', 'salary', 'status'];

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function sanksi() {
        return $this->hasOne(Sanksi::class);
    }

    public function mutasi() {
        return $this->hasMany(Mutasi::class);
    }

}
