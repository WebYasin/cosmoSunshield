<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\BackendModel;
use App\Models\CommonModel;
use App\Models\CatalogModel;

class Catalog extends Controller
{
    
    public function __construct()
    {
        $AdminModel = new CommonModel();
        $this->AdminModel = $AdminModel;
    }


    function category(Request $request){

        $AdminModel = new CommonModel();
        $data['page_title'] ='Category';
        $data['detail'] = $this->AdminModel->all_fetch('category',null);
        return view('admin.catalog.category',$data);
    }

   
    function delete_category(Request $request)
    {
       
    if ($request->getMethod()=='POST') {
      $id = $request->input('selected');
     if ($id) {
        foreach ($id as  $value) {
            $this->AdminModel->deleteData('category',array('id'=>$value));
        }
       session()->flash('success','Record Delete successfully');
     }else{
      session()->flash('error','Category can not be deleted it assign with a product');
     }     
    }
    return redirect('admin/category');  
  }

 
 function add_category(Request $request,$id=false){
    
   if($id) {
    
    $data['page_title'] = ' Edit Category';
    $data['form_action'] ='admin/add_category/'.$id;
    $row = $this->AdminModel->fs('category',array('id'=>$id));
    $data['name'] = $row->name;
    $data['description'] = $row->description; 
    $data['meta_title'] = $row->meta_title;
    $data['meta_description'] = $row->meta_description;
    $data['meta_keyword'] = $row->meta_keyword;
    $data['parent_id'] = $row->parent_id;
    $data['image'] = $row->image;
     $data['thumbnail'] = $row->thumbnail;
     $data['icon'] = $row->icon;
    $data['popular_category'] = $row->popular_category;
    $data['trending_category'] = $row->trending_category;
     $data['top'] = $row->top;
    $data['banner_id'] = $row->banner_id;
    $data['sort_order']=$row->sort_order;
    $data['status']=$row->status;
    $data['keyword']=$row->keyword;
    $data['banner_heading']=$row->banner_heading;

       
    }else{
    
    $data['page_title'] = ' Add Category';
    $data['form_action'] ='admin/add_category';
    $data['id'] = '';
    $data['trending_category'] = '';
    $data['name'] = '';
    $data['description'] = ''; 
    $data['meta_title'] = '';
    $data['meta_description'] = '';
    $data['meta_keyword'] = '';
    $data['parent_id'] = '';
    $data['image'] = '';
    $data['top'] = '';
    $data['banner_id'] = '';
    $data['sort_order']='';
    $data['status']='';
    $data['keyword']='';
    $data['icon'] = '';
    $data['thumbnail'] = '';
    $data['popular_category'] = '';
    $data['banner_heading']= '';
 

    }

    if($request->isMethod('post')){

        $validate = [
            'name' =>'required',['name.required' => 'Category name is required']
        ];

        $request->validate($validate);

     $save= array();
     $save['name'] =     $request->input('name');
      
      if(empty($request->input('keyword'))){
        $save['keyword'] =  sfu($request->input('name'));
      }else{
       $save['keyword'] =  sfu($request->input('keyword'));
      }
      
      $save['description'] =  $request->input('description');
      $save['meta_title'] =  $request->input('meta_title');
      $save['meta_description'] =  $request->input('meta_description');
      $save['meta_keyword'] =  $request->input('meta_keyword');
      $save['parent_id'] =  $request->input('parent_id');
      $save['sort_order'] =  $request->input('sort_order');
      $save['status'] =  $request->input('status');
     
      $save['popular_category'] =  $request->input('popular_category');
      $save['trending_category'] =  $request->input('trending_category');
      $save['banner_heading'] =  $request->input('banner_heading');
      
     
      // $request->validate([
      //       'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      //   ]);

        if (!empty($request->image)) {
          $imageName = time().'.'.$request->image->extension();  
          $request->image->move(public_path('images'), $imageName);
          // $request->image->move(public_path('images'), $imageName);
           $save['image'] = 'public/images/'.$imageName; 
        }
    
       

      if ($id) {
          $save['modify_date'] = date('Y-m-d H:i:s');
          $result=  $this->AdminModel->updateData('category',$save,array('id'=>$id));
          if ($result) {
         
          session()->flash('success','Record Update successfully');
         return  redirect('admin/add_category/'.$id);
          }else{
           session()->flash('error','Record not update');
          return redirect('admin/add_category/'.$id);
          }
      }else{
         $save['create_date'] = date('Y-m-d H:i:s');
         $save['modify_date'] = date('Y-m-d H:i:s');
         $result=  $this->AdminModel->insertData('category',$save);
          if ($result) {
        
           session()->flash('success','Record insert successfully');
          return redirect('admin/category');
          }else{
           session()->flash('error','Record not insert');
          return redirect('admin/add_category');
          }
       }

    }

    return view('admin/catalog/add_category',$data);


 }






}
