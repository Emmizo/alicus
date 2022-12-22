<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\NewUserCreatedEvent;
use App\Events\UserRegisteredEvent;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Company;
use Auth;
use AdminHelper;
use App\Helpers\Helper;
use Spatie\Permission\Models\Role;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * Class ManageUserController
 * namespace App\Http\Controllers
 * @package Illuminate\Http\Request
 * @package App\Models\Users
 * @package App\Models\Chapter
 * @package App\Events\NewUserCreatedEvent
 * @package App\Http\Requests\UserCreateRequest
 * @package App\Http\Requests\UserUpdateRequest
 * @package Auth
 */
class UserController extends Controller
{
    /**
     * This function is used to get manage users index page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author Techaffinity:kwizera
     */
    public function index(Request $request)
    {
       
        $data['role'] = $request->r;
        $data['title'] = "Manage Users";
        $data['addText'] = "Add User";
        $data['roles'] = Role::all();
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        return view('manage-users.index', $data);
    }

    /**
     * This function is used to get manage users index page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author Techaffinity:kwizera
     */
    public function indexAdmin(Request $request)
    {
       
        $data['role'] = $request->r;
        $data['title'] = "Manage Users";
        $data['addText'] = "Add User";
        $data['roles'] = Role::all();
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        return view('admin-user-manager.index', $data);
    }
    /**
     * This function is used to get user list ajax
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function getUserListAjax(Request $request)
    {
        $role = $request->role;
         $userAuth=\Auth::user();
        
         $user = User::join('companies','companies.id','users.company_id')->select('users.*')
            ->where(function ($query) use ($request) {
                return $request->role!="" ?
                    $query->where('users.role', $request->role) : '';
            })
            ->where('users.is_delete',0)->where('users.company_id',$userAuth->company_id)->get();

        return datatables()->of($user)
                        ->addColumn('action', function($user) use($userAuth){
                            $action = '<div class="action-btn"><a class="btn-dark" title="Edit" href="'.route('manage-user-edit', $user->id) .'"><i class="fa fa-edit"></i></a>';

                
                            if($userAuth->role==1 && $userAuth->delete_feature==1)
                            {
                                if($user->role!=1)
                               {
                                // $action = '';
                                // &nbsp;<a class="reset-pass" data-id2="'.$user->first_name.' '.$user->last_name.'" data-id="'.$user->email.'"  href="#" data-bs-toggle="modal" data-bs-target="#reset"><span>Reset</span></a>
                                $action .='&nbsp;<span title="Delete" style="cursor:pointer" class=" delete-user btn-dark" data-id="'.$user->id.'" data-url="'.route('manage-user-delete', $user->id) .'"><i class="fa fa-trash"></i></span></div>';

                              } 
                            }

                            
                            return $action;
                        })
                        
                        ->editColumn('role', function ($user) {
                            $row = str_replace('","', ',', $user->getRoleNames());
                            $row = str_replace('"', ' ', $row);
                            $row = str_replace('[', ' ', $row);
                            $row = str_replace(']', ' ', $row);
                            return $row;
                        })
                        ->editColumn('status', function($user){
                            $status = ($user->status == 1) ? 'checked' : '';
                            return '<input class="toggle-class" type="checkbox" data-id="'.$user->id.'" '.$status.'  data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-url="'.route('manage-user-status') .'">';
                        })
                        ->rawColumns(['action', 'status'])
                        ->make(true);
    }

    public function getUserListAjaxAdmin(Request $request)
    {
        $role = $request->role;
         $userAuth=\Auth::user();
        
         $user = User::leftjoin('companies','companies.id','users.company_id')->select('users.*')
            ->where(function ($query) use ($request) {
                return $request->role!="" ?
                    $query->where('users.role', $request->role) : '';
            })
            ->where('users.is_delete',0)->get();

        return datatables()->of($user)
                        ->addColumn('action', function($user) use($userAuth){
                            $action = '<div class="action-btn"><a class="btn-dark" title="Edit" href="'.route('manage-user-edit', $user->id) .'"><i class="fa fa-edit"></i></a>';

                
                            if($userAuth->role==1 && $userAuth->delete_feature==1)
                            {
                                if($user->role!=1)
                               {
                                // $action = '';
                                // &nbsp;<a class="reset-pass" data-id2="'.$user->first_name.' '.$user->last_name.'" data-id="'.$user->email.'"  href="#" data-bs-toggle="modal" data-bs-target="#reset"><span>Reset</span></a>
                                $action .='&nbsp;<span title="Delete" style="cursor:pointer" class=" delete-user btn-dark" data-id="'.$user->id.'" data-url="'.route('manage-user-delete', $user->id) .'"><i class="fa fa-trash"></i></span></div>';

                              } 
                            }

                            
                            return $action;
                        })
                        
                        ->editColumn('role', function ($user) {
                            $row = str_replace('","', ',', $user->getRoleNames());
                            $row = str_replace('"', ' ', $row);
                            $row = str_replace('[', ' ', $row);
                            $row = str_replace(']', ' ', $row);
                            return $row;
                        })
                        ->editColumn('status', function($user){
                            $status = ($user->status == 1) ? 'checked' : '';
                            return '<input class="toggle-class" type="checkbox" data-id="'.$user->id.'" '.$status.'  data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-url="'.route('manage-user-status') .'">';
                        })
                        ->rawColumns(['action', 'status'])
                        ->make(true);
    }
    /**
     * This function is used to get add manage user page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:Kwizera
     */
    public function add(Request $request)
    {
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id as comp_id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['roles'] = Role::all();
        $data['company'] = Company::where('status',1)->get();
        $data['title'] = "Manage Users - Add";
        $data['brVal'] = "Manage Users";
        return view('manage-users.add', $data);
    }
    /**
     * This function is used to get add manage user page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:Kwizera
     */
    public function addAdmin(Request $request)
    {
       
        $data['roles'] = Role::all();
        $data['company'] = Company::where('status',1)->get();
        $data['title'] = "Manage Users - Add";
        $data['brVal'] = "Manage Users";
        return view('admin-user-manager.add', $data);
    }
    /**
     * This function is used to get edit manage user page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function edit(Request $request)
    {
       
        $id = $request->id;
        if(!$id){
            $request->session()->flash('error', "Something Went Wrong!.");
            return redirect(route('manage-user'))->withInput();
        }
        $data['info'] = $info = User::find($id);
        if(!$info) {
            $request->session()->flash('error', "Unable to find user.");
            return redirect(route('manage-user'))->withInput();
        }
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['company'] = Company::where('status',1)->get();
        $data['roles'] = Role::all();
        $data['title'] = "Manage Users - Edit";
        $data['brVal'] = "Manage Users";
        return view('manage-users.edit', $data);
    }
/**
     * This function is used to get edit manage user page
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function editAdmin(Request $request)
    {
       
        $id = $request->id;
        if(!$id){
            $request->session()->flash('error', "Something Went Wrong!.");
            return redirect(route('manage-user'))->withInput();
        }
        $data['info'] = $info = User::find($id);
        if(!$info) {
            $request->session()->flash('error', "Unable to find user.");
            return redirect(route('manage-user'))->withInput();
        }
        $data['company'] = Company::where('status',1)->get();
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
        $data['roles'] = Role::all();
        $data['title'] = "Manage Users - Edit";
        $data['brVal'] = "Manage Users";
        return view('admin-user-manager.edit', $data);
    }
    /**
     * This function is used to save manage user
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:Kwizera
     */
    public function save(UserCreateRequest $request)
    {

         $password = Str::random(8);

         $encryptpassword = Hash::make($password);
         $info = $request->all();
         $employee_id = Helper::IDGenerator(new User, 'employee_id', 3, 'DQMS');

         $chkEmp = User::where('employee_id',$employee_id)->get();
         $i=1;
         $count = $chkEmp->count()>0?$chkEmp[0]->employee_id.''.$i:$employee_id;

         $info['encryptpassword'] = $encryptpassword;
         $info['password'] = $password;
         $info['first_name'] = $request->first_name;
         $info['last_name'] = $request->last_name;
         $info['phone_number'] = $request->phone_number;
         $info['email'] = $request->email;
         
         $info['company_id'] = $request->company_id;
         $info['employee_id'] = $count;
         $info['created_by'] = \Auth::user()->id;
         $info['role'] = $request->role;
         $info['profile_pic'] = null;

         $checkUser= User::where('email',$info['email'])->first();
            
         if(isset($checkUser))
         {
            $chkEmp = User::where('employee_id',$employee_id)->get();
         $i=1;
            $count = $chkEmp->count()>0?$chkEmp[0]->employee_id.''.$i:$employee_id;
            $info['first_name'] = $request->first_name;
            $info['last_name'] = $request->last_name;
            $info['phone_number'] = $request->phone_number;
            $info['email'] = $request->email;
            
            $info['company_id'] = $request->company_id;
            $info['created_by'] = \Auth::user()->id;
            
            $info['profile_pic'] = null;
            $info['is_delete'] = 0;
            $info['password'] = $password;
            $info['employee_id'] = $count;
            $info['role'] = $request->role;

            if (isset($request->role)) {
                $checkUser->assignRole($request->role);
            }
            if($info['status']) {
               event(new UserRegisteredEvent($info));
            }

            if((new User)->updateExistUser($info)) {
                $request->session()->flash('success', "User Updated Successfully.");
                return redirect(route('manage-user'));
            } else {
                $request->session()->flash('error', "Nothing to update (or) unable to update.");
                return redirect(route('manage-user'))->withInput();
            }
         }

        if($request->profile_pic) {
            $directory = public_path().'/users_pic';
            if (!is_dir($directory)) {
                mkdir($directory);
                chmod($directory, 0777);
            }
            $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('profile_pic')->getClientOriginalName());
            $request->file('profile_pic')->move($directory, $imageName);
            $info['profile_pic'] = 'users_pic/'.$imageName;
        }
        $userId = (new User)->createUser($info);
        if($userId) {
            $user = user::find($userId);
            if (isset($request->role)) {
                $user->assignRole($request->role);
            }
            if($info['status']) {
               event(new UserRegisteredEvent($info));
            }
            $request->session()->flash('success', "New User Created Successfully.");
            return redirect(route('manage-user'));
        } else {
            $request->session()->flash('error', "Nothing to update (or) unable to update.");
            return redirect(route('manage-user'))->withInput();
        }
    }
     /**
     * This function is used to save manage user
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:Kwizera
     */
    public function saveAdmin(UserCreateRequest $request)
    {

         $password = Str::random(8);

         $encryptpassword = Hash::make($password);
         $info = $request->all();
         $employee_id = Helper::IDGenerator(new User, 'employee_id', 3, 'DQMS');

         $chkEmp = User::where('employee_id',$employee_id)->get();
         $i=1;
         $count = $chkEmp->count()>0?$chkEmp[0]->employee_id.''.$i:$employee_id;

         $info['encryptpassword'] = $encryptpassword;
         $info['password'] = $password;
         $info['first_name'] = $request->first_name;
         $info['last_name'] = $request->last_name;
         $info['phone_number'] = $request->phone_number;
         $info['email'] = $request->email;
         
         $info['company_id'] = $request->company_id;
         $info['employee_id'] = $count;
         $info['created_by'] = \Auth::user()->id;
         $info['role'] = $request->role;
         $info['profile_pic'] = null;

         $checkUser= User::where('email',$info['email'])->first();
            
         if(isset($checkUser))
         {
            $chkEmp = User::where('employee_id',$employee_id)->get();
         $i=1;
            $count = $chkEmp->count()>0?$chkEmp[0]->employee_id.''.$i:$employee_id;
            $info['first_name'] = $request->first_name;
            $info['last_name'] = $request->last_name;
            $info['phone_number'] = $request->phone_number;
            $info['email'] = $request->email;
            
            $info['company_id'] = $request->company_id;
            $info['created_by'] = \Auth::user()->id;
            
            $info['profile_pic'] = null;
            $info['is_delete'] = 0;
            $info['password'] = $password;
            $info['employee_id'] = $count;
            $info['role'] = $request->role;

            if (isset($request->role)) {
                $checkUser->assignRole($request->role);
            }
            if($info['status']) {
               event(new UserRegisteredEvent($info));
            }

            if((new User)->updateExistUser($info)) {
                $request->session()->flash('success', "User Updated Successfully.");
                return redirect(route('manage-userAdmin'));
            } else {
                $request->session()->flash('error', "Nothing to update (or) unable to update.");
                return redirect(route('manage-userAdmin'))->withInput();
            }
         }

        if($request->profile_pic) {
            $directory = public_path().'/users_pic';
            if (!is_dir($directory)) {
                mkdir($directory);
                chmod($directory, 0777);
            }
            $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('profile_pic')->getClientOriginalName());
            $request->file('profile_pic')->move($directory, $imageName);
            $info['profile_pic'] = 'users_pic/'.$imageName;
        }
        $userId = (new User)->createUser($info);
        if($userId) {
            $user = user::find($userId);
            if (isset($request->role)) {
                $user->assignRole($request->role);
            }
            if($info['status']) {
               event(new UserRegisteredEvent($info));
            }
            $request->session()->flash('success', "New User Created Successfully.");
            return redirect(route('manage-userAdmin'));
        } else {
            $request->session()->flash('error', "Nothing to update (or) unable to update.");
            return redirect(route('manage-userAdmin'))->withInput();
        }
    }
    /**
     * This function is used to update manage user
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$request->id,
           
        ]);
        if ($validator->fails()) {
                    return redirect(route('manage-user-edit', $request->id))
                    ->withErrors($validator)
                    ->withInput();
        }
        $info['first_name'] = $request->first_name;
        $info['last_name'] = $request->last_name;
        
        $info['email'] = $request->email;
        $info['status'] = $request->status;
        $info['phone_number'] = $request->phone_number;
        $info['company_id'] = $request->company_id;
        $info['is_delete'] = 0;
        $info['role'] = $request->role;
        $info['id'] = $request->id;
        $image_name = $request->hidden_image;
        $info['profile_pic'] = $image_name;
        if($request->profile_pic) {
            $directory = public_path().'/users_pic';
            if (!is_dir($directory)) {
                mkdir($directory);
                chmod($directory, 0777);
            }
            $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('profile_pic')->getClientOriginalName());
            $request->file('profile_pic')->move($directory, $imageName);
            $info['profile_pic'] = 'users_pic/'.$imageName;
        }
        $user = User::find($request->id);
        if (isset($request->role)) {
            $user->syncRoles($request->role);
        } else {
            $user->syncRoles([]);
        }
        $update=(new User)->updateUser($info);

        if($update) {
            $request->session()->flash('success', "User Updated Successfully.");
            return redirect(route('manage-user'));
        } else {
            $request->session()->flash('error', "Nothing to update (or) unable to update.");
            return redirect(route('manage-user'))->withInput();
        }
    }
    /**
     * This function is used to update manage user
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function updateAdmin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$request->id,
           
        ]);
        if ($validator->fails()) {
                    return redirect(route('manage-user-editAdmin', $request->id))
                    ->withErrors($validator)
                    ->withInput();
        }
        $info['first_name'] = $request->first_name;
        $info['last_name'] = $request->last_name;
        
        $info['email'] = $request->email;
        $info['status'] = $request->status;
        $info['phone_number'] = $request->phone_number;
        $info['company_id'] = $request->company_id;
        $info['is_delete'] = 0;
        $info['role'] = $request->role;
        $info['id'] = $request->id;
        $image_name = $request->hidden_image;
        $info['profile_pic'] = $image_name;
        if($request->profile_pic) {
            $directory = public_path().'/users_pic';
            if (!is_dir($directory)) {
                mkdir($directory);
                chmod($directory, 0777);
            }
            $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('profile_pic')->getClientOriginalName());
            $request->file('profile_pic')->move($directory, $imageName);
            $info['profile_pic'] = 'users_pic/'.$imageName;
        }
        $user = User::find($request->id);
        if (isset($request->role)) {
            $user->syncRoles($request->role);
        } else {
            $user->syncRoles([]);
        }
        $update=(new User)->updateUser($info);

        if($update) {
            $request->session()->flash('success', "User Updated Successfully.");
            return redirect(route('manage-userAdmin'));
        } else {
            $request->session()->flash('error', "Nothing to update (or) unable to update.");
            return redirect(route('manage-userAdmin'))->withInput();
        }
    }

    /**
     * This function is used to update manage user
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function updateProfile2(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$request->id,
           
        ]);
        if ($validator->fails()) {
                    return redirect(route('manage-user-edit', $request->id))
                    ->withErrors($validator)
                    ->withInput();
        }
        $info['first_name'] = $request->first_name;
        $info['last_name'] = $request->last_name;
        $info['name'] = "-";
        $info['email'] = $request->email;
        $info['status'] = $request->status;
        $info['phone_number'] = $request->phone_number;
        $info['is_delete'] = 0;
        $info['role'] = $request->role;
        $info['id'] = $request->id;
        $image_name = $request->hidden_image;
        $info['profile_pic'] = $image_name;
        if($request->profile_pic) {
            $directory = public_path().'/users_pic';
            if (!is_dir($directory)) {
                mkdir($directory);
                chmod($directory, 0777);
            }
            $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('profile_pic')->getClientOriginalName());
            $request->file('profile_pic')->move($directory, $imageName);
            $info['profile_pic'] = 'users_pic/'.$imageName;
        }
        $user = User::find($request->id);
        if (isset($request->role)) {
            $user->syncRoles($request->role);
        } else {
            $user->syncRoles([]);
        }
        $update=(new User)->updateUser($info);

        if($update) {
            $request->session()->flash('success', "User Updated Successfully.");
            return redirect(route('manage-user'));
        } else {
            $request->session()->flash('error', "Nothing to update (or) unable to update.");
            return redirect(route('manage-user'))->withInput();
        }
    }
    /**
     * This function is used to delete manage user
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        if($id)
            return (new User)->deleteUser($id);
        else
            return false;
    }
    /**
     * This function is used to delete manage user
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function deleteAdmin(Request $request)
    {
        $id = $request->id;
        if($id)
            return (new User)->deleteUser($id);
        else
            return false;
    }
     /**
     * This function is used to Active Status update
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if($id)
            return (new User)->updateStatus($id,$status);
        else
            return false;
    }
     /**
     * This function is used to Active Status update
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function statusAdmin(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if($id)
            return (new User)->updateStatus($id,$status);
        else
            return false;
    }
    /**
     * This function is used to Active Delete Image
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:kwizera
     */
    public function deleteImage(Request $request)
    {
        $id = $request->id;
        if($id)
            return (new User)->deleteUserImages($id);
        else
            return false;
    }
     /**
     * This function is used to get edit profile
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:Kwizera
     */
    public function editProfile(Request $request)
    {
        $data['data']=User::join('companies','companies.id','users.company_id')->select('users.*','companies.id','companies.company_name','companies.company_logo')->where('users.id',\Auth::user()->id)->first();
    	$user = Auth::user();
    	$id   = $user->id;
        $data['info'] = $info = User::find($id);
        if(!$info) {
            $request->session()->flash('error', "Unable to find user.");
            return redirect(route('manage-edit-profile'))->withInput();
        }
        $data['roles'] = Role::all();
        $data['title'] = "Profile - Edit";
        $data['brVal'] = "Edit Profile";
        return view('manage-users.edit_profile', $data);
    }
    /**
     * This function is used to profile update
     *
     * @param SportsUpdateRequest $request
     * @return \Illuminate\View\View|\Illuminate\Routing\Redirector
     * @author alicus:Kwizera
     */
	public function updateProfile(Request $request) {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$request->id,
           
        ]);
        if ($validator->fails()) {
                    return redirect(route('manage-user-edit', $request->id))
                    ->withErrors($validator)
                    ->withInput();
        }
        $info['first_name'] = $request->first_name;
        $info['last_name'] = $request->last_name;
        $info['name'] = "-";
        $info['email'] = $request->email;
        $info['status'] = $request->status;
        $info['phone_number'] = $request->phone_number;
        $info['plants_mst_id'] = $request->plant_name;
         $info['departments_mst_id'] = $request->department_name;
         $info['is_plant_head'] = $request->plant_head;
         $info['is_platform_user'] = $request->is_platform_user;
         $info['department_head'] = $request->department_head;
         $info['management_rep'] = $request->is_management_rep;
         $info['is_customer_rep'] = $request->customer_complaints_rep;
        $info['delete_feature'] = $request->delete_feature;
        $info['is_delete'] = 0;
        $info['status']=1;
        $info['role'] = $request->role;
        $info['id'] = $request->id;
        $image_name = $request->hidden_image;
        $info['profile_pic'] = $image_name;
        if($request->profile_pic) {
            $directory = public_path().'/users_pic';
            if (!is_dir($directory)) {
                mkdir($directory);
                chmod($directory, 0777);
            }
            $imageName = strtotime(date('Y-m-d H:i:s')) . '-' . str_replace(' ', '-', $request->file('profile_pic')->getClientOriginalName());
            $request->file('profile_pic')->move($directory, $imageName);
            $info['profile_pic'] = 'users_pic/'.$imageName;
        }
        $user = User::find($request->id);
        if (isset($request->role)) {
            $user->syncRoles($request->role);
        } else {
            $user->syncRoles([]);
        }
        $update=(new User)->updateUser($info);

        if($update) {
            $request->session()->flash('success', "Profile Updated Successfully.");
            return redirect(route('manage-edit-profile'));
        } else {
            $request->session()->flash('error', "Nothing to update (or) unable to update.");
            return redirect(route('manage-edit-profile'))->withInput();
     }}
     public function fileImportExport()
    {
       return view('file-import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
     {
         Excel::import(new UsersImport,request()->file('file'));
                
         return redirect()->back();
     }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }  
}