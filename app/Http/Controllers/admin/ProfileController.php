<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Job;
use App\Picture;

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

    public function updatePicture(Request $request) {

        $rules = [
            'filename' => 'required',
        ];

        $this->validate($request, $rules);

        $user_id = auth()->user()->id;
        $data = $request->all();

        if($file = $request->file('filename')) {
            $filename = explode('.',$file->getClientOriginalName())[0];
            $filesize = $file->getSize();

            $fileextension = $file->getClientOriginalExtension();
            
            $fileToStore = $filename . '_' . time() . '.'.$fileextension;
            
            
            $data['filename'] = $fileToStore;
            $data['user_id'] = $user_id;
            $data['filesize'] = $filesize;

            // delete the old user picture
            Picture::where('user_id', $user_id)->delete();

            if(Picture::create($data)) {
                // Store the picture on the serve
                $file->move(public_path('images'), $fileToStore);

                return redirect('/admin/profile')->withStatus('Your picture successfully updated.');
            }else {
                return redirect('/admin/profile')->withStatus('Something wrong, Try again.');
            }
        }
    }

    public function jobs() {
        $jobs = Job::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10); 
        return view('admin.profile.jobs', compact('jobs'));
    }
}
