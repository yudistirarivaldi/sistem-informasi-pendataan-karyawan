<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Mutasi;
use App\Models\Salary;
use App\Models\Sanksi;
use App\Models\Overtime;
use App\Models\Schedule;
use App\Models\Master\Staff;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function index(Request $request)
    {
        $f = $request->filter ?? null;

        $data['title'] = "Laporan Karyawan";
        $data['staff'] = Staff::all();
        if($f == '' || $f == 'all')
        {
            $data['staff'] = Staff::all();
        }
        else
        {
            $data['staff'] = Staff::where('departement_id', $f)->get();
        }
        $data['departement_id'] = Staff::groupBy( 'departement_id' )
                ->orderBy( 'departement_id' )
                ->select(DB::raw('count(*) as count, departement_id'))
                ->get();
        $data['filter'] = $f;
        return view('laporan.karyawan', $data);
    }

    public function index_jadwal(Request $request)
    {
        $f = $request->filter ?? null;

        $data['title'] = "Laporan Jadwal Masuk";
        $data['schedule'] = Schedule::all();
        if($f == '' || $f == 'all')
        {
            $data['schedule'] = Schedule::all();
        }
        else
        {
            $data['schedule'] = Schedule::where('ket_schedule', $f)->get();
        }
        $data['ket_schedule'] = Schedule::groupBy( 'ket_schedule' )
                ->orderBy( 'ket_schedule' )
                ->select(DB::raw('count(*) as count, ket_schedule'))
                ->get();
        $data['filter'] = $f;
        return view('laporan.jadwal_masuk', $data);
    }

    public function index_cuti(Request $request)
    {
        $f = $request->filter ?? null;

        $data['title'] = "Laporan Cuti Karyawan";
        $data['cuti'] = Cuti::all();
        if($f == '' || $f == 'all')
        {
            $data['cuti'] = Cuti::all();
        }
        else
        {
            $data['cuti'] = Cuti::where('status', $f)->get();
        }
        $data['status'] = Cuti::groupBy( 'status' )
                ->orderBy( 'status' )
                ->select(DB::raw('count(*) as count, status'))
                ->get();
        $data['filter'] = $f;
        return view('laporan.cuti', $data);
    }

    public function index_sanksi(Request $request)
    {
        $f = $request->filter ?? null;

        $data['title'] = "Laporan Sanksi Karyawan";
        $data['sanksi'] = Sanksi::all();
        if($f == '' || $f == 'all')
        {
            $data['sanksi'] = Sanksi::all();
        }
        else
        {
            $data['sanksi'] = Sanksi::where('peringatan_id', $f)->get();
        }
        $data['peringatan_id'] = Sanksi::groupBy( 'peringatan_id' )
                ->orderBy( 'peringatan_id' )
                ->select(DB::raw('count(*) as count, peringatan_id'))
                ->get();
        $data['filter'] = $f;
        return view('laporan.sanksi', $data);
    }

    public function index_mutasi(Request $request)
    {
        $f = $request->filter ?? null;

        $data['title'] = "Laporan Mutasi Karyawan";
        $data['mutasi'] = Mutasi::all();
        if($f == '' || $f == 'all')
        {
            $data['mutasi'] = Mutasi::all();
        }
        else
        {
            $data['mutasi'] = Mutasi::where('position_id', $f)->get();
        }
        $data['position_id'] = Mutasi::groupBy( 'position_id' )
                ->orderBy( 'position_id' )
                ->select(DB::raw('count(*) as count, position_id'))
                ->get();
        $data['filter'] = $f;
        return view('laporan.mutasi', $data);
    }

    public function index_penggajian(Request $request)
    {
        $f = $request->filter ?? null;

        $data['title'] = "Laporan Gaji Karyawan";
        $data['salary'] = Salary::all();
        if($f == '' || $f == 'all')
        {
            $data['salary'] = Salary::all();
        }
        else
        {
            $data['salary'] = Salary::where('periode', $f)->get();
        }
        $data['periode'] = Salary::groupBy( 'periode' )
                ->orderBy( 'periode' )
                ->select(DB::raw('count(*) as count, periode'))
                ->get();
        $data['filter'] = $f;
        return view('laporan.penggajian', $data);
    }

    public function index_lembur(Request $request)
    {
        $f = $request->filter ?? null;

        $data['title'] = "Laporan Lembur Karyawan";
        $data['overtime'] = Overtime::all();
        if($f == '' || $f == 'all')
        {
            $data['overtime'] = Overtime::all();
        }
        else
        {
            $data['overtime'] = Overtime::where('tgl_overtime', $f)->get();
        }
        $data['tgl_overtime'] = Overtime::groupBy( 'tgl_overtime' )
                ->orderBy( 'tgl_overtime' )
                ->select(DB::raw('count(*) as count, tgl_overtime'))
                ->get();
        $data['filter'] = $f;
        return view('laporan.lembur', $data);
    }


    public function pdf($filter)
    {
        // filter berdasarkan departement
        $f = $filter ?? null;
        $data['title'] = "Laporan Karyawan";
        $data['staff'] = Staff::all();
        if($f == '' || $f == 'all')
        {
            $data['staff'] = Staff::all();
        }
        else
        {
            $data['staff'] = Staff::where('departement_id', $f)->get();
        }
        $data['departement_id'] = Staff::groupBy( 'departement_id' )
                ->orderBy( 'departement_id' )
                ->select(DB::raw('count(*) as count, departement_id'))
                ->get();
        $data['filter'] = $f;

        $customPaper = array(0,0,500,700);
        $pdf = Pdf::loadview('master.staff.pdf', $data)->setPaper($customPaper,'landscape');
    	return $pdf->download('laporan-data-karyawan.pdf');
    }

    public function pdf_jadwal($filter)
    {
        // filter berdasarkan departement
        $f = $filter ?? null;
        $data['title'] = "Laporan Jadwal Masuk";
        $data['schedule'] = Schedule::all();
        if($f == '' || $f == 'all')
        {
            $data['schedule'] = Schedule::all();
        }
        else
        {
            $data['schedule'] = Schedule::where('ket_schedule', $f)->get();
        }
        $data['ket_schedule'] = Schedule::groupBy( 'ket_schedule' )
                ->orderBy( 'ket_schedule' )
                ->select(DB::raw('count(*) as count, ket_schedule'))
                ->get();
        $data['filter'] = $f;

        $customPaper = array(0,0,500,700);
        $pdf = Pdf::loadview('schedule.pdf', $data)->setPaper($customPaper,'landscape');
    	return $pdf->download('laporan-jadwal-karyawan.pdf');
    }

    public function pdf_cuti($filter)
    {
        // filter berdasarkan departement
        $f = $filter ?? null;
        $data['title'] = "Laporan Cuti Karyawan";
        $data['cuti'] = Cuti::all();
        if($f == '' || $f == 'all')
        {
            $data['cuti'] = Cuti::all();
        }
        else
        {
            $data['cuti'] = Cuti::where('status', $f)->get();
        }
        $data['status'] = Cuti::groupBy( 'status' )
                ->orderBy( 'status' )
                ->select(DB::raw('count(*) as count, status'))
                ->get();
        $data['filter'] = $f;

        $customPaper = array(0,0,500,700);
        $pdf = Pdf::loadview('cuti.pdf', $data)->setPaper($customPaper,'landscape');
    	return $pdf->download('laporan-cuti-karyawan.pdf');
    }

    public function pdf_sanksi($filter)
    {
        // filter berdasarkan departement
        $f = $filter ?? null;
        $data['title'] = "Laporan Sanksi Karyawan";
        $data['sanksi'] = Sanksi::all();
        if($f == '' || $f == 'all')
        {
            $data['sanksi'] = Sanksi::all();
        }
        else
        {
            $data['sanksi'] = Sanksi::where('peringatan_id', $f)->get();
        }
        $data['peringatan_id'] = Sanksi::groupBy( 'peringatan_id' )
                ->orderBy( 'peringatan_id' )
                ->select(DB::raw('count(*) as count, peringatan_id'))
                ->get();
        $data['filter'] = $f;

        $customPaper = array(0,0,500,700);
        $pdf = Pdf::loadview('sanksi.pdf', $data)->setPaper($customPaper,'landscape');
    	return $pdf->download('laporan-sanksi-karyawan.pdf');
    }

    public function pdf_mutasi($filter)
    {
        // filter berdasarkan departement
        $f = $filter ?? null;
       $data['title'] = "Laporan Mutasi Karyawan";
        $data['mutasi'] = Mutasi::all();
        if($f == '' || $f == 'all')
        {
            $data['mutasi'] = Mutasi::all();
        }
        else
        {
            $data['mutasi'] = Mutasi::where('position_id', $f)->get();
        }
        $data['position_id'] = Mutasi::groupBy( 'position_id' )
                ->orderBy( 'position_id' )
                ->select(DB::raw('count(*) as count, position_id'))
                ->get();
        $data['filter'] = $f;

        $customPaper = array(0,0,500,700);
        $pdf = Pdf::loadview('mutasi.pdf', $data)->setPaper($customPaper,'landscape');
    	return $pdf->download('laporan-mutasi-karyawan.pdf');
    }

    public function pdf_gaji($filter)
    {
        // filter berdasarkan departement
        $f = $filter ?? null;
        $data['title'] = "Laporan Gaji Karyawan";
        $data['salary'] = Salary::all();
        if($f == '' || $f == 'all')
        {
            $data['salary'] = Salary::all();
        }
        else
        {
            $data['salary'] = Salary::where('periode', $f)->get();
        }
        $data['periode'] = Salary::groupBy( 'periode' )
                ->orderBy( 'periode' )
                ->select(DB::raw('count(*) as count, periode'))
                ->get();
        $data['filter'] = $f;

        $customPaper = array(0,0,500,700);
        $pdf = Pdf::loadview('salary.pdf_all', $data)->setPaper($customPaper,'landscape');
    	return $pdf->download('laporan-gaji-karyawan.pdf');
    }

    public function pdf_lembur($filter)
    {
        // filter berdasarkan departement
        $f = $filter ?? null;
        $data['title'] = "Laporan Lembur Karyawan";
        $data['overtime'] = Overtime::all();
        if($f == '' || $f == 'all')
        {
            $data['overtime'] = Overtime::all();
        }
        else
        {
            $data['overtime'] = Overtime::where('tgl_overtime', $f)->get();
        }
        $data['tgl_overtime'] = Overtime::groupBy( 'tgl_overtime' )
                ->orderBy( 'tgl_overtime' )
                ->select(DB::raw('count(*) as count, tgl_overtime'))
                ->get();
        $data['filter'] = $f;

        $customPaper = array(0,0,500,700);
        $pdf = Pdf::loadview('overtime.pdf', $data)->setPaper($customPaper,'landscape');
    	return $pdf->download('laporan-lembur-karyawan.pdf');
    }

}
