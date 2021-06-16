<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use PDF;
use Carbon;

use App\Pegawai;
use App\Kegiatan;
use App\Peminjaman;
use App\PeminjamanDetail;
use App\JenisHak;
use App\Kecamatan;
use App\Desa;

class PeminjamanRegisterController extends Controller
{

    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);

        $kegiatan = Kegiatan::orderBy('id','asc')->get();
        return view('peminjaman.register.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);
        $peminjaman = Peminjaman::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'unit_kerja' => $request->unit_kerja,
            'kegiatan_id' => $request->kegiatan,
            'via' => $request->via,
            'tanggal_pinjam' => datesInput($request->tanggal_pinjam),
            'tanggal_jatuh_tempo' =>  datesInput($request->tanggal_kembali),
            'created_by' => auth()->user()->id,
            'status' => '1'
        ]);

        if ($request->newno_hak != null){
            $datas = [];
            for($i = 0; $i < count($request->newno_hak); $i++){
                $desa = explode(', ', $request->newdesa[$i]);
                $datas = [
                    'peminjaman_id' => $peminjaman->id,
                    'no_seri' => $request->newno_seri[$i],
                    'no_hak' => $request->newno_hak[$i],
                    'jenis_hak' => $request->newjenis_hak[$i],
                    'desa' => $desa[0],
                    'kecamatan' => $desa[1],
                    'no_warkah' => $request->newno_warkah[$i],
                    'no_su' => $request->newno_su[$i],
                    'no_ht' => $request->newno_ht[$i],
                    'status' =>  '1',
                    'kegiatan_id' => $request->kegiatan,
                    'tanggal_pinjam' => datesInput($request->tanggal_pinjam),
                    'tanggal_jatuh_tempo' =>  datesInput($request->tanggal_kembali),
                ];
                PeminjamanDetail::insert($datas);
            }
        }

        return $peminjaman;
    }

    public function edit($id)
    {
        return Peminjaman::with('kegiatan','peminjamandetail')->find($id)->toJson();
    }

    public function update(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);

        $data = [
            'nip' => $request->nip,
            'nama' => $request->nama,
            'unit_kerja' => $request->unit_kerja,
            'kegiatan_id' => $request->kegiatan,
            'via' => $request->via,
            // 'tanggal_pinjam' => datesInput($request->tanggal_pinjam),
            'tanggal_kembali' => null,
            'tanggal_jatuh_tempo' =>  datesInput($request->tanggal_kembali),
        ];
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update($data);

        if($request->no_hak){
            foreach (array_keys($request->no_hak) as $key) {
                $detail = PeminjamanDetail::where('id', $key);
                $desa = explode(', ', $request->desa[$key][0]);
                $detail->update([
                    'no_seri' => $request->no_seri[$key][0],
                    'no_hak' => $request->no_hak[$key][0],
                    'jenis_hak' => $request->jenis_hak[$key][0],
                    'desa' => $desa[0],
                    'kecamatan' => $desa[1],
                    'no_ht' => $request->no_ht[$key][0],
                    'no_su' => $request->no_su[$key][0],
                    'no_warkah' => $request->no_warkah[$key][0],
                    'kegiatan_id' => $request->kegiatan,
                    'tanggal_pinjam' => datesInput($request->tanggal_pinjam),
                    'tanggal_jatuh_tempo' =>  datesInput($request->tanggal_kembali),
                ]);
            }
        }

        if ($request->newno_hak != null){
            foreach($request->newno_hak as $i => $val){
                $datanew[] = [
                    'peminjaman_id' => $id,
                    'no_seri' => $request->newno_seri[$i],
                    'no_hak' => $request->newno_hak[$i],
                    'jenis_hak' => $request->newjenis_hak[$i],
                    'desa' => $request->newdesa[$i],
                    'kecamatan' => $request->newkecamatan[$i],
                    'no_warkah' => $request->newno_warkah[$i],
                    'no_su' => $request->newno_su[$i],
                    'no_ht' => $request->newno_ht[$i],
                    'status' =>  '1',
                    'kegiatan_id' => $request->kegiatan,
                    'tanggal_pinjam' => datesInput($request->tanggal_pinjam),
                    'tanggal_jatuh_tempo' =>  datesInput($request->tanggal_kembali),
                ];
                PeminjamanDetail::insert($datanew);
            }

        }

        return $peminjaman;
    }

    public function destroy($id)
    {
        Auth::user()->authorizeRoles(['admin']);

        $data = PeminjamanDetail::find($id);
        $response = [
            'message' => 'Data No hak ' .$data->no_hak. 'berhasil di Hapus!',
            'table' => '#data-peminjaman',
            'id' => '#'.$data->id,
        ];
        $data->delete();
        return $response;
    }

    public function validasi(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);

        $datetime = Carbon::now();
        $replace = array(" ",":",'-');
        $datetime = str_replace($replace, '', $datetime);
        $shaid = preg_replace('/[^A-Za-z0-9\. -]/','',Hash::make($id));
        $shaid = str_replace('.', '', $shaid);
        $pathfile = 'app/pdf/peminjaman/'.$datetime.'-'.$shaid.'.pdf';

        $data_peminjaman = Peminjaman::find($id);
        PeminjamanDetail::where('peminjaman_id',$id)->update(['status'=>3]);

        $data = [
            'data' => $data_peminjaman,
        ];

        $data_peminjaman->status = 3;
        $data_peminjaman->pdf = $pathfile;
        $data_peminjaman->update();

        $pdf = PDF::loadView('peminjaman.register.cetak', $data);
        $pdf->save(storage_path().'/'.$pathfile);

        $response = [
            'message' => 'Data atas nama ' .$data_peminjaman->nama. 'berhasil divalidasi ke Pengembalian!',
            'id' => '#'.$data_peminjaman->id,
            'link' => '../storage/'.$pathfile,
            'cetak' => 'cetak',
        ];

        return $response;
    }
    public function cetak(Request $request, $id)
    {
        Auth::user()->authorizeRoles(['admin']);

        $datetime = Carbon::now();
        $replace = array(" ",":",'-');
        $datetime = str_replace($replace, '', $datetime);
        $shaid = preg_replace('/[^A-Za-z0-9\. -]/','',Hash::make($id));
        $shaid = str_replace('.', '', $shaid);
        $pathfile = 'app/pdf/peminjaman/'.$datetime.'-'.$shaid.'.pdf';
        $peminjaman = Peminjaman::with('peminjamandetail','kegiatan')->find($id);
        PeminjamanDetail::where('peminjaman_id',$id)->update(['status'=>2]);

        $data = [
            'data' => $peminjaman,
        ];

        $peminjaman->status = 2;
        $peminjaman->pdf = $pathfile;
        $peminjaman->update();

        $pdf = PDF::loadView('peminjaman.register.cetak', $data);
        $pdf->save(storage_path().'/'.$pathfile);

        $response = [
            'message' => 'Data atas nama ' .$peminjaman->nama. 'berhasil divalidasi ke Peminjaman Validasi!',
            'id' => '#'.$peminjaman->id,
            'link' => '../storage/'.$pathfile,
            'cetak' => 'cetak',
        ];
        return $response;
    }

    public function autoCompletePegawai(Request $request)
    {
        $query = $request->get('term','');

        $dataptsl=Pegawai::where('nip','LIKE','%'.$query.'%')->orWhere('nama','LIKE','%'.$query.'%')->limit(20)->get();
        $data=array();
        foreach ($dataptsl as $d) {
                $data[]=array('value'=>$d->nip.' || nama: '.$d->nama.' || Unit Kerja: '.$d->unit_kerja, 'id'=>$d->nip);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value'=>'Nama atau NIP tidak ada','id'=>''];
        }
    }

    public function autoCompletePegawaiShow(Request $request)
    {
        $id =  $request->nip;
        $datas=Pegawai::where('nip', $id)->first();
        $data= array(
            'nip'=>$datas->nip,
            'nama'=>$datas->nama,
            'unit_kerja'=>$datas->unit_kerja,
            'kegiatan_id'=>$datas->kegiatan_id,
        );
        $row_set[]              =$data;
        return $return = json_encode($row_set);
    }

    public function apiPeminjaman()
    {
        $data = Peminjaman::with('kegiatan','peminjamandetail')->where('status',1);
        return Datatables::of($data)
            ->addColumn('action',function($data){
                return ' <span class="label label-danger label-borok">' . $data->jumlahpinjam . '</span><a class ="btn btn-info btn-sm alertshow" id="'.$data->id.'" data-id="'.$data->id.'" data-judul="Peminjaman '.$data->nama.'" data-head="Cetak dan Validasi ke Peminjaman Validasi" data-type="Cetak"><em class="fa fa-print">
                        </em> </a>' .
                       ' <a class ="btn btn-warning btn-sm alertshow" id="'.$data->id.'" data-id="'.$data->id.'" data-judul="Peminjaman '.$data->nama.'" data-head="mengirim ke Pengembalian Validasi" data-type="Validasi"><em class="fa fa-rocket"></em> </a>'.
                        ' <a onclick="edit('.$data->id .')" class ="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> </a>';
            })->rawColumns(['action'])->make(true);
    }

    public function jenishak()
    {
        return JenisHak::pluck('nama', 'id');

    }

    public function kecamatan()
    {
        return Kecamatan::pluck('name','id');
    }

    public function desa()
    {
        return Desa::orderBy('name')->get();
    }

    public function cetakall()
    {
        ini_set('max_execution_time', '120');
        dd(phpinfo());
        exit;
        $test = Peminjaman::where('status', '!=', 1)
        ->skip(3605)
        ->take(1000)
        ->pluck('id');
        foreach($test as $id){
            $datetime = Carbon::now();
            $replace = array(" ",":",'-');
            $datetime = str_replace($replace, '', $datetime);
            $shaid = preg_replace('/[^A-Za-z0-9\. -]/','',Hash::make($id));
            $shaid = str_replace('.', '', $shaid);
            $pathfile = 'app/pdf/peminjaman/'.$datetime.'-'.$shaid.'.pdf';
            $peminjaman = Peminjaman::with('peminjamandetail','kegiatan')->find($id);
            $data = [
                'data' => $peminjaman,
            ];
            $peminjaman->pdf = $pathfile;
            $peminjaman->update();

            $pdf = PDF::loadView('peminjaman.register.cetak', $data);
            $pdf->save(storage_path().'/'.$pathfile);
        }
        return 'berhasil, file ada di app/pdf/peminjaman';
    }
}
