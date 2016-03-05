<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request as Request;
use Auth;
use Hash;
use PragmaRX\Google2FA\Google2FA;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout','getReauthenticate','postReauthenticate']);
    }

    public function login(Request $request) 
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return redirect('login')
                    ->withInput($request->only('email'))
                    ->withErrors(['password' => 'Bad credentials.']);
        }
    
        $userdata = [
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ];

        $is_coercion_password = Hash::check($request->input('password'), $user->coercion_password);

        if (Auth::validate($userdata) || ($is_coercion_password) ) {

            if ($is_coercion_password) {
                foreach ($user->bags()->whereNull('send_at')->whereNull('disable_at')->get() as $bag) {
                    $bag->send();
                    $bag->send_at = date('Y-m-d H:i:s');
                    $bag->save();
                }
            }

            if (!$user->two_factor) {
                if (Auth::loginUsingId($user->id)) {
                    return redirect($this->redirectTo);
                }
            } else {
                if ($request->has('code')) {
                    $google2fa = new Google2FA();
                    if ($google2fa->verifyKey($user->two_factor, $request->input('code'))) {
                        if (Auth::loginUsingId($user->id)) {
                            return redirect($this->redirectTo);
                        }
                    } else {
                        return redirect('login')
                        ->with('display_two_factor', true)
                        ->withInput()
                        ->withErrors(['code' => 'Bad verification code.']);
                    }
                } else {
                    return redirect('login')->with('display_two_factor', true)
                        ->withInput();
                }
            }
        } else {
            $this->incrementLoginAttempts($request);
            return redirect('login')
                    ->withInput($request->only('email'))
                    ->withErrors(['password' => 'Bad credentials.']);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create(
            [
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => str_random(60),
            ]
        );
    }
}
