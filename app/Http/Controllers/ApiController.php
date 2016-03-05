<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use File;
use Response;

class ApiController extends Controller
{
	public function signin(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user && app()['hash']->check($request->input('password'), $user->password)) {
            $user->api_token = str_random(60); // On génére un nouveau token aléatoire
            $user->save();
            return (new Response(json_encode(array('result' => 'ok', 'api_token' => $user->api_token, 'key' => File::get('D39B74E6.asc'))), 200))->header('Content-Type', 'application/json');
        }
        return (new Response(json_encode(array('error' => "Bad credentials")), 401));
    }

    public function randomApiToken(Request $request)
    {
        $token = str_random(60);
        $u = User::find(1);
        $u->api_token = $token;
        $u->save();
        return $token;
    }
}