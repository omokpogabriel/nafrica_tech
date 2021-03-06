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

    public function getresult(Request $request)
    {
        $this->validate($request, [
            'search' => ['required','string','min:3'],
            'search_type' => ['required','string','min:3'],
        ]);
        $search_term = $request->search;
        //->where('company_name','LIKE',"%{$search_term}%")->get();
        if($request->search_type =="owner"){
            $company = Company::where(['user_id'=>Auth::user()->id])
                ->where(function($query) use ($search_term){
                    $query->where('company_name','LIKE',"%{$search_term}%")

                            ->orWhere('email','LIKE',"%{$search_term}%");
                })->get();
        }else{
            $company = Company::where(function($query) use ($request){
                    return $query->
                    where('company_name','LIKE',"%{$request->search}%")
                        ->orWhere('email','LIKE',"%{$request->search}%");
                })->get();
        }

        return view('result')->with(['company'=>$company]);
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
     * in the case, it is the new company that is added by the user
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

            // checks is a companmy with the sent name was been registered  by the user
            $company = Company::where(['user_id'=>Auth::user()->id,
                 'company_name'=>$request->company_name
            ])->count('company_name');

            // returns false it the company already exists as part of the user company
            if($company >0){
                return response()
                    ->json(['status'=>false,'message'=>"company already registered by user"]);
            }

             // gets the details of the logged in user
              $user = User::find($request->user()->id);

            // adds the new user to the user companies
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
     * Update an exisiting company details
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
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
     * Remove a registered company.
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
