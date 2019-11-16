<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Http\Requests\UserRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Events\CreatingUserProfile;
use App\Events\CreatingCompanyProfile;

use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index(Request $request)
    {   
        if( $q = $request->input('q') ) {
            $users = User::where('admin', 0)->where(function($query) use($q) {
                $query->where('name','LIKE','%'.$q.'%')->orwhere('email','LIKE','%'.$q.'%');
            })->paginate(15);
        }else {
            $users = User::where('admin', 0)->orderBy('id', 'desc')->paginate(15);
        }
        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request, User $model)
    {
        $user = $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        if($user->emp_type == 'employee') {
            event(new CreatingUserProfile($user));
        }else {
            event(new CreatingCompanyProfile($user));
        }
        return redirect()->route('users.index')->withStatus(__('User successfully created.'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User  $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        return redirect()->route('users.index')->withStatus(__('User successfully updated.'));
    }
    public function destroy(User $user)
    {
        if($user->emp_type == "employee") {
            if($user->userprofile) {
                $user->userprofile->delete();
            }
        }else {
            if($user->companyprofile) {
                $user->companyprofile->delete();
            }
        }
        $user->delete();
        return back()->withStatus(__('User successfully deleted.'));
    }

}
