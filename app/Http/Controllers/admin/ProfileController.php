<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Job;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }
    
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function jobs() {
        $jobs = Job::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10); 
        return view('admin.profile.jobs', compact('jobs'));
    }
}
