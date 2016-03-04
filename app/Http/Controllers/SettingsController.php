<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use PragmaRX\Google2FA\Google2FA;

class SettingsController extends Controller
{
    public function index()
    {
        if (!Auth::user()->two_factor) {
            $google2fa = new Google2FA();
            $google2fa_secret = $google2fa->generateSecretKey(32);
            $google2fa_url = $google2fa->getQRCodeGoogleUrl(
                'Leter',
                Auth::user()->email,
                $google2fa_secret
            );
        }

        return view('settings.index', compact(['google2fa_url', 'google2fa_secret']));
    }

    public function updateEmail(Request $request)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('update_email.password')])) {

            $this->validate(
                $request, [
                'update_email.email' => 'required|email|max:255|unique:users,email,'.Auth::user()->id
                ]
            );

            Auth::user()->email = $request->input('update_email.email');

            if (Auth::user()->save()) {
                return redirect('settings')->with('update_email.status', 'Great! Your email was successfully updated.');
            } else {
                return back()
                 ->withErrors(['updating' => 'Error while updating your new email please retry later.']);
            }
        } else {
            return back()
                    ->withErrors(['update_email.password' => 'Bad password.']);
        }
    }

    public function updatePassword(Request $request)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('update_password.current_password')])) {

            $this->validate(
                $request, [
                   'update_password.current_password' => 'required',
                'update_password.password' => 'required|confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
                ]
            );

            Auth::user()->password = Hash::make($request->input('update_password.password'));

            if (Auth::user()->save()) {
                return redirect('settings')->with('update_password.status', 'Great! Your password was successfully updated.');
            } else {
                return back()
                 ->withErrors(['updating' => 'Error while updating your new password please retry later.']);
            }
        } else {
            return back()
                 ->withErrors(['update_password.current_password' => 'Bad password.']);
        }
    }

    public function updateCoercionPassword(Request $request)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('update_coercion_password.current_password')])) {

            $this->validate(
                $request, [
                   'update_coercion_password.current_password' => 'required',
                    'update_coercion_password.password' => 'confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
                ]
            );

            if ($request->has('update_coercion_password.password')) {
                Auth::user()->coercion_password = Hash::make($request->input('update_coercion_password.password'));
            } else {
                Auth::user()->coercion_password = null;
            }

            if (Auth::user()->save()) {
                return redirect('settings')->with('update_coercion_password.status', 'Great! Your coercion password was successfully updated.');
            } else {
                return back()
                 ->withErrors(['updating' => 'Error while updating your coercion password please retry later.']);
            }
        } else {
            return back()
                 ->withErrors(['update_coercion_password.current_password' => 'Bad password.']);
        }
    }

    public function enableTwoFactorAuth(Request $request) 
    {
        $google2fa = new Google2FA();
        if ($google2fa->verifyKey($request->input('enable_2fa.google_2fa'), $request->input('enable_2fa.code'))) {
            
            Auth::user()->two_factor = $request->input('enable_2fa.google_2fa');
            
            if (Auth::user()->save()) {
                return redirect('settings')->with('disable_2fa.status', 'Great! Two-factor authentication is enabled.');
            } else {
                return back()
                    ->withErrors(['enabling' => 'Error while enabling two-factor authentication please retry later.']);
            }            
        } else {
            return back()
                    ->withErrors(['enable_2fa.code' => 'Bad confirmation code.']);
        }
    }

    public function disableTwoFactorAuth(Request $request) 
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('disable_2fa.password')])) {

            Auth::user()->two_factor = null;

            if (Auth::user()->save()) {
                return redirect('settings')->with('enable_2fa.status', 'Two-factor authentication is disabled.');;
            } else {
                return back()
                 ->withErrors(['disabling' => 'Error while disabling two-factor authentication please retry later.']);
            }
        } else {
            return back()
                    ->withErrors(['disable_2fa.password' => 'Bad password.']);
        }
    }
}
