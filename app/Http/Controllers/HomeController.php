<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Schedule;
use App\Models\Master\Staff;
use DB;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class HomeController extends Controller
{
    public function index()
    {
        $data['salary'] = Salary::count();
        $data['schedule'] = Schedule::count();
        $data['staff'] = Staff::count();

        if (Auth::user()->hasRole('admin')) {
            return view('home', $data);
        }

        return view('home_karyawan', $data);
    }

    public function getStaffPosition()
    {
        $data = DB::table('tb_staff', 'a')
                    ->groupBy( 'a.position_id' )
                    ->orderBy('name_position', 'asc')
                    ->select(DB::raw('count(a.position_id) as count, tb_position.name as name_position'))
                    // ->where('periode', $id)
                    ->join('tb_position', 'tb_position.id', '=', 'a.position_id')
                    ->get();
        return response()->json($data);
    }

    public function getStaffDepartement()
    {
        $data = DB::table('tb_staff', 'a')
                    ->groupBy( 'a.departement_id' )
                    ->orderBy( 'name_departement', 'asc' )
                    ->select(DB::raw('count(a.departement_id) as count, tb_departement.name as name_departement'))
                    // ->where('periode', $id)
                    ->join('tb_departement', 'tb_departement.id', '=', 'a.departement_id')
                    ->get();
        return response()->json($data);
    }

    public function getAbsensiByMonth()
    {
        $userId = Auth::id();
        $bulanIni = Carbon::now()->format('Y-m');

        // Hitung jumlah hari kerja bulan ini (Senin–Jumat)
        $hariKerja = CarbonPeriod::create(
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        )->filter(function ($date) {
            return !$date->isWeekend();
        })->count();

        // Ambil data absensi bulan ini
        $data = DB::table('tb_absensi')
            ->join('tb_schedule', 'tb_schedule.id', '=', 'tb_absensi.schedule_id')
            ->join('tb_attendance', 'tb_attendance.id', '=', 'tb_absensi.attendance_id')
            ->selectRaw('tb_attendance.name as status, COUNT(*) as total')
            ->where('tb_schedule.staff_id', $userId)
            ->whereBetween('tb_absensi.tanggal_absen', [
                Carbon::now()->startOfMonth()->toDateString(),
                Carbon::now()->endOfMonth()->toDateString()
            ])
            ->groupBy('tb_attendance.name')
            ->get();

        $map = collect($data)->keyBy('status');

        // Hitung total hari absen tercatat
        $totalTercatat = $map->sum('total');

        // Kalau Present tidak ada → anggap seluruh hari kerja sebagai Alpha
        if (!$map->has('Present')) {
            return response()->json([
                [
                    'bulan' => $bulanIni,
                    'status' => 'Alpha',
                    'total' => $hariKerja
                ]
            ]);
        }

        // Kalau Present ada, tambahkan Alpha jika ada sisa hari kerja
        $statusList = ['Present', 'Sick', 'Permission'];
        $final = [];

        foreach ($statusList as $status) {
            $final[] = [
                'bulan' => $bulanIni,
                'status' => $status,
                'total' => $map[$status]->total ?? 0
            ];
        }

        // Tambahkan Alpha = hari kerja - total absensi tercatat
        $totalAbsensi = $final[0]['total'] + $final[1]['total'] + $final[2]['total'];
        $final[] = [
            'bulan' => $bulanIni,
            'status' => 'Alpha',
            'total' => max($hariKerja - $totalAbsensi, 0)
        ];

        return response()->json($final);
    }

    public function getStaffKinerja()
    {
        $userId = Auth::id();
        $data = DB::table('tb_kinerja')
                    ->select('tb_kinerja.*')
                    ->join('tb_staff', 'tb_staff.id', '=', 'tb_kinerja.staff_id')
                    ->where('tb_staff.users_id', $userId)
                    ->get();
        return response()->json($data);
    }
}
