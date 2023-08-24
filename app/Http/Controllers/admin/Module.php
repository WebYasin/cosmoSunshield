<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestimonialModel;
use App\Models\BlogModel;
use App\Models\BlogCategoryModel;
use App\Models\CommonModel;
use Illuminate\Support\Str;


class Module extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
    }

    function testimonial(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = TestimonialModel::get();
        $data['page_title']  = 'Testimonial';
        return  view('admin.module.testimonial', $data);
    }

    function add_testimonial(Request $request, $id = false)
    {
        if (!empty($id)) {
            $data['page_title']     = 'Edit Testimonial';
            $data['form_action']    = 'admin/add_testimonial/' . $id;
            $row =  TestimonialModel::firstWhere('id', $id);
            $data['name']           =  $row->name;
            $data['description']    =  $row->description;
            $data['image']          =  $row->image;
            $data['designation']    =  $row->designation;
            $data['sort_order']     =  $row->sort_order;
            $data['status']         =  $row->status;
        } else {
            $data['page_title']     = 'Add Testimonial';
            $data['form_action']    = 'admin/add_testimonial';
            $data['name']           = '';
            $data['description']    = '';
            $data['image']          = '';
            $data['designation']    = '';
            $data['sort_order']     = '';
            $data['status']         = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'          => 'required',
                'designation'   => 'required',
                'description'   => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['name']           =  $request->input('name');
            $save['designation']    =  $request->input('designation');
            $save['description']    =  $request->input('description');
            $save['sort_order']     =  $request->input('sort_order');
            $save['status']         =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() .rand(). '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }


            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = TestimonialModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');
                // print_r($save);exit();
                $result = TestimonialModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.module.add_testimonial', $data);
    }

    function delete_testimonial(Request $request){
        $ids = $request->input('selected');
        if($ids){
        foreach($ids as $value){
            TestimonialModel::where('id',$value)->delete();
        }
        return redirect()->back()->with('success', 'Record Delete successfully!');
       }

     }
     //Blog Catgory
     function blog_category(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = BlogCategoryModel::get();
        $data['page_title']  = 'Blog Category';
        return  view('admin.module.blog_category', $data);
    }

    function add_blog_category(Request $request, $id = false)
    {
        if (!empty($id)) {
            $data['page_title']     = 'Edit Blog Category';
            $data['form_action']    = 'admin/add_blog_category/' . $id;
            $row =  BlogCategoryModel::firstWhere('id', $id);
            $data['name']           =  $row->name;
            $data['status']         =  $row->status;
        } else {
            $data['page_title']     = 'Add Blog Category';
            $data['form_action']    = 'admin/add_blog_category';
            $data['name']           = '';
            $data['status']         = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'          => 'required',
                'status'        => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['name']           =  $request->input('name');
            $save['status']         =  $request->input('status');




            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = BlogCategoryModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result = BlogCategoryModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.module.add_blog_category', $data);
    }
    //Blog
    function blog(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $fetch_data          =  BlogModel::paginate(10);
        $data['detail']      =  $fetch_data->withPath(url('/admin/blogs'));
        $data['page_title']  = 'Blog List';
        return  view('admin.module.blog', $data);
    }

    function add_blog(Request $request, $id = false)
    {
        $data['all_category'] = BlogCategoryModel::get();
        if (!empty($id)) {
            $data['page_title']     = 'Edit Blog';
            $data['form_action']    = 'admin/add_blog/' . $id;
            $row =  BlogModel::firstWhere('id', $id);
            $data['title']              =  $row->title;
            $data['cat_id']             =  $row->cat_id;
            $data['short_description']  =  $row->short_description;
            $data['description']        =  $row->description;
            $data['thumbnail']          =  $row->thumbnail;
            $data['image']              =  $row->image;
            $data['meta_title']         =  $row->meta_title;
            $data['meta_keyword']       =  $row->meta_keyword;
            $data['meta_description']   =  $row->meta_description;
            $data['status']             =  $row->status;
            $data['featured']           =  $row->featured;
            $data['related']            =  $row->related;
            $data['show_on_home']       =  $row->show_on_home;
            $data['slug']               =  $row->slug;
            $data['publish_date']       =  $row->publish_date;
        } else {
            $data['page_title']         = 'Add Blog';
            $data['form_action']        = 'admin/add_blog';
            $data['cat_id']             = '';
            $data['title']              = '';
            $data['description']        = '';
            $data['short_description']  = '';
            $data['thumbnail']          = '';
            $data['image']              = '';
            $data['meta_title']         = '';
            $data['meta_keyword']       = '';
            $data['meta_description']   = '';
            $data['status']             = '';
            $data['featured']           = '';
            $data['related']            = '';
            $data['show_on_home']       = '';
            $data['slug']               = '';
            $data['publish_date']       = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title'          => 'required',
                'cat_id'         => 'required',
                'description'    => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['cat_id']             =  $request->input('cat_id');
            $save['title']              =  $request->input('title');
            $save['short_description']  =  $request->input('short_description');
            $save['description']        =  $request->input('description');
            $save['meta_title']         =  $request->input('meta_title');
            $save['meta_keyword']       =  $request->input('meta_keyword');
            $save['meta_description']   =  $request->input('meta_description');
            $save['featured']           =  $request->input('featured');
            $save['status']             =  $request->input('status');
            $save['related']            =  $request->input('related');
            $save['show_on_home']       =  $request->input('show_on_home');
            $save['publish_date']       =  $request->input('publish_date');

            if($request->input('slug')){
            $save['slug']               =  $request->input('slug');
            }else{
                $slug = Str::slug($request->input('title'), '-');
                $save['slug']               =  $slug;
            }

            if (!empty($request->image)) {
                $imageName = time() .rand(). '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->thumbnail)) {
                $imageName = time() .rand(). '.' . $request->thumbnail->extension();
                $request->thumbnail->move('uploads/images', $imageName);
                $save['thumbnail'] = 'uploads/images/' . $imageName;
            }


            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = BlogModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result = BlogModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.module.add_blog', $data);
    }

    function delete_blog(Request $request){
        $ids = $request->input('selected');
        if($ids){
        foreach($ids as $value){
            BlogModel::where('id',$value)->delete();
        }
        return redirect()->back()->with('success', 'Record Delete successfully!');
       }

     }


     //controller end here
}
