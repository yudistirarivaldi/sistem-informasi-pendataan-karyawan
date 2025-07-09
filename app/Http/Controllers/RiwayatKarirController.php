<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Master\Staff;
use Illuminate\Http\Request;
use App\Models\Master\Position;
use App\Models\RiwayatKarir;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RiwayatKarirController extends Controller
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
            $data['riwayat_karir'] = RiwayatKarir::orderby('created_at', 'desc')->get();
            $data['count'] = RiwayatKarir::count();
            return view('riwayat_karir.index', $data);

        }
        else
        {
            $data['riwayat_karir'] = RiwayatKarir::where('staff_id', Auth::user()->staff->id)
            ->orderby('id', 'desc')
            ->get();

            $data['count'] = 1;
            return view('riwayat_karir.index', $data);
        }
    }

    public function edit(RiwayatKarir $riwayat_karir)
    {
        $data['title'] = "Edit Riwayat Karir Karyawan";
        $data['staff'] = Staff::all();
        $data['posisi'] = Position::all();
        $data['riwayat_karir'] = $riwayat_karir;
        return view('riwayat_karir.edit', $data);
    }

    public function update(Request $request, RiwayatKarir $riwayat_karir)
    {

        $request->validate([
            'position_id'=>'required',
            'position_new_id'=>'required',
        ]);

        $riwayat_karir->update($request->all());
        $message = [
            'alert-type'=>'success',
            'message'=> 'Data riwayat karir updated successfully'
        ];
        return redirect()->route('staff.karir.index')->with($message);
    }

    public function destroy(Request $request, $id)
    {
        $id = $request->id;
        if($id)
        {
            $riwayat_karir = RiwayatKarir::find($id);
            if($riwayat_karir)
            {
                $riwayat_karir->delete();
            }
            $count = RiwayatKarir::count();
            $message = [
                'alert-type' => 'success',
                'count' => $count,
                'message' => 'Data riwayat karir deleted successfully.'
            ];
            return response()->json($message);
        }
    }

}
