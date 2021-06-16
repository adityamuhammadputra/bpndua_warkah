<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);

        return view('user.role.index');
    }


    public function store(Request $request)
    {
        if ($request->id) {
            $role = Role::find($request->id);
            $role->update(['name'=>$request->name]);
            $pesan = 'Diubah';

        }else {
            $role = Role::create(['name' => $request->name]);
            $pesan = 'Ditambah';
        }
        return redirect()->back()->with('info', 'Role '.$role['name'].' berhasil '.$pesan);
    }

    public function edit($id)
    {
        Auth::user()->authorizeRoles(['admin']);

        return Role::findById($id);
    }


    public function destroy($id)
    {
        $data = Role::find($id);
        $data->delete();
        return $data->name;
    }

    public function apidata()
    {
        $data = Role::all();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            return ' <a onclick="editData(' . $data->id . ')" class ="btn btn-primary btn-edit"><i class="fa fa-pencil-square-o">
                        </i> </a>' .
                    ' <a onclick="deleteData(' . $data->id . ')" class ="btn btn-danger"><i class="fa fa-trash-o">
                        </i> </a>';
        })
        ->rawColumns(['action'])->make(true);
    }

}
