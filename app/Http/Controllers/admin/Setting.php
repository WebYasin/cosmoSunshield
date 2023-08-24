<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\session;
use Illuminate\Routing\Redirector;
use App\Models\BackendModel;
use App\Models\SettingModel;
use App\Models\CommonModel;
use App\Models\FrontMenuModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class Setting extends Controller
{
    //
    public function __construct(){

        $this->AdminModel = new CommonModel();

    }


function user_group(Request $request)
 {

    if(empty($this->AdminModel->permission(request()->segment(2)))) {
     return redirect('admin/permission-denied');
    }

     $data['detail'] = $this->AdminModel->all_fetch('admin_group',null);
     $data['page_title']  ='User Groups';
     return  view('admin.setting.user_group',$data);

 }


 function add_user_group(Request $request, $id=false)
 {

   $data['menu_list'] = $this->AdminModel->all_fetch('menu',array('parent_id'=>0,'status'=>1),'sort_order','asc');

  if(!empty($id)) {

    $data['page_title'] = ' Edit User Group';
    $data['form_action'] ='admin/add_user_group/'.$id;
    $row = $this->AdminModel->fs('admin_group',array('id'=>$id));
    $data['menu_id'] = json_decode($row->permission);
    $data['name'] =  $row->name;
    $this->form_user_id = $id;
    }else{

     $data['page_title'] = ' Add User Group';
     $data['form_action'] ='admin/add_user_group';
     $data['name'] =  '';
     $data['menu_id'] = '';

    }



  if($request->isMethod('post')){

    $validatedData = $request->validate([
        'name' => 'required',
     ], [
        'name.required' => 'Name is required'
     ]);


      $save= array();
      $save['name'] =     $request->input('name');
      $save['permission'] =     json_encode($request->input('permission'));

      if ($id) {

          $save['modify_date'] =  date('Y-m-d');
          $result=  $this->AdminModel->updateData('admin_group',$save,array('id'=>$id));
          if ($result) {
          session()->flash('success','Record Update successfully');
         return redirect('admin/user_group');
          }else{
          session()->flash('error','Record not update');
         return redirect('admin/add_user_group/'.$id);
          }
      }else{
         $save['create_date'] =  date('Y-m-d');
         $save['modify_date'] =  date('Y-m-d');
         $result=  $this->AdminModel->insertData('admin_group',$save);
          if ($result) {

          session()->flash('success','Record insert successfully');
          return redirect('admin/user_group');
          }else{
          session()->flash('error','Record not insert');
         return redirect('admin/add_user_group');
          }

      }

  }
return view('admin.setting.add_user_group',$data);
}



function delete_user_group(Request $request)
{

     if ($request->isMethod('post')) {
        $ids = $request->input('selected');
        foreach ($ids as $key => $value) {
         if ($value != session('adminID')) {
          $result =  $this->AdminModel->deleteData('admin_group',array('id'=>$value));
         }
      }
       if ($result) {
          return back()->with('success','Record Delete successfully');
        }else{
         return back()->with('error','User can not be deleted ');
        }
    }
}


/////////////////


function menu(Request $request)
 {

      if(empty($this->AdminModel->permission(request()->segment(2)))) {
     return redirect('admin/permission-denied');
    }

     $data['menu'] = $this->AdminModel->all_fetch('menu',null);
     $data['page_title']  ='Backend Menu';
     return  view('admin.setting.menu',$data);

 }


function add_menu(Request $request, $id=false)
{

   $data['menu_list'] = $this->AdminModel->all_fetch('menu',array('parent_id'=>'0'));

 if($id) {

   $data['page_title'] = ' Edit Menu ';
   $data['form_action'] ='admin/add_menu/'.$id;
   $row = $this->AdminModel->fs('menu',array('id'=>$id));
   $data['name'] =  $row->name;
  $data['fafa'] =  $row->fafa;
  $data['link'] =  $row->link;
  $data['sort_order'] =  $row->sort_order;
  $data['status'] =  $row->status;
  $data['parent_id'] =  $row->parent_id;
   }else{

   $data['page_title'] = ' Add Menu';
   $data['form_action'] ='admin/add_menu';
   $data['name'] =  '';
   $data['fafa'] =  '';
   $data['link'] =  '';
   $data['sort_order'] =  '';
   $data['status'] =  '';
   $data['parent_id'] =  '';
   }


   if ($request->getMethod()=='POST') {

  $rules = [
    'name'=>'required',
  ];

   $request->validate($rules);

   $save= array();
   $save['name'] =     $request->input('name');
   $save['fafa'] =     $request->input('fafa');
   $save['link'] =     $request->input('link');
   $save['sort_order'] =     $request->input('sort_order');
   $save['status'] =     $request->input('status');
   if($request->input('parent_id')){
   $save['parent_id'] =     $request->input('parent_id');
   }


   if ($id) {
     $save['modify_date'] =   date('Y-m-d H:i:s');
     $result=  $this->AdminModel->updateData('menu',$save,array('id'=>$id));
     if ($result) {
        return redirect()->back()->with('success', 'Record Update successfully!');
     }else{
     return redirect()->back()->with('error', 'Record not update!');
     }
   }else{
     $save['create_date'] =   date('Y-m-d H:i:s');
     $save['modify_date'] =   date('Y-m-d H:i:s');
    $result=  $this->AdminModel->insertData('menu',$save);
     if ($result) {
        return redirect()->back()->with('success', 'Record insert successfully!');
     }else{
        return redirect()->back()->with('error', 'Record not insert!');
     }

   }

   }

 return  view('admin.setting.add_menu',$data);
}


function delete_menu(Request $request){
   $ids = $request->input('selected');
   if($ids){
   foreach($ids as $value){
   $this->AdminModel->deleteData('menu',array('id'=>$value));
   }
   session()->flash('success','Record Delete successfully');
  }
   return redirect('admin/menu');

}

///////////////////////////////

// user

function users(Request $request)
 {
    if(empty($this->AdminModel->permission($request->segment(2)))){
     return redirect('admin/permission-denied');
    }

     $data['detail'] = $this->AdminModel->all_fetch('admin',null);
     $users = $this->AdminModel->all_fetch('admin_group',null);
     foreach ($users as $key => $value) {
       $urlist[$value->id] = $value->name;
     }
     $data['user_list'] = $urlist;
     $data['page_title']  ='Users List';
     return view('admin.setting.user',$data);

 }


 function add_user(Request $request, $id=false)
 {

 $data['user_list'] = $this->AdminModel->all_fetch('admin_group',null);

  if(!empty($id)) {

    $data['page_title'] = ' Edit User';
    $data['form_action'] ='admin/add_user/'.$id;
    $row = $this->AdminModel->fs('admin',array('id'=>$id));
    $data['menu_id'] = json_decode($row->permission);
    $data['firstname'] =  $row->firstname;
    $data['lastname'] =  $row->lastname;
    $data['username'] =  $row->username;
    $data['email'] =  $row->email;
    $data['photo'] =  $row->photo;
    $data['status'] =  $row->status;
    $data['user_group_id'] =  $row->user_group_id;

    $this->form_user_id = $id;
    }else{

     $data['page_title'] = ' Add User';
     $data['form_action'] ='admin/add_user';
     $data['firstname'] =  '';
     $data['lastname'] =  '';
     $data['username'] = '';
     $data['email'] = '';
     $data['photo'] = '';
     $data['status'] = '';
     $data['menu_id'] = '';
     $data['user_group_id'] = '';

    }


  if($request->getMethod()=='POST'){

      $rules = [
        'username'=>'required',
        'firstname'=>'required',['firstname.required','First Name is required']
      ];

     $request->validate($rules);

      $save= array();
      $save['firstname'] =     $request->input('firstname');
      $save['lastname'] =     $request->input('lastname');
      $save['email'] =     $request->input('email');
      $save['status'] =     $request->input('status');
      $save['username'] =     $request->input('username');
       // $save['permission'] =     json_encode($request->input('permission'));
      $save['user_group_id'] =     $request->input('user_group_id');

       if (!empty($request->input('password'))) {
        $save['password'] = Hash::make($request->input('password'));
      }

      if (!empty($request->photo)) {
         $imageName = time().'.'.$request->photo->extension();
         $request->photo->move('uploads/images', $imageName);
         $save['photo'] = 'uploads/images/'.$imageName;
      }



      if ($id) {

          $save['modify_date'] =  date('Y-m-d');
          $result =  $this->AdminModel->updateData('admin',$save,array('id'=>$id));
          if ($result) {
          session()->flash('success','Record Update successfully');
          return redirect('admin/users');
          }else{
          session()->flash('error','Record not update');
          return redirect('admin/add_user/'.$id);
          }
      }else{
         $save['create_date'] =  date('Y-m-d');
          $save['modify_date'] =  date('Y-m-d');
         $result=  $this->AdminModel->insertData('admin',$save);
          if ($result) {

          session()->flash('success','Record insert successfully');
         return redirect('admin/users');
          }else{
          session()->flash('error','Record not insert');
         return redirect('admin/add_user');
          }

      }

   }

return view('admin.setting.add_user',$data);
}


function delete_users(Request $request)
{

    if ($request->isMethod('post')) {
     $id = $request->input('selected');
     $last_record = $this->AdminModel->all_fetch('admin',null);
     if (count($last_record) >= 2) {

      if ($id) {
          foreach ($id as $key => $value) {
           $this->AdminModel->deleteData('admin',array('id'=>$value));
          }
        }
       session()->flash('success','Record Delete successfully');

      }else{
      session()->flash('error','Last User can not be deleted');

    }
   }
  return redirect('admin/users');

}

//////////////////



function front_menu()
{
    if(empty($this->AdminModel->permission(request()->segment(2)))) {
        return redirect('admin/permission-denied');
       }

    $data['page_title']  = 'Frontend Menu Managment';
    $fetch_data          =  FrontMenuModel::paginate(10);
    $data['detail']      =  $fetch_data->withPath(url('/admin/front_menu'));
    return  view('admin.setting.front_menu', $data);

}

function add_front_menu(Request $request, $id = false)
{

//    $data['menu_list'] = $model->asObject()->where(array('parent_id'=>'0'))->findAll();
   $data['menu_list'] = FrontMenuModel ::where('parent_id',0)->get();

 if(@$id) {

   $data['page_title'] = ' Edit Front Menu ';
   $data['form_action'] ='admin/add_front_menu/'.$id;
   $row =  FrontMenuModel::firstWhere('id', $id);
   $data['name'] =  $row->name;
   $data['subTitle'] =  $row->subTitle;
   $data['description'] =  $row->description;
   $data['title'] =  $row->title;
    $data['image'] =  $row->image;
   $data['link'] =  $row->link;
   $data['sort_order'] =  $row->sort_order;
   $data['status'] =  $row->status;
   $data['parent_id'] =  $row->parent_id;
   $data['header'] =  $row->header;
   $data['footer'] =  $row->footer;
   $data['position'] =  $row->position;
   $data['sort_order_footer'] =  $row->sort_order_footer;
   $data['metaTitle'] =  $row->metaTitle;
   $data['metaKeyword'] =  $row->metaKeyword;
   $data['metaDescription'] =  $row->metaDescription;
   }else{

   $data['page_title'] = ' Add Front Menu';
   $data['form_action'] ='admin/add_front_menu';
   $data['name'] =  '';
   $data['subTitle'] =  '';
   $data['link'] =  '';
   $data['sort_order'] =  '';
   $data['title'] =  '';
   $data['status'] =  '';
   $data['parent_id'] =  '';
   $data['header'] =  '';
   $data['footer'] =  '';
   $data['position'] =  '';
   $data['sort_order_footer'] =  '';
   $data['metaTitle'] =  '';
   $data['metaKeyword'] =  '';
   $data['metaDescription'] = '';
   $data['image'] = '';
   $data['description'] = '';
   }

   if ($request->getMethod() == 'POST') {

   $rules = [
     'name'=>'required'
   ];

        $request->validate($rules);


       $save= array();
       $save['name'] =     $request->input('name');
       $save['subTitle'] =     $request->input('subTitle');
    //    $save['link'] =     $request->input('link');
       if($request->input('link')){
        $save['link']               =  $request->input('link');
        }else{
            $slug = Str::slug($request->input('name'), '-');
            $save['link']               =  $slug;
        }
       $save['sort_order'] =  $request->input('sort_order');
       $save['status'] =     $request->input('status');
       $save['parent_id'] =     $request->input('parent_id') ?  $request->input('parent_id') : 0;
       $save['title'] =     $request->input('title');
       $save['header'] =     $request->input('header');
       $save['footer'] =     $request->input('footer');
       $save['position'] =     $request->input('position');
       $save['metaTitle'] =     $request->input('metaTitle');
       $save['metaKeyword'] =     $request->input('metaKeyword');
       $save['metaDescription'] =     $request->input('metaDescription');
       $save['sort_order_footer'] =     $request->input('sort_order_footer');
       $save['description'] = $request->input('description');

       if (!empty($request->image)) {
        $imageName = time() .rand(). '.' . $request->image->extension();
        $request->image->move('uploads/images', $imageName);
        $save['image'] = 'uploads/images/' . $imageName;
    }


     if ($id) {
         $save['modify_date'] =   date('Y-m-d H:i:s');
         $save['id'] =  $id;
         $result = FrontMenuModel::where('id', $id)->update($save);

         if ($result) {
             return redirect()->back()->with('success', 'Record Update successfully!');
         } else {
             return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
         }
     }else{
       $save['create_date'] =   date('Y-m-d H:i:s');
       $save['modify_date'] =   date('Y-m-d H:i:s');
       $result = FrontMenuModel::create($save);
       if ($result) {
           return redirect()->back()->with('success', 'Record insert successfully!');
       } else {
           return redirect()->back()->with('error', 'Record not insert!');
       }

     }

  }
   return  view('admin.setting.add_front_menu', $data);

}



function delete_front_menu(){
   $model = new FrontMenuModel();
   $ids = $request->input('selected');
   foreach($ids as $value){
   $model->delete(array('id'=>$value));
   }
   $this->session->setFlashdata('success','Record Delete successfully');
   return redirect()->to('admin/front_menu');

}





}
