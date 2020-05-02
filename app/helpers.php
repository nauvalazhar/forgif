<?php
use App\User;

function member() {
	$res = [
		"firstname" => firstname(isset(auth()->user()->name) ? auth()->user()->name : 'Guest')
	];
	return (object) $res;
}

function firstname($name) {
	return explode(" ", $name)[0];
}

function avatar($picture, $size=false) {
	if(!$picture) {
		return url('media/user_default.png');
	}
	return  url('') . '/media/' . $picture . $size . '.png';
}

function gif($gif) {
	$player = '<div class=\'gif--player\' controlslist="nodownload">
	<video tabindex="-1" preload="true" poster="'.url("media/thumbs/" . $gif . '.png').'" loop="true">
		<source src="'.url("media/player/" . $gif . ".mp4").'" type="video/mp4">
		Your browser does not support the video tag.
	</video>
	</div>';
	return $player;
}

function cover($cover) {
	if(!$cover) {
		return url('media/cover_default.png');
	}
	return url('') . '/media/' . $cover . '.png';
}

function bio($bio, $user = false) {
	if(!$bio && $user->id == @Auth::user()->id) {
		return '<i>No bio, give a little information about you</i>';
	}else if(!$bio && $user->id !== @Auth::user()->id) {
		return '<i>No bio, '.firstname($user->name).' still shy to write bio</i>';
	}
	return $bio;
}

function forgifButton($user, $forgifed = 'uname') {
	$btn = "";
	if(!Auth::check()) {
		return "@" . $user->username;
	}
	if($user->id == Auth::user()->id) {
		return '<div class="help-block"><i>It\'s you</i></div>';
	}

	if($user->has_follow_request) {
		return '<div class="help-block"><i>Waiting for Forgif confirmation</i></div>';
	}else if($user->has_follow_confirmed && !$user->has_follow_waiting) {
		// if($forgifed == 'uname') {
		// 	$btn .=  "@" . $user->username;
		// }else{
		// 	$btn .= $forgifed;
		// }
		$btn .= '<a class="btn btn-sm btn-danger btn-follow unforgif--button" data-to="'.$user->id.'">Unforgif</a>';
	}else{
    $btn .= '<a href="#" class="btn btn-sm btn-primary btn-follow ' . ($user->has_follow_waiting  ? 'confirm--button':'forgif--button') .'" data-target=".' . ($user->has_follow_waiting ? 'confirm' : 'search') . '-list-' . $user->id . '" data-id="' . $user->id .'" data-to="' . $user->id .'"><i class="ion ion-plus"></i> ';
			if($user->has_follow_waiting) {
				$btn .=	'Confirm';
			}elseif($user->has_follow){
				$btn .=	'Forgif Back';
			}else{
				$btn .=	'Forgif';
			}
    $btn .= '</a>';
		if($user->has_follow) {
			$btn .=	'<div class="help-text xs">';
			$btn .=	firstname($user->name) . ' has forgifed you';
			$btn .= '	</div>';
		}
	}

	return $btn;
}

function myenc($string) {
	$string = $string;
	$str = base64_encode($string);
	$str = rtrim($str, "==");
	return $str;
}

function mydec($string) {
	$string = $string . '==';
	$str = base64_decode($string);
	return $str;
}

function isAdmin() {
	return (Auth::user()->status <= 1 && Auth::user()->status !== NULL);
}