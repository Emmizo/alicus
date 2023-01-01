<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use App\Helpers\Helper;
use File;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Document";
        $data['add']= "Add Document to ".$request->name;
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['client_id']= $request->id;
        $data['documents'] = Document::join('clients','clients.id','documents.client_id')
        ->join('users','users.id','documents.created_by')
        ->select('clients.client_name','documents.*','users.first_name')->where('documents.client_id',$request->id)->where('documents.discharged',0)->get();
        return view('manage-document.index',$data);
    }
    public function indexDis(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Document";
        $data['add']= "Add Document to ".$request->name;
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['client_id']= $request->id;
        $data['documents'] = Document::join('clients','clients.id','documents.client_id')->select('clients.client_name','documents.*')->where('documents.client_id',$request->id)->where('documents.discharged',1)->get();
        return view('manage-archive.document',$data);
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
            'title'=>'required',
            'doc_name' => 'required|mimes:pdf|max:50000000',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401,'message' => "file must be pdf and no more than 10MB"]);
                    
        }
        $str = str_replace(" ", "-", $request->company_name);
        $directory = public_path().'/documents/'.$str;
            // echo $directory;
            $file = new Document();
            if (!is_dir($directory)) {
                mkdir($directory);
                chmod($directory, 0777);
            }
            $docs = Helper::IDGenerator(new Document, 'docs',3, $request->title);
            $imageName = $str.'/'.$docs.'.' . $request->file('doc_name')->getClientOriginalExtension();
            $request->file('doc_name')->move($directory, $imageName);
            $file->title = $request->title;
            $file->doc_name = $imageName;
            $file->client_id= $request->client_id;
            $file->created_by = \Auth::user()->id;
            $file->created_at = date('Y-m-d H:i:s');
            $file->save();
            $request->session()
        ->flash('success', "New patient added");
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
    public function delete($id)
    {
       $del= Document::find($id);
       
       $path =public_path('/documents/' . $del->doc_name);
       $isExists = File::exists($path);
       if($isExists){
       File::delete($path);
       $del->delete();
       }else{
        $del->delete();
       }
       return response()->json(['status' => 200,'message' => "Deleted"]);
    }
}
