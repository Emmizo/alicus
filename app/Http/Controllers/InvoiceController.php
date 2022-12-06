<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invoice;
class InvoiceController extends Controller
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
        $data['birth']= $request->birth;
        $createDate = new \DateTime($request->date);
        $strip = $createDate->format('Y-m-d');
        $data['started']= $strip;
        $data['data']=$comp;
        $data['name']=$request->name;
        $data['clientId']= $request->id;
        $data['invoice']=Invoice::where('client_id',$request->id)->first();
        $data['invoices']=Invoice::where('client_id',$request->id)->count();
        return view('manage-clients.invoice',$data);
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
            'client_id'=>'required',
            'start_date'=>'required',
            'billing_date'=>'required',
            'price_per_day'=>'required',
            'no_of_day'=>'required',
            'tot'=>'required',
            'payment'=>'required',
            'due_payment'=>'required',
            // 'level_participation'=>'required',
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
        $add=Invoice::create([
            'client_id'=> $request->client_id,
            'start_date'=> $request->start_date,
            'billing_date'=> $request->billing_date,
            'price_per_day'=> $request->price_per_day,
            'no_of_day'=> $request->no_of_day,
            'staff_id'=>\Auth::user()->id,
            'tot'=> $request->tot,
            'payment'=>$request->payment,
            'due_payment'=>$request->due_payment,
        ]);
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
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
           
            'start_date'=>'required',
            'billing_date'=>'required',
            'price_per_day'=>'required',
            'no_of_day'=>'required',
            'tot'=>'required',
            'payment'=>'required',
            'due_payment'=>'required',
            // 'level_participation'=>'required',
            ]);
            if ($validator->fails()) {
                $data1 ['status'] = 401;
                $data1 ['data'] = 'Validation Error.';
                $data1 ['message'] =$validator->errors()->first();
                return response()->json($data1); 
            }
        $add=Invoice::where('id',$request->invoice_id)->update([
            'start_date'=> $request->start_date,
            'billing_date'=> $request->billing_date,
            'price_per_day'=> $request->price_per_day,
            'no_of_day'=> $request->no_of_day,
            // 'staff_id'=>\Auth::user()->id,
            'tot'=> $request->tot,
            'payment'=>$request->payment,
            'due_payment'=>$request->due_payment,
        ]);
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
