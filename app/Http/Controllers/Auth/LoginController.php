<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Image;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(\Illuminate\Http\Request $request) {
        //return $request->only($this->username(), 'password');
        return ['email' => $request->{$this->username()}, 'password' => $request->password];
    }

    public function redirectToProvider($provider)
    {
        $this->validateProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $this->validateProvider($provider);

        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreate($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreate($user, $provider) {
        $authUser = User::where('provider_id', $user->id)->orWhere('email', $user->email)->first();
        if ($authUser) {
            if(empty($authUser->provider_id)) {
                User::find($authUser->id)->update([
                    'provider_id' => $user->id,
                    'provider' => $provider
                ]);
            }
            return $authUser;
        }
        $filename = "user_" . uniqid();
        file_put_contents("media/".$filename . "_lg.png", fopen(str_replace(1920, 250, $user->avatar_original), 'r'));
        $image = Image::make('media/'.$filename.'_lg.png');
        $image->resize(100, 100);
        $image->save(base_path('..') . "/media/" . $filename . "_md.png");
        $image->resize(50, 50);
        $image->save(base_path('..') . "/media/" . $filename . ".png");
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'picture' => $filename,
            'username' => $user->id,
            'status' => 2
        ]);
    }

    /**
     * Validate the given provider to only allowed provider.
     *
     * @param   string
     * @return  void
     * @throws  \NotFoundHttpException
     */
    protected function validateProvider($provider) {
        $allowedProvider = [
            'facebook', 'twitter'
        ];

        if(!in_array($provider, $allowedProvider)) return abort(404);
    }
}
