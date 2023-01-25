<?php

namespace App\Exports;

use App\Models\Master\Staff;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StaffExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        
        return view('master.staff.pdf', [
           'items' => Staff::all()
        ]);
    }
}
