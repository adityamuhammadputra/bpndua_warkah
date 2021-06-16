<?php

namespace App\Http\Controllers;

use App\Album;
use App\Desa;
use App\JenisWarkah;
use App\Kegiatan;
use App\Pegawai;
use App\Ruang;
use App\Tahun;
use App\Warkah;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Auth;

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
            'desa' => Desa::orderBy('name')->get(),
        ];

        return view('master.warkah.index',compact('data'));
    }

    public function checkWarkah(Request $request)
    {
        $warkahCount = Warkah::where('no_warkah', $request->no_warkah)
                        ->where('tahun', $request->tahun)
                        ->count();

        return response()->json($warkahCount, 200);
    }

    public function store(Request $request)
    {
        $input = $request->except('_method', '_token', 'type');

        if ($request->type == 'kegiatan') {
            Kegiatan::create($input);
        } else if ($request->type == 'warkah') {
            Warkah::create($input);
        } else {
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
        $input = $request->except('_method', '_token', 'type', 'id');
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
            $data = Warkah::with('jenis');
        } else {
            $data = Pegawai::with('kegiatans');
        }

        return DataTables::of($data)
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
            ->rawColumns(['action'])
            ->make(true);
    }
}
