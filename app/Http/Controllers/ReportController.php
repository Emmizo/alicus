<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['data']= $comp;
        $data['daily']= Client::join('companies','companies.id','clients.company_id')->where('clients.created_by',\Auth::user()->id)->
        whereDay('clients.created_at', Carbon::now()->day)->count();
        $data['monthly'] =Client::join('companies','companies.id','clients.company_id')->where('clients.created_by',\Auth::user()->id)->
        whereMonth('clients.created_at', Carbon::now()->month)->count();
        $data['weekly']= Client::join('companies','companies.id','clients.company_id')->where('clients.created_by',\Auth::user()->id)->whereBetween('clients.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
        
        return view('manage-daily-reports.index',$data);
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
    public function clientDaily(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['data']= $comp;
        return view('manage-daily-reports.client-daily-report',$data);
        
        //
    }
    public function dailyAjax()
    {
        $client = Client::join('companies','companies.id','clients.company_id')->where('clients.created_by',\Auth::user()->id)->
         whereDay('clients.created_at', Carbon::now()->day)->get();
        return datatables()->of($client)
        ->addColumn('status', function($client){

            $status= $client->paid==0?"Pending":"Paid";
            return '<div>'.$status.'</div>';

        })
        ->rawColumns(['status'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientMonthly(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['data']= $comp;
        return view('manage-daily-reports.client-monthly-report',$data);
        
        //
    }
    public function monthlyAjax()
    {
        $client = Client::join('companies','companies.id','clients.company_id')->where('clients.created_by',\Auth::user()->id)->
         whereMonth('clients.created_at', Carbon::now()->month)->get();
        return datatables()->of($client)
        ->addColumn('status', function($client){
                $status= $client->paid==0?"Pending":"Paid";
            return '<div>'.$status.'</div>';

        })
        ->rawColumns(['status'])
        ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientWeekly(Request $request)
    {
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['data']= $comp;
        return view('manage-daily-reports.client-weekly-report',$data);
        
        //
    }
    public function weeklyAjax()
    {
        $client = Client::join('companies','companies.id','clients.company_id')->where('created_by',\Auth::user()->id)->whereBetween('clients.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get();
        return datatables()->of($client)
        ->addColumn('status', function($client){
            $status= $client->paid==0?"Pending":"Paid";
            return '<div>'.$status.'</div>';

        })
        ->rawColumns(['status'])
        ->make(true);
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
