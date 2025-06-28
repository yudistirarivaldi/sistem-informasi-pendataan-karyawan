<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Master\Staff;
use Illuminate\Http\Request;
use App\Models\Master\Position;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('pimpinan'))
        {
            $data['mutasi'] = Mutasi::all();
            $data['count'] = Mutasi::count();
            return view('mutasi.index', $data);

        }
        else
        {
            $data['mutasi'] = Mutasi::where('staff_id', Auth::user()->staff->id)->get();
            $data['count'] = 1;
            return view('mutasi.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Buat Mutasi Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        return view('mutasi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'staff_id'=>'required',
            'position_id'=>'required',
            'dari'=>'required',
            'ke'=>'required',
            'keterangan'=>'required',

        ]);

        Mutasi::create($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data mutasi created successfully'
        ];
        return redirect()->route('mutasi.index')->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mutasi $mutasi)
    {
        $data['title'] = "Buat Mutasi Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        $data['mutasi'] = $mutasi;
        return view('mutasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mutasi $mutasi)
    {
         $request->validate([
            'staff_id'=>'required',
            'position_id'=>'required',
            'dari'=>'required',
            'ke'=>'required',
            'keterangan'=>'required',
        ]);

        $mutasi->update($request->all());
        $message = [
            'alert-type'=>'success',
            'message'=> 'Data mutasi updated successfully'
        ];
        return redirect()->route('mutasi.index')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $request->id;
        if($id)
        {
            $mutasi = Mutasi::find($id);
            if($mutasi)
            {
                $mutasi->delete();
            }
            $count = Mutasi::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data mutasi deleted successfully.'
            ];
            return response()->json($message);
        }
    }

    public function excel()
    {
      // filter berdasarkan departement
        $items = Mutasi::all();

        return view('mutasi.excel', [
           'items' => $items
        ]);
    }

     public function pdf()
    {

        $items = Mutasi::all();

        $customPaper = array(0,0,567.00,1000);

        $pdf = Pdf::loadview('mutasi.pdf', [ 'items'=> $items ])->setPaper($customPaper);
    	return $pdf->download('laporan-jadwal-mutasi-karyawan.pdf');


    }

}
