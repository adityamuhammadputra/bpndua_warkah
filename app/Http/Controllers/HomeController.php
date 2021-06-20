<?php

namespace App\Http\Controllers;

use App\JenisWarkah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\PeminjamanDetail;
use App\Kegiatan;
use App\Peminjaman;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $peminjaman = PeminjamanDetail::where('status', 3);
        $total_peminjaman = $peminjaman->count();
        $tanggal_pemijaman_max = datesOutput2($peminjaman->max('tanggal_pinjam'));
        $tanggal_pemijaman_min = datesOutput2($peminjaman->min('tanggal_pinjam'));
        $data_pinjam = [
            'total' => $total_peminjaman,
            'min_tanggal' => $tanggal_pemijaman_min,
            'max_tanggal' => $tanggal_pemijaman_max,
        ];

        $pengembalian = PeminjamanDetail::where('status',4);
        $total_pengembalian = $pengembalian->count();
        $tanggal_pengembalian_max = datesOutput2($pengembalian->max('tanggal_pinjam'));
        $tanggal_pengembalian_min = datesOutput2($pengembalian->min('tanggal_pinjam'));
        $data_kembali = [
            'total' => $total_pengembalian,
            'min_tanggal' => $tanggal_pengembalian_min,
            'max_tanggal' => $tanggal_pengembalian_max,
        ];

        $jenis = JenisWarkah::get();
        $peminjamanJenis = [];

        foreach($jenis as $j) :
            $peminjamanJenis [] = [
                'name' => $j->name,
                'count' => PeminjamanDetail::where('jenis', $j->name)->count(),
                'dateMin' => datesOutput2(PeminjamanDetail::where('jenis', $j->name)->min('tanggal_pinjam')) ?? '-',
                'dateMax' => datesOutput2(PeminjamanDetail::where('jenis', $j->name)->max('tanggal_pinjam')) ?? '-',
            ];
        endforeach;

        $dashboard1 = Kegiatan::with('peminjamandetails')->whereIn('id', ['1','2','3','4','5','6','7','8'])->get();
        $dashboard2 = Kegiatan::with('peminjamandetails')->whereIn('id', ['9','10','11','12','13','14','15','16'])->get();
        $dashboard3 = Kegiatan::with('peminjamandetails')->whereIn('id', ['17','18','19', '20', '21', '22', '23','25'])->get();

        $grafik = DB::select(DB::raw('SELECT a.nama_kegiatan as label, COUNT(b.kegiatan_id) as y, a.id as id FROM master_kegiatan a
                                    LEFT JOIN peminjaman_detail b
                                    ON a.id = b.kegiatan_id
                                    GROUP BY a.nama_kegiatan'));

        $data = [
            'peminjamanJenis' => $peminjamanJenis,
            'peminjaman' => $data_pinjam,
            'pengembalian' => $data_kembali,
            'dashboard' => [
                'dashboard1' => $dashboard1,
                'dashboard2' => $dashboard2,
                'dashboard3' => $dashboard3,
            ]
        ];

        return view('home', compact('data','grafik'));
    }

    public function detailpinjam($id)
    {
        return Kegiatan::with('peminjamans')->find($id);
    }

    public function apimodal(Request $request)
    {
        $data = PeminjamanDetail::with('peminjamans','kegiatans');
        if($request->status != null)
            $data->where('status', $request->status);

        if ($request->kegiatan_id != null) {
            $data->where('kegiatan_id', $request->kegiatan_id);
        }
        if($request->mulai && $request->selesai && $request->status==3){
            $data->whereBetween('tanggal_pinjam',[datesInput($request->mulai. ' 00:00'), datesInput($request->selesai. ' 23:59')]);
        }
        if($request->mulai && $request->selesai && $request->status==4){
            $data->whereBetween('tanggal_kembali',[datesInput($request->mulai. ' 00:00'), datesInput($request->selesai. ' 23:59')]);
        }
        return DataTables::of($data)->make(true);
    }

}
