<?php

namespace App\Http\Controllers;

use App\Album;
use App\Desa;
use App\Imports\WarkahImport;
use App\JenisWarkah;
use App\Kantor;
use App\Kegiatan;
use App\Pegawai;
use App\Ruang;
use App\Tahun;
use App\Warkah;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MasterController extends Controller
{
    public function indexkegiatan()
    {
        Auth::user()->authorizeRoles(['admin']);

        return view('master.kegiatan.index');
    }

    public function indexpeminjam()
    {
        Auth::user()->authorizeRoles(['admin']);

        $kegiatan = Kegiatan::all();
        return view('master.peminjam.index',compact('kegiatan'));
    }

    public function indexWarkah()
    {
        Auth::user()->authorizeRoles(['admin']);
        $data = (object) [
            'jenis' => JenisWarkah::all(),
            'tahun' => Tahun::where('status', 1)->get(),
            'album' => Album::all(),
            'ruang' => Ruang::all(),
            'kantor' => Kantor::get(),
            'desa' => Desa::orderBy('name')->get(),
        ];

        return view('master.warkah.index',compact('data'));
    }

    public function checkWarkah(Request $request)
    {
        $warkahCount = Warkah::where('no_warkah', $request->no_warkah)
                ->where('tahun', $request->tahun)
                ->count();

        if($request->id) :
            $warkahOld = Warkah::find($request->id);
            return $warkahOld;
            if($request->no_warkah . $request->tahun == $warkahOld->no_warkah . $warkahOld->tahun) {
                $warkahCount = 0;
            }
        endif;

        return response()->json($warkahCount, 200);
    }

    public function autoComplete(Request $request)
    {
        $query = $request->get('term','');

        $datas = Warkah::where('kantor_id', userKantorId())
                    ->where(function($q) use($query){
                        $q->where('no_warkah','LIKE','%'.$query.'%')
                            ->orWhere('tahun','LIKE','%'.$query.'%');
                    })
                    ->available()
                    ->limit(10)
                    ->get();

        $data = [];
        foreach ($datas as $d) {
            $data[]= [
                    'value'=>$d->no_warkah.'/'.$d->tahun.' || Jenis: '. optional($d->jenisWarkah)->name,
                    'id' => $d->id
            ];
        }

        if (count($data)) {
            return $data;
        } else {
            return ['value'=>"$query tidak ditemukan atau tidak tersedia",'label' => 0];
        }
    }

    public function showAutoComplete(Request $request)
    {
        $warkah = Warkah::find($request->id);
        $data = [
            'no_warkah' => $warkah->no_warkah_tahun,
            'jenis' => $warkah->jenisWarkah->name,
            'album' => $warkah->album,
            'posisi' => $warkah->posisi,
            'desa' => $warkah->desa,
            'row' => $request->row,
            'warkah_id' => $warkah->id,
        ];
        return json_encode($data);
    }

    public function uploadExcel(Request $request)
    {
        ini_set('memory_limit', -1);
        $param = $request->only('kantor_id', 'jenis', 'ruang');
        $param['fileName'] = $request->file('files')->getClientOriginalName();
        Excel::import(new WarkahImport($param), request()->file('files'));

        return 'Berhasil disimpan';
    }

    public function store(Request $request)
    {
        $input = $request->except('_method', '_token', 'type', 'no_warkah', 'no_warkah_multi');

        if ($request->type == 'kegiatan') {
            Kegiatan::create($input);
        } else if ($request->type == 'warkah') {
            if($request->no_warkah_multi) {
                foreach($request->no_warkah_multi as $val) :
                    $input['no_warkah'] = $val;
                    $input['kantor_id'] = userKantorId();
                    Warkah::create($input);
                endforeach;
            }
        } else {
            $input['kantor_id'] = userKantorId();
            Pegawai::create($input);
        }
        return $request->type.' Berhasil di Simpan';
    }

    public function edit($id, $type)
    {
        if ($type == 'kegiatan') {
            return Kegiatan::findOrFail($id);
        } else if ($type == 'warkah') {
            return Warkah::findOrFail($id);
        } else {
            return Pegawai::findOrFail($id);
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_method', '_token', 'type', 'id', 'no_warkah_multi');
        if ($request->type == 'kegiatan') {
            Kegiatan::find($id)->update($input);
        } else if ($request->type == 'warkah') {
            Warkah::find($id)->update($input);
        }else {
            Pegawai::find($id)->update($input);
        }
        return $request->type. ' Berhasil di Ubah';
    }

    public function destroy($id, $type)
    {
        if ($type == 'kegiatan') {
            Kegiatan::destroy($id);
        } else if ($type == 'warkah') {
            Warkah::destroy($id);
        } else {
            Pegawai::destroy($id);
        }
        return $type . ' berhasil dihapus';
    }

    public function datatable(Request $request)
    {
        if ($request->master == 'kegiatan') {
            $data = Kegiatan::query();
        } else if ($request->master == 'warkah') {
            $data = Warkah::with('jenisWarkah');
                        // ->where('kantor_id', userKantorId());

            if($request->jenis){
                $data->where('jenis', $request->jenis);
            }

            if($request->desa){
                $data->where('desa', $request->desa);
            }

            if($request->kantor){
                $data->where('kantor_id', $request->kantor);
            }

            if($request->status){
                if($request->status == 2) {
                    $data->whereHas('peminjamanDetails', function($q) {
                        $q->where('status', '<', 4);
                    });
                } else {
                    $data->available();
                }
            }
        } else {
            $data = Pegawai::with('kegiatans');
        }

        return DataTables::of($data)
            ->addColumn('status', function ($data) use ($request) {
                $status = '';
                if ($request->master == 'warkah') {
                    if($data->peminjamanDetails && $data->peminjamanDetails->status < 4)
                        $status = '<a class="label label-danger" style="text-decoration: line-through;"
                                        target="_blank"
                                        href="/peminjaman/monitoring?w=' . $data->peminjamanDetails->no_warkah . '">
                                        Tersedia
                                   </a>';
                    else
                        $status = '<span class="label label-warning">Tersedia</span>';
                }
                return $status;
            })
            ->addColumn('kantor', function ($data) use ($request) {
                $kantor = '';
                // if ($request->master == 'peminjam') {
                if(isset($data->kantor) && $data->kantor->id == '1')
                    $kantor = '<span class="label label-success">'.$data->kantor->name.'</span>';
                else {
                    $kantor = '<span class="label label-warning">'.optional($data->kantor)->name.'</span>';
                }
                // }
                return $kantor;
            })
            ->addColumn('action', function ($data) use ($request) {
                if ($request->master == 'peminjam') {
                    $datanama = $data->nama;
                } else if ($request->master == 'warkah') {
                    $datanama = $data->no_warkah;
                } else {
                    $datanama = $data->nama_kegiatan;
                }
                return  ' <a id="editData" data-id="' . $data->id . '" data-type="' . $request->master . '" data-nama="'.$datanama.'" class="btn btn-xs btn-mini btn-primary"><i class="fa fa-pencil"></i></a>' .
                    ' <a id="deleteData" data-id="' . $data->id . '" data-type="' . $request->master . '" data-nama="'.$datanama.'" class="btn btn-xs btn-mini btn-danger"> <i class="fa fa-times-circle"></i></a>';
            })
            ->rawColumns(['action', 'status', 'kantor'])
            ->make(true);
    }
}
