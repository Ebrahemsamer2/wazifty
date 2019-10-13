<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('owner');
    }

    public function index()
    {
        $admins = User::where('admin', '=','1')->whereNotIn('email', ['soltan_algaram41@yahoo.com'] )->orderBy('id', 'desc')->paginate(15);

        return view('admin.admins.index', ['users' => $admins]);
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(AdminRequest $request, User $admin)
    {
        $admin->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('admins.index')->withStatus(__('Admin successfully created.'));
    }

    public function edit(User $admin)
    {
        if($admin->isAdmin()) {
            return view('admin.admins.edit', compact('admin'));
        }else {
            return abort(404);
        }
    }

    public function update(AdminRequest $request, User $admin)
    {
        $admin->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        return redirect()->route('admins.index')->withStatus(__('Admin successfully updated.'));
    }
    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admins.index')->withStatus(__('Admin successfully deleted.'));
    }
}
