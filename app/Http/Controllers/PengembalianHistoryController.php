<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Kegiatan;
use App\PeminjamanDetail;

class PengembalianHistoryController extends Controller
{
    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);
        $kegiatan = Kegiatan::orderBy('id','asc')->get();
        return view('pengembalian.history.index', compact('kegiatan'));
    }

    public function api(Request $request)
    {
        $data = PeminjamanDetail::with('kegiatans','peminjamans')->where('status',4);
        if($request->kegiatan_id){
            $data->where('kegiatan_id', $request->kegiatan_id);
        }

        if($request->mulai && $request->selesai){
            $data->whereBetween('tanggal_kembali',[datesInput($request->mulai. ' 00:00'), datesInput($request->selesai. ' 23:59')]);
        }

        return Datatables::of($data)
            ->addColumn('action',function($data){
                return '<a class="lihatbukti" href="/storage/'.$data->peminjamans->pdf.'"><label class="label label-warning">Lihat Bukti</label></a>';
            })->rawColumns(['action'])->make(true);
    }
}
