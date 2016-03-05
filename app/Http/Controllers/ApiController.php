<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
	public function signin(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user && app()['hash']->check($request->input('password'), $user->password)) {
            $user->api_token = str_random(60); // On génére un nouveau token aléatoire
            $user->save();
            return response()->json(['result' => 'ok', 'api_token' => $user->api_token]);
        }
        return (new Response(array('error' => "Bad credentials"), 401))->header('Content-Type', 'application/json');
    }

    public function publicKey(Request $request)
    {
    	return response()->download("/public/D39B74E6.asc");
    }
}