<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Kegiatan;
use App\Peminjaman;
use App\PeminjamanDetail;

class PengembalianValidasiController extends Controller
{
    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);
        $kegiatan = Kegiatan::orderBy('id','asc')->get();
        return view('pengembalian.validasi.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);

        $cekbox = explode(',', $request->checbox);
        $datadetail = PeminjamanDetail::whereIn('id', $cekbox);
        $peminjaman_id = $datadetail->pluck('peminjaman_id');
        $datapeminjaman = Peminjaman::whereIn('id',  $peminjaman_id);
        $datapeminjaman->update([
            'status' => 4,
            'tanggal_kembali' => Carbon::now(),
        ]);
        $datadetail->update([
            'status' => 4,
            'tanggal_kembali' => Carbon::now(),
        ]);
        return $datapeminjaman->pluck('nama');
    }

    public function apiPengembalianValidasi(Request $request)
    {
        $data = PeminjamanDetail::with('kegiatans','peminjamans')
                        ->where('status',3)
                        ->where('kantor_id', userKantorId());

        if($request->kegiatan_id){
            $data->where('kegiatan_id', $request->kegiatan_id);
        }

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <label class="check"><input type="checkbox" class="icheckbox" name="check[]" value="'.$data->id.'"/></label>';
            })->rawColumns(['action'])->make(true);
    }


}
