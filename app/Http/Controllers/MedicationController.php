<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medication;
class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Medication";
        $data['add']= "Add Medical to ".$request->name;
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['client_id']= $request->client_id;
        $data['medications'] = Medication::join('clients','clients.id','medications.client_id')->select('clients.client_name','medications.*')->where('medications.client_id',$request->client_id)->where('medications.discharged',0)->get();
        return view('manage-clients.apply-medical',$data);
    }
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDis(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Medication";
        $data['add']= "Add Medical to ".$request->name;
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['client_id']= $request->client_id;
        $data['medications'] = Medication::join('clients','clients.id','medications.client_id')->select('clients.client_name','medications.*')->where('medications.client_id',$request->client_id)->where('medications.discharged',0)->get();
        return view('manage-archive.apply-medical',$data);
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
        'medication_name'=>'required',
        'dose_units'=>'required',
        'dose_quantity'=>'required',
        'frequency'=>'required',
        'prescriber'=>'required',
        'date_start'=>'required',
        'client_id'=>'required',
        ]);
        if ($validator->fails()) {
            $data1 ['status'] = 401;
            $data1 ['data'] = 'Validation Error.';
            $data1 ['message'] =$validator->errors()->first();
            return response()->json($data1); 
        }
       $add = Medication::create([
        'medication_name'=> $request->medication_name,
        'dose_units'=> $request->dose_units,
        'dose_quantity'=> $request->dose_quantity,
        'frequency'=> $request->frequency,
        'prescriber'=> $request->prescriber,
        'date_start'=> $request->date_start,
        'created_by'=>\Auth::user()->id,
        'client_id'=>$request->client_id,
       ]);
       $request->session()
        ->flash('success', "New Medical applied");
        return response()->json(['status' => 201,'message' => "new record recorded"]);
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
    public function edit(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Edit Medication";
        $data['data']=$comp;
        $med=Medication::where('id',$request->id)->first();
        $data['medicals'] = $med;
        $data['add']= "Update ".$med->medication_name;
        return view('manage-medication.edit',$data);
        //
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
            'medication_name'=>'required',
            'dose_units'=>'required',
            'dose_quantity'=>'required',
            'frequency'=>'required',
            'prescriber'=>'required',
            'date_start'=>'required',
            
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
           $add = Medication::where('id',$request->id)->update([
            'medication_name'=> $request->medication_name,
            'dose_units'=> $request->dose_units,
            'dose_quantity'=> $request->dose_quantity,
            'frequency'=> $request->frequency,
            'prescriber'=> $request->prescriber,
            'date_start'=> $request->date_start,

           ]);
           $request->session()
            ->flash('success', "New patient added");
            return response()->json(['status' => 201,'message' => "new  added"]);
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
