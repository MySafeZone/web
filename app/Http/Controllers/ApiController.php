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
use Storage;

class ApiController extends Controller
{
	public function signin(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user->api_token = str_random(60); // On génére un nouveau token aléatoire
            $user->save();
            return Response::make(
                    json_encode(array('result' => 'ok', 'api_token' => $user->api_token, 'key' => File::get('D39B74E6.asc'), 'key_id' => "D39B74E6")),
                    200,
                    array('Content-Type' => 'application/json; charset=utf-8')
                );
        }
        return Response::make(
            json_encode(array('error' => "Bad credentials")),
            401,
            array('Content-Type' => 'application/json; charset=utf-8')
        );
    }

    public function upload(Request $request)
    {
        Storage::disk('local')->put('public/safezone_fb/file.txt', 'Hello !');
        Storage::disk('local')->put('public/file.txt', 'Hello 2 !');
        Storage::put("/app/public/safezone_fb/test_storage_a.txt", "Via storage peut être ?")
        file_put_contents(public_path() + "/test_fpc_f.txt", "via file put content");
        file_put_contents("/app/public/safezone_fb/test_fpc_a.txt", "via file put content dans le fb ?");
        if ($request->file('photo')->isValid()) {
            $request->file('document')->move("/app/public/safezone_fb/");
        }
        return 200;
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