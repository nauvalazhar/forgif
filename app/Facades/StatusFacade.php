<?php
namespace App\Facades;
use App\Status;
use App\Friends;
use App\Likes;
use Auth;
use DB;

class StatusFacade {
	public function timeline($p) {
		$perpage = 3;
		$offset = ($p <= 1 ? 0 : ($p - 1) * $perpage);
		$take = $perpage;

		if(Auth::check()) {
			$me = @Auth::user()->id;
			$status = Status::where('privacy', 'public')
			->orWhere(function($query) use($me) {
				$query->where("user_id", $me);
				$query->orWhereIn("user_id", function($query) use($me) {
					$query->select("user_to")->from(with(new Friends())->getTable())->where("user_from", $me)->where('status', 'confirmed');
				});
			});
		}else{
			$status = new Status();
		}
		$status = $status->where('status', 'publish')
		->orderBy('created_at', 'desc')
		->with('users')			
		->offset($offset)
		->take($take)
		->get();

		$_status = [];
		foreach ($status as $item) {
			$_status[$item->id] = $item;
			$_status[$item->id]['date'] = $item->created_at->diffForHumans();
			$_status[$item->id]['content'] = $item->content;
			$_status[$item->id]['attachment'] = gif($item->attachment);
			$_status[$item->id]['has_like'] = Likes::wherePostId($item->id)->whereUserId(@Auth::user()->id)->count();
			$_status[$item->id]['like_count'] = Likes::wherePostId($item->id)->count();
			$_status[$item->id]['owner'] = ($item->users->id == @Auth::user()->id ? true : false);
			$_status[$item->id]['admin'] = (@Auth::user()->status == 1 ? true : false);
			$_status[$item->id]['login'] = Auth::check();
			$_status[$item->id]['uniqueid'] = myenc($item->id);
      $_status[$item->id]['link'] = route('status.view', myenc($item->id));
		}
		return $status;
	}

	public function me($p, $user) {
		$perpage = 3;
		$offset = ($p <= 1 ? 0 : ($p - 1) * $perpage);
		$take = $perpage;
		$status = Status::whereUserId($user)
		->orderBy('created_at', 'desc')
		->with('users')
		->offset($offset)
		->take($take)
		->get();
		$_status = [];
		foreach ($status as $item) {
			$_status[$item->id] = $item;
			$_status[$item->id]['date'] = $item->created_at->diffForHumans();
			$_status[$item->id]['content'] = $item->content;
			$_status[$item->id]['attachment'] = gif($item->attachment);
			$_status[$item->id]['has_like'] = Likes::wherePostId($item->id)->whereUserId(@Auth::user()->id)->count();
			$_status[$item->id]['like_count'] = Likes::wherePostId($item->id)->count();
			$_status[$item->id]['owner'] = ($item->users->id == @Auth::user()->id ? true : false);
			$_status[$item->id]['admin'] = (@Auth::user()->status == 1 ? true : false);
			$_status[$item->id]['login'] = Auth::check();
			$_status[$item->id]['uniqueid'] = myenc($item->id);
      $_status[$item->id]['link'] = route('status.view', myenc($item->id));
		}

		return $status;
	}
}