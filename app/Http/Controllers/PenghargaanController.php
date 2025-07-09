<?php

namespace App\Http\Controllers;

use App\Models\Penghargaan;
use App\Models\Master\Staff;
use Illuminate\Http\Request;
use App\Models\Master\Position;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PenghargaanController extends Controller
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
            $data['penghargaan'] = Penghargaan::all();
            $data['count'] = Penghargaan::count();
            return view('penghargaan.index', $data);

        }
        else
        {
            $data['penghargaan'] = Penghargaan::where('staff_id', Auth::user()->staff->id)->get();
            $data['count'] = 1;
            return view('penghargaan.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Buat Penghargaan Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        return view('penghargaan.create', $data);
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
            'keterangan'=>'required',

        ]);

        Penghargaan::create($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data penghargaan created successfully'
        ];
        return redirect()->route('penghargaan.index')->with($message);
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
    public function edit(Penghargaan $penghargaan)
    {
        $data['title'] = "Buat Penghargaan Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        $data['penghargaan'] = $penghargaan;
        return view('penghargaan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penghargaan $penghargaan)
    {
         $request->validate([
            'staff_id'=>'required',
            'position_id'=>'required',
            'keterangan'=>'required',
        ]);

        $penghargaan->update($request->all());
        $message = [
            'alert-type'=>'success',
            'message'=> 'Data penghargaan updated successfully'
        ];
        return redirect()->route('penghargaan.index')->with($message);
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
            $penghargaan = Penghargaan::find($id);
            if($penghargaan)
            {
                $penghargaan->delete();
            }
            $count = Penghargaan::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data penghargaan deleted successfully.'
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

        $pdf = Pdf::loadview('penghargaan.pdf', [ 'items'=> $items ])->setPaper($customPaper);
    	return $pdf->download('laporan-penghargaan-karyawan.pdf');


    }

}
