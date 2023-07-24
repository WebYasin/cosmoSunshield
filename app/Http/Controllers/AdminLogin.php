<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\session;
use Illuminate\Http\Request;
use App\Models\BackendModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLogin extends Controller
{

    public function __construct()
    {
        // if(session()->has('adminLogin')){
        //     return redirect('admin/dashboard');
        // }
        // $this->middleware('adminAuth');
        // $this->middleware('log')->only('index');
        // $this->middleware('subscribed')->except('store');
    }

   function index(){

    if(session()->has('adminLogin')){
        return redirect('admin/dashboard');
    }
       $data['page_title'] = 'Admin Login';
       return view('admin.login',$data);
   }


  function verify(Request $request){
    $array = array();
    // $dd = $request->all();
    $username =  $request->input('username');
    $password =  $request->input('password');
    // echo Hash::make($password); exit;

    // check username
    $check_username = DB::table('admin')->where('username',$username)->first();

    if (empty($check_username)) {
    $array['status'] = 0;
    $array['msg']='Invalid username';
    echo json_encode($array); die();
    }

    // check password
    if(!Hash::check($password,$check_username->password)){
    $array['status'] = 0;
    $array['msg']='Password do not match';
    echo json_encode($array); die();
    }

    // account status
    $user = DB::table('admin')->where(array('username'=>$username,'status'=>1))->first();
    if (empty($user)) {
        $array['status'] = 0;
        $array['msg']='Your account is deactived please contact web adminstrator';
        echo json_encode($array); die();
    }else{
        session(['adminLogin' => 1]);
        session(['adminID' => $user->id]);
        $array['status'] =1;
        $array['msg'] ='Login Success';
        $array['link'] = 'admin/dashboard';
        echo json_encode($array);

    }


  }



}
