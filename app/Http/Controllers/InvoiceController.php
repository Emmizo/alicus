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
        $data['title'] = "Manage Invoice";
        // $data['birth']= $request->birth;
        
        
        $data['data']=$comp;
        $data['name']=$request->name;
        // $data['clientId']= $request->id;
        // $data['invoicess']=Invoice::where('client_id',$request->id)->orderBy('created_at','DESC')->get();
        $invoice=Invoice::rightjoin('clients','clients.id','invoices.client_id')
        ->select('clients.client_name','clients.id as clientId','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.*')
        ->where('clients.id',$request->id)->get();
        $data['invoicess']= $invoice;
        $data['clientId']=$request->id;
        $createDate = new \DateTime($invoice[0]->created_at);
        $strip = $createDate->format('Y-m-d');
        $data['started']= $strip;
        $data['invoices']=Invoice::where('client_id',$request->id)->count();
        return view('manage-invoice.index',$data);
        //
    }
    public function indexDis(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Invoice";
        
        $data['data']=$comp;
        $data['name']=$request->name;
        $invoice=Invoice::rightjoin('clients','clients.id','invoices.client_id')
        ->select('clients.client_name','clients.id as clientId','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.*')
        ->where('clients.id',$request->id)->get();
        $data['invoicess']= $invoice;
        // return $invoice;
        $data['clientId']=$request->id;
        $createDate = new \DateTime($invoice[0]->created_at);
        $strip = $createDate->format('Y-m-d');
        $data['started']= $strip;
        $data['invoices']=Invoice::where('client_id',$request->id)->count();
        return view('manage-archive.index-invoice',$data);
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
    public function show(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['data']=$comp;
        $data['invoicess']=Invoice::join('clients','clients.id','invoices.client_id')->where('client_id',$request->id)->first();
        return view('manage-invoice.edit',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id){
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Invoice";
        $data['data']=$comp;
        $data['invoices']=Invoice::join('clients','clients.id','invoices.client_id')
        ->select('clients.client_name','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.*')
        ->where('invoices.id',$id)->where('invoices.discharged',0)->get();
        
        return view('manage-invoice.invoice',$data);
    
    }
    public function viewDis($id){
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Invoice";
        $data['data']=$comp;
        $data['invoices']=Invoice::join('clients','clients.id','invoices.client_id')
        ->select('clients.client_name','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.*')
        ->where('invoices.id',$id)->where('invoices.discharged',1)->get();
        
        return view('manage-archive.invoice',$data);
    
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
        $data['title'] = "Manage Invoice";
        $data['data']=$comp;
        $invoice=Invoice::join('clients','clients.id','invoices.client_id')
        ->select('clients.client_name','clients.id as clientId','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.*')
        ->where('invoices.id',$id)->get();
        $data['invoices']= $invoice;
        $createDate = new \DateTime($invoice[0]->created_at);
        $strip = $createDate->format('Y-m-d');
        $data['started']= $strip;
        return view('manage-invoice.edit-invoice',$data);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all($id)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Invoice";
        $data['data']=$comp;
        $data['invoices']=Invoice::join('clients','clients.id','invoices.client_id')
        ->select('clients.client_name','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.*')
        ->where('invoices.client_id',$id)->get();
        $data['id']=$id;
        return view('manage-invoice.all',$data);
    }
    public function allDis($id)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Invoice";
        $data['data']=$comp;
        $data['invoices']=Invoice::join('clients','clients.id','invoices.client_id')
        ->select('clients.client_name','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.*')
        ->where('invoices.client_id',$id)->get();
        $data['id']=$id;
        return view('manage-archive.all-invoice',$data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all_invoices(Request $request){
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data['title'] = "Manage Invoice";
        $data['data']=$comp;
        $from=$request->from;
        $to=$request->to;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['insurancess'] = \DB::table('insurances')->where('insurances.company_id',$comp->comp_id)->get();
        $data['insurances'] = \DB::table('insurances')->where('insurances.company_id',$comp->comp_id)->where('id',$request->search)->get();
        $data['paid']=Invoice::join('clients','clients.id','invoices.client_id')->where('clients.company_id',$comp->comp_id)->where('clients.insurance_ID', 'like', '%' . request('search') . '%')
        ->when(isset($to), function($q) use($from, $to){
            $q->whereBetween('invoices.created_at', [$from, $to]);
        })
        ->sum('invoices.payment');
        $invoice=Invoice::join('clients','clients.id','invoices.client_id')
        ->select('clients.id as clientId','clients.client_name','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.start_date','invoices.billing_date','invoices.no_of_day','invoices.price_per_day','invoices.tot','invoices.payment','invoices.due_payment',\DB::raw("SUM(invoices.payment) as total_paid"))
        
        ->groupBy('clients.id','clients.client_name','clients.telephone','clients.BOD','clients.created_at','invoices.start_date','invoices.billing_date','invoices.no_of_day','invoices.price_per_day','invoices.tot','invoices.payment','invoices.due_payment')
        ->where('clients.company_id',$comp->comp_id)->where('clients.insurance_ID', 'like', '%' . request('search') . '%')
        ->when(isset($to), function($q) use($from, $to){
            $q->whereBetween('invoices.created_at', [$from, $to]);
        })
        // ->whereBetween('invoices.created_at', 'like', '%' . [$request->from, $request->to])
        ->get();
        $invoiceUnique= $invoice->unique('clientId');
        $invoiceUnique->values()->all();
        $data['invoices']=$invoiceUnique;
        return view('manage-invoice.all-invoice',$data);
    }
}
