<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $userEmail = $user->email;

        $userData = User::where("email", $userEmail)->first();

        if($userData){
            Auth::login($userData, true);
            return redirect()->route('home');
        } else {
            $newUser = User::create([
                'name' => 'New User Name',
                'email' => $userEmail,
                'password' => password_hash('protector994', PASSWORD_DEFAULT)
            ]);
            if($newUser){
                return redirect()->route('home');
            }
        }
    }

    /**
     * Redirect the user to the Bitbucket authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToBitbucketProvider()
    {
        return Socialite::driver('bitbucket')->redirect();
    }

    /**
     * Obtain the user information from Bitbucket.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleBitbucketProviderCallback()
    {
        $user = Socialite::driver('bitbucket')->user();

        $userName = $user->nickname;
        $userEmail = $user->email;

        $userData = User::where("email", $userEmail)->first();

        if($userData){
            Auth::login($userData, true);
            return redirect()->route('home');
        } else {
            $newUser = User::create([
                'name' => $userName,
                'email' => $userEmail,
                'password' => password_hash('protector994', PASSWORD_DEFAULT)
            ]);
            if($newUser){
                return redirect()->route('home');
            }
        }
    }
}
