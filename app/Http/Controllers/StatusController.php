<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Likes;
use Crypt;
use Auth;
use Status as StatusFac;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class StatusController extends Controller
{
    public function post(Request $request) {
        if(!Auth::check()) return response(["users" => ["Please login or register to share your GIF"]], 422);
        if(Auth::user()->status == NULL) return response(["users" => ["You need to activate your account to share your GIF"]], 422);
    	$this->validate($request, [
    		'content' => 'required|max:160',
    		'attachment' => 'required|mimetypes:image/gif|max:2000'
    	]);

    	$fileName = uniqid();
    	$attachment = $request->file('attachment')->move(
    		base_path('public') . "/media/", $fileName . ".gif"
    	);
    	imagepng(imagecreatefromstring(file_get_contents($attachment)), base_path('public') . "/media/thumbs/" . $fileName . ".png");
        $tomp4 = new Process(env('FFMPEG') . 'ffmpeg -i ' . $attachment . ' -movflags faststart -pix_fmt yuv420p -vf "scale=trunc(iw/2)*2:trunc(ih/2)*2" ' . base_path('public/media') . '/player/' . $fileName . '.mp4');
        try {
            $tomp4->mustRun();
            
            $meta = [];
            $meta['ip'] = $request->ip();
            $meta = json_encode($meta);

            $status = Status::create([
                'user_id' => Auth::user()->id,
                'content' => $request->content,
                'attachment' => $fileName,
                'privacy' => 'friend',
                'status' => 'publish',
                'meta' => $meta
            ]);

            $status = Status::with('users')->find($status['id']);
                $status['date'] = $status->created_at->diffForHumans();
                $status['content'] = $status->content;
                $status['attachment'] = gif($status->attachment);
                $status['has_like'] = Likes::wherePostId($status->id)->whereUserId(Auth::user()->id)->count();
                $status['like_count'] = Likes::wherePostId($status->id)->count();
                $status['owner'] = ($status->users->id == Auth::user()->id ? true : false);
                $status['admin'] = (Auth::user()->status == 1 ? true : false);
                $status['login'] = Auth::check();
                $status['uniqueid'] = myenc($status->id);
                $status['link'] = route('status.view', myenc($status->id));

            return response(['data' => $status, 'success' => true], 200);
        } catch(ProcessFailedException $e) {
            return response(['data' => $e->getMessage(), 'success' => false], 500);
        }
    }

    public function destroy($id) {
    	$status = Status::find($id);
    	$status->delete();

  		return response(['data' => 'OK', 'success' => true], 200);
    }

    public function restore($id) {
    	$status = Status::withTrashed()->find($id);
    	$status->restore();

  		return response(['data' => 'OK', 'success' => true], 200);
    }

    public function update($id, Request $request) {
    	$status = Status::find($id);
    	if(Auth::user()->id && $status->user_id) {
	    	$status->content = $request->content;
	    	$status->save();

	  		return response(['data' => $status, 'success' => true], 200);    		
    	}
    }

    public function setpublic($id) {
        $status = Status::find($id);
        if(Auth::user()->id && $status->user_id && isAdmin()) {
            $status->privacy = 'public';
            $status->save();

            return response(['data' => $status, 'success' => true], 200);           
        }
    }

    public function get($p) {
    	return response(['data' => StatusFac::timeline($p), 'success' => true], 200);
    }

    public function me($user,$p) {
    	return response(['data' => StatusFac::me($p, $user), 'success' => true], 200);
    }

    public function like($id) {
    	if(Auth::check()) {  		
	    	$like = Likes::create([
	    		'user_id' => Auth::user()->id,
	    		'post_id' => $id
	    	]);
	    	return response(['data' => 'OK', 'success' => true], 200);
    	}
    }

    public function unlike($id) {
    	$like = Likes::wherePostId($id)->whereUserId(Auth::user()->id)->delete();
    	return response(['data' => 'OK', 'success' => true], 200);
    }

    public function view($id) {
        $id = mydec($id);

        $status = Status::whereId($id)->with('users')->first();
        $status['date'] = $status->created_at->diffForHumans();
        $status['content'] = $status->content;
        $status['has_like'] = Likes::wherePostId($status->id)->whereUserId(@Auth::user()->id)->count();
        $status['like_count'] = Likes::wherePostId($status->id)->count();
        $status['owner'] = ($status->users->id == @Auth::user()->id ? true : false);
        $status['admin'] = (@Auth::user()->status == 1 ? true : false);
        $status['login'] = Auth::check();
        $status['uniqueid'] = myenc($status->id);
        $status['link'] = route('status.view', myenc($status->id));
        return view('status', compact('status'));
    }

    public function play($id) {
        $id = mydec($id);

        $status = Status::whereId($id)->with('users')->first();
        list($image_width, $image_height) = getimagesize(base_path('public/media/thumbs/' . $status->attachment . '.png'));
        return view('play', compact('status', 'image_width', 'image_height'));
    }
}
