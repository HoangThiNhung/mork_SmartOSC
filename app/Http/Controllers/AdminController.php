<?php namespace App\Http\Controllers ;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Redirect;
use Request;
use Hash;
use App\User;
use App\Role;
use PHPMailer;
use Auth;
use Route;

class AdminController extends Controller {
	public function getLogin()
	{
		return view('auth.login');
	}

    public function activeaccount($token,$id){
        $result = User::checkactive($token,$id);

        switch ($result) {
            case '0':
                return redirect('auth/login')->withErrors(['error' => 'Link die']);
                break;
            case '1':
                return redirect('auth/login')->withErrors(['error' => 'Your account has been activated']);
                break;
            case '2':
                return redirect('auth/login')->withErrors(['error' => 'Active success']);
                break;
            
            default:
                return redirect('auth/login')->withErrors(['error' => 'Link die']);
                break;
        }

    }

	public function postLogin(LoginRequest $request)
	{
		if (Auth::attempt(array('email' => Request::get('email'), 'password' => Request::get('password')  )))
		{ 
            if(Auth::user()->role_id == 1){

                    if(Auth::user()->status == 'active'){
                    return Redirect::to('admin/');
                }else{

                    Auth::logout();
                    return Redirect::to('auth/login')->withErrors(['error' => 'Account not Active. Please check mail active account']);
                }
                return Redirect::to('admin/');
            }elseif (Auth::user()->role_id == 0) {

                    if(Auth::user()->status == 'active'){
                        return Redirect::to('/');
                }else{

                    Auth::logout();
                    return Redirect::to('auth/login')->withErrors(['error' => 'Account not Active. Please check mail active account']);
                }
            }else{
                Auth::logout();
                return Redirect::to('auth/login')->withErrors(['error' => 'Account not Admin']);
            }
     		
		}else{
			return Redirect::to('auth/login')->withErrors(['error' => 'Login Faill']);
		}
	}


    public function getLogout(){
        Auth::logout();
        return redirect('/')->withErrors(['error' => 'Logout done']);
    }



	public function register()
	{
		return view('auth.register');
	}

	public function postRegister(Request $request)
    {
        $user = [	"remember_token"	=>	Request::get('_token'),
        			"name"				=> 	Request::get('name'),
        			"password"			=> 	hash::make(Request::get('password')),
        			"email"				=>	Request::get('email'),
        			"role_id"			=> 	1,
        		];
        User::Create($user);
    }
    
    public function getIndex()
    {
    	//return view('backend.pages.home');
        return view('backend.pages.index');
    }

    public function getAddRole(){
        return view('backend.pages.role.addRole2');
    }

    public function postAddRole(){
        if(Request::get('role') != null){
            $obj = new Role;
            $obj->name = trim(Request::get('role'));
            $obj->save();
        }
        //return Redirect::to('admin/permission')->withErrors(['error' => 'Add role success !']);
        return "Add role success!";
    }

    public function getUpdateRole(){
        $listRole= new Role;
        $role = $listRole->all();
        return view('backend.pages.role.updateRole2', compact('role'));
    }

     public function postUpdateRole(){
        if(is_numeric(Request::get('role'))){
            $obj = new role;
            $obj->where('id','=',Request::get('role'))->update(['name'=>trim(Request::get('newRole'))]);
        }
        //return Redirect::to('admin/permission')->withErrors(['error' => 'Update role success !']);
        return "update role success!";
    }

    public function getDeleteRole(){
        $listRole = role::all();
        return view('backend.pages.role.deleteRole2',compact('listRole'));
    }

    public function postDeleteRole(Request $request){
        role::destroy(Request::get('delete'));
        User::where('role_id', '=', Request::get('delete'))->update(['role_id' => 0]);
        //return Redirect::to('admin/permission')->withErrors(['error' => 'Delete role success !']);
        return "Delete role success!";
    }
}
