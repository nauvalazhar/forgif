<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use YoHang88\LetterAvatar\LetterAvatar;
use App\Mail\RegisterNotification;
use Mail;
use Sendmail;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $filename = "user_" . uniqid();
        $avatar = new LetterAvatar($data['name'], 'square', 50);
        $avatar->saveAs(base_path('public') . '/media/' . $filename . ".png", 'image/png');

        $avatar = new LetterAvatar($data['name'], 'square', 100);
        $avatar->saveAs(base_path('public') . '/media/' . $filename . "_md.png", 'image/png');

        $avatar = new LetterAvatar($data['name'], 'square', 250);
        $avatar->saveAs(base_path('public') . '/media/' . $filename . "_lg.png", 'image/png');

        $username = explode("@", $data['email']);
        $username = $username[0];


        $data = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $username,
            'password' => bcrypt($data['password']),
            'picture' => $filename
        ]);
        Sendmail::register($data);
        return Auth::loginUsingId($data->id);
    }
}
