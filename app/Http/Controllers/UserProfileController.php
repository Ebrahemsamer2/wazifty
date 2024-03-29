<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Picture;
use App\Resume;

use App\Events\ProfileSeen;

class UserProfileController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	$user = auth()->user();
    	if($user->emp_type == "employee") {
    		return view('userprofile.index', compact('user'));
    	}else {
    		return abort(404);
    	}
    }

    public function update(Request $request) {

		$user = auth()->user();
		$profile = $user->userprofile;

		if($request->has('submitbasicinfo')){
			
			$rules = [
				'name' => 'required|string|min:5|max:50',
				'email' => 'required|email',
				'address' => 'string|max:100',
				'phone' => 'string|min:10',
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
				$user->userprofile->address = $request->address;
			}
			if($request->has('phone')) {
				$user->userprofile->phone = $request->phone;
			}

			if($user->save() && $user->userprofile->save()) {
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

			}else if($request->has("submiteducationinfo")) {

				$rules = [
					'college' => 'required|string|min:5|max:100',
					'graduation_year' => 'string|min:4|max:4',
					'degree' => 'required|string',
				];

				$this->validate($request, $rules);

				if($request->has("college")) {
					$user->userprofile->college = $request->college;
				}
				if($request->has("graduation_year")) {
					$user->userprofile->graduation_year = $request->graduation_year;
				}
				if($request->has("degree")) {
					$user->userprofile->degree = $request->degree;
				}

				if($user->userprofile->save()) {
					return redirect()->back()->withStatus('Education info successfully updated');
				}else {
					return redirect()->back()->withStatus('Something wrong, Try again');
				}

			} else if($request->has("submitemploymentinfo")){

				$rules = [
					'job_title' => 'string|min:5|max:40|nullable',
					'summary' => 'string|min:100|max:1000|nullable',
					'skills' => 'string|min:5|max:500|nullable',
					'file' => 'file|nullable',
				];

				$this->validate($request, $rules);
				if($resume = $request->file("resume")) {

					$filename = $resume->getClientOriginalName();
					$fileextension = $resume->getClientOriginalExtension();
					$filesize = $resume->getSize();

					if(! in_array($fileextension,['pdf', 'txt', 'PNG','jpg'])) {
						return redirect()->back()->withStatus('Only PDF, TXT, PNG, and JPG files are allowed');
					}else if( $filesize > 15000000) {
						return redirect()->back()->withStatus('Your filesize can not be greater than 1.5M');
					}

					$fileToStore = auth()->user()->id.explode('.', $filename)[0] .'_'.time().'_.'.$fileextension;

					// delete the old resume
		            $oldResume = Resume::where('user_id', auth()->user()->id)->first();

		            if($oldResume) {
		            	$oldResumeFileName = $oldResume->filename;
		            	$oldResume->delete();

		            	if(file_exists('resumes/'.$oldResumeFileName)) {
		            		unlink('resumes/'.$oldResumeFileName);
		            	}
		            }

		            if(Resume::create(['filename' => $fileToStore, 'filesize' => $filesize,'user_id' => auth()->user()->id])) {
		                // Store the picture on the serve
		                $resume->move(public_path('resumes'), $fileToStore);
					}
				}
				if($request->has("job_title")) {
					$user->userprofile->job_title = $request->job_title;
				}

				if($request->has("summary")) {
					$user->userprofile->summary = $request->summary;
				}

				if($request->has("skills")) {
					$user->userprofile->skills = $request->skills;
				}

				if($user->userprofile->save()) {
					return redirect()->back()->withStatus('Employment info successfully updated');
				}else {
					return redirect()->back()->withStatus('Something wrong, Try again');
				}
				} else if($request->has("submitotherinfo")) {

					$rules = [
						'github' => 'url|min:10|nullable',
						'portfolio' => 'url|nullable',
						'linkedin' => 'url|nullable',
						'website' => 'url|nullable',
					];

					$this->validate($request, $rules);

					if($request->has("github")) {
						$user->userprofile->github = $request->github;
					}
					if($request->has("portfolio")) {
						$user->userprofile->portfolio = $request->portfolio;
					}
					if($request->has("linkedin")) {
						$user->userprofile->linkedin = $request->linkedin;
					}
					if($request->has("website")) {
						$user->userprofile->website = $request->website;
					}

					if($user->userprofile->save()) {
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
    	$user = User::where('emp_type', 'employee')->where('id',$id)->first();
    	if($user && ( auth()->user()->emp_type == 'employer' || auth()->user()->id === $user->id )) {

    		if(auth()->user()->emp_type == 'employer') {
    			$company = auth()->user()->id;
    			event(new ProfileSeen($user, $company));
    		}
    		return view('userprofile.show', compact('user'));
    	}
    	return abort(404);
    }
}
