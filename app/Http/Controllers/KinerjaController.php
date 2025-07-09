<?php

namespace App\Http\Controllers;

use App\Models\Kinerja;
use App\Models\Master\Staff;
use Illuminate\Http\Request;
use App\Models\Master\Position;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class KinerjaController extends Controller
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
            $data['kinerja'] = Kinerja::all();
            $data['count'] = Kinerja::count();
            return view('kinerja.index', $data);

        }
        else
        {
            $data['kinerja'] = Kinerja::where('staff_id', Auth::user()->staff->id)->get();
            $data['count'] = 1;
            return view('kinerja.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Buat Kinerja Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();

        return view('kinerja.create', $data);
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
            'keterangan'=>'required',
            'status'=>'required',
            'month'=>'required',
        ]);

        Kinerja::create($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data kinerja created successfully'
        ];
        return redirect()->route('kinerja.index')->with($message);
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
    public function edit(Kinerja $kinerja)
    {
        $data['title'] = "Buat Kinerja Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        $data['kinerja'] = $kinerja;
        return view('kinerja.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kinerja $kinerja)
    {
         $request->validate([
            'staff_id'=>'required',
            'keterangan'=>'required',
            'status'=>'required',
            'month'=>'required',
        ]);

        $kinerja->update($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data kinerja updated successfully'
        ];
        return redirect()->route('kinerja.index')->with($message);
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
            $kinerja = Kinerja::find($id);
            if($kinerja)
            {
                $kinerja->delete();
            }
            $count = Kinerja::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data kinerja deleted successfully.'
            ];
            return response()->json($message);
        }
    }
}
