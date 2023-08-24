<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerCategoryModel;
use App\Models\CareerModel;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\CareerHeadingModel;
use App\Models\CareerGalleryModel;
use Illuminate\Support\Str;

class Career extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key','config_icon')->first();
        $this->noImage = $default_img->value;
    }
    //Headings
    function career_heading(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = CareerHeadingModel::get();
        $data['page_title']  = 'Heading';
        $data['noImage']     = $this->noImage;

        return  view('admin.career.career_heading', $data);
    }

    function add_career_heading(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Heading';
            $data['form_action']        = 'admin/add_career_heading/' . $id;
            $row                        =  CareerHeadingModel::firstWhere('id', $id);
            $data['heading1']           =  $row->heading1;
            $data['description1']       =  $row->description1;
            $data['heading2']           =  $row->heading2;
            $data['heading2_1']         =  $row->heading2_1;
            $data['description2']       =  $row->description2;
            $data['name2']              =  $row->name2;
            $data['designation2']       =  $row->designation2;
            $data['img2']               =  $row->img2;
            $data['heading3']           =  $row->heading3;
            $data['description3']       =  $row->description3;
            $data['heading4']           =  $row->heading4;
            $data['description4']       =  $row->description4;
            $data['heading5']           =  $row->heading5;
            $data['description5']       =  $row->description5;
            $data['btn_name']           =  $row->btn_name;
            $data['btn_link']           =  $row->btn_link;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Heading';
            $data['form_action']        = 'admin/add_career_heading';
            $data['heading1']            = '';
            $data['description1']        = '';
            $data['heading2']            = '';
            $data['heading2_1']          = '';
            $data['description2']        = '';
            $data['name2']               = '';
            $data['designation2']        = '';
            $data['img2']                = '';
            $data['heading3']            = '';
            $data['description3']        = '';
            $data['heading4']            = '';
            $data['description4']        = '';
            $data['heading5']            = '';
            $data['description5']        = '';
            $data['btn_name']            = '';
            $data['btn_link']            = '';
            $data['status']              = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'heading1'          => 'required',
                'description1'      => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['heading1']           =  $request->input('heading1');
            $save['description1']       =  $request->input('description1');
            $save['heading2']           =  $request->input('heading2');
            $save['heading2_1']         =  $request->input('heading2_1');
            $save['description2']       =  $request->input('description2');
            $save['name2']              =  $request->input('name2');
            $save['designation2']       =  $request->input('designation2');
            $save['heading3']           =  $request->input('heading3');
            $save['description3']       =  $request->input('description3');
            $save['heading4']           =  $request->input('heading4');
            $save['description4']       =  $request->input('description4');
            $save['heading5']           =  $request->input('heading5');
            $save['description5']       =  $request->input('description5');
            $save['btn_name']           =  $request->input('btn_name');
            $save['btn_link']           =  $request->input('btn_link');
            $save['status']             =  $request->input('status');

            if (!empty($request->img2)) {
                $imageName = time() . rand() . '.' . $request->img2->extension();
                $request->img2->move('uploads/images', $imageName);
                $save['img2'] = 'uploads/images/' . $imageName;
            }


            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = CareerHeadingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  CareerHeadingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.career.add_career_heading', $data);
    }
     //Career Gallery
     function career_gallery(Request $request)
     {

         if (empty($this->AdminModel->permission($request->segment(2)))) {
             return redirect('admin/permission-denied');
         }
         $data['detail']      = CareerGalleryModel::get();
         $data['page_title']  = 'Career Gallery';
         $data['noImage']     = $this->noImage;
         return  view('admin.career.career_gallery', $data);
     }

     function add_career_gallery(Request $request, $id = false)
     {
         if (!empty($id)) {
             $data['page_title']     = 'Edit Career Gallery';
             $data['form_action']    = 'admin/add_career_gallery/' . $id;
             $row =  CareerGalleryModel::firstWhere('id', $id);
             $data['name']           =  $row->name;
             $data['status']         =  $row->status;
             $data['image']          =  $row->image;
             $data['sort_order']     =  $row->sort_order;
         } else {
             $data['page_title']     = 'Add Career Gallery';
             $data['form_action']    = 'admin/add_career_gallery';
             $data['name']           = '';
             $data['status']         = '';
             $data['sort_order']     = '';
             $data['image']          = '';
         }
         if ($request->getMethod() == 'POST') {
             $rules = [
                 'name'          => 'required',
                 'status'        => 'required',
                 'image'         => 'image|max:1024'
             ];
             $request->validate($rules);

             $save = array();
             $save['name']           =  $request->input('name');
             $save['status']         =  $request->input('status');
             $save['sort_order']     =  $request->input('sort_order');

            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }


             if ($id) {

                 $save['modify_date'] =  date('Y-m-d');
                 $result = CareerGalleryModel::where('id', $id)->update($save);

                 if ($result) {
                     return redirect()->back()->with('success', 'Record Update successfully!');
                 } else {
                     return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                 }
             } else {
                 $save['create_date'] =  date('Y-m-d');
                 $save['modify_date'] =  date('Y-m-d');

                 $result = CareerGalleryModel::create($save);
                 if ($result) {
                     return redirect()->back()->with('success', 'Record insert successfully!');
                 } else {
                     return redirect()->back()->with('error', 'Record not insert!');
                 }
             }
         }

         return view('admin.career.add_career_gallery', $data);
     }
    //Career Catgory
    function career_category(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = CareerCategoryModel::get();
        $data['page_title']  = 'Career Category';
        return  view('admin.career.career_category', $data);
    }

    function add_career_category(Request $request, $id = false)
    {
        if (!empty($id)) {
            $data['page_title']     = 'Edit Career Category';
            $data['form_action']    = 'admin/add_career_category/' . $id;
            $row =  CareerCategoryModel::firstWhere('id', $id);
            $data['name']           =  $row->name;
            $data['status']         =  $row->status;
            $data['sort_order']     =  $row->sort_order;
        } else {
            $data['page_title']     = 'Add Career Category';
            $data['form_action']    = 'admin/add_career_category';
            $data['name']           = '';
            $data['status']         = '';
            $data['sort_order']     = '';
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
            $save['sort_order']     =  $request->input('sort_order');


            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = CareerCategoryModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result = CareerCategoryModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.career.add_career_category', $data);
    }

    function career(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $fetch_data          =  CareerModel::paginate(10);
        $data['detail']      =  $fetch_data->withPath(url('/admin/career'));
        $data['page_title']  = 'Career List';
        return  view('admin.career.career', $data);
    }

    function add_career(Request $request, $id = false)
    {
        $data['all_category'] = CareerCategoryModel::get();
        if (!empty($id)) {
            $data['page_title']     = 'Edit Career';
            $data['form_action']    = 'admin/add_career/' . $id;
            $row =  CareerModel::firstWhere('id', $id);
            $data['title']              =  $row->title;
            $data['cat_id']             =  $row->cat_id;
            $data['description']        =  $row->description;
            $data['location']           =  $row->location;
            $data['remuneration']       =  $row->remuneration;
            $data['metaTitle']         =  $row->metaTitle;
            $data['metaKeyword']       =  $row->metaKeyword;
            $data['metaDescription']   =  $row->metaDescription;
            $data['status']             =  $row->status;
            $data['experience']         =  $row->experience;
            $data['skills']             =  $row->skills;
            $data['industry']           =  $row->industry;
            $data['slug']               =  $row->slug;
            $data['qualification']      =  $row->qualification;
            $data['show_in_career']     =  $row->show_in_career;
            $data['jobType']            =  $row->jobType;
            $data['sort_order']         =  $row->sort_order;

        } else {
            $data['page_title']         = 'Add Career';
            $data['form_action']        = 'admin/add_career';
            $data['cat_id']             = '';
            $data['title']              = '';
            $data['description']        = '';
            $data['location']           = '';
            $data['remuneration']       = '';
            $data['metaTitle']         = '';
            $data['metaKeyword']       = '';
            $data['metaDescription']   = '';
            $data['status']             = '';
            $data['experience']         = '';
            $data['skills']             = '';
            $data['industry']           = '';
            $data['slug']               = '';
            $data['qualification']      = '';
            $data['show_in_career']     = '';
            $data['jobType']            = '';
            $data['sort_order']         = '';
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
            $save['location']           =  $request->input('location');
            $save['description']        =  $request->input('description');
            $save['metaTitle']          =  $request->input('metaTitle');
            $save['metaKeyword']        =  $request->input('metaKeyword');
            $save['metaDescription']    =  $request->input('metaDescription');
            $save['experience']         =  $request->input('experience');
            $save['status']             =  $request->input('status');
            $save['skills']             =  $request->input('skills');
            $save['industry']           =  $request->input('industry');
            $save['remuneration']       =  $request->input('remuneration');
            $save['qualification']      =  $request->input('qualification');
            $save['show_in_career']     =  $request->input('show_in_career');
            $save['jobType']            =  $request->input('jobType');
            $save['sort_order']         =  $request->input('sort_order');


            if ($request->input('slug')) {
                $save['slug']               =  $request->input('slug');
            } else {
                $slug = Str::slug($request->input('title'), '-');
                $save['slug']               =  $slug;
            }




            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = CareerModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result = CareerModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.career.add_career', $data);
    }




    //end
}
