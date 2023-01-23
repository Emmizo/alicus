<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\User;
use App\Models\Client;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Progress Note";
        $data['add']= "Add Progress Note ";
        $data['data']=$comp;
        $data['client']=Client::select('clients.id','client_name','BOD','created_at')->where('id',$request->client)->first();
        $data['company_id']= $request->id;
        $data['clientID']= $request->client;
        $data['groups'] = Progress::join('clients','clients.id','progress_notes.client_id')
        ->join('users','users.id','progress_notes.staff_id')
        ->select('users.first_name','users.last_name','clients.client_name','clients.BOD','clients.created_at as admitted_at','progress_notes.*')->where('progress_notes.client_id',$request->client)->where('progress_notes.discharged',0)->get();
        return view('progress-notes.index',$data);
    }

    public function indexDis(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Progress Note";
        $data['add']= "Add Progress Note ";
        $data['data']=$comp;
        $data['client']=Client::select('clients.id','client_name','BOD','created_at')->where('id',$request->client)->first();
        $data['company_id']= $request->id;
        $data['clientID']= $request->client;
        $data['groups'] = Progress::join('clients','clients.id','progress_notes.client_id')
        ->join('users','users.id','progress_notes.staff_id')
        ->select('users.first_name','users.last_name','clients.client_name','clients.BOD','clients.created_at as admitted_at','progress_notes.*')->where('progress_notes.client_id',$request->client)->where('progress_notes.discharged',1)->get();
        return view('manage-archive.progress-note',$data);
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
            
            'progress_note'=>'required',
            
            // 'level_participation'=>'required',
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
        $add=New Progress();
        $add->client_id=$request->client_id;
        $add->progress_note= $request->progress_note;
        $add->level_participation= json_encode($request->level_participation);
        $add->staff_id= \Auth::user()->id;
        $add->created_at = date('Y-m-d H:i:s');
        $add->save();

        $request->session()
        ->flash('success', "New group notes added");
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
        $data['title'] = "Manage Progress Note";
        $data['add']= "Add Progress note ";
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['birth'] = $request->birth;
        $data['created']=$request->created;
        $data['groups'] = Progress::join('users','users.id','progress_notes.staff_id')
        ->select('progress_notes.*','users.first_name','users.last_name')
        ->where('progress_notes.id',$request->id)->get();
        return view('progress-notes.view',$data);
    }
    public function showDis(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Progress Note";
        $data['add']= "Add Progress note ";
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['birth'] = $request->birth;
        $data['created']=$request->created;
        $data['groups'] = Progress::where('id',$request->id)->where('discharged',1)->get();
        return view('manage-archive.view-progress',$data);
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
