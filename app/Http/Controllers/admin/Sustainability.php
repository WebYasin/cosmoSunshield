<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\SustainabilityModel;
use App\Models\SustainabilityGoalModel;
use App\Models\SustainabilityHeadingModel;

use Illuminate\Http\Request;

class Sustainability extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }
     //Headings
     function sustainability_heading(Request $request)
     {

         if (empty($this->AdminModel->permission($request->segment(2)))) {
             return redirect('admin/permission-denied');
         }
         $data['detail']      = SustainabilityHeadingModel::get();
         $data['page_title']  = 'Sustainability Heading';
         $data['noImage']     = $this->noImage;

         return  view('admin.sustainability.sustainability_heading', $data);
     }

     function add_sustainability_heading(Request $request, $id = false)
     {

         if (!empty($id)) {
             $data['page_title']         = 'Edit Sustainability Heading';
             $data['form_action']        = 'admin/add_sustainability_heading/' . $id;
             $row                        =  SustainabilityHeadingModel::firstWhere('id', $id);
             $data['heading1']           =  $row->heading1;
             $data['description1']       =  $row->description1;
             $data['heading2']           =  $row->heading2;
             $data['description2']       =  $row->description2;
             $data['heading3']           =  $row->heading3;
             $data['description3']       =  $row->description3;
             $data['image2']             =  $row->image2;
             $data['status']             =  $row->status;
         } else {
             $data['page_title']         = 'Add Sustainability Heading';
             $data['form_action']        = 'admin/add_sustainability_heading';
             $data['heading1']           = '';
             $data['description1']       =  '';
             $data['heading2']           =  '';
             $data['description2']       =  '';
             $data['heading3']           =  '';
             $data['description3']       =  '';
             $data['image2']             =  '';
             $data['status']             =  '';
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
             $save['description2']       =  $request->input('description2');
             $save['heading3']           =  $request->input('heading3');
             $save['description3']       =  $request->input('description3');
             $save['status']             =  $request->input('status');

             if (!empty($request->image2)) {
                $imageName = time() .rand(). '.' . $request->image2->extension();
                $request->image2->move('uploads/images', $imageName);
                $save['image2'] = 'uploads/images/' . $imageName;
            }
             if ($id) {
                 $save['modify_date'] =  date('Y-m-d');
                 $result = SustainabilityHeadingModel::where('id', $id)->update($save);

                 if ($result) {
                     return redirect()->back()->with('success', 'Record Update successfully!');
                 } else {
                     return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                 }
             } else {
                 $save['create_date'] =  date('Y-m-d');
                 $save['modify_date'] =  date('Y-m-d');

                 $result =  SustainabilityHeadingModel::insertGetId($save);

                 if ($result) {
                     return redirect()->back()->with('success', 'Record insert successfully!');
                 } else {
                     return redirect()->back()->with('error', 'Record not insert!');
                 }
             }
         }

         return view('admin.sustainability.add_sustainability_heading', $data);
     }


    function sustainability_goal(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = SustainabilityGoalModel::get();
        $data['page_title']  = 'Sustainability Goal List';
        $data['noImage']     = $this->noImage;

        return  view('admin.sustainability.sustainability_goal', $data);
    }

    function add_sustainability_goal(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Sustainability Goal';
            $data['form_action']        = 'admin/add_sustainability_goal/' . $id;
            $row                        =  SustainabilityGoalModel::firstWhere('id', $id);
            $data['name']               =  $row->name;
            $data['description']        =  $row->description;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Sustainability Goal';
            $data['form_action']        = 'admin/add_sustainability_goal';
            $data['name']               = '';
            $data['description']        = '';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'           => 'required',
                'description'    => 'required',
                'image'          => 'image|max:1024'
            ];
            $request->validate($rules);

            $save = array();
            $save['name']               =  $request->input('name');
            $save['description']        =  $request->input('description');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = SustainabilityGoalModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  SustainabilityGoalModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.sustainability.add_sustainability_goal', $data);
    }

    function delete_sustainability_goal(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                SustainabilityGoalModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }

    function sustainability(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = SustainabilityModel::get();
        $data['page_title']  = 'Sustainability List';
        $data['noImage']     = $this->noImage;

        return  view('admin.sustainability.sustainability', $data);
    }

    function add_sustainability(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Sustainability';
            $data['form_action']        = 'admin/add_sustainability/' . $id;
            $row                        =  SustainabilityModel::firstWhere('id', $id);
            $data['name']               =  $row->name;
            $data['description']        =  $row->description;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Sustainability';
            $data['form_action']        = 'admin/add_sustainability';
            $data['name']               = '';
            $data['description']        = '';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'           => 'required',
                'description'    => 'required',
                'image'          => 'image|max:1024'
            ];
            $request->validate($rules);

            $save = array();
            $save['name']               =  $request->input('name');
            $save['description']        =  $request->input('description');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = SustainabilityModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  SustainabilityModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.sustainability.add_sustainability', $data);
    }

    function delete_sustainability(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                SustainabilityModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }
}
