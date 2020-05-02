<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Friends;
use Auth;
use Session;
use Image;
use Crypt;

class UsersController extends Controller
{
	public function detail($req) {
		$user = User::whereUsername($req)->first();
		if(!$user) return view('errors.404');
		$user['posts'] = Status::whereUserId($user->id)->count();
		$user['forgifing'] = Friends::whereUserFrom($user->id)->whereStatus('confirmed')->count();
		$user['forgifers'] = Friends::whereUserTo($user->id)->whereStatus('confirmed')->count();
		$user['has_follow'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'confirmed')->count();
		$user['has_follow_waiting'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'waiting')->count();
		$user['has_follow_request'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'waiting')->count();
		return view('profile', compact('user'));
		$user['has_follow_confirmed'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'confirmed')->count();
	}

	public function forgifings($req) {
		$user = User::whereUsername($req)->first();
		$forgifings = Friends::with('users_from')->whereUserFrom($user->id)->paginate(20);
		$user['posts'] = Status::whereUserId($user->id)->count();
		$user['forgifing'] = Friends::whereUserFrom($user->id)->whereStatus('confirmed')->count();
		$user['forgifers'] = Friends::whereUserTo($user->id)->whereStatus('confirmed')->count();

		return view('profile', compact('forgifings', 'user'));
	}

	public function forgifers($req) {
		$user = User::whereUsername($req)->first();
		$forgifers = Friends::with('users')->whereUserTo($user->id)->paginate(20);
		$user['posts'] = Status::whereUserId($user->id)->count();
		$user['forgifing'] = Friends::whereUserFrom($user->id)->whereStatus('confirmed')->count();
		$user['forgifers'] = Friends::whereUserTo($user->id)->whereStatus('confirmed')->count();
		return view('profile', compact('forgifers', 'user'));
	}

	public function settings() {
		return view('settings');
	}

	public function update(Request $request) {
		$this->validate($request, [
      'name' => 'required|string|max:30',
      'email' => 'required|string|email|max:30|unique:users,email,'.Auth::user()->id,
      'username' => 'required|string|max:15|unique:users,username,'.Auth::user()->id,
      'location' => 'sometimes|nullable|max:50',
      'bio' => 'sometimes|nullable|max:160|min:12',
      'password' => 'sometimes|nullable|min:6|confirmed'
		]);

		$input = $request->all();
		$user = User::find(Auth::user()->id);
		if(isset($input['password'])) {
			$input['password'] = bcrypt($input['password']);
		}else{
			$input['password'] = $user->password;
		}
		$update = $user->update($input);

  	Session::flash('success', 'Your account information has been updated.');
  	return redirect()->back();
	}

	public function picture() {
		return view('picture');
	}

	public function picture_update(Request $request) {
		$this->validate($request, [
			'picture' => 'required|mimetypes:image/png,image/jpeg,image/gif,image/jpg|max:2000'
		]);
		$filename = "user_" . uniqid();
		$image = Image::make($request->file('picture'));
		$image->crop(250, 250);
		$image->save(base_path('public') . "/media/" . $filename . "_lg.png");
		$image->resize(100, 100);
		$image->save(base_path('public') . "/media/" . $filename . "_md.png");
		$image->resize(50, 50);
		$image->save(base_path('public') . "/media/" . $filename . ".png");
		$user = User::find(Auth::user()->id);
		$user->picture = $filename;
		$user->save();
		Session::flash("success", "Your profile picture has been updated.");
		return redirect()->back();
	}

	public function cover() {
		return view('cover');
	}

	public function cover_update(Request $request) {
		$this->validate($request, [
			'cover' => 'required|mimetypes:image/png,image/jpeg,image/gif,image/jpg|max:2000'
		]);

		$filename = "user_cover_" . uniqid();

		imagepng(imagecreatefromstring(file_get_contents($request->file('cover'))), base_path('public') . "/media/" . $filename . ".png");

		$user = User::find(Auth::user()->id);
		$user->cover = $filename;
		$user->save();
		Session::flash("success", "Your profile cover has been updated.");
		return redirect()->back();
	}

	public function search() {
		$q = request()->q;
		$result = User::where('name', 'like', '%'.$q.'%')->orWhere('username', 'like', '%'.$q.'%')->orWhere('email', 'like', '%'.$q.'%')->take(10)->get();
		$_result = [];
		foreach($result as $user) {
			$_result[$user->id] = $user;
			$_result[$user->id]['has_follow'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'confirmed')->count();
			$_result[$user->id]['has_follow_waiting'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'waiting')->count();
			$_result[$user->id]['has_follow_request'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'waiting')->count();
			$_result[$user->id]['has_follow_confirmed'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'confirmed')->count();
		}
		return view('search', compact('q', 'result'));
	}

	public function activate($id) {
		$id = Crypt::decrypt($id);
		User::find($id)->update(['status' => 2]);
		return redirect()->route('home');
	}

	public function friends() {
		$friends = User::selectRaw("distinct users.*, (select count(*) from " . with(new Status())->getTable() . " where users.id = status.user_id) as post_count")
		->orderBy('post_count', 'desc')
		->paginate(20);
		$_friends = [];
		foreach($friends as $user) {
			$_friends[$user->id] = $user;
			$_friends[$user->id]['has_follow'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'confirmed')->count();
			$_friends[$user->id]['has_follow_waiting'] = Friends::where('user_to', @Auth::user()->id)->where('user_from', $user->id)->where('status', 'waiting')->count();
			$_friends[$user->id]['has_follow_request'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'waiting')->count();
			$_friends[$user->id]['has_follow_confirmed'] = Friends::where('user_from', @Auth::user()->id)->where('user_to', $user->id)->where('status', 'confirmed')->count();
		}
		return view('users', compact('friends'));
	}
}
