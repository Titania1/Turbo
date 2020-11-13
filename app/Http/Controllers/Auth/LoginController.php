<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

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

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $response = Socialite::driver('google')->user();
        } catch (\Exception $exception) {
            return redirect('/login')->with('error', $exception->getMessage());
        }

        $db_user = User::where('email', $response->email)->first();

        if ($db_user) {
            auth()->login($db_user);

            return redirect(RouteServiceProvider::HOME);
        } else {
            $userInfo = $response->user;
            $user = User::create([
                'name'      => $userInfo['name'],
                'email'     => $userInfo['email'],
                'token'     => $response->token,
                'google_id' => $userInfo['id'],
                'provider'  => 'google',
            ]);
            $user->markEmailAsVerified();

            $user->profile()->create([
                'avatar' => $userInfo['picture'],
                'locale' => $userInfo['locale'],
            ]);

            app()->setLocale($userInfo['locale']);

            auth()->login($user);

            return redirect(RouteServiceProvider::HOME);
        }
    }

    public function handleFacebookCallback()
    {
        try {
            $response = Socialite::driver('facebook')->user();
        } catch (\Exception $exception) {
            return redirect('/login')->with('error', $exception->getMessage());
        }

        $db_user = User::where('facebook_id', $response->id)->first();

        if ($db_user) {
            auth()->login($db_user);

            return redirect(RouteServiceProvider::HOME);
        } else {
            $userInfo = $response->user;
            $user = User::create([
                'name'        => $userInfo['name'],
                'email'       => $response->email,
                'token'       => $response->token,
                'facebook_id' => $userInfo['id'],
                'provider'    => 'facebook',
            ]);

            $user->markEmailAsVerified();

            $user->profile()->create([
                'avatar'          => $response->avatar,
                'avatar_original' => $response->avatar_original,
            ]);

            auth()->login($user);

            return redirect(RouteServiceProvider::HOME);
        }
    }
}
