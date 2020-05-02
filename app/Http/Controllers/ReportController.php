<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Status;
use Auth;
use Session;

class ReportController extends Controller
{
	public function post(Request $request) {
		// $user_to = Report::selectRaw('*, count(id) as total')->groupBy('to_user')->get();
		// $_target = [];
		// foreach($user_to as $i){
		// 	$_target[$i->to_user] = $i->total;
		// }
		// $target = array_search(min($_target), $_target);
		// 
		$this->validate($request, [
			'reason' => 'required|max:160'
		]);

		$report = Report::create([
			'post_id' => $request->id,
			'reason' => $request->reason,
			'status' => 'unread',
			'user_id' => Auth::user()->id
		]);
		return response(['data' => 'OK', 'status' => true], 200);
	}

	public function list_report() {
		if(!Auth::check() || !isAdmin()) return view('errors.404');

		$reports = Report::with('users')->whereStatus('unread')->paginate(10);
		return view('reports', compact('reports'));
	}

	public function destroy_report(Request $request) {
		if(!Auth::check() || !isAdmin()) return view('errors.404');
		$report = Report::find($request->id);
		$report->status = 'deleted';
		$report->by_user = Auth::user()->id;
		$report->save();
		Status::find($report->post_id)->delete();
		Session::flash('success', 'Post deleted successfully');
		return redirect()->back();
	}
}
