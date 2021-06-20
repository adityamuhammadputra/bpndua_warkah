<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Kegiatan;
use App\Peminjaman;
use App\PeminjamanDetail;

class PeminjamanValidasiController extends Controller
{

    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);

        $kegiatan = Kegiatan::orderBy('id','asc')->get();
        return view('peminjaman.validasi.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);

        $cekbox = explode(',', $request->checbox);
        $datadetail = PeminjamanDetail::whereIn('id', $cekbox);
        $peminjaman_id = $datadetail->pluck('peminjaman_id');
        $datapeminjaman = Peminjaman::whereIn('id',  $peminjaman_id);
        $datapeminjaman->update(['status' => 3]);
        $datadetail->update(['status' => 3]);
        return $datapeminjaman->pluck('nama');
    }

    public function apiPeminjamanValidasi(Request $request)
    {
        $data = PeminjamanDetail::with('kegiatans','peminjamans')
                    ->where('kantor_id', userKantorId())
                    ->where('status',2);

        if($request->kegiatan_id){
            $data->where('kegiatan_id', $request->kegiatan_id);
        }

        if($request->hari_lewat){
            $date= Carbon::now()->addDays('-'.$request->hari_lewat)->format('Y-m-d');
            $data->whereDate('tanggal_pinjam', '<=', $date);
        }

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <label class="check"><input type="checkbox" class="icheckbox" name="check[]" value="'.$data->id.'"/></label>';
            })->rawColumns(['action'])->make(true);
    }
}
