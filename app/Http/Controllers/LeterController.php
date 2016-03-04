<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Leter;
use App\Models\Bag;
use Auth;
use App\Repositories\LeterRepository;

class LeterController extends Controller
{
    protected $leters;

    public function __construct(LeterRepository $leters)
    {
        $this->middleware('auth');

        $this->leters = $leters;
    }

    public function create(Request $request)
    {
        $bag = Bag::findOrFail($request->input('bag_id'));
        return view('leter.create', compact(['bag']));
    }

    public function store(Request $request)
    {
        $bag = Bag::findOrFail($request->input('data.bag_id'));
        $this->authorize('owner', $bag);

        $this->validate(
            $request, [
            'data.title' => 'required|max:90',
            'data.content' => 'required',
            ]
        );
        
        if (Leter::create($request->input('data'))) {
            return redirect(secure_url('/bag/'.$bag->id))
                ->with('status', 'Leter successfully created.');
        } else {
            return back()
                ->with('error', 'Error while creating the Leter please retry later.')
                ->withInput();
        }
    }

    public function checkdelete(Request $request, Leter $leter)
    {
        $url = secure_url('leter/'.$leter->id);
        $title = "Re-enter password to delete the Leter: <i>".$leter->title."</i>";
        $method = "DELETE";
        return view('auth.reauthenticate', compact(['url', 'title','method']));
    }

    public function destroy(Request $request, Leter $leter)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('password')])) {
            $this->authorize('owner', $leter);

            if ($leter->delete()) {
                return redirect(secure_url('/bag/'.$leter->bag_id))   
                    ->with('status', 'Leter successfully deleted.');
            } else {
                return back()
                    ->with('error', 'Error while deleting the Leter please retry later.');
            }
        } else {
            return back()
                    ->withErrors(['password' => 'Bad password.']);
        }
    }
}
