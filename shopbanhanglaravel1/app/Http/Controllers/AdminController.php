<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Login;
use Laravel\Socialite\Facades\Socialite;
use App\Social;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Random\Engine\Secure;

session_start();

class AdminController extends Controller
{   
    public function login_google(){
    return Socialite::driver('google')->redirect();
    }
public function callback_google(){
    $users = Socialite::driver('google')->user();
    $authUser = $this->findOrCreateUser($users,'google');
    $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
    return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công !');
}
public function findOrCreateUser($users,$provider){
    $authUser = Social::where('provider_user_id',$users->id)->first();    
    if($authUser){
        return $authUser;
    }
        $duc = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);
        $orang = Login::where('admin_email',$provider->getEmail())->first();
        if(!$orang){
            $orang = Login::create([
                'admin_name' => $provider->getName(),
                'admin_email' => $provider->getEmail(),
                'admin_password' => '',
                'admin_phone' => '',
            ]);
        }
        $duc->login()->associate($orang);
        $duc->save();
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công ! ');
    

} 
      
    public function login_facebook(){
        return SociaLite::driver('facebook')->redirect();
    }
    public function callback_facebook(){
        $provider = SociaLite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công !');
        }else{
            $duc = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);
            $orang = Login::where('admin_email',$provider->getEmail())->first();
            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
            $duc->login()->associate($orang);
            $duc->save();
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công ! ');
        }

    }
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        $login_count = $login->count();
        if($login_count){
            Session::put('admin_name',$login->admin_name);
            Session::put('admin_id',$login->id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoạc tài khoản không chính xác! Vui lòng nhập lại!');
            return Redirect::to('/admin');
        }



        // $admin_email = $request->admin_email;
        // $admin_password = md5($request->admin_password);
        // $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        // if($result){
        //     Session::put('admin_name',$result->admin_name);
        //     Session::put('admin_id',$result->id);
        //     return  Redirect::to('/dashboard');
        // }else{
        //     Session::put('message','Mật khẩu hoặc tài khoản không chính xác. Vui lòng nhập lại !');
        //     return  Redirect::to('/admin');

        // }
}
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return  Redirect::to('/admin');
}
}