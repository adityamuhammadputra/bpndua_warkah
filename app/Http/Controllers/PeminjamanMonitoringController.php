<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


use App\Kegiatan;
use App\PeminjamanDetail;
use App\Warkah;

class PeminjamanMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $kegiatan = Kegiatan::orderBy('id','asc')
                    ->get();

        $warkahPinjam = Warkah::find($request->w);
        return view('peminjaman.monitoring.index', compact('kegiatan'));
    }

    public function apiPeminjamanMonitoring(Request $request)
    {
        $data = PeminjamanDetail::with('kegiatans','peminjamans')
                    ->where('kantor_id', userKantorId());

        if($request->kegiatan_id){
            $data->where('kegiatan_id', $request->kegiatan_id);
        }
        if($request->status){
            $data->where('status', $request->status);
        }
        if($request->mulai && $request->selesai){
            $data->whereBetween('tanggal_pinjam',[datesInput($request->mulai. ' 00:00'), datesInput($request->selesai. ' 23:59')]);
        }
        return Datatables::of($data)
            ->addColumn('action',function($data){
                if($data->status == 1){
                    return '<a class=""><label class="label label-danger">Di Registrasi</label></a>';
                }else if($data->status == 2) {
                    return '<a class="lihatbukti" href="/storage/' . $data->peminjamans->pdf . '" target="_blank"><label class="label label-default">Belum Validasi</label></a>';
                }elseif ($data->status == 3) {
                    return '<a class="lihatbukti" href="/storage/' . $data->peminjamans->pdf . '" target="_blank"><label class="label label-success">Sedang Dipinjam</label></a>';
                }else {
                    return '<a class="lihatbukti" href="/storage/' . $data->peminjamans->pdf . '" target="_blank"><label class="label label-info">Sudah Kembalikan</label></a>';
                }
            })->rawColumns(['action'])->make(true);
    }
}




