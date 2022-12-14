<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;
use Validator;

class InsuranceController extends Controller
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
        $validator = \Validator::make($request->all(), [
            'insurance_name' => 'required|unique:insurances,insurance_name,'.\Auth::user()->company_id,
        ]);
        
        if ($validator->fails()) {
            $data ['status'] = 401;
            $data ['data'] = 'Validation Error.';
            $data ['message'] = $validator->errors()->first();
            return response()->json($data);  
        }
        
        $datas=Insurance::create([
          'insurance_name'=>$request->insurance_name,
          'company_id'=>\Auth::user()->company_id,
        ]);
        $datas['insurances'] = Insurance::orderBy('created_at','DESC')->where('company_id',\Auth::user()->company_id)->get();
        return response()->json(['status' => 200,'message' => "Other insurance add",'data'=>$datas]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
