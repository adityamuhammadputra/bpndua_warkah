<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;

use App\User;


class UserController extends Controller
{

    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);

        $data = Role::all();
        return view('user.index', compact('data'));
    }

    public function user()
    {
        return view('user.user');
    }

    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['admin']);

        $input = $request->except('_token','_method');
        $input['email'] = $request->email."@gmail.com";
        $input['password'] = Hash::make($request->password);

        $input['foto'] = null;


        if ($request->hasFile('foto')){
            $input['foto'] = '/upload/foto/'.str_slug($input['name'],'-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto/'), $input['foto']);
        }

        $user = User::create($input);
        if ($request->role) {
            $user->assignRole([
                $request->role
            ]);
        }

        return $user->name;
    }

    public function edit($id)
    {
        Auth::user()->authorizeRoles(['admin']);

        return User::with('roles')->find($id);
    }

    public function destroy($id)
    {
        Auth::user()->authorizeRoles(['admin']);

        return User::destroy($id);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_mothod','_token');
        $input['password'] = Hash::make($request->password);
        $input['email'] = $request->email.'@gmail.com';

        $contact = User::findOrFail($id);

        $input['foto'] = $contact->foto;

        if($request->hasFile('foto'))
        {
            if($contact->foto != null)
            {
                unlink(public_path($contact->foto));
            }

            $input['foto'] = '/upload/foto/'.str_slug($input['name'],'-').'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('/upload/foto/'), $input['foto']);
        }
        $contact->update($input);

        if ($request->role) {
            $contact->syncRoles([
                $request->role
            ]);
        }

        return $contact->name;
    }

    public function cekusers(Request $request)
    {
        $email = $request->email."@gmail.com";
        $oldemail = $request->oldemail."@gmail.com";
        $data = User::where('email', $email)->count();
        if ($data == 1 && Auth::user()->email != $email && $email != $oldemail) {
            echo "ada";
        } else {
            echo "tidak";
        }
    }

    public function api()
    {
        // $this->authorize('user.read');

        $user = User::with('roles');

        return Datatables::of($user)
            ->addColumn('show_photo', function ($user) {
                if ($user->foto == null) {
                    return 'No images';
                }
                return '<img class="rounded-square" windth="50" height="50" src="' . url($user->foto) . '" alt="">';
            })
            ->addColumn('akses', function ($user) {
                $roles = '';
                foreach ($user->roles as $role) {
                    $roles .= '<span class="label label-info">' . $role->name . '</span> ';
                }
                return $roles;
            })
            ->addColumn('action', function ($user) {

                return ' <a onclick="editForm(' . $user->id . ')" class ="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit">
                        </i> Edit </a>' .
                    ' <a onclick="deleteData(' . $user->id . ')" class ="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash">
                        </i> Delete </a>';
            })->rawColumns(['show_photo', 'action', 'akses'])->make(true);
    }

}
