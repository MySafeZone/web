<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EncryptedFile;
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
        $u = Auth::guard('api')->user();

        // var_dump($request->all());
        // var_dump($request->file("Stegano1.jpg"));

        $res = "upload error";
        if ($request->hasFile('document')) {
            $res = "document uploaded";
            $doc_file = $request->file('document');
            $filename = $doc_file->getClientOriginalName();
            // fonctionne
            $doc_file->move(public_path('files'), $doc_file->getClientOriginalName());
            // dans le file bucket peut être ?
            // $doc_file->move(public_path('safezone_fb'), $filename);
            // var_dump($doc_file);
            // $file = new EncryptedFile();
            // $file->content = $filename;
            // // var_dump($file->content);
            // $file->user_id = $u->id;
            // $file->save();
        }        

        return Response::make(
            json_encode(array('result' => $res)),
            200,
            array('Content-Type' => 'application/json; charset=utf-8')
        );
    }

    public function testUpload(Request $request)
    {
        return view('safezone.testupload');
    }
}