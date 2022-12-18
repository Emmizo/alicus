<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\User;
use Validator;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Payor";
        $data['add']="Add new Payor";
        $data['data']=$comp;
        $data['insurances'] = \DB::table('insurances')->where('insurances.company_id',$comp->comp_id)->get();
        return view('manage-insurance.index',$data);
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
          'insurance_company'=>$request->insurance_company,
          'insurance_name'=>$request->insurance_name,
          'phone'=>$request->phone,
          'address'=>$request->address,
          'percentage'=>$request->percentage,
          'company_id'=>\Auth::user()->company_id,
        ]);
        // $datas['insurances'] = Insurance::orderBy('created_at','DESC')->where('company_id',\Auth::user()->company_id)->get();
        return response()->json(['status' => 200,'message' => "Other insurance add"]);
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
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Payor";
        $data['add']="Edit Payor";
        $data['data']=$comp;
        $data['insurances'] = \DB::table('insurances')->where('insurances.id',$id)->first();
        return view('manage-insurance.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'insurance_name' => 'required|unique:insurances,id,'.$request->id,'unique:insurances,insurance_name,'.\Auth::user()->company_id,
        ]);
        
        if ($validator->fails()) {
            $data ['status'] = 401;
            $data ['data'] = 'Validation Error.';
            $data ['message'] = $validator->errors()->first();
            return response()->json($data);  
        }
        // $val = Insurance::whereNot('id',$request->id)->where('company_id',\Auth::user()->company_id)->where('insurance_name',$request->insurance_name)->count();
        // if($val>0){
            // $data ['status'] = 401;
            // $data ['data'] = 'Validation Error.';
            // $data ['message'] = "This insurance already there";
            // return response()->json($data);  
        // }else{
        $datas=Insurance::where('id',$request->id)->update([
          'insurance_company'=>$request->insurance_company,
          'insurance_name'=>$request->insurance_name,
          'phone'=>$request->phone,
          'address'=>$request->address,
          'percentage'=>$request->percentage,
        ]);
        return response()->json(['status' => 200,'message' => "insurance updated"]);
    // }
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
