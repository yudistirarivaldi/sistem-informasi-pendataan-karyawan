<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Overtime;
use App\Models\Master\Staff;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Master\Departement;
use Illuminate\Support\Facades\Auth;

class OvertimeController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('pimpinan')) {
            $overtime = Overtime::all();
        } else {
            $overtime = Overtime::where('staff_id', Auth::user()->staff->id)->get();
        }

        $totalJamLemburPerBulan = $this->calculateTotalJamLemburPerBulan($overtime);

        $data = [
            'overtime' => $overtime,
            'count' => count($overtime),
            'totalJamLemburPerBulan' => $totalJamLemburPerBulan,
        ];

        return view('overtime.index', $data);
    }

    private function calculateTotalJamLemburPerBulan($overtimes)
    {
        $result = [];

        foreach ($overtimes as $ot) {
            // Ganti dari $ot->tanggal ke $ot->tgl_overtime
            $bulanTahun = date('Y-m', strtotime($ot->tgl_overtime));

            if ($ot->waktu_mulai && $ot->waktu_selesai) {
                $mulai = \Carbon\Carbon::createFromFormat('H:i:s', $ot->waktu_mulai);
                $selesai = \Carbon\Carbon::createFromFormat('H:i:s', $ot->waktu_selesai);

                $jam = $selesai->diffInMinutes($mulai) / 60;

                if (!isset($result[$bulanTahun])) {
                    $result[$bulanTahun] = 0;
                }

                $result[$bulanTahun] += $jam;
            }
        }

        return $result;
    }

    public function create()
    {
        $data['title'] = "Buat overtime";
        $data['staff'] = Staff::all();
        $data['departement'] = Departement::all();
        return view('overtime.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id'=>'required',
            'departement_id'=>'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
            'tgl_overtime' => [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                $tanggalHariIni = Carbon::now()->format('Y-m-d');
                if ($value != $tanggalHariIni) {
                    $fail('Tanggal harus sesuai dengan tanggal hari ini.');
                }
            },
        ],

            'latitude'  => '',
        ]);

        // if ($request->latitude == "") {
        // $message = [
        //     'alert-type' => 'error',
        //     'message' => 'Anda harus update lokasi'
        // ];
        // return redirect()->back()->with($message);
        // }


        // if ($request->latitude != -0.502106) {
        // $message = [
        //     'alert-type' => 'error',
        //     'message' => 'Anda harus berada di area kantor'
        // ];
        // return redirect()->back()->with($message);
        // }

        overtime::create($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data overtime created successfully'
        ];
        return redirect()->route('overtime.index')->with($message);
    }



    public function edit(Overtime $overtime)
    {
        $data['title'] = "Edit overtime";
        $data['staff'] = Staff::all();
        $data['departement'] = Departement::all();
        $data['overtime'] = $overtime;
        return view('overtime.edit', $data);
    }

    public function update(Request $request, Overtime $overtime)
    {

        $request->validate([
            'staff_id'=>'required',
            'departement_id'=>'required',
            'jumlah_overtime'=>'required|max:2',
            'tgl_overtime'=>'required|date',
        ]);

        $overtime->update($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data overtime updated successfully'
        ];
        return redirect()->route('overtime.index')->with($message);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $overtime = Overtime::find($id);
            if($overtime)
            {
                $overtime->delete();
            }
            $count = Overtime::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data overtime deleted successfully.'
            ];
            return response()->json($message);
        }
    }

    public function excel()
    {
      // filter berdasarkan departement
        $items = Overtime::all();

        return view('overtime.excel', [
           'items' => $items
        ]);
    }

     public function pdf()
    {

        $items = Overtime::all();



        $customPaper = array(0,0,567.00,1000);

        $pdf = Pdf::loadview('overtime.pdf', [ 'items'=> $items ])->setPaper($customPaper);
    	return $pdf->download('laporan-jadwal-lembur-karyawan.pdf');


    }

}
