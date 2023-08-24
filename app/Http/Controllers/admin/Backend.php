<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\BackendModel;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Hash;


class Backend extends Controller
{
    //
    function index(Request $request){


        $model = new BackendModel();
        $AdminModel = new CommonModel();

        $data['page_title'] = 'Dashboard';
        $data['admin'] = $AdminModel->all_fetch('admin',null);
        return view('admin.dashboard',$data);
    }



public function get_map(){
  if($this->input->post('cname')=='India'){
    $data['country'] = $this->AdminModel->get_country($this->input->post('cname'));
    $data['map'] = $this->AdminModel->get_world_map($data['country'][0]->id);
    $data['totaldd'] = count($data['map']);
    $data['price'] = $this->AdminModel->get_total_price();
    echo json_encode($data);
    }
}




    public function profile(Request $request)
    {
      $model = new BackendModel();

      $data['page_title']= 'Profile';
      $data['detail'] = $this->AdminModel->fs('admin',array('id'=>session()->get('adminID')));
      $data['form_action'] ='admin/profile';

     if($request->isMethod('post')){

     $rules['username'] = ['username'=>'required'];
     $rules['email'] =  ['email'=>'required'];
     $rules['firstname'] = ['firstname'=>'required'];

     if(!empty($request->input('password'))){
        $rules['password'] = ['password'=>'min:6'];
        $rules['confirm'] = ['confirm'=>'same:password'];
     }

        $request->validate($rules);

        $save = array();
        $save['username'] = $request->input('username');
        $save['firstname'] = $request->input('firstname');
        $save['lastname'] = $request->input('lastname');
        $save['email'] = $request->input('email');
        $save['modify_date'] = date('Y-m-d H:i:s');

        if (!empty($request->input('password'))) {

        $save['password'] = Hash::make($request->input('password'));
        }
         if (!empty($request->photo)) {
          $imageName = time().'.'.$request->photo->extension();
          $request->photo->move(public_path('images'), $imageName);
          // $request->image->move(public_path('images'), $imageName);
           $save['photo'] = 'public/images/'.$imageName;
        }


        $result = $this->AdminModel->updateData('admin',$save,array('id'=>session()->get('adminID')));
        if ($result) {
          session()->flash('success','Record update successfully');
        return   redirect('admin/profile');
        }else{
            session()->flash('error','Record update unsuccessful!');
          return  redirect('admin/profile');
        }

      }
      return view('admin.profile',$data);
  }



    function permission_denied(){
         $data['page_title']= 'Permision Denied';
         return view('admin/permission_denied',$data);
    }






    function logout(Request $request){

        session()->forget('adminID');
        session()->forget('adminLogin');
        return redirect('admin_console');
     }


}
