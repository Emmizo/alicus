<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'login','register','forgot_password']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try{
            
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
        
            if ($validator->fails()) {
                        return redirect(route('admin-login'))
                        ->withErrors($validator)
                        ->withInput();
            }
       
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                if(Auth::user()->status == 1 && Auth::user()->is_delete == 0){
                    
                    return redirect()->intended('dashboard')
                    ->withSuccess('Signed in');
                }{
                    $request->session()->flash('error', "Your account blocked,Please contact your admin");
                return redirect(route('admin-login'));
                }
               
            }else{
                $request->session()->flash('error', "Login details are not valid");
                return redirect(route('admin-login'));
            }
          
        }
        catch(Exception $e)
        {

        }
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
