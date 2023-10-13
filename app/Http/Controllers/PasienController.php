<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data['pasien'] = Pasien::all();
            $data['count']    = Pasien::count();
            return view('pasien.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Buat pasien";
        return view('pasien.create', $data);
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
            'kode_pasien'=>'required',
            'nama_pasien'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required',
        ]);

        Pasien::create($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data pasien created successfully'
        ];
        return redirect()->route('pasien.index')->with($message);
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
   public function edit(Pasien $pasien)
    {
        $data['title'] = "Edit overtime";
        $data['pasien'] = $pasien;
        return view('pasien.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Pasien $pasien)
    {

        $request->validate([
            'kode_pasien'=>'required',
            'nama_pasien'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required',
        ]);

        $pasien->update($request->all());

        $message = [
            'alert-type'=>'success',
            'message'=> 'Data pasien updated successfully'
        ];
        return redirect()->route('pasien.index')->with($message);
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
            $pasien = Pasien::find($id);
            if($pasien)
            {
                $pasien->delete();
            }
            $count = Pasien::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data schedule deleted successfully.'
            ];
            return response()->json($message);
        }
    }
}
