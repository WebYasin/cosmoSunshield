<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\session;
use Illuminate\Routing\Redirector;
use App\Models\BackendModel;
use App\Models\CommonModel;
use App\Models\SettingModel;

class Store extends Controller
{

        public function __construct()
        {
            $AdminModel = new CommonModel();
            $this->AdminModel = $AdminModel;
        }


     function store(Request $requestq){


       $data['page_title'] = 'Web Setting';

       $setting = $this->AdminModel->all_fetch('setting',array('code'=>'config'));
       foreach ($setting as $key => $value) {
         $all_setting[$value->key] = $value->value;
       }

       $data['config'] = $all_setting;

        return view('admin.setting.store',$data);


      }




    function add_store(Request $request , $id=false)
    {

       $model = new SettingModel();
       $all_setting = array();
       $data['country_list'] = $this->AdminModel->all_fetch('country',null);
       $data['state_list'] = $this->AdminModel->all_fetch('state',null);


       $data['page_title'] = ' Edit Store';
       $data['form_action'] ='admin/add_store';
       $setting = $this->AdminModel->all_fetch('setting',array('code'=>'config'));
       foreach ($setting as $key => $value) {
         $all_setting[$value->key] = $value->value;
       }

       $data['config'] = $all_setting;


      if($request->isMethod('post')) {

       $rules = [
           'config_name'=>'required'
       ];

       $request->validate($rules);

       $save= array();
       $save = $request->input();
       // $save = $request->all();


        if (!empty($request->config_logo)) {
            $imageName = time().'.'.$request->config_logo->extension();
           $request->config_logo->move('uploads/images/', $imageName);
           $save['config_logo'] = 'uploads/images/'.$imageName;
          }else{
            $save['config_logo'] = $request->input('old_config_logo');
            unset($save['old_config_logo']);
          }
          if (!empty($request->checkout_image)) {
            $imageName = time().'.'.$request->checkout_image->extension();
           $request->checkout_image->move('uploads/images/', $imageName);
           $save['checkout_image'] = 'uploads/images/'.$imageName;
          }else{
            $save['checkout_image'] = $request->input('old_checkout_image');
            unset($save['old_checkout_image']);
          }


          if (!empty($request->config_icon)) {
           $config_icon = time().'.'.$request->config_icon->extension();
           $request->config_icon->move('uploads/images/', $config_icon);
           $save['config_icon'] = 'uploads/images/'.$config_icon;
          }else{
            $save['config_icon'] = $request->input('old_config_icon');
            unset($save['old_config_icon']);
          }



         if (!empty($request->config_favicon)) {
          $config_favicon = time().'.'.$request->config_favicon->extension();
          $request->config_favicon->move('uploads/images/', $config_favicon);
           $save['config_favicon'] = 'uploads/images/'.$config_favicon;
          }else{
            $save['config_favicon'] = $request->input('old_config_favicon');
            unset($save['old_config_favicon']);
          }


          unset($save['_token']);
          $result = $model->save_setting($save);

          if ($result) {
           session()->flash('success','Record Update successfully');
           return  redirect()->to('admin/store');
           }else{
           session()->flash('error','Record not insert');
           return redirect()->to('admin/add_store');
           }


       }


      return  view('admin.setting.add_store',$data);
   }



    //
}
