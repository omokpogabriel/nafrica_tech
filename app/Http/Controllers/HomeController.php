<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Rules\MobileLength;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard after login.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id',Auth::user()->id)->select('id','name','email','mobile','country')->with('company')->first();
        return view('home')->with(['user_info'=>$user]);
    }


    /**
     * Takes the user to the update profile page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $user = User::where('id',Auth::user()->id)->select('name','mobile','country')->first();
        return view('profileUpdate')->with(['user_info'=>$user]);
    }

    /**
     * accepts user request to update profile information
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', new MobileLength()],
            'country' => ['required', 'string', 'min:3', 'max:50'],
        ]);
        $user = User::where('id',$request->user()->id)
                ->update(
                    [
                        'name' => $request->name,
                        'mobile' => $request->mobile,
                        'country' => $request->country
                    ]
                );

        return redirect()->action([HomeController::class, 'index']);
    }
}
