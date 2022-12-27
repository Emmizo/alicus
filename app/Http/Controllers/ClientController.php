<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Medication;
use App\Models\Echat;
use App\Models\Individiual;
use App\Models\GroupNote;
use App\Models\Progress;
use App\Models\Invoice;
use App\Models\Document;
use Carbon\Carbon;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Client";
        $data['add']= "Add Client";
        $data['data']=$comp;
        $data['insurances'] = \DB::table('insurances')->where('insurances.company_id',$comp->comp_id)->get();
        $data['clients'] = Client::join('companies','clients.company_id','companies.id')->join('users','users.id','clients.created_by')->select('clients.*','users.first_name','users.last_name')->where('clients.company_id',$comp->comp_id)
        ->where('clients.discharged',0)
        ->orderBy('clients.updated_at','DESC')
        ->get(); 
        return view('manage-clients.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addClient()
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Client";
        $data['add']= "Add Client";
        $data['data']=$comp;
        $data['insurances'] = \DB::table('insurances')->where('insurances.company_id',$comp->comp_id)->get();
        return view('manage-clients.add',$data);
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
        'insurance_ID'=>'required',
        'country'=>'required',
        'race'=>'required',
        'house_hold'=>'required',
        'ethnicity'=>'required',
        'gender_birth'=>'required',
        'martial_status'=>'required',
        'preferred_language'=>'required',
        
        'client_PIN'=>'required',
        'comp_id'=>'required',
        ]);
        if ($validator->fails()) {
            $data1 ['status'] = 401;
            $data1 ['data'] = 'Validation Error.';
            $data1 ['message'] =$validator->errors()->first();
            return response()->json($data1); 
        }
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addDay();
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
        'insurance_code' =>$request->insurance_code,
        'created_by'=>\Auth::user()->id,
        'created_at'=>date('Y-m-d H:i:s'),
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
    public function showDis($id)
    {
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title']="More Information";
        $data['clients'] = Client::join('companies','clients.company_id','companies.id')->select('clients.*')->where('clients.id',$id)->get(); 
        return view('manage-archive.view-client', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['title']="Edit Facesheet";
        $data['clientID']=$id;
        $data['data']=$comp;
        $data['insurances'] = \DB::table('insurances')->where('insurances.company_id',$comp->comp_id)->get();
        $data['clients'] = Client::join('companies','clients.company_id','companies.id')->select('clients.*')->where('clients.id',$id)->get(); 
        $data['race']=[
            'American Indan or Alaska Native',
        'Asian',
        'Black or African-American',
        'Native Hawaiian or Other Pacific Islander',
        'White',
        'Asian-Asian Indian',
        'Asian-Chinese',
        'Asian-Fillipino',
        'Asian-Japanese',
        'Asian-Korean',
        'Asian-Vietnamese',
        'Asian-Vietnamese',
        'Asian-Other Asian',
        'Asian-Unknown',
        'Native Hawaiian or Other Pacific Islander - Chamorro',
        
        'Native Hawaiian or Other Pacific Islander - Guarmanian',
        
        'Native Hawaiian or Other Pacific Islander - Native Hawaiian',
        
        'Native Hawaiian or Other Pacific Islander - Samoan',
        'Native Hawaiian or Other Pacific Islander - Unknown',
        'Other',
        'Unknown',
        'Alaskan Native',
        'Multi-Racial'];

        $data['eth']=[
            'Hispanic or Latino',
            'Ashkenazi Jewish',
            'Not Hispanic or Latino',
            'Hispanic or Latino - Central American',
            'Hispanic or Latino - Cuban',
            'Hispanic or Latino - Dominican',
            'Hispanic or Latino - Mexican',
            'Hispanic or Latino - Other Hispanic',
            'Hispanic or Latino - Puerto Rican',
            'Hispanic or Latino - South American',
            'Haitian',
            'Spanish/Latino',
            'Mexican',
            'Mexican American',
            'None of the Above',
        ];
        $data['genders']=[
            'Male',
            'Female',
            'Unknown'
        ];
        $data['martials']=[
            'Married',
            'Divorced',
            'Single',
        ];
        $data['languages']=[
            'English',
            'Spanish',
            'French',
            'Swahili',
            'Latin',
        ];
        $data['emp']=[
            'Employed',
            'Unemployed'
        ];
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
            // 'SSN'=>'required',
            // 'insurance_ID'=>'required',
            'country'=>'required',
            // 'address'=>'required',
            // 'telephone'=>'required',
            // 'email'=>'required',
            'race'=>'required',
            'house_hold'=>'required',
            'ethnicity'=>'required',
            'gender_birth'=>'required',
            'martial_status'=>'required',
            'preferred_language'=>'required',
            'employment_status'=>'required',
            // 'emergency_name'=>'required',
            // 'emergency_phone'=>'required',
            // 'emergency_name'=>'required',
            // 'relationship'=>'required',
            // 'emergency_address'=>'required',
            // 'primary_care_provider'=>'required',
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
            'insurance_code' =>$request->insurance_code,
            'created_by'=>\Auth::user()->id,
            'updated_at'=>date('Y-m-d H:i:s'),
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
        ->join('users','users.id','echat.staff_id')
        ->select('users.first_name','users.last_name','medications.medication_name','medications.dose_units','medications.dose_quantity','medications.frequency','echat.*','clients.client_name')
        ->where('medications.client_id',$request->client)->where('medications.discharged',0)->get();
        $data['medications'] = Medication::join('clients','clients.id','medications.client_id')
        ->select('medications.*')->where('medications.client_id',$request->client)->where('medications.discharged',0)->get();
        return view('manage-clients.echat',$data);
    }
    public function applyViewDis(Request $request)
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
        ->where('medications.client_id',$request->client)->where('medications.discharged',1)->get();
        $data['medications'] = Medication::join('clients','clients.id','medications.client_id')
        ->select('medications.*')->where('medications.client_id',$request->client)->where('medications.discharged',1)->get();
        return view('manage-archive.echat',$data);
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
            $id= $request->clientID;
            $chk= Client::where('id',$id)->where('client_PIN',$request->client_pin)->get();
            $real=Client::where('id',$id)->first();
            // return $chk;
            if($chk->count()>0){
            $medical=$request->medical_id;

            foreach($medical as $key =>$med){
            $add= New Echat();
                $add->medical_applied_id= $med;
                $add->client_pin =$request->client_pin;
                $add->staff_id=\Auth::user()->id;
                $add->staff_signature=\Auth::user()->id;
                $add->qty=$request->qty[$key];
                $add->action = $request->action[$key];

                $add->comment=isset($request->comment)?$request->comment[$key]:null;
            $add->save();
        }
        $clientId=$request->client_id;
        
        $update= Client::where('clients.id',$clientId)->update(['status'=>0]);
        $request->session()
            ->flash('success', 'chat recorded for '.$request->name);
            return response()->json(['status' => 201,'message' => "updated"]);
    }else{
        return response()->json(['status' => 401,'message' => "Authorized",'data'=>$real->client_PIN]);
    }
            // return redirect(route('client-list'));

    }
    /**
     * dicharge the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Discharged(Request $request){
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Client";
        $data['add']= "Add Client";
        $data['data']=$comp;
        $data['insurances'] = \DB::table('insurances')->where('insurances.company_id',$comp->comp_id)->get();
        $data['clients'] = Client::join('companies','clients.company_id','companies.id')->join('users','users.id','clients.created_by')->select('clients.*','users.first_name','users.last_name')->where('clients.company_id',$comp->comp_id)
        ->where('clients.discharged',1)
        ->get(); 
        return view('manage-archive.index',$data);
    }
/**
     * dicsharging the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function discharging($id) {
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addDay();
        $client = Client::where('id',$id)->update(['discharged'=>1,'discharged_at'=>$newDateTime]);
        $doc = Document::where('client_id',$id)->update(['discharged'=>1]);
        $group= GroupNote::where('client_id',$id)->update(['discharged'=>1]);
        $individual = Individiual::where('client_id',$id)->update(['discharged'=>1]);
        $progress = Progress::where('client_id',$id)->update(['discharged'=>1]);
        $invoice=Invoice::where('client_id',$id)->update(['discharged'=>1]);
        $echat=Medication::where('client_id',$id)->update(['discharged'=>1]);
        return redirect(route('client-list'));

    }
 public function undo($id){
    $currentDateTime = Carbon::now();
    $newDateTime = Carbon::now()->addDay();
    $client = Client::where('id',$id)->update(['discharged'=>0,'created_at'=>date('Y-m-d H:i:s')]);
    return redirect(route('client-list'));
 }
}
