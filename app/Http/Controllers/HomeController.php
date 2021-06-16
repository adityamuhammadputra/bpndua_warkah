<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\PeminjamanDetail;
use App\Kegiatan;


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

        $bukutanah = PeminjamanDetail::whereNotNull('no_hak')->where('no_hak', '!=', 'null')->where('status', 3);
        $total_bukutanah = $bukutanah->count();
        $tanggal_bukutanah_max = datesOutput2($bukutanah->max('tanggal_pinjam'));
        $tanggal_bukutanah_min = datesOutput2($bukutanah->min('tanggal_pinjam'));
        $data_bukutanah = [
            'total' => $total_bukutanah,
            'min_tanggal' => $tanggal_bukutanah_min,
            'max_tanggal' => $tanggal_bukutanah_max,
        ];


        $suratukur = PeminjamanDetail::whereNotNull('no_su')->where('no_su', '!=', 'null')->where('status', 3);
        $total_suratukur = $suratukur->count();
        $tanggal_suratukur_max = datesOutput2($suratukur->max('tanggal_pinjam'));
        $tanggal_suratukur_min = datesOutput2($suratukur->min('tanggal_pinjam'));
        $data_suratukur = [
            'total' => $total_suratukur,
            'min_tanggal' => $tanggal_suratukur_min,
            'max_tanggal' => $tanggal_suratukur_max,
        ];

        $warkah = PeminjamanDetail::whereNotNull('no_warkah')->where('no_warkah', '!=', 'null')->where('status', 3);
        $total_warkah = $warkah->count();
        $tanggal_warkah_max = datesOutput2($warkah->max('tanggal_pinjam'));
        $tanggal_warkah_min = datesOutput2($warkah->min('tanggal_pinjam'));
        $data_warkah = [
            'total' => $total_warkah,
            'min_tanggal' => $tanggal_warkah_min,
            'max_tanggal' => $tanggal_warkah_max,
        ];

        $dashboard1 = Kegiatan::with('peminjamandetails')->whereIn('id', ['1','2','3','4','5','6','7','8'])->get();
        $dashboard2 = Kegiatan::with('peminjamandetails')->whereIn('id', ['9','10','11','12','13','14','15','16'])->get();
        $dashboard3 = Kegiatan::with('peminjamandetails')->whereIn('id', ['17','18','19', '20', '21', '22', '23','25'])->get();

        $grafik = DB::select(DB::raw('SELECT a.nama_kegiatan as label, COUNT(b.kegiatan_id) as y FROM master_kegiatan a
                                    LEFT JOIN peminjaman_detail b
                                    ON a.id = b.kegiatan_id
                                    GROUP BY a.nama_kegiatan'));

        $data = [
            'bukutanah' => $data_bukutanah,
            'suratukur' => $data_suratukur,
            'warkah' => $data_warkah,
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
        $data = PeminjamanDetail::with('peminjamans','kegiatans')->where('status', $request->status);
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
