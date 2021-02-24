<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
          'company_name' => ['required','string','min:3'],
          'company_email' => ['required','email','min:3'],
          'company_country' => ['required','string','min:3']
        ]);


        $company = Company::where(['user_id'=>Auth::user()->id,
             'company_name'=>$request->company_name
        ])->count('company_name');

        if($company >0){
            return response()
                ->json(['status'=>false,'message'=>"company already registered by user"]);
        }

          $user = User::find($request->user()->id);

          $user->company()->create([
                'company_name' => $request->company_name,
                'email' => $request->company_email,
                'country' => $request->company_country
             ]);

        return response()
            ->json(['status'=>true,
                    'message'=>"company was added successful",
                     'user_info'=>User::where('id',Auth::user()->id)->with('company')->first()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'company_name' => ['required','string','min:3'],
            'company_email' => ['required','email','min:3'],
            'company_country' => ['required','string','min:3']
        ]);

        $company = Company::where('id',$id)
            ->update(
                [
                    'company_name' => $request->company_name,
                    'email' => $request->company_email,
                    'country' => $request->company_country
                ]
            );
        if($company ==0){
            return  response()->json(['status'=>false,
                'message'=>"unable to update company"]);
        }
        return response()
            ->json(['status'=>true,
                'message'=>"update was successful",
                'user_info'=>User::where('id',Auth::user()->id)->with('company')->first()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Company::where(['user_id'=>Auth::user()->id, 'id'=>$request->id])->delete();
        $user = User::where('id',Auth::user()->id)->select('id','name','email','mobile','country')->with('company')->first();
        return response()->json(['user_info'=>$user]);
    }
}
