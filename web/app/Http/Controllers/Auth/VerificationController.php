<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Models\RegisterUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    protected $vueRouteHome = '';
    protected $vueRouteLogin = 'login';

    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Complete registration
     * 登録を完了させる
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register($token)
    {
        $registerUser = $this->getRegisterUser($token);

        if(!$registerUser)
        {
          $message = __('not provisionally registered.');
          return $this->redirectWithMessage($this->vueRouteLogin, $message);
        }

        event(new Registered($user = $this->createUser($registerUser->toArray())));
        Auth::login($user, true);
        $message = __('completion of registration.');
        return $this->redirectWithMessage($this->vueRouteHome, $message);
    }

    /**
     * get register user and clean table
     * @param string $activationCode
     * @return RegisterUser | null
     */
    private function getRegisterUser($token)
    {
        $registerUser = RegisterUser::where('token', $token)->first();

        if($registerUser)
        {
            RegisterUser::destroy($registerUser->email);
        }

        return $registerUser;
    }

    /**
     * Create a new user instance after a valid registration
     * @param array $data
     * @return \App\User
     */
    protected function createUser(array $data)
    {
        return User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'email_verified_at' => now(),
          'password' => $data['password'],
        ]);
    }

    /**
     * redirect with message
     * @param string $vueRoute
     * @param string $message
     * @return Redirect
     */
    protected function redirectWithMessage($vueRoute, $message)
    {
        $route = url($vueRoute);
        return redirect($route)
            ->cookie('MESSAGE', $message, 0, '', '', false, false);
    }
}