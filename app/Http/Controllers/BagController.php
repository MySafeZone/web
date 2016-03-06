<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Bag;
use App\Models\Leter;
use App\Models\EncryptedFile;
use Auth;
use Mail;
use App\Repositories\BagRepository;

class BagController extends Controller
{
    protected $bags;

    public function __construct(BagRepository $bags)
    {
        $this->middleware('auth', ['except' => 'decrypt']);

        $this->bags = $bags;
    }

    public function index(Request $request)
    {
        return view(
            'bags.index', [
            'files' => $request->user()->files->sortByDesc('created_at')
            ]
        );
    }

    public function show(Request $request, Bag $bag)
    {
        return view('leter.index', compact(['bag']));
    }

    public function create() 
    {
        $periodicities = Bag::$periodicities;     
        return view('bags.create', compact(['periodicities']));
    }

    public function store(Request $request) 
    {
        $this->validate(
            $request, [
            'data.recipients' => 'required|emails',
            'data.title' => 'required|max:90',
            'data.periodicity' => 'required|integer|in:1,2,3,4,5,6'
            ]
        );

        $bag = Bag::create(array_merge(array_merge($request->input('data'), ['user_id' => Auth::user()->id])));

        if ($bag ) {
            $bag->updateEnd();

            return redirect('home')
                ->with('status', 'Bag successfully created.');
        } else {
            return back()
                ->with('error', 'Error while creating the Bag please retry later.')
                ->withInput();
        }
    }

    public function checkDelete(Request $request, Bag $bag)
    {
        $url = secure_url('bag/'.$bag->id);
        $title = "Re-enter password to delete the Bag: <i>".$bag->title."</i>";
        $method = "DELETE";
        return view('auth.reauthenticate', compact(['url', 'title','method']));
    }

    public function destroy(Request $request, Bag $bag)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('password')])) {
            $this->authorize('owner', $bag);

            $bag->leters()->delete();

            if ($bag->delete()) {
                return redirect('home')
                ->with('status', 'Bag successfully deleted.');
            } else {
                return back()
                    ->with('error', 'Error while deleting the Bag please retry later.');
            }
        } else {
            return back()
                    ->withErrors(['password' => 'Bad password.']);
        }
    }

    public function checkDisable(Request $request, Bag $bag)
    {
        $url = secure_url('bag/'.$bag->id.'/disable');
        $title = "Re-enter password to disable the Bag: <i>".$bag->title."</i>";
        $method = "PATCH";
        return view('auth.reauthenticate', compact(['url', 'title','method']));
    }

    public function disable(Request $request, Bag $bag)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('password')])) {
            $this->authorize('owner', $bag);

            $bag->disable_at = date('Y-m-d H:i:s');

            if ($bag->save()) {
                return redirect('home')
                ->with('status', 'Bag successfully disabled.');
            } else {
                return back()
                    ->with('error', 'Error while saving the Bag please retry later.');
            }
        } else {
            return back()
                    ->withErrors(['password' => 'Bad password.']);
        }
    }

    public function checkEnable(Request $request, Bag $bag)
    {
        $url = secure_url('bag/'.$bag->id.'/enable');
        $title = "Re-enter password to enable the Bag: <i>".$bag->title."</i>";
        $method = "PATCH";
        return view('auth.reauthenticate', compact(['url', 'title','method']));
    }

    public function enable(Request $request, Bag $bag)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('password')])) {
            $this->authorize('owner', $bag);

            $bag->disable_at = null;

            if ($bag->save()) {
                return redirect('home')
                ->with('status', 'Bag successfully enabled.');;
            } else {
                return back()
                    ->with('error', 'Error while saving the Bag please retry later.');
            }
        } else {
            return back()
                    ->withErrors(['password' => 'Bad password.']);
        }
    }

    public function checkSend(Request $request, Bag $bag)
    {
        $url = secure_url('bag/'.$bag->id.'/send');
        $title = "Re-enter password to send the Bag: <i>".$bag->title."</i>";
        $method = "POST";
        return view('auth.reauthenticate', compact(['url', 'title','method']));
    }

    public function send(Request $request, Bag $bag)
    {
        if (Auth::validate(['email' => Auth::user()->email, 'password' => $request->input('password')])) {
            $this->authorize('owner', $bag);

            $bag->send();
            $bag->send_at = date('Y-m-d H:i:s');

            if ($bag->save()) {
                return redirect('home')
                    ->with('status', 'Bag successfully sent.');;
            } else {
                return back()
                    ->with('error', 'Error while sending the Bag please retry later.');
            }
        } else {
            return back()
                    ->withErrors(['password' => 'Bad password.']);
        }
    }

    public function decrypt(Request $request, Bag $bag)
    {
        return view('bags.decrypt', compact(['bag']));
    }
}
