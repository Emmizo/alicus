<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Client;
use App\Models\GroupNote;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   /**
     * This function is used to return default dashboard page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author Techaffinity:kwizera
     */
    public function index()
    {
        $users = User::where('status',1)->where('is_delete', 0)->count();
        $comp=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo','companies.phone','companies.email')->where('users.id',\Auth::user()->id)->first();
        $data= $comp;
        $company_users=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->count();
        $clients = Client::where('company_id',$comp->comp_id??'')->count();
        $companies =Company::where('status',1)->count();
        $medications = GroupNote::join('clients','clients.id','group_notes.client_id')->where('client_id',$comp->comp_id??'')->count();

        $chart = Client::join('companies','companies.id','clients.company_id')->select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(clients.created_at) as month_name"))
        ->whereYear('clients.created_at', date('Y'))
        ->groupBy(\DB::raw("Month(clients.created_at)"),'month_name')
        ->where('clients.company_id',$comp->comp_id??'')
        ->pluck('count', 'month_name');
        $invoice=Invoice::join('clients','clients.id','invoices.client_id')
        ->select('clients.id as clientId','clients.client_name','clients.telephone','clients.BOD','clients.created_at as admitted','invoices.start_date','invoices.billing_date','invoices.no_of_day','invoices.price_per_day','invoices.tot','invoices.payment','invoices.due_payment')
        ->where('clients.company_id',$comp->comp_id)
        ->count();

        $labels = $chart->keys();
        $dataChart = $chart->values();

        return view('dashboard',compact('labels', 'dataChart','medications','clients','users','company_users','data','companies','invoice'));
        //
    }
/**
     * This function is used to return default dashboard page with result in chart
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author Techaffinity:kwizera
     */
    public function auditDash(Request $request){
       
    }
}
