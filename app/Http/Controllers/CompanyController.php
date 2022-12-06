<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = "Manage Company";
        $data['addText'] = "Add User";
        return view('manage-company.index',$data);
    }
/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(Request $request)
    {
        //
        if ($request->ajax()) {
			$company=Company::select('id','first_name','last_name','company_name','company_logo','email','phone','created_at','updated_at','status');
			return datatables()->of($company)
				->addColumn('action', function ($company) {

					$updateBtn='<a href="' . route('company-edit', ['id' => $company->id]) . '" class="text-dark" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp;';

					return (\Auth::user()->role==1 )?$updateBtn.'<span title="Delete" class="delete-role text-danger pointer" data-role-id="' . $company->id . '"><i class="fa fa-trash" aria-hidden="true"></i></span>':$updateBtn;
				})
				->editColumn('status', function ($company){
					$status = ($company->status == 1) ? 'checked' : '';
					return '<input class="toggle-class" type="checkbox" data-id="'.$company->id.'" '.$status.'  data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-url="'.route('role-status') .'">';
				})
				->addColumn('fullname',function ($company){
                    return $company->first_name.' '.$company->last_name;
                })
				->rawColumns(['action', 'status','fullname'])
				->make(true);
		}
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['title'] = "Add new company";
        
        return view('manage-company.add',$data);
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
        //
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required|unique:companies,company_name',
            'phone' => 'required',
            // 'company_logo' => 'required|mimes:jpeg,png,jpg|max:5120',
        ]);
        if ($validator->fails()) {
            return redirect(route('company-add'))
            ->withErrors($validator)
            ->withInput();
}
       if($request->file('company_logo')){
        $directory = public_path().'/companies_logo';
               if (!is_dir($directory)) {
                   mkdir($directory);
                   chmod($directory, 0777);
               }
               $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('company_logo')->getClientOriginalName());
               $request->file('company_logo')->move($directory, $imageName);
               $imageName = 'companies_logo/'.$imageName;
               $comp =Company::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'company_logo'=> $imageName,
               ]);
            }else{
                $comp =Company::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'company_name' => $request->company_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    // 'company_logo'=> $imageName,
                   ]);
            }
               
                // new Company();
               
            //    $comp->save();
               $request->session()
                    ->flash('success', "Company is created successfully");
                    return redirect(route('company-list'));
                    // return response()->json(['status' => 201,'message' => "new  added"]);
        
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
     * This function is used to return update form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author Techaffinity:Kwizera
     */
    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $plant = Company::find($id);
        $plant->status=$status;
        $plant->save();
        return response()
                    ->json(['status' => 200, 'message' => "Status changed"]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit company";
        $data['company'] = Company::where('id',$id)->first();
        return view('manage-company.edit',$data);
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
        //
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required|unique:companies,company_name,'.$request->company_id,
            'phone' => 'required',
            
        ]);
        if ($validator->fails()) {
            $data1 ['status'] = 401;
            $data1 ['data'] = 'Validation Error.';
            $data1 ['message'] =$validator->errors()->first();
            return response()->json($data1); 
        }
        // $directory = public_path().'/companies_logo';
        //        if (!is_dir($directory)) {
        //            mkdir($directory);
        //            chmod($directory, 0777);
        //        }
              
            //    $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('company_logo')->getClientOriginalName());
            //    $request->file('company_logo')->move($directory, $imageName);
            //    $imageName = 'companies_logo/'.$imageName;
               
               $comp =Company::find($request->company_id);
               
                $comp->first_name = $request->first_name;
                $comp->last_name = $request->last_name;
                $comp->company_name = $request->company_name;
                $comp->phone = $request->phone;
                $comp->email = $request->email;
                // $comp->company_logo= $imageName;
                $comp->save();
               $request->session()
                    ->flash('success', "Company is created successfully");
                    return response()->json(['status' => 201,'message' => "new  added"]);
                    // return redirect(route('company-list'));
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
