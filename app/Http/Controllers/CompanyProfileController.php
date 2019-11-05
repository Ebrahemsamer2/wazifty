<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Picture;

class CompanyProfileController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	$company = auth()->user();
    	if($company->emp_type == "employer") {
    		return view('companyprofile.index', compact('company'));
    	}else {
    		return abort(404);
    	}
    }
    
public function update(Request $request) {

	$user = auth()->user();
	$profile = $user->companyprofile;

	if($request->has('submitbasicinfo')){
		
		$rules = [
			'name' => 'required|string|min:5|max:50',
			'email' => 'required|email',
			'address' => 'required|string|max:100',
			'phone' => 'required|string|min:10',
		];

		$this->validate($request, $rules);

		if($request->has('name')) {
			$user->name = $request->name;
		}
		if($request->has('email')) {

			$temp_user = User::where('email', $request->email)->first();

			if($temp_user){
				if($temp_user->email != $user->email) {
					return redirect()->back()->withStatus("Email belongs to another user.");
				}
			}else {
				$user->email = $request->email;
			}
		}
		if($request->has('address')) {
			$user->companyprofile->address = $request->address;
		}
		if($request->has('phone')) {
			$user->companyprofile->phone = $request->phone;
		}

		if($user->save() && $user->companyprofile->save()) {
			return redirect()->back()->withStatus("Profile successfully updated");
		}
		
	} else if($request->has("submitchangepassword")) {
			// password button clicked

			$rules = [
				'old_password' => 'required|min:6',
				'new_password' => 'required|min:6|confirmed',
				'new_password_confirmation' => 'required|min:6',
			];

			$this->validate($request, $rules);

			if($request->has('old_password')) {

				if (Hash::check($request->old_password, $user->password)) {
					// The passwords match...
					
					$user->password = Hash::make($request->new_password);
					if($user->save()) {
						return redirect()->back()->withStatus("Password successfully updated");
					}
				} else {
					return redirect()->back()->withStatus("Wrong password");
				}
			}

		} else if($request->has("submitemploymentinfo")){

			$rules = [
				'website' => 'url|min:10|nullable',
				'about' => 'string|min:100|max:1000|nullable'
			];

			$this->validate($request, $rules);

			if($request->has("website")) {
				$user->companyprofile->website = $request->website;
			}

			if($request->has("about")) {
				$user->companyprofile->about = $request->about;
			}

			if($user->companyprofile->save()) {
				return redirect()->back()->withStatus('Company info successfully updated');
			}else {
				return redirect()->back()->withStatus('Something wrong, Try again');
			}
		} else if($request->has("submitotherinfo")) {

			$rules = [
				'github' => 'url|min:10|nullable',
				'portfolio' => 'url|nullable',
				'linkedin' => 'url|nullable',
				'facebook' => 'url|nullable',
			];

			$this->validate($request, $rules);

			if($request->has("github")) {
				$user->companyprofile->github = $request->github;
			}
			if($request->has("portfolio")) {
				$user->companyprofile->portfolio = $request->portfolio;
			}
			if($request->has("linkedin")) {
				$user->companyprofile->linkedin = $request->linkedin;
			}
			if($request->has("facebook")) {
				$user->companyprofile->facebook = $request->facebook;
			}

			if($user->companyprofile->save()) {
				return redirect()->back()->withStatus("Online Presence successfully updated");
			}else {
				return redirect()->back()->withStatus("Something wrong, Try again");
			}
		}

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

                return redirect()->back()->withStatus('Picture successfully updated.');
            }else {
                return redirect()->back()->withStatus('Something wrong, Try again.');
            }
        }

	}

    public function show($id) {
    	$company = User::where('emp_type', 'employer')->where('id',$id)->first();
    	if($company && ( auth()->user()->emp_type == 'employee' || auth()->user()->id == $id) ) {
    		$jobs = $company->jobs()->orderBy('active', 'desc')->get();
    		return view('companyprofile.show', compact('company', 'jobs','id'));
    	}
    	return abort(404);
    }
}
