<?php

namespace App\Http\Controllers;

use App\Models\Sanksi;
use App\Models\Peringatan;
use App\Models\Master\Staff;
use Illuminate\Http\Request;
use App\Models\Master\Position;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Master\Keterangan;
use Illuminate\Support\Facades\Auth;

class SanksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['sanksi'] = Sanksi::all();
        // $data['count'] = Sanksi::count();
        // return view('sanksi.index', $data);

        if(Auth::user()->hasRole('admin'))
        {
            $data['sanksi'] = Sanksi::all();
            $data['count']    = Sanksi::count();
            return view('sanksi.index', $data);

        }
        else
        {
            $data['sanksi'] = Sanksi::where('staff_id', Auth::user()->staff->id)->get();
            $data['count'] = 1;
            return view('sanksi.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Buat Sanksi Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        $data['peringatan'] = Peringatan::all();
        return view('sanksi.create', $data);
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
            'peringatan_id'=>'required',
            'dokumen'=>'required',
        ]);

         if ($request->hasFile('dokumen')) {
        $dokumen = $request->file('dokumen');
        $dokumenPath = $dokumen->store('dokumen', 'public'); // Menyimpan file ke direktori "public/storage/dokumen".

        Sanksi::create([
            'staff_id' => $request->staff_id,
            'position_id' => $request->position_id,
            'keterangan' => $request->keterangan,
            'peringatan_id' => $request->peringatan_id,
            'dokumen' => $dokumenPath, // Menyimpan path file yang diunggah ke dalam database.
        ]);
    }

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data sanksi created successfully'
        ];
        return redirect()->route('sanksi.index')->with($message);
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
    public function edit(Sanksi $sanksi)
    {
        $data['title'] = "Buat Sanksi Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        $data['peringatan'] = Peringatan::all();
        $data['sanksi'] = $sanksi;
        return view('sanksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sanksi $sanksi)
    {
        $request->validate([
            'staff_id'=>'required',
            'position_id'=>'required',
            'keterangan'=>'required',
            'peringatan_id'=>'required',
        ]);

        $sanksi->update($request->all());
        $message = [
            'alert-type'=>'success',
            'message'=> 'Data sanksi updated successfully'
        ];
        return redirect()->route('sanksi.index')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $sanksi = Sanksi::find($id);
            if($sanksi)
            {
                $sanksi->delete();
            }
            $count = Sanksi::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data sanksi deleted successfully.'
            ];
            return response()->json($message);
        }
    }

    public function excel()
    {
      // filter berdasarkan departement
        $items = Sanksi::all();

        return view('sanksi.excel', [
           'items' => $items
        ]);
    }

    public function pdf()
    {

        $items = Sanksi::all();

        $customPaper = array(0,0,567.00,1000);

        $pdf = Pdf::loadview('sanksi.pdf', [ 'items'=> $items ])->setPaper($customPaper);
    	return $pdf->download('laporan-jadwal-sanksi-karyawan.pdf');


    }

}
