<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Individiual;
use App\Models\User;
use App\Models\Client;

class IndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Individual Therapy Note";
        $data['add']= "Add Individual Therapy Note ";
        $data['data']=$comp;
        $data['client']=Client::select('clients.id','client_name','BOD','created_at')->where('id',$request->client)->first();
        $data['company_id']= $request->id;
        $data['clientID']= $request->client;
        $data['groups'] = Individiual::join('clients','clients.id','individual_notes.client_id')
        ->join('users','users.id','individual_notes.staff_id')
        ->select('users.first_name','users.last_name','clients.client_name','clients.BOD','clients.created_at as admitted_at','individual_notes.*')->where('individual_notes.client_id',$request->client)->where('individual_notes.discharged',0)->get();
        return view('individual-therapy-notes.index',$data);
    }
    public function indexDis(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Individual Therapy Note";
        $data['add']= "Add Individual Therapy Note ";
        $data['data']=$comp;
        $data['client']=Client::select('clients.id','client_name','BOD','created_at')->where('id',$request->client)->first();
        $data['company_id']= $request->id;
        $data['clientID']= $request->client;
        $data['groups'] = Individiual::join('clients','clients.id','individual_notes.client_id')
        ->join('users','users.id','individual_notes.staff_id')
        ->select('users.first_name','users.last_name','clients.client_name','clients.BOD','clients.created_at as admitted_at','individual_notes.*')->where('individual_notes.client_id',$request->client)->where('individual_notes.discharged',1)->get();
        return view('manage-archive.individual-therapy',$data);
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
            'client_id'=>'required',
            'topic'=>'required',
            'individual_therapy'=>'required',
            'mood'=>'required',
            'effect'=>'required',
            // 'level_participation'=>'required',
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
        $add=New Individiual();
        $add->client_id=$request->client_id;
        $add->topic= $request->topic;
        $add->individual_therapy= $request->individual_therapy;
        $add->mood= json_encode($request->mood);
        $add->effect= json_encode($request->effect);
        $add->level_participation= json_encode($request->level_participation);
        $add->staff_id= \Auth::user()->id;
        $add->comments= $request->comments;
        $add->created_at = date('Y-m-d H:i:s');
        $add->save();

        $request->session()
        ->flash('success', "New Individual notes added");
        // return redirect(route('company-list'));
        return response()->json(['status' => 201,'message' => "updated"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Individual Therapy Note";
        $data['add']= "Add Group note ";
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['birth'] = $request->birth;
        $data['created']=$request->created;
        $data['groups'] = Individiual::join('users','users.id','individual_notes.staff_id')->select('individual_notes.*','users.first_name','users.last_name')->where('individual_notes.id',$request->id)->get();
        return view('individual-therapy-notes.view',$data);
    }
    public function showDis(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Individual Therapy Note";
        $data['add']= "Add Group note ";
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['birth'] = $request->birth;
        $data['created']=$request->created;
        $data['groups'] = Individiual::join('users','users.id','individual_notes.staff_id')->select('individual_notes.*','users.first_name','users.last_name')->where('individual_notes.id',$request->id)->where('individual_notes.discharged',1)->get();
        return view('manage-archive.view-individual',$data);
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
