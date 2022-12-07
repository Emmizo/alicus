<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Medication;
use App\Models\Echat;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Client";
        $data['add']= "Add Client";
        $data['data']=$comp;
        
        $data['clients'] = Client::join('companies','clients.company_id','companies.id')->join('users','users.id','clients.created_by')->select('clients.*','users.first_name','users.last_name')->where('clients.company_id',$comp->comp_id)->get(); 
        return view('manage-clients.index',$data);
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
        'client_name'=>'required',
        'BOD'=>'required',
        'SSN'=>'required',
        'insurance_ID'=>'required',
        'country'=>'required',
        'address'=>'required',
        'telephone'=>'required',
        'email'=>'required',
        'race'=>'required',
        'house_hold'=>'required',
        'ethnicity'=>'required',
        'gender_birth'=>'required',
        'martial_status'=>'required',
        'preferred_language'=>'required',
        'employment_status'=>'required',
        'emergency_name'=>'required',
        'emergency_phone'=>'required',
        'emergency_name'=>'required',
        'relationship'=>'required',
        'emergency_address'=>'required',
        'primary_care_provider'=>'required',
        'client_PIN'=>'required',
        'comp_id'=>'required',
        ]);
        if ($validator->fails()) {
            $data1 ['status'] = 401;
            $data1 ['data'] = 'Validation Error.';
            $data1 ['message'] =$validator->errors()->first();
            return response()->json($data1); 
        }

        $client= Client::create([
        'client_name'=>$request->client_name,
        'BOD'=>$request->BOD,
        'ssn'=>$request->SSN,
        'insurance_ID'=>$request->insurance_ID,
        'country'=>$request->country,
        'address'=>$request->address,
        'telephone'=>$request->telephone,
        'email'=>$request->email,
        'race'=>$request->race,
        'house_hold'=>$request->house_hold,
        'ethnicity'=>$request->ethnicity,
        'gender_birth'=>$request->gender_birth,
        'martial_status'=>$request->martial_status,
        'preferred_language'=>$request->preferred_language,
        'employment_status'=>$request->employment_status,
        'emergency_name'=>$request->emergency_name,
        'emergency_phone'=>$request->emergency_phone,
        'emergency_email'=>$request->emergency_email,
        'relationship'=>$request->relationship,
        'emergency_address'=>$request->emergency_address,
        'primary_care_provider'=>$request->primary_care_provider,
        'client_PIN'=>$request->client_PIN,
        'company_id'=>$request->comp_id,
        'created_by'=>\Auth::user()->id,
        ]);
        $request->session()
        ->flash('success', "New patient added");
        // return redirect(route('company-list'));
        return response()->json(['status' => 201,'message' => "new  added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title']="More Information";
        $data['clients'] = Client::join('companies','clients.company_id','companies.id')->select('clients.*')->where('clients.id',$id)->get(); 
        return view('manage-clients.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title']="Edit Patient";
        $data['clientID']=$id;
        $data['clients'] = Client::join('companies','clients.company_id','companies.id')->select('clients.*')->where('clients.id',$id)->get(); 
        return view('manage-clients.edit', $data);
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
            'client_name'=>'required',
            'BOD'=>'required',
            'SSN'=>'required',
            'insurance_ID'=>'required',
            'country'=>'required',
            'address'=>'required',
            'telephone'=>'required',
            'email'=>'required',
            'race'=>'required',
            'house_hold'=>'required',
            'ethnicity'=>'required',
            'gender_birth'=>'required',
            'martial_status'=>'required',
            'preferred_language'=>'required',
            'employment_status'=>'required',
            'emergency_name'=>'required',
            'emergency_phone'=>'required',
            'emergency_name'=>'required',
            'relationship'=>'required',
            'emergency_address'=>'required',
            'primary_care_provider'=>'required',
            'client_PIN'=>'required',
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
    
            $client= Client::where('id',$request->id)->update([
            'client_name'=>$request->client_name,
            'BOD'=>$request->BOD,
            'ssn'=>$request->SSN,
            'insurance_ID'=>$request->insurance_ID,
            'country'=>$request->country,
            'address'=>$request->address,
            'telephone'=>$request->telephone,
            'email'=>$request->email,
            'race'=>$request->race,
            'house_hold'=>$request->house_hold,
            'ethnicity'=>$request->ethnicity,
            'gender_birth'=>$request->gender_birth,
            'martial_status'=>$request->martial_status,
            'preferred_language'=>$request->preferred_language,
            'employment_status'=>$request->employment_status,
            'emergency_name'=>$request->emergency_name,
            'emergency_phone'=>$request->emergency_phone,
            'emergency_email'=>$request->emergency_email,
            'relationship'=>$request->relationship,
            'emergency_address'=>$request->emergency_address,
            'primary_care_provider'=>$request->primary_care_provider,
            'client_PIN'=>$request->client_PIN,
            'created_by'=>\Auth::user()->id,
            ]);
            $request->session()
            ->flash('success', "New patient added");
            // return redirect(route('company-list'));
            return response()->json(['status' => 201,'message' => "updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Medication";
        $data['add']= "Add Medical to ".$request->name;
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['client']=$request->client;
        $data['company_id']= $request->id;
        $data['medications'] = Medication::join('companies','companies.id','medications.company_id')->select('companies.company_name','medications.*')->where('medications.company_id',$request->id)->get();
        return view('manage-clients.apply-medical',$data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applyView(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Medication";
        $data['add']= "Medication Report";
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['client']=$request->client;
        $data['company_id']= $request->id;
        $data['echats']=Echat::join('medications','medications.id','echat.medical_applied_id')
        ->join('clients','medications.client_id','clients.id')
        ->select('medications.medication_name','medications.dose_units','medications.dose_quantity','medications.frequency','echat.*')
        ->where('medications.client_id',$request->client)->get();
        $data['medications'] = Medication::join('clients','clients.id','medications.client_id')
        ->select('medications.*')->where('medications.client_id',$request->client)->get();
        return view('manage-clients.echat',$data);
    }

    /**
     * add medical  the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function add(Request $request){
        $validator = \Validator::make($request->all(), [
            'medical_id'=>'required',
            
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
            $medical=$request->medical_id;
            foreach($medical as $key =>$med){
            $add= \DB::table('medical_clients')->insert([
                'medical_id'=> $med,
                'client_id'=>$request->client_id,
                'created_by'=>\Auth::user()->id,
            ]);
        }
        $update= Client::where('id',$request->client_id)->update(['status'=>0]);
        $request->session()
            ->flash('success', "New record added");
            // return redirect(route('company-list'));
            return response()->json(['status' => 201,'message' => "updated"]);
     }
 /**
     * add medical chat the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function echatStore(Request $request){
        $validator = \Validator::make($request->all(), [
            'medical_id'=>'required',
            'client_pin'=>'required',
            'qty'=>'required',
            'action'=>'required',
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
            $medical=$request->medical_id;
            foreach($medical as $key =>$med){
            $add= New Echat();
                $add->medical_applied_id= $med;
                $add->client_pin =$request->client_pin;
                $add->staff_id=\Auth::user()->id;
                $add->staff_signature=$request->staff_signature;
                $add->qty=$request->qty[$key];
                $add->action = $request->action[$key];

                $add->comment=isset($request->comment)?$request->comment[$key]:null;
            $add->save();
        }
        $clientId=$request->client_id;
        
        $update= Client::where('clients.id',$clientId)->update(['status'=>0]);
        $request->session()
            ->flash('success', 'chat recorded for '.$request->name);
            
            return redirect(route('client-list'));

    }
    
}
