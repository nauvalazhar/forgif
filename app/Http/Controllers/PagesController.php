<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use Session;
use Crypt;
use Auth;

class PagesController extends Controller
{
	public function view($slug) {
		$page = Pages::with('users')->whereSlug($slug)->first();
		$pages = Pages::inRandomOrder()->take(5)->get();
		if(!$page) return view('errors.404');
		return view('page', compact('page', 'pages'));
	}

	public function help() {
		$pages = Pages::orderBy('created_at', 'desc');
		$q = request()->q;
		if($q) {
			$pages = $pages->where('title', 'like', '%'.$q.'%')->orWhere('content', 'like', '%'.$q.'%')->orWhere('keywords', 'like', '%'.$q.'%');
		}
		$pages = $pages->paginate(12);
		return view('help', compact('pages', 'q'));
	}

	public function index() {
		if(!Auth::check() || !isAdmin()) return view('errors.404');
		$pages = Pages::paginate(10);
		return view('pages', compact('pages'));
	}

	public function delete($id) {
		if(!Auth::check() || !isAdmin()) return view('errors.404');
		try {
		    $id = Crypt::decrypt($id);
		    $page_delete = Pages::find($id);
		    $pages = Pages::paginate(10);
		    return view('pages', compact('pages', 'page_delete'));
		} catch (Illuminate\Contracts\Encryption\DecryptException $msg) {
		    //
		}
	}

	public function destroy($id) {
		if(!Auth::check() || !isAdmin()) return view('errors.404');
		try {
		    $id = Crypt::decrypt($id);
		    $pages = Pages::find($id)->delete();
				Session::flash('msg', 'Page deleted successfully');
				return redirect()->route('pages');
		} catch (Illuminate\Contracts\Encryption\DecryptException $msg) {
		    //
		}
	}

	public function edit($id) {
		if(!Auth::check() || !isAdmin()) return view('errors.404');
		try {
		    $id = Crypt::decrypt($id);
		    $page_edit = Pages::find($id);
		    $pages = Pages::paginate(10);
		    return view('pages', compact('pages', 'page_edit', 'id'));
		} catch (Illuminate\Contracts\Encryption\DecryptException $msg) {
		    //
		}
	}

	public function update($id, Request $request) {
		if(!Auth::check() || !isAdmin()) return view('errors.404');
		try {
				$this->validate($request, [
					'title' => 'required',
					'slug' => 'required',
					'keywords' => 'required',
					'content' => 'required',
					'status' => 'required'
				]);
		    $id = Crypt::decrypt($id);
				$pages = Pages::find($id)->update($request->all());
				Session::flash('msg', 'Page updated successfully');
				return redirect()->back();
		} catch (Illuminate\Contracts\Encryption\DecryptException $err) {
		    //
		}
	}

	public function store(Request $request) {
		if(!Auth::check() || !isAdmin()) return view('errors.404');
		$this->validate($request, [
			'title' => 'required',
			'slug' => 'required',
			'keywords' => 'required',
			'content' => 'required',
			'status' => 'required'
		]);
		$input = $request->all();
		$input['user_id'] = Auth::user()->id;
		$pages = Pages::create($input);
		Session::flash('msg', 'Page created successfully');
		return redirect()->back();
	}

	public function contact() {
		return view('contact');
	}
}
