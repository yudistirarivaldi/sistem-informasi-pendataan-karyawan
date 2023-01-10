<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ScheduleExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data['schedule'] = Schedule::all();
        return view('schedule.excel', $data);

    }

    // public function headings(): array{
    //     return [
    //         'id', 'staff_id', 'tgl_masuk', 'ket_schedule', 'status'
    //     ];
    // }
}
